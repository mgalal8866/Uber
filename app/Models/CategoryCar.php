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
        // $localPath = public_path('files/users/' . $this->id . '/' . $this->image);
        // $urlPath = asset('files/users/' . $this->id . '/' . $this->image);

        // if (File::exists($localPath)) {
        //     if ($this->image == null) {
        //         return asset('assets/img/default_avatar.png');
        //     }
        //     return $urlPath;
        // } else {

        //     return
        return $this->image?path('category') . $this->image:  asset('assets/img/no-image.png');
    }
}
