<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Контактна інформація
            [
                'key' => 'organization_name',
                'value' => 'Циклова комісія програмування та інформаційних технологій',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Назва організації',
                'description' => 'Повна назва організації',
                'sort_order' => 1,
            ],
            [
                'key' => 'phone',
                'value' => '+38 (0312) 61-33-45',
                'type' => 'tel',
                'group' => 'contact',
                'label' => 'Телефон',
                'description' => 'Основний телефон для зв\'язку',
                'sort_order' => 2,
            ],
            [
                'key' => 'email',
                'value' => 'collegepit@uzhnu.ua',
                'type' => 'email',
                'group' => 'contact',
                'label' => 'Email',
                'description' => 'Основний email для зв\'язку',
                'sort_order' => 3,
            ],

            // Адреса
            [
                'key' => 'address_street',
                'value' => 'вул. Українська, 19',
                'type' => 'text',
                'group' => 'address',
                'label' => 'Вулиця та номер будинку',
                'description' => 'Адреса розташування',
                'sort_order' => 4,
            ],
            [
                'key' => 'address_city',
                'value' => 'м. Ужгород',
                'type' => 'text',
                'group' => 'address',
                'label' => 'Місто',
                'description' => 'Місто розташування',
                'sort_order' => 5,
            ],
            [
                'key' => 'address_region',
                'value' => 'Закарпатська область',
                'type' => 'text',
                'group' => 'address',
                'label' => 'Область',
                'description' => 'Область розташування',
                'sort_order' => 6,
            ],
            [
                'key' => 'address_postal_code',
                'value' => '88000',
                'type' => 'text',
                'group' => 'address',
                'label' => 'Поштовий індекс',
                'description' => 'Поштовий індекс',
                'sort_order' => 7,
            ],

            // Карта
            [
                'key' => 'map_latitude',
                'value' => '48.6134116',
                'type' => 'coordinates',
                'group' => 'map',
                'label' => 'Широта',
                'description' => 'Координати широти для Google Maps',
                'sort_order' => 8,
            ],
            [
                'key' => 'map_longitude',
                'value' => '22.3066565',
                'type' => 'coordinates',
                'group' => 'map',
                'label' => 'Довгота',
                'description' => 'Координати довготи для Google Maps',
                'sort_order' => 9,
            ],
            [
                'key' => 'map_zoom',
                'value' => '15',
                'type' => 'number',
                'group' => 'map',
                'label' => 'Масштаб карти',
                'description' => 'Рівень масштабування карти (1-20)',
                'sort_order' => 10,
            ],
            [
                'key' => 'google_maps_api_key',
                'value' => 'YOUR_API_KEY',
                'type' => 'text',
                'group' => 'map',
                'label' => 'Google Maps API ключ',
                'description' => 'API ключ для Google Maps',
                'sort_order' => 11,
            ],
        ];

        foreach ($settings as $setting) {
            \App\Models\ContactSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
