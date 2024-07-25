<?php

namespace App\Repository;


use App\Models\User;
use App\Models\MyServices;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Traits\MapsProcessing;
use App\Traits\ImageProcessing;

use Illuminate\Support\Facades\Auth;


use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\ServicesResource;
use App\Http\Resources\NotificationResource;
use App\Repositoryinterface\NotificationRepositoryinterface;

class DBNotificationRepository implements NotificationRepositoryinterface
{
    use ImageProcessing, MapsProcessing;

    protected Model $model;
    protected $request;

    public function __construct(Notification $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function my_notification()
    {
        $user_id = Auth::user()->id;

        $notifi = $this->model::where(function($query) use ($user_id) {
            $query->where('user_id', $user_id)
                  ->orWhereNull('user_id');
        })->get();
        
        if ($notifi != null) {
            return Resp(NotificationResource::collection($notifi), __('messages.success'), 200, true);
        }
    }

}
