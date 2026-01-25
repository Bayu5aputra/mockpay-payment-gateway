<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('api_keys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merchant_id')->constrained()->onDelete('cascade');
            $table->string('key_name', 100); // User-friendly name
            $table->string('api_key', 100)->unique();
            $table->enum('environment', ['sandbox', 'production'])->default('sandbox');
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
            
            // Indexes
            $table->index('merchant_id');
            $table->index('api_key');
            $table->index(['environment', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('api_keys');
    }
};