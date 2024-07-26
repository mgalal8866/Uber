<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TripOldUserResource extends JsonResource
{



    public function toArray(Request $request): array
    {
        $user =     User::whereHas('credit', function ($q) {
            $q->where('is_default', 1);
        })->find($this->user->id);
        return [
            'trip_id'                  => $this->id,
            'date'                      => $this->created_at->translatedFormat('d/m/y H:i A'),
            'origin_address'           => $this->origin_address,
            'destination_address'      => $this->destination_address,
            'distance'                 => $this->distance . 'k.m',
            'min'                      => number_format($this->min, 2),
            'final_amount'             => $this->final_amount . ' ر.س ',
            'payment_type'             => $user != null ? (count($user->credit) > 0 ? __('trans.credit') : __('trans.cash')) : __('trans.cash'),
            'status'                   => $this->status,
            'name'                     => $this->driver->user->name,
            'driver_image'             =>  $this->driver->user->imageurl,
             'brand'                    => $this->driver->brand->title,
             'color'                    => $this->driver->color,

            // 'user'                     => $this->user? new UserResource($this->user):''
        ];
    }
}
