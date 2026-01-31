<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merchant_id')->constrained()->onDelete('cascade');
            $table->foreignId('payment_channel_id')->nullable()->constrained()->onDelete('set null');
            
            // Transaction identifiers
            $table->string('transaction_id', 100)->unique(); // TRX-YYYYMMDD-XXXXX
            $table->string('order_id', 255); // Merchant's order ID
            
            // Amount details
            $table->decimal('amount', 20, 2); // Original amount
            $table->decimal('fee', 10, 2)->default(0); // Total fee
            $table->decimal('total_amount', 20, 2); // amount + fee
            $table->string('currency', 3)->default('IDR');
            
            // Status
            $table->enum('status', [
                'pending',
                'processing', 
                'settlement',
                'cancel',
                'expire',
                'failed',
                'refund',
                'partial_refund'
            ])->default('pending');
            
            // Payment method info
            $table->string('payment_type', 50)->nullable(); // bank_transfer, ewallet, etc.
            $table->string('payment_method', 50)->nullable(); // bca_va, gopay, etc.
            
            // Customer info
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone', 20)->nullable();
            
            // Additional data
            $table->text('description')->nullable();
            $table->json('items')->nullable(); // Array of purchased items
            $table->json('metadata')->nullable(); // Custom merchant data
            
            // URLs
            $table->string('callback_url', 500)->nullable();
            
            // Timestamps
            $table->timestamp('expired_at'); // Payment expiry
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('settled_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamp('refunded_at')->nullable();
            
            // Request info
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            
            $table->timestamps();
            $table->softDeletes(); // TAMBAHKAN INI
            
            // Indexes
            $table->index('transaction_id');
            $table->index('order_id');
            $table->index('merchant_id');
            $table->index('status');
            $table->index('payment_method');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};