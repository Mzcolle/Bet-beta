<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Verifica se as colunas existem antes de modificar
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                // Modifica cada coluna apenas se existir
                if (Schema::hasColumn('users', 'affiliate_revenue_share')) {
                    $table->decimal('affiliate_revenue_share', 8, 2)->nullable()->change();
                }
                if (Schema::hasColumn('users', 'affiliate_cpa')) {
                    $table->decimal('affiliate_cpa', 8, 2)->nullable()->change();
                }
                if (Schema::hasColumn('users', 'affiliate_baseline')) {
                    $table->decimal('affiliate_baseline', 8, 2)->nullable()->change();
                }
            });
        }
    }

    public function down()
    {
        // Reverter para NOT NULL (opcional, com valores padrão)
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'affiliate_revenue_share')) {
                    DB::statement('ALTER TABLE users MODIFY affiliate_revenue_share DECIMAL(8,2) NOT NULL DEFAULT 0');
                }
                if (Schema::hasColumn('users', 'affiliate_cpa')) {
                    DB::statement('ALTER TABLE users MODIFY affiliate_cpa DECIMAL(8,2) NOT NULL DEFAULT 0');
                }
                if (Schema::hasColumn('users', 'affiliate_baseline')) {
                    DB::statement('ALTER TABLE users MODIFY affiliate_baseline DECIMAL(8,2) NOT NULL DEFAULT 0');
                }
            });
        }
    }
};