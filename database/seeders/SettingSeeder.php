<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'currency_code' => 'BRL',
            'prefix' => 'R$',
            // Adicione outras configurações padrão aqui, se necessário
        ]);
    }
}


