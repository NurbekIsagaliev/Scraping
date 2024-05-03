<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\GisGosreestrTableSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Вызов сидера для парсинга данных с сайта GisGosreestr
        $this->call([
            GisGosreestrTableSeeder::class,
        ]);
      
    }
}
