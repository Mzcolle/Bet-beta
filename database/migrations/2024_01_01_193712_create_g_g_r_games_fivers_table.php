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
        Schema::create('ggr_games_fivers', function (Blueprint $table) {
            $table->id();
            
            // CORRIGIDO: Mudou de integer() para unsignedBigInteger() 
            // para ser compatível com a tabela users
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // OU alternativamente, você pode usar a forma moderna:
            // $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            $table->string('provider');
            $table->string('game');
            $table->decimal('balance_bet', 20, 2)->default(0);
            $table->decimal('balance_win', 20, 2)->default(0);
            $table->string('currency', 50)->default('BRL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ggr_games_fivers');
    }
};