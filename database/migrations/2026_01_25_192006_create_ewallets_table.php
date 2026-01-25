<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ewallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->onDelete('cascade');
            
            $table->enum('provider', ['gopay', 'ovo', 'dana', 'shopeepay', 'linkaja', 'sakuku']);
            $table->string('account_phone', 20)->nullable(); // Customer phone
            
            // Payment methods
            $table->string('deeplink_url', 500)->nullable();
            $table->text('qr_string')->nullable();
            $table->string('qr_image_url', 500)->nullable();
            
            // Callback
            $table->string('callback_url', 500)->nullable();
            $table->string('reference_id', 100)->nullable(); // Provider reference
            
            // Status
            $table->boolean('is_paid')->default(false);
            $table->timestamp('paid_at')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('transaction_id');
            $table->index('provider');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ewallets');
    }
};