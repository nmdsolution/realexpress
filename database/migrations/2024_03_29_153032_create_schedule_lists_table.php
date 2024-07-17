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
        Schema::create('schedule_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bus_id')->constrained('buses')->cascadeOnDelete();
            $table->foreignId('from_location')->constrained('locations')->cascadeOnDelete();
            $table->foreignId('to_location')->constrained('locations')->cascadeOnDelete();
            $table->dateTime('departure_time')->nullable();
            $table->dateTime('arriver estimer')->nullable();
            $table->enum('status',['encour','impayer','non payer'])->default('encour');
            $table->integer('availability')->nullable();
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_lists');
    }
};
