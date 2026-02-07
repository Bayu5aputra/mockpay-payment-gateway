<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $driver = DB::getDriverName();

        if (in_array($driver, ['mysql', 'mariadb'], true)) {
            DB::statement("ALTER TABLE credit_cards MODIFY COLUMN masked_card VARCHAR(20) NULL");
            DB::statement("ALTER TABLE credit_cards MODIFY COLUMN card_type ENUM('visa','mastercard','jcb','amex') NULL");
            DB::statement("ALTER TABLE credit_cards MODIFY COLUMN card_category ENUM('credit','debit') NULL");
        }
    }

    public function down(): void
    {
        $driver = DB::getDriverName();

        if (in_array($driver, ['mysql', 'mariadb'], true)) {
            DB::statement("ALTER TABLE credit_cards MODIFY COLUMN masked_card VARCHAR(20) NOT NULL");
            DB::statement("ALTER TABLE credit_cards MODIFY COLUMN card_type ENUM('visa','mastercard','jcb','amex') NOT NULL");
            DB::statement("ALTER TABLE credit_cards MODIFY COLUMN card_category ENUM('credit','debit') NOT NULL");
        }
    }
};
