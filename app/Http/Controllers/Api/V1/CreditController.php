<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests\SignUp;
use App\Traits\MapsProcessing;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreditRequest;
use Illuminate\Support\Facades\Http;
use App\Repositoryinterface\CreditRepositoryinterface;

class CreditController extends Controller
{
use MapsProcessing;
    private $creditRepositry;
    public function __construct(CreditRepositoryinterface $creditRepositry)
    {
        $this->creditRepositry = $creditRepositry;
    }

    public function credit_new(CreditRequest $request) {
       return $this->creditRepositry->credit_new();
    }
    public function credit_get() {
       return $this->creditRepositry->credit_get();
    }

}
