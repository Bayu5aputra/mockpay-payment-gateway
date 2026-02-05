<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('merchant_invitations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invited_by');
            $table->string('email')->index();
            $table->string('token', 100)->unique();
            $table->enum('status', ['pending', 'accepted', 'expired'])->default('pending');
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('accepted_at')->nullable();
            $table->timestamps();

            $table->foreign('invited_by')->references('id')->on('merchants')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('merchant_invitations');
    }
};
