<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('webhook_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merchant_id')->constrained()->onDelete('cascade');
            $table->foreignId('transaction_id')->nullable()->constrained()->onDelete('cascade');
            
            $table->string('event', 100); // e.g., payment.success
            $table->string('webhook_url', 500); // Target URL
            
            // Request data
            $table->json('payload'); // Request body
            $table->json('headers')->nullable(); // Request headers
            
            // Response data
            $table->integer('response_code')->nullable(); // HTTP status
            $table->text('response_body')->nullable();
            
            // Retry logic
            $table->integer('attempt_count')->default(1);
            $table->enum('status', ['success', 'failed', 'pending'])->default('pending');
            $table->text('error_message')->nullable();
            
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('next_retry_at')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('merchant_id');
            $table->index('transaction_id');
            $table->index('status');
            $table->index('sent_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('webhook_logs');
    }
};