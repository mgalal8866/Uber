<?php

namespace App\Repository;

use App\Models\Otp;
use App\Models\User;
use App\Models\UserCredit;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Traits\MapsProcessing;
use App\Traits\ImageProcessing;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\AddressResource;
use App\Http\Resources\CreditResource;
use App\Http\Resources\CreditResourceCollection;
use Illuminate\Database\Eloquent\Model;
use App\Repositoryinterface\CreditRepositoryinterface;

class DBCreditRepository implements CreditRepositoryinterface
{
    use ImageProcessing, MapsProcessing;

    protected Model $model;
    protected $request;

    public function __construct(UserCredit $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function credit_get()
    {
        $id = Auth::user()->id;
        $data['wallet'] = Auth::user()->balance;

        $credit = $this->model::where(['user_id' =>  $id])->orderby('is_default', 'desc')->get();
        if ($credit != null) {
            $data['credit'] = $credit;
            return Resp(new CreditResourceCollection($data), __('messages.success'), 200, true);
        }
    }
    public function credit_new()
    {

        $user = Auth::user();

        $data['user_id'] = $user->id;
        if ($this->request->has('name')) {
            $data['name'] = $this->request->name;
        }
        if ($this->request->has('number')) {
            $data['number'] = $this->request->number;
        }
        if ($this->request->has('exp_month')) {
            $data['exp_month'] = $this->request->exp_month;
        }
        if ($this->request->has('exp_year')) {
            $data['exp_year'] = $this->request->exp_year;
        }
        if ($this->request->has('cvc')) {
            $data['cvc'] = $this->request->cvc;
        }

         $data['is_default'] = 1;

         $this->model::where(['user_id' =>   $user->id, 'is_default' => 1])->update(['is_default' => 0]);
        $credit = $this->model::create($data);



        if ($credit != null) {
            return Resp(new CreditResource($credit), __('messages.success_credit_new'), 200, true);
        }
        return Resp('', 'error', 402, true);
    }
}
