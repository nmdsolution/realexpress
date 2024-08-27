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
        Schema::table('locations', function (Blueprint $table) {
            // Drop the enum column and replace it with a string column
            $table->string('status')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            // If you want to revert back to the enum type, you can use this
            // Make sure to list all possible enum values
            $table->enum('status', ['diponible', 'fermer'])->nullable()->change();
        });
    }
};
