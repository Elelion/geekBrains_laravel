<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Указываем здесь сиды которые будут выполнятся в указанной последовательности
     * php artisan db:seed
     *
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            CategorySeeder::class,
            NewsSeeder::class
        ]);
    }
}
