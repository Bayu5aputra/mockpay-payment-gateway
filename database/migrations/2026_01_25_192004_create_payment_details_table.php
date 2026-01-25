<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->onDelete('cascade');
            
            $table->string('payment_type', 50); // va, ewallet, card, qris, retail
            
            // For Virtual Account
            $table->string('account_number', 100)->nullable();
            
            // For QRIS/E-wallet
            $table->text('qr_string')->nullable();
            $table->string('qr_image_url', 500)->nullable();
            
            // For Credit Card
            $table->string('card_token', 255)->nullable();
            
            // For E-wallet
            $table->string('deeplink_url', 500)->nullable();
            
            // For Retail
            $table->string('payment_code', 50)->nullable();
            
            // Common
            $table->timestamp('expiry_time')->nullable();
            $table->json('payment_instructions')->nullable(); // Step by step
            $table->json('additional_data')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('transaction_id');
            $table->index('payment_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_details');
    }
};