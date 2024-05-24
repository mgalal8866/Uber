<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests\SignUp;
use App\Traits\MapsProcessing;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreditRequest;
use Illuminate\Support\Facades\Http;
use App\Repositoryinterface\CreditRepositoryinterface;
use App\Repositoryinterface\ExtraServicesRepositoryinterface;

class ExtraServicesController extends Controller
{
use MapsProcessing;
    private $servicesRepositry;
    public function __construct(ExtraServicesRepositoryinterface $servicesRepositry)
    {
        $this->servicesRepositry = $servicesRepositry;
    }

    public function services( ) {
       return $this->servicesRepositry->extra_services_get();
    }
    public function services_choose() {
       return $this->servicesRepositry->extra_services_choose();
    }

}
