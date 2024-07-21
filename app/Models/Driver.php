<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function brand()
    {
        return $this->belongsTo(CarBrand::class);
    }
    public function category()
    {
        return $this->belongsTo(CategoryCar::class);
    }
    public function model()
    {
        return $this->belongsTo(CarModel::class);
    }
    public function rating()
    {
        return $this->morphMany(Rating::class, 'ratingable');
    }
    public function getVehicleImageAttribute()
    {
        if ($this->vehicle_image == null) {

            return '';
        }

        return env('APP_URL') . '/storage/documents/' . ($this->user_id??$this->id) . '/' . $this->vehicle_image;
    }
   
}
