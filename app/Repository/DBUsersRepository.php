<?php

namespace App\Repository;

use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\LoginUserResource;
use App\Repositoryinterface\UsersRepositoryinterface;

class DBUsersRepository implements UsersRepositoryinterface
{

    protected Model $model;
    protected $request;

    public function __construct(User $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }
    // public function credentials($data)
    // {

    //     $credentials = [
    //         'phone' => $data['phone'],
    //         'password' =>  $data['password'],
    //     ];
    //     if ($token = Auth::guard('api')->attempt($credentials)) {
    //         $user = auth('api')->user();
    //     } else {
    //         return Resp('', 'Invalid Credentials', 404, false);
    //     }

    //     if ($token == null) {
    //         return Resp('', 'User Not found', 404, false);
    //     }
    //     // $user =  auth('api')->user();
    //     $user->token = $token;
    //     $data =  new LoginUserResource($user);
    //     return Resp($data, 'Success', 200, true);
    // }

    public function verify_otp()
    {
        $otp =  Otp::where(['otp' => $this->request->code, 'verify' => 0])->orderBy('created_at', 'desc')->first();
        if ($otp == null) {
            return Resp('', __('messages.code_not_correct'), 400, true);
        }
        $user = User::where(['phone' => $otp->phone])->with(['address'])->first();
        if ($user != null) {
            $user->token = $user->createToken($user->name . '-AuthToken')->plainTextToken;
            return Resp(new UserResource($user), __('messages.success_login'), 200, true);
        } else {
            return Resp('', __('messages.notfound'), 400, false);
        }
    }
    public function send_otp()
    {
        $otp = rand(123456, 99999);
        Otp::create(['phone' => $this->request->phone, 'otp' => $otp]);
        return Resp('', __('messages.success_send_otp'), 200, true);
    }
    public function check_verfiy_otp($phone)
    {
        $user = User::where('phone', $this->request->phone)->first();
        if ($user != null) {
            $otp = rand(123456, 99999);
            $user->otp()->create(['otp', $otp]);
            return Resp('', __('messages.successignup'), 200, true);
        }
        return Resp('', __('messages.notfound'), 200, false);
    }


    public function signup()
    {

        $user =  User::create([
            'name'       => $this->request->name,
            'email'       => $this->request->email ?? null,
            'phone'      => $this->request->phone,
            'accept_rules'      => $this->request->accept_rule,
        ]);
        $user->token = $user->createToken($user->name . '-AuthToken')->plainTextToken;


        if ($user != null) {
            return Resp(new UserResource($user), __('messages.success_signup'), 200, true);
        }
        return Resp('', 'error', 402, true);
    }
    // public function profile_update($request)
    // {

    //     $id = Auth::guard('api')->user()->id;
    //     $user =  User::find($id);

    //     if ($this->request->has('name')) {
    //         $user->name = $this->request->name;
    //     }


    //     $user->save();
    //     if ($user != null) {

    //         $data =  new LoginUserResource($user);
    //         return Resp($data, 'Success', 200, true);
    //     }
    //     return Resp('', 'error', 402, true);
    // }
    // public function profile_details()
    // {

    //     $id = Auth::guard('api')->user()->id;
    //     $user =  User::find($id);
    //     if ($user != null) {

    //         $data =  new LoginUserResource($user);
    //         return Resp($data, 'Success', 200, true);
    //     }
    //     return Resp('', 'error', 402, true);
    // }
    // public function  forgotpassword($request)
    // {
    //     $user =  $this->model->where('phone', $this->request->phone)->first();
    //     return Resp('', 'Send Code Success', 200, true);
    // }
    // public function  verificationcode($request)
    // {
    //     if ($this->request->code == '11111') {
    //         return Resp('', 'Success', 200, true);
    //     } else {
    //         return Resp('', 'invalid Code', 400, false);
    //     }
    // }

    // public function  resend_code($request)
    // {
    //     return Resp('', 'Send Code Success', 200, true);
    // }
    // public function  change_password($request)
    // {
    //     $user =  $this->model->where('phone', $this->request->phone)->first();
    //     $user->password = $this->request->password;
    //     $user->save();
    //     $data= ['phone'=>$user->phone,'password'=>$this->request->password];
    //     return  $this->credentials($data);
    //     }
}
