<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'phone',
    //     'email',
    //     'password',
    // ];
    protected $guarded = [];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];



    public function getImageurlAttribute()
    {
        if($this->image ==null){

            return '';
        }
        return path($this->id,'users')  . $this->image;
    }
    public function otp()
    {
        return $this->hasMany(Otp::class);
    }
    public function myservice()
    {
        return $this->hasMany(MyServices::class);
    }
    public function driver()
    {
        return $this->hasOne(Driver::class);
    }
    public function address()
    {
        return $this->hasMany(UserAddress::class);
    }
    public function credit()
    {
        return $this->hasMany(UserCredit::class);
    }
}
