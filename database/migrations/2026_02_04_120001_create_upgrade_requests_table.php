<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('upgrade_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('approved_by_merchant_id')->nullable()->constrained('merchants')->nullOnDelete();

            $table->enum('plan', ['pro', 'enterprise']);
            $table->unsignedBigInteger('requested_price')->nullable(); // for enterprise custom price
            $table->unsignedBigInteger('base_price');
            $table->decimal('tax_rate', 5, 2)->default(11.00);
            $table->unsignedBigInteger('tax_amount');
            $table->unsignedBigInteger('admin_fee')->default(2000);
            $table->unsignedBigInteger('total_amount');
            $table->string('currency', 3)->default('IDR');

            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('invoice_number')->nullable();
            $table->timestamp('invoice_sent_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->text('rejection_reason')->nullable();

            $table->string('proof_path')->nullable();
            $table->string('proof_original_name')->nullable();
            $table->string('proof_mime')->nullable();
            $table->unsignedBigInteger('proof_size')->nullable();
            $table->string('proof_hash', 64)->nullable();

            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['status', 'plan']);
            $table->index(['invoice_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('upgrade_requests');
    }
};
