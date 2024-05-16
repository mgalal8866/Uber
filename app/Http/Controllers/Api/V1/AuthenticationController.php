<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Repositoryinterface\UsersRepositoryinterface;

class AuthenticationController extends Controller
{

    private $userRepositry;
    public function __construct(UsersRepositoryinterface $userRepositry)
    {
        $this->userRepositry = $userRepositry;
    }

    public function signup() {
       return $this->userRepositry->signup();
    }
    public function login() {
       return $this->userRepositry->login();
    }
}
