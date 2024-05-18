<?php

namespace App\Repository;

use App\Models\Otp;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Traits\ImageProcessing;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\AddressResource;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\LoginUserResource;
use App\Repositoryinterface\UsersRepositoryinterface;

class DBUsersRepository implements UsersRepositoryinterface
{
    use ImageProcessing;

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
        $otp = '111111';
        Otp::create(['phone' => $this->request->phone, 'otp' => $otp]);
        return Resp('', __('messages.success_send_otp'), 200, true);
    }



    public function signup()
    {
        $data = [
            'name'          => $this->request->name,
            'email'         => $this->request->email ?? null,
            'phone'         => $this->request->phone,
            'accept_rules'  => $this->request->accept_rule,
        ];
        $user =  User::create($data);
        if ($this->request->image) {
            $dataX = $this->saveImageAndThumbnail($this->request->image, false, $user->id, 'Users');
            $user->image =  $dataX['image'];
            $user->save();
        }

        $user->token = $user->createToken($user->name . '-AuthToken')->plainTextToken;
        if ($user != null) {
            return Resp(new UserResource($user), __('messages.success_signup'), 200, true);
        }
        return Resp('', 'error', 402, true);
    }
    public function profile()
    {
        $user = Auth::user();
        if ($user != null) {
            return Resp(new UserResource($user), __('messages.success'), 200, true);
        }
        return Resp('', 'error', 402, true);
    }
    public function address_new()
    {
        $user_id = Auth::user()->id;
        if ($this->request->is_default == 1) {
            Useraddress::where(['user_id' =>  $user_id, 'is_default' => 1])->update(['is_default' => 0]);
        }
        $address = UserAddress::create([
            'user_id' =>  $user_id,
            'name' => $this->request->name,
            'address' => $this->request->address,
            'lat' => $this->request->lat ?? '0',
            'long' => $this->request->long ?? '0',
            'is_default' => $this->request->is_default ?? '0'

        ]);
        if ($address != null) {
            return Resp(new AddressResource($address), __('messages.success'), 200, true);
        }
        return Resp('', 'error', 402, true);
    }
    public function address()
    {
        $user_id = Auth::user()->id;
        $address = UserAddress::where('user_id', $user_id)->get();
        if ($address != null) {
            return Resp(AddressResource::collection($address), __('messages.success'), 200, true);
        }
        return Resp('', 'error', 402, true);
    }
    public function profile_update()
    {

        $id = Auth::user()->id;
        $user =  User::find($id);
        if ($this->request->has('name')) {
            $user->name = $this->request->name;
        }
        if ($this->request->has('email')) {
            $user->email = $this->request->email;
        }
        if ($this->request->has('image')) {
            if ($user->image != null) {
               $this->deletefile($user->image, $user->id, 'Users');
            }
            $dataX = $this->saveImageAndThumbnail($this->request->image, false, $user->id, 'Users');
            $user->image =  $dataX['image'];
        }
        $user->save();
        if ($user != null) {
            return Resp(new UserResource($user), __('messages.success_update_profile'), 200, true);
        }
        return Resp('', 'error', 402, true);
    }
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
