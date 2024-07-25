<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class DriverAreaResource extends JsonResource
{



    public function toArray(Request $request): array
    {

        return [
            'lat'        => $this->lat,
            'long'       => $this->long,
            'area_name'  => $this->area_name,
            'address'    => $this->address,
            'radius'     => $this->radius,
           ];
    }
}
