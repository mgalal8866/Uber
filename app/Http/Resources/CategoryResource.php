<?php

namespace App\Http\Resources;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $user =     User::whereHas('credit',function($q){
            $q->where('is_default',1);
        })->find( Auth::user()->id);

        // }
        // dd($result);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->imageurl??'',
            'price' => number_format($price).' - ' . number_format( ($price*1.5)) . ' ر.س '    ,
            'price_int' => number_format($price).',' . number_format( ($price*1.5))  ,
            'time' =>  $time . ' / ' . $min,
            'time_int' =>  $result['min']??'' ,
            'km_int' =>  $result['km']??'',
            'origin_location' =>  $request->origin??'',
            'origin_addresses' =>  $response['origin_addresses'][0]??'',
            'destination_location' => $request->destination??'',
            'destination_address' =>  $response['destination_addresses'][0]??'',
            'payment' =>  $user !=null? (count($user->credit) > 0 ? __('trans.credit') : __('trans.cash')): __('trans.cash') ,

        ];
    }
}
