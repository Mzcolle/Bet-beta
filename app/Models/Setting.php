<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'software_name',
        'software_description',
        'software_favicon',
        'software_logo_white',
        'software_logo_black',
        'software_background',
        'currency_code',
        'decimal_format',
        'currency_position',
        'prefix',
        'storage',
        'min_deposit',
        'max_deposit',
        'min_withdrawal',
        'max_withdrawal',
        'bonus_vip',
        'activate_vip_bonus',
        'ngr_percent',
        'revshare_percentage',
        'revshare_reverse',
        'cpa_value',
        'cpa_baseline',
        'soccer_percentage',
        'turn_on_football',
        'initial_bonus',
        'suitpay_is_enable',
        'stripe_is_enable',
        'bspay_is_enable',
        'mercadopago_is_enable',
        'sharkpay_is_enable',
        'digitopay_is_enable',
        'withdrawal_limit',
        'withdrawal_period',
        'disable_spin',
        'perc_sub_lv1',
        'perc_sub_lv2',
        'perc_sub_lv3',
        'rollover',
        'rollover_deposit',
        'disable_rollover',
        'rollover_protection',
    ];

    protected $hidden = ['updated_at'];

    protected $attributes = [
        'software_name' => 'BetPlus',
        'sharkpay_is_enable' => false,
        'stripe_is_enable' => false,
        'suitpay_is_enable' => false,
        'bspay_is_enable' => false,
        'mercadopago_is_enable' => false,
        'digitopay_is_enable' => false,
        'disable_spin' => false,
        'disable_rollover' => false,
        'activate_vip_bonus' => false,
        'turn_on_football' => false,
        'rollover_protection' => false,
        'min_deposit' => 10,
        'max_deposit' => 5000,
        'min_withdrawal' => 20,
        'max_withdrawal' => 5000,
        'initial_bonus' => 0,
        'ngr_percent' => 0,
        'revshare_percentage' => 0,
        'revshare_reverse' => 0,
        'cpa_value' => 0,
        'cpa_baseline' => 0,
        'soccer_percentage' => 0,
        'withdrawal_limit' => 0,
        'perc_sub_lv1' => 0,
        'perc_sub_lv2' => 0,
        'perc_sub_lv3' => 0,
        'rollover' => 0,
        'rollover_deposit' => 0,
    ];

    /**
     * Get the first settings record or create if not exists
     */
    public static function getSettings()
    {
        return self::firstOrCreate([], [
            'software_name' => env('APP_NAME', 'BetPlus')
        ]);
    }
}