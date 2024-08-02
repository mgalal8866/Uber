<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use App\Support\HasAdvancedFilter;
use Illuminate\Support\Facades\File;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasAdvancedFilter,HasFactory, Notifiable;

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
    public $orderable = [
        'id',
        'name',
    ];
    public $filterable = [
        'id',
        'name',
        'phone',
    ];
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

        $localPath = public_path('files/users/' . $this->id . '/' . $this->image);
        $urlPath = asset('files/users/' . $this->id . '/' . $this->image);

        if (File::exists($localPath)) {
            if ($this->image == null) {
                return asset('assets/img/default_avatar.png');
            }
            return $urlPath;
        } else {

            return asset('assets/img/default_avatar.png');
        }
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
    public function trips_user()
    {
        return $this->hasMany(Trip::class, 'user_id');
    }
    public function trips_driver()
    {
        return $this->hasMany(Trip::class, 'driver_id');
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
