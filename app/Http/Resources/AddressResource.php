<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Traits\MapsProcessing;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{


    public function toArray(Request $request): array
    {
        if ($request->has('lat') && $request->has('lat') &&  !empty($request->lat) &&  !empty($request->long)) {
            $response = distancematrix($this->lat . ',' . $this->long, ($request->lat ?? $this->lat) . ',' . ($request->long ?? $this->long));
            $response = $response['rows'][0]['elements'][0]['distance']['text'] . ',' . $response['rows'][0]['elements'][0]['duration']['text'];
        }



        return [
            'name'        => $this->name,
            'address'     => $this->address,
            'distance'    =>  $response??'',



        ];
    }
}
