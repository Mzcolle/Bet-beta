<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSettingsTableColumns extends Migration
{
    public function up()
    {
        if (Schema::hasTable('settings')) {
            Schema::table('settings', function (Blueprint $table) {
                if (!Schema::hasColumn('settings', 'sharkpay_is_enable')) {
                    $table->boolean('sharkpay_is_enable')->default(false);
                }
                
                // Adicione outras colunas conforme necessário
                if (!Schema::hasColumn('settings', 'software_favicon')) {
                    $table->string('software_favicon')->nullable();
                }
            });
        }
    }

    public function down()
    {
        // Não é necessário reverter nesta migração segura
    }
}