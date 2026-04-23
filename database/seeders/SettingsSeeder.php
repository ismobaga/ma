<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_name' => 'Maison Aminata',
            'site_tagline' => 'Mode africaine authentique',
            'whatsapp_number' => '22300000000',
            'contact_phone' => '+223 00 00 00 00',
            'contact_email' => 'contact@maisonaminata.com',
            'address' => 'Bamako, Mali',
            'hero_title' => 'Bienvenue chez Maison Aminata',
            'hero_subtitle' => 'Découvrez notre collection de mode africaine authentique',
            'hero_button_text' => 'Découvrir la boutique',
            'hero_button_link' => '/boutique',
            'instagram_url' => '',
            'facebook_url' => '',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
