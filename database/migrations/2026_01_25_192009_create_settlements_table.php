<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settlements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merchant_id')->constrained()->onDelete('cascade');
            
            $table->string('settlement_id', 100)->unique();
            $table->date('settlement_date'); // Date of settlement
            $table->date('period_start');
            $table->date('period_end');
            
            // Settlement calculation
            $table->integer('total_transactions')->default(0);
            $table->decimal('gross_amount', 20, 2)->default(0); // Total transaction amount
            $table->decimal('total_fee', 15, 2)->default(0);
            $table->decimal('net_amount', 20, 2)->default(0); // Amount to merchant
            
            // Status
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');
            
            // Bank account info
            $table->string('bank_name', 100)->nullable();
            $table->string('bank_account_number', 50)->nullable();
            $table->string('bank_account_name')->nullable();
            
            // Transfer proof (mock)
            $table->string('transfer_proof')->nullable();
            $table->text('notes')->nullable();
            
            $table->timestamp('processed_at')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('merchant_id');
            $table->index('settlement_date');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settlements');
    }
};