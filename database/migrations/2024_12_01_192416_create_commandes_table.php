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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string("numCom");
            $table->date("dateCom");
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text("location");
            $table->enum('status', ['pending', 'completed', 'canceled'])->default('pending');
            $table->decimal("totalPrix",10,2);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
