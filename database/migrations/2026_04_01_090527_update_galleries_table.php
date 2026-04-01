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
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn('branch_name');
            $table->unsignedBigInteger('contact_id')->after('id');
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->json('branch_name')->nullable();
            $table->dropForeign(['contact_id']);
            $table->dropColumn('contact_id');
        });
    }
};
