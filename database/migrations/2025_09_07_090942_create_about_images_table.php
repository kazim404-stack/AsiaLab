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
          Schema::create('about_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('about_us_id');
            $table->string('image');
            $table->timestamps();
            $table->foreign('about_us_id')->references('id')->on('about_us')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_images');
    }
};
