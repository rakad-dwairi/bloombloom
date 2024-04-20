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
        Schema::create('frames', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->enum('status', ['active', 'inactive']);
            $table->integer('stock')->default(0);
            $table->enum('currency', ['usd', 'gbp', 'eur', 'jod', 'jpy']);
            $table->decimal('price', 10, 2);
            $table->timestamps();

            $table->unique(['currency', 'price']);
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frames');
    }
};
