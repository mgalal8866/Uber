<?php

use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

if (!function_exists('findNearbyDrivers')) {
    function findNearbyDrivers($latitude, $longitude, $radius = 2)
    {
        $haversine = "(6371 * acos(cos(radians($latitude))
        * cos(radians(lat))
        * cos(radians(`long`)
        - radians($longitude))
        + sin(radians($latitude))
        * sin(radians(lat))))";



        return DB::table('users')
            ->select('id','lat','long', DB::raw("{$haversine} AS distance"))
            ->having('distance', '<', $radius)
            ->get();
    }
}

if (!function_exists('distancematrix')) {
    function distancematrix($origin, $destination)
    {
        $google_map_api_key = env('GOOGLE_MAP_API_KEY');
        $response = Http::get('https://maps.googleapis.com/maps/api/distancematrix/json', [
            'origins' => $origin,
            'destinations' => $destination,
            'key' => $google_map_api_key,
            'mode' => 'driving'
        ]);
        if ($response->successful()) {
            return $response->json();
        }
        return [
            'status' => 'error',
            'message' => 'Failed to retrieve distance matrix data.'
        ];
    }
}
function getsetting($cache, array $value)
{
    // Cache::forget($cache);
    $settings = Cache::rememberForever($cache, function () use ($value) {
        return Setting::whereIn('key', $value)->get();
    });

    $set =  $settings->pluck('value', 'key')->toarray();
    $data = array_map(function ($value) {
        if ($value === null) {
            return '';
        }
        return $value === null ? '' : $value;
    }, $set);
    return $data;
}
function Resp($data = null, $msg = null, $status = 200, $statusval = true)
{
    if ($status == 422) {
        return response()->json(['errors' => $data, 'msg' => $msg, 'status' => $status, 'statusval' => $statusval = false], $status);
    } elseif ($status != 200) {
        return response()->json(['msg' => $msg, 'status' => $status, 'statusval' => $statusval = false], $status);
    } else {
        return response()->json(['data' => $data, 'msg' => $msg, 'status' => $status, 'statusval' => $statusval], $status);
    }
}

function path($folder)
{
    $p =  '/files' . '/' . $folder;
    $path = asset($p);
    if (!File::exists($path)) {
        mkdir($path, 0777, true);
    }
    return  $path . '/';
}
function path2($folder,$folder2)
{
    $p =  '/files' . '/' . $folder.'/'.$folder2;
    $path = asset($p);
    if (!File::exists($path)) {
        mkdir($path, 0777, true);
    }
    return  $path . '/';
}
// function getSetting($key, $default = null)
// {
//     $setting = Setting::find($key);
//     return $setting ? $setting->value : $default;
// }

if (!function_exists('getSetting')) {
    function getSetting()
    {
        try {
            return app('getSetting');
        } catch (Exception $exception) {
            return false;
        }
    }
}
if (!function_exists('uploadfile')) {
    function uploadfile($file, $filePath)
    {
        // $file = $orginalfile;
        // $filename = time() . '.' . $file->extension();
        // $timestamp = 1706938020;
        // $datetime = date("Y-m-d H:i:s", $timestamp);
        // echo $datetime;
        // dd($datetime    );
        // $filePath = $this->path($CFC->id, 'courses');
        // if (!file_exists($filePath)) {
        //     mkdir($filePath, 0777, true);
        // }
        $filename =  $file->getClientOriginalName();;
        $file->storeAs($filePath, $filename, 'files');
        return $filename;
    }
}
