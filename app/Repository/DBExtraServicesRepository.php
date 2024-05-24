<?php

namespace App\Repository;


use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ExtraServices;
use App\Traits\MapsProcessing;
use App\Traits\ImageProcessing;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\CreditResource;
use App\Http\Resources\AddressResource;
use Illuminate\Database\Eloquent\Model;

use App\Http\Resources\ServicesResource;
use App\Models\MyServices;
use App\Repositoryinterface\ExtraServicesRepositoryinterface;

class DBExtraServicesRepository implements ExtraServicesRepositoryinterface
{
    use ImageProcessing, MapsProcessing;

    protected Model $model;
    protected $request;

    public function __construct(ExtraServices $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function extra_services_get()
    {
        $id = Auth::user()->id;
        $user = User::with('driver')->find($id);
        $is_user = ($user->driver ? 1 : 0);
        $services = $this->model::active()->where(['isuser' =>  $is_user, 'isuser' => null])->with(['myservice' => function ($q) use ($id) {
                $q->where('user_id', $id);
            }])->get();

        if ($services != null) {
            return Resp(ServicesResource::collection($services), __('messages.success'), 200, true);
        }
    }
    public function extra_services_choose()
    {

        $user_id = Auth::user()->id;
        foreach ($this->request->ids as $id) {
            $myservice = MyServices::updateOrCreate(
                ['user_id' => $user_id, 'service_id' => $id],
                ['user_id' => $user_id, 'service_id' => $id]
            );
        }
        if ( $myservice != null) {
            return Resp('', __('messages.success'), 200, true);
        }
        return Resp('', 'error', 402, true);
    }
}
