<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\LoginUserResource;
use App\Repositoryinterface\UsersRepositoryinterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
    public function login()
    {
        $data= ['phone'=>$this->request->phone,'password'=>$this->request->password];
        $credentials = [
            'phone' => $data['phone'],
            'password' =>  $data['password'],
        ];
        if ($token = Auth::guard()->attempt($credentials)) {
            $user = User::where('phone', '=', $data['phone'])->first();
            $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;
            $data = [
                'name'       => $user->name,
                'email'       => $user->email,
                'phone'      => $user->phone,
                'access_token' => $token,
            ];
        } else {
            return Resp('', 'Invalid Credentials', 404, false);
        }

        if ($user != null) {
            return Resp($data, __('tan.successignup'), 200, true);
        }
    }

    public function sendotp()
    {
        $code = rand(123456, 999999);
        return Resp($code, 'Success', 200, true);
    }

    public function signup()
    {

        $user =  User::create([
            'name'       => $this->request->name,
            'email'       => $this->request->email,
            'phone'      => $this->request->phone,
            'password'   => $this->request->password,
        ]);
        $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;

        $data = [
            'name'       => $user->name,
            'email'       => $user->email,
            'phone'      => $user->phone,
            'access_token' => $token,
        ];
        if ($user != null) {
            return Resp($data, __('tan.successignup'), 200, true);
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
