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
        Schema::create('vip_users', function (Blueprint $table) {
            $table->id();
            
            // Já estava correto
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // CORRIGIDO: vip_id mudou de integer() para unsignedBigInteger()
            // CORRIGIDO: nome da tabela de '´vips' para 'vips' (removido caractere especial)
            $table->unsignedBigInteger('vip_id')->index();
            $table->foreign('vip_id')->references('id')->on('vips')->onDelete('cascade');
            
            $table->bigInteger('level');
            $table->bigInteger('points');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vip_users');
    }
};