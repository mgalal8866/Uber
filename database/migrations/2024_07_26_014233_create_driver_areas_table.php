<?php

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
        Schema::create('driver_areas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('driver_id')->nullable();
            $table->foreign('driver_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('lat')->nullable();
            $table->text('long')->nullable();
            $table->text('area_name')->nullable();
            $table->text('address')->nullable();
            $table->text('radius')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_areas');
    }
};
