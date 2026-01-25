<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('qris_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->onDelete('cascade');
            
            $table->text('qr_string'); // QRIS standard format
            $table->string('qr_image_url', 500);
            
            // QRIS metadata
            $table->string('acquirer', 100)->nullable(); // QRIS acquirer
            $table->string('nmid', 50)->nullable(); // National Merchant ID
            $table->string('terminal_id', 50)->nullable();
            
            $table->timestamp('expired_at');
            
            $table->timestamps();
            
            // Indexes
            $table->index('transaction_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qris_payments');
    }
};