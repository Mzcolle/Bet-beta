<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Verifica se a coluna já existe antes de adicionar
        if (!Schema::hasColumn('settings', 'turn_on_football')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->boolean('turn_on_football')
                    ->default(0)
                    ->after('activate_vip_bonus');
            });
        }
    }

    public function down()
    {
        // Verifica se a coluna existe antes de remover (opcional para rollback seguro)
        if (Schema::hasColumn('settings', 'turn_on_football')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->dropColumn('turn_on_football');
            });
        }
    }
};