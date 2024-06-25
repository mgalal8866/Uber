<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('user_id')->nullable()->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('category_id')->nullable()->references('id')->on('category_cars')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('charge_km')->nullable();
            $table->string('charge_min')->nullable();

            $table->foreignId('brand_id');
            $table->foreign('brand_id')->references('id')->on('car_brands')->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreignId('model_id');
            $table->foreign('model_id')->references('id')->on('car_models')->cascadeOnDelete()->cascadeOnUpdate();

            $table->string('color', 15);

            $table->year('release_year');

            $table->string('passengers_number')->nullable();

            $table->string('national_id_number')->nullable();
            $table->string('national_id_doc')->nullable();
            $table->string('driving_license_doc')->nullable();

            $table->string('vehicle_registration_doc')->nullable();
            $table->string('vehicle_insurance_doc')->nullable();
            $table->string('vehicle_serial_number')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
