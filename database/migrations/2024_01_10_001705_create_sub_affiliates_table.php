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
        Schema::create('sub_affiliates', function (Blueprint $table) {
            $table->id();
            
            // CORRIGIDO: Mudou de integer() para unsignedBigInteger()
            $table->unsignedBigInteger('affiliate_id')->index();
            $table->foreign('affiliate_id')->references('id')->on('users')->cascadeOnDelete();
            
            // CORRIGIDO: Mudou de integer() para unsignedBigInteger()
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_affiliates');
    }
};