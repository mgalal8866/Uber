<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        return path2('users',$this->id)  . $this->image;
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
    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
    public function rating()
    {
        return $this->morphMany(Rating::class, 'ratingable');
    }

    public static function findToken($token)
    {
        $token = str_replace('Bearer ', '', $token); // Remove 'Bearer ' prefix if it exists
        $accessToken = PersonalAccessToken::findToken($token);

        if ($accessToken) {
            return $accessToken->tokenable; // Assuming tokenable is the User model
        }

        return null;
    }
}
