<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests\SignUp;
use App\Traits\MapsProcessing;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\AddAddressRequest;
use App\Models\Trip;
use App\Repositoryinterface\CarRepositoryinterface;
use App\Repositoryinterface\TripsRepositoryinterface;


class CarController extends Controller
{
use MapsProcessing;
    private $carRepositry;
    public function __construct(CarRepositoryinterface $carRepositry)
    {
        $this->carRepositry = $carRepositry;
    }
    public function brands() {
       return $this->carRepositry->brands();
    }
    public function model() {
       return $this->carRepositry->model();
    }


}
