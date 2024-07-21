<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class DriverResource extends JsonResource
{



    public function toArray(Request $request): array
    {

        return [
            'trip_id'                  => $this->id,
            'name'                     => $this->user->name,
            'phone'                    => $this->user->phone,
            'vehicle_image'            => $this->vehicle_imageurl,
            'driver_image'             => $this->user->imageurl,
            'vehicle_serial_number'    => $this->vehicle_serial_number,
            'color'                    => $this->color,
            'category'                 => $this->category?->name??'',
            'brand'                    => $this->brand->title,
            'model'                    => $this->model->title,
            'lat'                      => $this->user->lat,
            'long'                     => $this->user->long,
            'rating'                   =>  $this->user->rating? ($this->user->rating->sum('stars')/$this->user->rating->count()):'',

           ];
    }
}
