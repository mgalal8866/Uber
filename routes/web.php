<?php

use App\Models\Trip;
use GuzzleHttp\Client;
use App\Events\TripAccepted;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/', function () {
    // TripAccepted::dispatch('1');
    // $locations = [
    //     [
    //         'latitude' => '31.260262',
    //         'longitude' => '29.988416',
    //         'name' => 'loc1',
    //         'icon' => 'http://public.test/files/woman.png',
    //         'size_w' => 30,
    //         'size_h' => 40
    //     ],
    //     [
    //         'latitude' => '31.247963',
    //         'longitude' => '29.967503',
    //         'name' => 'loc1',
    //         'icon' => 'http://public.test/files/1.webp'
    //     ],


    //     [
    //         'latitude' => '31.266235',
    //         'longitude' => '29.989349',
    //         'name' => 'loc2',
    //         'icon' => 'http://public.test/files/1.webp'
    //     ]
    // ];

    // //  $locations = Trip::take(5)->get();
    // $locations = findNearbyDrivers('31.252717', '30.007483' );

    return view('welcome', compact('locations'));
});

Route::get('/qa1', function () {
    return findNearbyDrivers('31.252717', '30.007483');
});
Route::get('/qa', function () {
    function calculateDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371; // Earth's radius in km
        $deltaLat = deg2rad($lat2 - $lat1);
        $deltaLng = deg2rad($lng2 - $lng1);
        $a = sin($deltaLat / 2) * sin($deltaLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($deltaLng / 2) * sin($deltaLng / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;
        return $distance;
    }
    // $locations = [
    //     [
    //         'latitude' => '31.260262',
    //         'longitude' => '29.988416',
    //         'name' => 'loc1',
    //         'icon' => 'http://public.test/files/woman.png',
    //         'size_w' => 30,
    //         'size_h' => 40
    //     ],
    //     [
    //         'latitude' => '31.247963',
    //         'longitude' => '29.967503',
    //         'name' => 'loc1',
    //         'icon' => 'http://public.test/files/1.webp'
    //     ],
    //     [
    //         'latitude' => '31.266235',
    //         'longitude' => '29.989349',
    //         'name' => 'loc2',
    //         'icon' => 'http://public.test/files/1.webp'
    //     ]
    // ];
    $locations = Trip::take(190)->get()->toarray();
    // $locations = Trip::where('id', 1)->get()->toarray();

    function getDistancesFromGoogleMaps($startLat, $startLng, $locations)
    {
        $client = new Client();
        $apiKey =  env('GOOGLE_MAP_API_KEY');
        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$startLat},{$startLng}&destinations=";

        foreach ($locations as $location) {
            $parts = explode(',', $location['driver_location']);
            $url .= "{$parts[0]},{$parts[1]}|";
        }
        $url .= "&key={$apiKey}";
        $response = $client->get($url);
        $data = json_decode($response->getBody(), true);
        $distances = [];
        dd($data);
        if ($data['rows'][0]['elements'][0]['status'] != 'ZERO_RESULTS') {
            foreach ($data['rows'][0]['elements'] as $element) {
                $distances[] = $element['distance']['value']; // Distance in meters
            }
            return $distances;
        }
    }
    $closestLocations = [];
    $closestDistances = array_fill(0, 10, INF); // Array to track the 15 closest distances
    $numClosest = 2;
    $batches = array_chunk($locations, 500);

    foreach ($batches as $batch) {

        $distances =  getDistancesFromGoogleMaps('31.252717', '30.007483',  $batch);

        foreach ($distances as $key => $distance) {
            if ($distance < 5500) {
                $index = array_search(max($closestDistances), $closestDistances); // Get index of farthest among the closest
                if ($distance < $closestDistances[$index]) {
                    $closestLocations[$index] = $batch[$key]; // Replace the location with the closer one
                    $closestDistances[$index] = $distance; // Update the distance
                }
            }
        }
    }
    $closestDistances = array_map(function ($value) {
        return is_finite($value) ? $value : null;
    }, $closestDistances);

    return response()->json(['closest_locations' => $closestLocations, 'distances' => $closestDistances]);


    // $closestLocations = [];
    // $closestDistances = [];
    // // Calculate distance for each location
    // foreach ($locations as $location) {
    //     $distance = calculateDistance('31.260384', '29.983577', $location['latitude'], $location['longitude']);
    //     if (count($closestLocations) < 15) {
    //         $closestLocations[] = $location;
    //         $closestDistances[] = $distance;
    //     } else {
    //         // Find the farthest location among the current closest ones
    //         $farthestIndex = array_search(max($closestDistances), $closestDistances);
    //         // Replace the farthest location if the current one is closer
    //         if ($distance < $closestDistances[$farthestIndex]) {
    //             $closestLocations[$farthestIndex] = $location;
    //             $closestDistances[$farthestIndex] = $distance;
    //         }
    //     }
    // }


    // return response()->json(['closest_locations' => $closestLocations, 'distances' => $closestDistances]);


    // // echo calculateDistance('31.260262', '29.988416', '31.266235', '29.989349');
    // return distancematrix('31.260262,29.988416', '31.260384,29.983577');
});
