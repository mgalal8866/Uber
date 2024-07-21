<?php

use App\Models\CategoryCar;
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

            // $table->foreignIdFor(CategoryCar::class)->nullable();
            // $table->integer('category_id')->references('id')->on('category_cars');
            $table->integer('category_id')->nullable();

            $table->text('origin_location')->nullable();
            $table->text('origin_address')->nullable();

            $table->text('destination_location')->nullable();
            $table->text('destination_address')->nullable();

            $table->string('distance')->nullable();

            $table->string('min')->nullable();
            $table->json('services')->nullable();

            $table->json('driver_location')->nullable();


            $table->string('canceled_by')->nullable();
            $table->json('comment_driver')->nullable();
            $table->json('comment_user')->nullable();

            $table->decimal('final_amount',8,2)->nullable();
            $table->text('suggested_amount')->nullable();
            $table->timestamp('is_searching')->nullable();
            $table->timestamp('is_accepted')->nullable();
            $table->timestamp('is_started')->nullable();
            $table->timestamp('is_completed')->nullable();
            $table->timestamp('is_cancel')->nullable();
            $table->string('payment_transaction')->nullable();
            $table->enum('payment_type',['cash','credit'])->nullable();
            $table->enum('status',['searching','accepted','started','completed','canceled'])->nullable();
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
