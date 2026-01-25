<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('credit_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->onDelete('cascade');
            
            // Card info (tokenized/masked)
            $table->string('card_token', 255)->nullable(); // For saved cards
            $table->string('masked_card', 20); // e.g., 411111******1111
            $table->enum('card_type', ['visa', 'mastercard', 'jcb', 'amex']);
            $table->enum('card_category', ['credit', 'debit']);
            $table->string('bank', 100)->nullable(); // Issuing bank
            
            // 3DS Authentication
            $table->enum('authentication_type', ['3ds', 'non_3ds'])->default('3ds');
            $table->string('authentication_url', 500)->nullable();
            $table->boolean('is_authenticated')->default(false);
            $table->string('authentication_id', 255)->nullable();
            
            // Installment
            $table->integer('installment_term')->default(0); // 0=full, 3,6,12,24
            $table->decimal('installment_rate', 5, 2)->default(0); // Interest rate
            
            // Save card option
            $table->boolean('save_card')->default(false);
            
            $table->timestamps();
            
            // Indexes
            $table->index('transaction_id');
            $table->index('card_token');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('credit_cards');
    }
};