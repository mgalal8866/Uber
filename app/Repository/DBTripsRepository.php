<?php

namespace App\Repository;

use App\Http\Resources\CategoryResource;
use App\Models\CategoryCar;
use App\Models\Trip;
use App\Models\User;

use Illuminate\Http\Request;
use App\Traits\MapsProcessing;
use App\Traits\ImageProcessing;

use Illuminate\Database\Eloquent\Model;
use App\Repositoryinterface\TripsRepositoryinterface;


class DBTripsRepository implements TripsRepositoryinterface
{
    use ImageProcessing,MapsProcessing;

    protected Model $model;
    protected $request;

    public function __construct(Trip $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }
    public function start()
    {

    }
    public function accept()
    {

    }
    public function get_price()
    {
        $this->request->validate([
            'origin' => 'required',
            'destination' => 'required',
        ]);
        $category = CategoryCar::active()->get();
       return CategoryResource::collection($category , $this->request->origin, $this->request->destination);

    }
    public function create()
    {
        $this->request->validate([
            'origin' => 'required',
            'destination' => 'required',
            'destination_name' => 'required'
        ]);

        $trip = $this->request->user()->trips()->create( $this->request->only([
            'origin',
            'destination',
            'destination_name'
        ]));

        // TripAccepted::dispatch($trip, $trip->user);
        // return  $this->model;
        return Resp('', __('messages.success'), 200, true);
    }
    public function end()
    {

    }

}
