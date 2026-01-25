<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('refunds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->onDelete('cascade');
            $table->foreignId('merchant_id')->constrained()->onDelete('cascade');
            
            $table->string('refund_id', 100)->unique();
            $table->decimal('refund_amount', 20, 2); // Amount to refund
            $table->text('reason')->nullable();
            
            $table->enum('refund_type', ['full', 'partial'])->default('full');
            $table->enum('status', ['pending', 'processing', 'completed', 'rejected', 'failed'])
                  ->default('pending');
            
            $table->text('notes')->nullable();
            
            $table->timestamp('processed_at')->nullable();
            $table->timestamp('refunded_at')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('transaction_id');
            $table->index('merchant_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('refunds');
    }
};