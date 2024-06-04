<?php
namespace App\Repositoryinterface;

interface TripsRepositoryinterface{



    public function create();

    public function accept();
    public function start();
    public function end();
    public function get_price();




}

