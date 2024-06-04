<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryCar extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function ScopeActive()
    {
        return $this->where('active',0);
    }
    public function driver()
    {
        return $this->hasMany(Driver::class,'category_id');
    }

    public function getImageurlAttribute()
    {
        return $this->image?path('category') . $this->image: path('').'no-imag.png';
    }
}
