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
        Schema::table('games', function (Blueprint $table) {
            // Verifica se a coluna provider_id existe
            if (Schema::hasColumn('games', 'provider_id')) {
                // Tenta remover a chave estrangeira se existir
                $this->safeDropForeign($table, 'games_provider_id_foreign');
                
                // Modifica a coluna existente
                $table->unsignedBigInteger('provider_id')->nullable(false)->change();
            } else {
                // Cria a coluna se não existir
                $table->unsignedBigInteger('provider_id')->after('id');
            }
            
            // Adiciona a chave estrangeira
            $table->foreign('provider_id')
                  ->references('id')
                  ->on('providers')
                  ->onDelete('cascade');
        });
    }

    /**
     * Helper para remover chave estrangeira de forma segura
     */
    private function safeDropForeign(Blueprint $table, string $keyName): void
    {
        $connection = Schema::getConnection();
        $dbSchemaManager = $connection->getDoctrineSchemaManager();
        $doctrineTable = $dbSchemaManager->listTableDetails($table->getTable());
        
        if ($doctrineTable->hasForeignKey($keyName)) {
            $table->dropForeign($keyName);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('games', function (Blueprint $table) {
            // Remove apenas a chave estrangeira se existir
            $this->safeDropForeign($table, 'games_provider_id_foreign');
            
            // Não removemos a coluna para evitar perda de dados
            // $table->dropColumn('provider_id'); // Descomente se quiser remover completamente
        });
    }
};