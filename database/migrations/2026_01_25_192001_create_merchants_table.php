<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Contact name
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('company_name');
            $table->text('company_address')->nullable();
            $table->string('phone', 20);
            $table->enum('business_type', ['ecommerce', 'marketplace', 'subscription', 'donation', 'other'])
                  ->default('ecommerce');
            $table->enum('status', ['pending', 'active', 'suspended'])
                  ->default('pending');
            
            // API Keys (bisa juga dipindah ke tabel terpisah)
            $table->string('api_key_production', 100)->unique()->nullable();
            $table->string('api_key_sandbox', 100)->unique()->nullable();
            
            // Webhook Configuration
            $table->string('webhook_url', 500)->nullable();
            $table->string('webhook_secret', 100)->nullable();
            $table->string('callback_url', 500)->nullable();
            
            // Balance (mock)
            $table->decimal('balance', 20, 2)->default(0);
            
            // Logo
            $table->string('logo')->nullable();
            
            $table->rememberToken();
            $table->timestamps();
            
            // Indexes
            $table->index('email');
            $table->index('api_key_production');
            $table->index('api_key_sandbox');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('merchants');
    }
};