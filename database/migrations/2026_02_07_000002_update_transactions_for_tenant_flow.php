<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('transactions', 'payment_channel')) {
            Schema::table('transactions', function (Blueprint $table) {
                $table->string('payment_channel', 50)->nullable()->after('payment_method');
            });
        }

        $driver = DB::getDriverName();

        if (in_array($driver, ['mysql', 'mariadb'], true)) {
            DB::statement('ALTER TABLE transactions MODIFY COLUMN merchant_id BIGINT UNSIGNED NULL');
            DB::statement("ALTER TABLE transactions MODIFY COLUMN status ENUM('pending','processing','settlement','cancel','expire','failed','refund','partial_refund','cancelled','expired','refunded') DEFAULT 'pending'");
        }

        DB::table('transactions')->where('status', 'cancel')->update(['status' => 'cancelled']);
        DB::table('transactions')->where('status', 'expire')->update(['status' => 'expired']);
        DB::table('transactions')->where('status', 'refund')->update(['status' => 'refunded']);

        if (in_array($driver, ['mysql', 'mariadb'], true)) {
            DB::statement("ALTER TABLE transactions MODIFY COLUMN status ENUM('pending','processing','settlement','cancelled','expired','failed','refunded','partial_refund') DEFAULT 'pending'");
        }
    }

    public function down(): void
    {
        $driver = DB::getDriverName();

        if (in_array($driver, ['mysql', 'mariadb'], true)) {
            DB::statement("ALTER TABLE transactions MODIFY COLUMN status ENUM('pending','processing','settlement','cancel','expire','failed','refund','partial_refund') DEFAULT 'pending'");
        }

        DB::table('transactions')->where('status', 'cancelled')->update(['status' => 'cancel']);
        DB::table('transactions')->where('status', 'expired')->update(['status' => 'expire']);
        DB::table('transactions')->where('status', 'refunded')->update(['status' => 'refund']);

        if (in_array($driver, ['mysql', 'mariadb'], true)) {
            DB::statement('ALTER TABLE transactions MODIFY COLUMN merchant_id BIGINT UNSIGNED NOT NULL');
        }

        if (Schema::hasColumn('transactions', 'payment_channel')) {
            Schema::table('transactions', function (Blueprint $table) {
                $table->dropColumn('payment_channel');
            });
        }
    }
};
