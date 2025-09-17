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
        Schema::table('testimonails', function (Blueprint $table) {
            $table->tinyInteger('rate')->after('image')->default(5);
        });
    }

    public function down(): void
    {
        Schema::table('testimonails', function (Blueprint $table) {
            $table->dropColumn('rate');
        });
    }
};
