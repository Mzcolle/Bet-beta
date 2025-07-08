<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('game_exclusives')) {
            Schema::create('game_exclusives', function (Blueprint $table) {
                $table->id();
                $table->string('name')->nullable();
                $table->timestamps();
                // Adicione outras colunas conforme necessário
            });
        } else {
            // Se a tabela já existir, apenas adicionar colunas faltantes
            Schema::table('game_exclusives', function (Blueprint $table) {
                if (!Schema::hasColumn('game_exclusives', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }
                if (!Schema::hasColumn('game_exclusives', 'updated_at')) {
                    $table->timestamp('updated_at')->nullable();
                }
            });
        }
    }

    public function down(): void
    {
        // Não remover a tabela no down() para evitar perda de dados
        // Schema::dropIfExists('game_exclusives');
    }
};