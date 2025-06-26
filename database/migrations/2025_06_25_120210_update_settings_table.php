<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// Na migração criada
public function up()
{
    Schema::table('settings', function (Blueprint $table) {
        // Adicione aqui qualquer coluna faltante
        if (!Schema::hasColumn('settings', 'sharkpay_is_enable')) {
            $table->boolean('sharkpay_is_enable')->default(false);
        }
        // Repita para outras colunas necessárias
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            //
        });
    }
};
