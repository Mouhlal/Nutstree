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
        Schema::create('commandes_produits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')->constrained()->onDelete('cascade');
            $table->foreignId('produit_id')->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('prix', 10, 2);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes_produits');
    }
};
