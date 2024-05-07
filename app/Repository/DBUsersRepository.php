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
    public function credentials($data)
    {

        $credentials = [
            'phone' => $data['phone'],
            'password' =>  $data['password'],
        ];
        if ($token = Auth::guard('api')->attempt($credentials)) {
            $user = auth('api')->user();
        } else {
            return Resp('', 'Invalid Credentials', 404, false);
        }

        if ($token == null) {
            return Resp('', 'User Not found', 404, false);
        }
        // $user =  auth('api')->user();
        $user->token = $token;
        $data =  new LoginUserResource($user);
        return Resp($data, 'Success', 200, true);
    }
    public function login($request)
    {
        $data= ['phone'=>$request->phone,'password'=>$request->password];
     return  $this->credentials($data);
    }
    public function get_teamwork()
    {
        $data= User::whereTeamwork('1')->get();
     return   $data;
    }
    public function sendotp()
    {
        $code = rand(123456, 999999);
        return Resp($code, 'Success', 200, true);
    }

    public function signup($request)
    {

        $user =  User::create([
            'name'       => $request->name,
            'phone'      => $request->phone,
            'password'   => $request->password,
            'type'       => $request->type,
            'gender'     => $request->gender,
            'specialist_id' => $request->specialist_id,
            'city_id'    => $request->city_id,
            'area_id'    => $request->area_id,
            'description'    => $request->description,
            // 'image'    => $request->image,
        ]);
        if($request->image){

            $user->image = '';
            $user->save();
        }
        if ($user != null) {

            return $this->login($request);
        }
        return Resp('', 'error', 402, true);
    }
    public function profile_update($request)
    {

        $id = Auth::guard('api')->user()->id;
        $user =  User::find($id);

        if ($this->request->has('name')) {
            $user->name = $request->name;
        }


        $user->save();
        if ($user != null) {

            $data =  new LoginUserResource($user);
            return Resp($data, 'Success', 200, true);
        }
        return Resp('', 'error', 402, true);
    }
    public function profile_details()
    {

        $id = Auth::guard('api')->user()->id;
        $user =  User::find($id);
        if ($user != null) {

            $data =  new LoginUserResource($user);
            return Resp($data, 'Success', 200, true);
        }
        return Resp('', 'error', 402, true);
    }
    public function  forgotpassword($request)
    {
        $user =  $this->model->where('phone', $request->phone)->first();
        return Resp('', 'Send Code Success', 200, true);
    }
    public function  verificationcode($request)
    {
        if ($request->code == '11111') {
            return Resp('', 'Success', 200, true);
        } else {
            return Resp('', 'invalid Code', 400, false);
        }
    }

    public function  resend_code($request)
    {
        return Resp('', 'Send Code Success', 200, true);
    }
    public function  change_password($request)
    {
        $user =  $this->model->where('phone', $request->phone)->first();
        $user->password = $request->password;
        $user->save();
        $data= ['phone'=>$user->phone,'password'=>$request->password];
        return  $this->credentials($data);
        }
}
