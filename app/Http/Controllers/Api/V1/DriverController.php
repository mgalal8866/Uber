<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests\SignUp;
use App\Traits\MapsProcessing;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\AddAddressRequest;
use App\Models\Trip;
use App\Repositoryinterface\DriverRepositoryinterface;
use App\Repositoryinterface\TripsRepositoryinterface;


class DriverController extends Controller
{
    use MapsProcessing;
    private $driverRepositry;
    public function __construct(DriverRepositoryinterface $driverRepositry)
    {
        $this->driverRepositry = $driverRepositry;
    }
    public function registration()
    {
        return $this->driverRepositry->registration();
    }
    public function services()
    {
        return $this->driverRepositry->services();
    }
    public function status_online()
    {
        return $this->driverRepositry->status_online();
    }
}
