<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts  =
    [
        'origin'      => 'array',
        'destination' => 'array',
        'services'   => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function driver()
    {
        return $this->belongsTo(Driver::class,'driver_id');
    }
}
