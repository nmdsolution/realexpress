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
        Schema::create('expeditions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bus_id')->constrained('buses')->cascadeOnDelete(); // Corrected foreign key
            $table->string('from_location')->constrained('locations')->cascadeOnDelete();
            $table->string('to_location');
            $table->string('ref_no')->unique();
            $table->string('name');
            $table->integer('qty');
            $table->string('status');
            $table->decimal('prix', 10, 2);
            $table->decimal('valeur', 10, 2);
            $table->string('expeditair');
            $table->string('tel_expeditair');
            $table->string('destinatair');
            $table->string('tel_destinatair');
            $table->string('agent');
            $table->string('recu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expeditions');
    }
};
