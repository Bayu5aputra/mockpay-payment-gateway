<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('virtual_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->onDelete('cascade');
            
            $table->string('bank_code', 20); // bca, mandiri, bni, bri, permata, cimb
            $table->string('va_number', 50)->unique(); // Generated VA number
            $table->decimal('amount', 20, 2);
            
            // Configuration
            $table->boolean('is_open_amount')->default(false); // Can pay any amount
            $table->boolean('is_single_use')->default(true);
            $table->boolean('is_closed')->default(false); // Already paid or expired
            
            // Instructions
            $table->json('instructions')->nullable(); // Bank-specific payment steps
            
            // Timestamps
            $table->timestamp('expired_at');
            $table->timestamp('paid_at')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('transaction_id');
            $table->index('va_number');
            $table->index('bank_code');
            $table->index('is_closed');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('virtual_accounts');
    }
};