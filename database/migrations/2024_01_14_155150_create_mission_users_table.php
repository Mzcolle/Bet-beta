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
        Schema::create('mission_users', function (Blueprint $table) {
            $table->id();
            
            // CORRIGIDO: user_id para ser compatível com users.id (bigint)
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // CORRIGIDO: mission_id também precisa ser bigint para ser compatível com missions.id
            $table->unsignedBigInteger('mission_id')->index();
            $table->foreign('mission_id')->references('id')->on('missions')->onDelete('cascade');
            
            $table->bigInteger('rounds')->default(0);
            $table->decimal('rewards', 10, 2)->default(0);
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mission_users');
    }
};