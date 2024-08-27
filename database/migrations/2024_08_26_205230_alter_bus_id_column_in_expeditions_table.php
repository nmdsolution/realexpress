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
        Schema::table('expeditions', function (Blueprint $table) {
            // Drop the foreign key constraint first
            $table->dropForeign(['bus_id']);

            // Change the column type
            $table->string('bus_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('expeditions', function (Blueprint $table) {
            // Revert the column type change
            $table->foreignId('bus_id')->constrained('buses')->cascadeOnDelete()->change();
        });
    }
};
