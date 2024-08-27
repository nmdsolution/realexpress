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
        Schema::create('depenses', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('agence', 100); // Type of expense (e.g., Taxi, Water, etc.)
            $table->decimal('montant', 10, 2); // Amount of the expense
            $table->date('date_depense'); // Date of the expense
            $table->text('description')->nullable(); // Description or notes
            $table->string('justificatif', 255)->nullable(); // Path to the receipt or invoice
            $table->string('moyen_paiement')->nullable(); // Payment metho
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depenses');
    }
};
