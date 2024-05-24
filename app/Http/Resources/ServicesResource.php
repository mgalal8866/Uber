<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Traits\MapsProcessing;
use Illuminate\Http\Resources\Json\JsonResource;

class ServicesResource extends JsonResource
{


    public function toArray(Request $request): array
    {

        return [
            'id'          => $this->id,
            'name'          => $this->name,
            'check'          => $this->myservice->count()>0 ?1:0
        ];
    }
}
