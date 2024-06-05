<?php

use App\Models\User;
use App\Models\Driver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignIdFor(User::class);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreignIdFor(Driver::class)->nullable();
            $table->foreign('driver_id')->references('id')->on('users');
            $table->timestamp('is_started')->nullable();
            $table->timestamp('is_complete')->nullable();
            $table->json('origin')->nullable();
            $table->json('destination')->nullable();
            $table->json('services')->nullable();
            $table->string('destination_name')->nullable();
            $table->json('driver_location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
