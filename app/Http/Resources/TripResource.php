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
            'origin_location'          => $this->request->origin_location,
            'origin_address'           => $this->request->origin_address,

            'destination_location'     => $this->request->destination_location,
            'destination_address'      => $this->request->destination_address,

            'distance'                 => $this->request->distance,
            'min'                      => $this->request->min,
            'suggested_amount'         => $this->request->suggested_amount,
            'final_amount'             => $this->request->final_amount,

            'status'                   => 'searching',

        ];
    }
}
