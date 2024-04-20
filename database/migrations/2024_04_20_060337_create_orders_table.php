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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('frame_id')->nullable();  // Allow null if price applies to lens
            $table->unsignedBigInteger('lens_id')->nullable();  // Allow null if price applies to frame
            $table->decimal('total_price', 10, 2);
            $table->string('currency');

            $table->timestamps();

            // Foreign key constraints (optional)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('frame_id')->references('id')->on('frames')->onDelete('cascade');
            $table->foreign('lens_id')->references('id')->on('lenses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
