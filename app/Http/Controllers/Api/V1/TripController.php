<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests\SignUp;
use App\Traits\MapsProcessing;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\AddAddressRequest;
use App\Models\Trip;
use App\Repositoryinterface\TripsRepositoryinterface;


class TripController extends Controller
{
use MapsProcessing;
    private $tripRepositry;
    public function __construct(TripsRepositoryinterface $tripRepositry)
    {
        $this->tripRepositry = $tripRepositry;
    }
    public function create() {
       return $this->tripRepositry->create();
    }
    public function accept(Trip $trip) {
        return $this->tripRepositry->accept($trip);
     }
    public function start(Trip $trip) {
       return $this->tripRepositry->start($trip);
    }
    public function end(Trip $trip) {
       return $this->tripRepositry->end($trip);
    }
    public function location(Trip $trip) {
       return $this->tripRepositry->location($trip);
    }
    public function get_price() {
       return $this->tripRepositry->get_price();
    }
    public function driver_trips($status) {
        return $this->tripRepositry->driver_trips($status);
     }
     public function user_trips($status) {
        return $this->tripRepositry->user_trips($status);
     }
}
