<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraServices extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function ScopeActive()
    {
        return $this->where('active',0);
    }
    public function myservice()
    {
        return $this->hasMany(MyServices::class,'service_id');
    }
}
