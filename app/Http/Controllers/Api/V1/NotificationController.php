<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests\SignUp;
use App\Traits\MapsProcessing;
use App\Http\Controllers\Controller;
use App\Http\Requests\notifiRequest;
use Illuminate\Support\Facades\Http;
use App\Repositoryinterface\notifiRepositoryinterface;
use App\Repositoryinterface\NotificationRepositoryinterface;

class NotificationController extends Controller
{

    private $notifiRepositry;
    public function __construct(NotificationRepositoryinterface $notifiRepositry)
    {
        $this->notifiRepositry = $notifiRepositry;
    }


    public function notifi_get() {
       return $this->notifiRepositry->my_notification();
    }

}
