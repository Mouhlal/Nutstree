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
        Schema::create('code_promos', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Le code promo
            $table->decimal('discount', 8, 2); // Le pourcentage de réduction
            $table->softDeletes();
            $table->timestamp('expires_at')->nullable(); // Date d'expiration (facultatif)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('code_promos');
    }
};
