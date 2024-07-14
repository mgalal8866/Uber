<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{



    public function toArray(Request $request): array
    {

        return [
            'trip_id'                  => $this->id,
            'origin_location'          => $this->origin_location,
            'origin_address'           => $this->origin_address,

            'destination_location'     => $this->destination_location,
            'destination_address'      => $this->destination_address,

            'distance'                 => $this->distance,
            'min'                      => $this->min,
            'suggested_amount'         => $this->suggested_amount,
            'final_amount'             => $this->final_amount,

            'status'                   =>  $this->status,
            'driver'                   => $this->driver??'',
            'user'                   => $this->user??''
           ];
    }
}
