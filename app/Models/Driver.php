<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function getVehicleImageAttribute()
    {
        if ($this->vehicle_insurance_doc == null) {

            return '';
        }

        return env('APP_URL') . '/storage/documents/' . ($this->user_id??$this->id) . '/' . $this->vehicle_insurance_doc;
    }
}
