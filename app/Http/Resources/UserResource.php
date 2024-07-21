<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'name'     => $this->name??'',
            'phone'    => $this->phone??'',
            'image'    => $this->imageurl ?? '',
            'email'    => $this->email ?? '',
            'balance'  => $this->balance ?? '0',
            'status'   => $this->status??'',
            'type'     => $this->type??''

        ];
        if ($this->token) {
            $data['token'] = $this->token;
        }
        if ($this->type == 'driver' &&  $this->driver) {
            $data['driver']  =   [
                'driver_status'         => $this->driver->status,
                'driver_is_online'      => $this->is_online,
                'driver_balance'        => $this->driver->balance ?? '0',
                'driver_vehicle_image'  => $this->driver->vehicle_image
            ];
        }

        // if ($this->credit) {
        //     $data['creadit'] = $this->creadit;
        // }

        return $data;
    }
}
