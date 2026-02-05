<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('merchants', function (Blueprint $table) {
            $table->string('bank_name', 100)->nullable()->after('balance');
            $table->string('bank_account_number', 50)->nullable()->after('bank_name');
            $table->string('bank_account_name', 255)->nullable()->after('bank_account_number');
            $table->boolean('email_notifications')->default(true)->after('bank_account_name');
            $table->boolean('webhook_notifications')->default(true)->after('email_notifications');
            $table->string('website', 255)->nullable()->after('webhook_notifications');
            $table->string('tax_id', 50)->nullable()->after('website');
            $table->string('city', 100)->nullable()->after('tax_id');
            $table->string('state', 100)->nullable()->after('city');
            $table->string('postal_code', 20)->nullable()->after('state');
            $table->string('country', 100)->nullable()->after('postal_code');
        });
    }

    public function down(): void
    {
        Schema::table('merchants', function (Blueprint $table) {
            $table->dropColumn([
                'bank_name',
                'bank_account_number',
                'bank_account_name',
                'email_notifications',
                'webhook_notifications',
                'website',
                'tax_id',
                'city',
                'state',
                'postal_code',
                'country',
            ]);
        });
    }
};
