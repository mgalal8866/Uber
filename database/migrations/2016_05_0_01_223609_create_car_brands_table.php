<?php

use App\Models\CarBrand;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends  Migration
{
    public function up()
    {
        Schema::create('car_brands', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('code',55);
            $table->string('title',55);
            $table->timestamps();
        });
        $data = json_decode(File::get(public_path('mar/car_brands.json')), true);
        foreach ($data as $value) {
            CarBrand::create($value);
        }
    }

    public function down()
    {
        Schema::dropIfExists('car_brands');
    }
};
