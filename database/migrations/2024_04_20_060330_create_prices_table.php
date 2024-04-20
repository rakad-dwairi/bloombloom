<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->id();

            $table->enum('type', ['frame', 'lens']);

            $table->unsignedBigInteger('frame_id')->nullable();
            $table->unsignedBigInteger('lens_id')->nullable();
            
            $table->enum('currency', ['usd', 'gbp', 'eur', 'jod', 'jpy']);
            $table->decimal('price', 10, 2);
            $table->timestamps();
    
            $table->foreign('frame_id')->references('id')->on('frames')->onDelete('cascade');
            $table->foreign('lens_id')->references('id')->on('lenses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
