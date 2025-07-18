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
        Schema::create('affiliate_histories', function (Blueprint $table) {
            $table->id();
            
            // CORREÇÃO: Mudança de integer() para foreignId()
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('inviter')->references('id')->on('users')->onDelete('cascade');
            
            // OU se preferir a forma manual:
            // $table->unsignedBigInteger('user_id')->index();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->unsignedBigInteger('inviter')->index();
            // $table->foreign('inviter')->references('id')->on('users')->onDelete('cascade');
            
            $table->decimal('commission', 20, 2)->default(0);
            $table->string('commission_type')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('deposited')->default(0);
            $table->decimal('deposited_amount', 10, 2)->default(0);
            $table->bigInteger('losses')->default(0);
            $table->decimal('losses_amount', 10, 2)->default(0);
            $table->decimal('commission_paid', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliate_histories');
    }
};