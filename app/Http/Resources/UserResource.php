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
            'name'     => $this->name,
            'phone'    => $this->phone,
            'email'    => $this->email ?? '',
            'balance'  => $this->balance ?? '0',
            'lat'      => $this->live_lat ?? '0',
            'long'     => $this->live_long ?? '0',
            'address'  => AddressResource::collection($this->address),

        ];

        if ($this->token) {
            $data['token'] = $this->token;
        }
        // if ($this->credit) {
        //     $data['creadit'] = $this->creadit;
        // }

        return $data;
    }
}
