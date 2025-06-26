<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('settings', function (Blueprint $table) {
        if (!Schema::hasColumn('settings', 'sharkpay_is_enable')) {
            $table->boolean('sharkpay_is_enable')->default(false)->after('stripe_is_enable');
        }
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            //
        });
    }
};
