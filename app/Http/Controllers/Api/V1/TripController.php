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
    private $userRepositry;
    public function __construct(TripsRepositoryinterface $userRepositry)
    {
        $this->userRepositry = $userRepositry;
    }
    public function create() {
       return $this->userRepositry->create();
    }

}
