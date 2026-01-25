<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('retail_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->onDelete('cascade');
            
            $table->enum('store_type', ['alfamart', 'alfamidi', 'indomaret', 'lawson', 'dandan']);
            $table->string('payment_code', 50)->unique(); // Code to show at cashier
            $table->string('barcode_string', 100); // For barcode generation
            $table->string('barcode_image_url', 500)->nullable();
            
            $table->string('store_name')->nullable();
            $table->text('message')->nullable(); // Instructions
            
            $table->timestamp('expired_at');
            
            $table->timestamps();
            
            // Indexes
            $table->index('transaction_id');
            $table->index('payment_code');
            $table->index('store_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('retail_payments');
    }
};