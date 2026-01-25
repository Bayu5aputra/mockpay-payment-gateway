<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_channels', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique(); // e.g., bca_va, gopay, credit_card
            $table->string('name', 100); // Display name
            $table->enum('type', ['bank_transfer', 'ewallet', 'card', 'qris', 'retail', 'paylater']);
            $table->string('category', 50); // virtual_account, direct_debit, etc.
            $table->string('provider', 50)->nullable(); // Bank or ewallet provider
            $table->string('icon')->nullable(); // Icon URL or path
            $table->text('description')->nullable();
            
            // Fee Configuration
            $table->decimal('fee_merchant_percentage', 5, 2)->default(0);
            $table->decimal('fee_merchant_fixed', 10, 2)->default(0);
            $table->decimal('fee_customer_percentage', 5, 2)->default(0);
            $table->decimal('fee_customer_fixed', 10, 2)->default(0);
            
            // Limits
            $table->decimal('min_amount', 15, 2)->default(10000);
            $table->decimal('max_amount', 15, 2)->default(50000000);
            
            // Status
            $table->boolean('is_active')->default(true);
            
            // Additional settings (JSON)
            $table->json('settings')->nullable();
            
            // Display order
            $table->integer('display_order')->default(0);
            
            $table->timestamps();
            
            // Indexes
            $table->index('code');
            $table->index('type');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_channels');
    }
};