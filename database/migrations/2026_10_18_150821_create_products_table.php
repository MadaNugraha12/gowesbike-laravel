<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('brand');
            $table->decimal('price', 15, 2);
            $table->text('description');

            $table->string('groupset')->nullable();
            $table->string('brakes')->nullable();
            $table->string('wheelset')->nullable();
            $table->string('tires')->nullable();
            $table->string('crankset')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};