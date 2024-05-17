<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'name'        => $this->name,
            'address'     => $this->address,
            'is_default'  => $this->Is_default,
            'lat'         => $this->lat,
            'long'        => $this->long,

        ];


        return $data;
    }
}
