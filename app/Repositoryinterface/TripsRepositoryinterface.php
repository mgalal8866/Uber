<?php
namespace App\Repositoryinterface;

interface TripsRepositoryinterface{



    public function create();

    public function accept($trip);
    public function start($trip);
    public function end($trip);
    public function rating($trip);
    public function location($trip);
    public function arrival_to_customer($trip);
    public function get_price();

    public function driver_trips($status);
    public function user_trips($status);





}

