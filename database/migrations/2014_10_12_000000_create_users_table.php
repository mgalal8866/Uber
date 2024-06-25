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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->decimal('balance',8,2)->default(0);
            $table->string('lat')->default(0);
            $table->string('long')->default(0);
            $table->boolean('accept_rules')->default(0);
            $table->boolean('is_online')->default(0);
            $table->enum('type', ['driver', 'user'])->default('user');
            $table->enum('status', ['accept', 'block', 'pending'])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
