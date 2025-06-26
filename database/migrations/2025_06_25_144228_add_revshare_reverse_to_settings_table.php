<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Verifica se a coluna já existe antes de adicionar
        if (!Schema::hasColumn('settings', 'revshare_reverse')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->boolean('revshare_reverse')
                    ->default(false)
                    ->after('revshare_percentage');
            });
        }
    }

    public function down()
    {
        // Opção segura para rollback (verifica antes de remover)
        if (Schema::hasColumn('settings', 'revshare_reverse')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->dropColumn('revshare_reverse');
            });
        }
    }
};