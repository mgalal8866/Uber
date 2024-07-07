<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{



    public function toArray(Request $request): array
    {
        // if ($request->has('lat') && $request->has('lat') &&  $request->lat != '' &&   $request->long != '' && $this->lat != null  && $this->long != null  ) {
        $response = distancematrix($request->origin, $request->destination);

        $result['km'] = $response['rows'][0]['elements'][0]['distance']['value']/1000;
        $result['min'] = $response['rows'][0]['elements'][0]['duration']['value']/60;
        $price = ($this->charge_km * $result['km'] )+($this->charge_min * $result['min'] ) + 4 ;
        $time = Carbon::now()->addMinutes($result['min'])->translatedFormat('H:i A');
        $min =  number_format($result['min'] ) .' دقائق ' ;
        // }
        // dd($result);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->imageurl??'',
            'price' => number_format($price).' - ' . number_format( ($price*1.5)) . ' ر.س '    ,
            'time' =>  $time . ' / ' . $min,
            'time_int' =>  $result['min']??'' ,
            'km_int' =>  $result['km']??'',
            'origin_address' =>  $response['rows']??'',
            'destination_address' =>  $result['km']??'',
        ];
    }
}
