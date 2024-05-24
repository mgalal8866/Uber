<?php

namespace App\Models;

use App\Models\User;
use App\Models\ExtraServices;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MyServices extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function service()
    {
        return $this->belongsTo(ExtraServices::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
