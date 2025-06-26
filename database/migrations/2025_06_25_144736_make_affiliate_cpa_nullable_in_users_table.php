<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Altera a coluna para ser nula
            // Verifique o tipo de dado e a precisão da sua coluna 'affiliate_cpa'
            // Exemplo: $table->decimal('affiliate_cpa', 8, 2)->nullable()->change();
            // Ou $table->double('affiliate_cpa')->nullable()->change();
            // Ou $table->integer('affiliate_cpa')->nullable()->change();
            $table->decimal('affiliate_cpa', 8, 2)->nullable()->change(); // Ajuste o tipo e precisão conforme seu DB
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Reverte a coluna para não ser nula (se necessário)
            $table->decimal('affiliate_cpa', 8, 2)->nullable(false)->change(); // Ajuste o tipo e precisão
        });
    }
};
