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
            $table->decimal('affiliate_revenue_share', 8, 2)->nullable()->change();
            // Se você não sabe o tipo exato, use o tipo que ela já tem, ex:
            // $table->double('affiliate_revenue_share')->nullable()->change();
            // $table->integer('affiliate_revenue_share')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Reverte a coluna para não ser nula (se necessário)
            // Isso pode falhar se houver valores nulos na coluna
            $table->decimal('affiliate_revenue_share', 8, 2)->nullable(false)->change();
        });
    }
};
