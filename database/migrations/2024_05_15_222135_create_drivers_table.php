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
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('category_id')->nullable()->references('id')->on('category_cars')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('charge_km');
            $table->string('charge_min');
            $table->string('year')->nullable();
            $table->string('color')->nullable();
            $table->string('model')->nullable();
            $table->string('number')->nullable();
            $table->json('license_files')->nullable();
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
