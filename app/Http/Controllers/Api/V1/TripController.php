<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests\SignUp;
use App\Traits\MapsProcessing;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\AddAddressRequest;
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
    public function get_price() {
       return $this->tripRepositry->get_price();
    }

}
