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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')->constrained()->cascadeOnDelete();
            $table->enum('paymentMethod', ['Cash on Delivery', 'Credit Card', 'PayPal'])->default('Cash on Delivery');
            $table->string('transaction_id')->unique();
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded', 'cancelled'])->default('pending');
            $table->softDeletes();
            $table->timestamps();
            /*
            pending : Le paiement a été créé mais n'est pas encore finalisé ou confirmé.
            completed : Le paiement a été réalisé avec succès et l'argent a été reçu.
            failed : Le paiement a échoué pour une raison quelconque (ex. erreur de transaction, fonds insuffisants, etc.).
            refunded : Le paiement a été remboursé à l'utilisateur.
            cancelled : Le paiement a été annulé avant ou après avoir été initié.
            */
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
