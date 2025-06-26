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
    if (!Schema::hasColumn('settings', 'sharkpay_is_enable')) {
        Schema::table('settings', function (Blueprint $table) {
            $table->boolean('sharkpay_is_enable')->default(false)->after('stripe_is_enable');
        });
    }
}

public function down()
{
    if (Schema::hasColumn('settings', 'sharkpay_is_enable')) {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('sharkpay_is_enable');
        });
    }
}
};
