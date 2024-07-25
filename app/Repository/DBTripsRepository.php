<?php

namespace App\Repository;

use Carbon\Carbon;
use App\Models\Trip;
use App\Models\User;
use App\Events\TripEnded;
use App\Events\TripCreated;
use App\Models\CategoryCar;
use App\Events\TripAccepted;
use Illuminate\Http\Request;
use App\Traits\MapsProcessing;

use App\Traits\ImageProcessing;
use App\Http\Resources\TripResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\CategoryResource;
use App\Models\Rating;
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
            'origin_location'       => 'required',
            'origin_address'        => 'required',
            'destination_location'  => 'required',
            'destination_address'   => 'required',
            'min'                   => 'required',
            'distance'              => 'required',
            'suggested_amount'      => 'required',
            'category_id'           => 'required'
        ]);

        $trip = $this->request->user()->trips()->create([
            'origin_location'          => $this->request->origin_location,
            'origin_address'           => $this->request->origin_address,
            'destination_location'     => $this->request->destination_location,
            'destination_address'      => $this->request->destination_address,
            'category_id'               => $this->request->category_id,
            'min'                      => $this->request->min,
            'distance'                 => $this->request->distance,
            'suggested_amount'         => $this->request->suggested_amount,
            'payment_type'              => (count($this->request->user()->credit) > 0 ? 'credit' : 'cash'),
            'status'                   => 'searching',
            'is_searching'             => Carbon::now(),
        ]);

        TripCreated::dispatch($trip);
        return Resp(new TripResource($trip), __('messages.success'), 200, true);
    }
    public function start($trip)
    {
        $trip->update([
            'is_started' => Carbon::now(),
            'status'     => 'started',
        ]);
        $trip->load(['driver.user', 'driver']);
        TripAccepted::dispatch($trip);
        return Resp(new TripResource($trip), __('messages.success'), 200, true);
    }
    public function arrival_to_customer($trip)
    {

        return Resp('', __('messages.success'), 200, true);
    }
    public function accept($trip)
    {


        $trip->update([
            'driver_id'   => Auth::user()->id,
            'is_accepted' => Carbon::now(),
            'status'      => 'accepted',
        ]);

        $trip->load(['user', 'driver','user.rating', 'driver.model','driver.brand','driver.user.rating']);
        TripAccepted::dispatch($trip);
        return Resp(new TripResource($trip), __('messages.success'), 200, true);
    }
    public function rating($trip)
    {

        Rating::Create([
            'trip_id'           => $trip->id,
            'user_id'           => Auth::user()->id,
            'ratingable_id'     => $trip->driver_id,
            'ratingable_type'   => User::class,
            'body'              => $this->request->body ?? '',
            'stars'             => $this->request->stars ?? ''
        ]);

        return Resp('', __('messages.success'), 200, true);
    }
    public function end($trip)
    {
        $trip->update([
            'is_completed' => Carbon::now(),
            'status'     => 'completed',
        ]);
        $trip->load(['driver.user', 'driver']);
        TripEnded::dispatch($trip);
        return Resp(new TripResource($trip), __('messages.success'), 200, true);
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
        return Resp(new TripResource($trip), __('messages.success'), 200, true);
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
    public function driver_trips($status)
    {

        $trip =  $this->model->where(['user_id' => Auth::user()->id])->where('status', '=', $status)->get();
        return Resp(TripResource::collection($trip), __('messages.success'), 200, true);
    }
    public function user_trips($status)
    {
        $trip =  $this->model->where(['user_id' => Auth::user()->id, 'status' => $status])->get();
        return Resp(TripResource::collection($trip), __('messages.success'), 200, true);
    }
}
