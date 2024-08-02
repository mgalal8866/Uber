<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trip extends Model
{
    use HasFactory,HasAdvancedFilter;
    protected $guarded = [];
    protected $casts  =
    [
        'origin'      => 'array',
        'destination' => 'array',
        'services'   => 'array',
    ];
    public $orderable = [
        'id',
        'user',
        'driver',
    ];
    public $filterable = [
        'id',
        'user.name',
        'driver.user.name',
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
