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
        Schema::table('commandes', function (Blueprint $table) {
            $table->string('tel')->nullable(); // Ajoute la colonne 'tel', vous pouvez le rendre nullable si vous ne voulez pas qu'il soit obligatoire

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->dropColumn('tel'); // Supprime la colonne 'tel' si la migration est annulée

        });
    }
};
