<?php
namespace App\Repositoryinterface;

interface UsersRepositoryinterface{


    public function login($request);
    public function signup($request);
    public function profile_update($request);
    public function profile_details();
    public function verificationcode($request);
    public function forgotpassword($request);
    public function change_password($request);
    public function resend_code($request);


}

