<?php

namespace App\Repository;

use Carbon\Carbon;
use App\Models\Trip;
use App\Models\User;
use App\Events\TripCreated;

use App\Models\CategoryCar;
use Illuminate\Http\Request;
use App\Traits\MapsProcessing;

use App\Traits\ImageProcessing;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\CategoryResource;
use App\Repositoryinterface\TripsRepositoryinterface;

class DBTripsRepository implements TripsRepositoryinterface
{
    use ImageProcessing, MapsProcessing;

    protected Model $model;
    protected $request;

    public function __construct(Trip $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }
    public function create()
    {
        $this->request->validate([
            'origin' => 'required',
            'destination' => 'required',
            'category_id' => 'required'
        ]);

        $trip = $this->request->user()->trips()->create([
            'origin'       => $this->request->origin,
            'destination'  => $this->request->destination,
            'category_id'  => $this->request->category_id,
            'services'     => $this->request->services,
        ]);

        TripCreated::dispatch($trip, $this->request->user());
        return Resp('', __('messages.success'), 200, true);
    }
    public function start($trip)
    {
        $trip->update([
            'is_started' => Carbon::now(),
        ]);
        $trip->load('driver.user');
        return   $trip;
    }
    public function accept($trip)
    {
        $this->request->validate([
            'driver_location' => 'required',
        ]);

        $trip->update([
            'driver_id' => $this->request->user()->id,
            'driver_location' => $this->request->driver_location,
        ]);

        $trip->load('driver.user');
        return   $trip;
    }
    public function end($trip)
    {

        $trip->update([
            'is_complete' => Carbon::now(),
        ]);
        $trip->load('driver.user');
        return   $trip;
    }
    public function location($trip)
    {
        $this->request->validate([
            'driver_location' => 'required',
        ]);

        $trip->update([
            'driver_location' => $this->request->driver_location,
        ]);

        $trip->load('driver.user');
        return   $trip;
    }

    public function get_price()
    {
        $this->request->validate([
            'origin' => 'required',
            'destination' => 'required',
        ]);
        $category = CategoryCar::active()->get();
        return CategoryResource::collection($category, $this->request->origin, $this->request->destination);
    }
}
