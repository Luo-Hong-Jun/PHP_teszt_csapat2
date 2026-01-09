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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('Name')->nullable();
            $table->integer('Cylinders')->nullable();
            $table->float('Miles_per_Gallon')->nullable();
            $table->float('Horsepower')->nullable();
            $table->float('Weight_in_lbs')->nullable();
            $table->float('Acceleration')->nullable();
            $table->date('Year')->nullable();
            $table->string('Origin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
