<?php

use App\Models\CarModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('car_models', function (Blueprint $table) {
            $table->id();
            $table->string('code',125);
            $table->string('title',125);
            $table->foreignId('car_brand_id');
            $table->foreign('car_brand_id')->references('id')->on('car_brands')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });

        $data = json_decode(File::get(public_path('mar/car_models.json')), true);
        foreach ($data as $value) {
            CarModel::create($value);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_models');
    }
};
