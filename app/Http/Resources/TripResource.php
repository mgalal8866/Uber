<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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

            'distance'                 => $this->distance . 'k.m',
            'min'                      => $this->min,
            'time_arrival'             => Carbon::now()->addMinutes($this->min)->translatedFormat('H:i A'),
            'suggested_amount'         => $this->suggested_amount . 'ر.س',
            'final_amount'             => $this->final_amount,

            'status'                   => $this->status,
            'driver'                   => $this->driver ? new DriverResource($this->driver):'',
            'user'                     => $this->user? new UserResource($this->driver):''
           ];
    }
}
