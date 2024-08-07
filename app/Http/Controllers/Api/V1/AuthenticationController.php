<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests\SignUp;
use App\Traits\MapsProcessing;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\AddAddressRequest;
use App\Repositoryinterface\UsersRepositoryinterface;

class AuthenticationController extends Controller
{
use MapsProcessing;
    private $userRepositry;
    public function __construct(UsersRepositoryinterface $userRepositry)
    {
        $this->userRepositry = $userRepositry;
    }
    public function signup(SignUp $request) {
       return $this->userRepositry->signup();
    }
    public function send_otp() {
       return $this->userRepositry->send_otp();
    }
    public function verify_otp() {
       return $this->userRepositry->verify_otp();
    }
    public function profile() {
       return $this->userRepositry->profile();
    }
    public function profile_update() {
       return $this->userRepositry->profile_update();
    }
    public function address_new(AddAddressRequest $request) {
       return $this->userRepositry->address_new();
    }

    public function addressdelete($id) {
       return $this->userRepositry->addressdelete($id);
    }
    public function address() {
       return $this->userRepositry->address();
    }
}
