<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * php artisan make:seeder CategorySeeder
 *
 * сидеры нужны для заполнения БД тестовыми данными
 * выполняются после того как будут применены миграции с созданием
 * необходимых таблиц !!!
 */
class CategorySeeder extends Seeder
{
    /**
     * заполняет нашу таблицу news вставляя в нее данные из метода getData
     *
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert($this->getData());
    }

    /**
     * Factory::create(); - библиотека Facker которая встроена в ядро Laravel
     * позволяет генерировать тестовые данные для заполнения БД через сидеры
     */
    public function getData(): array
    {
        $faker = Factory::create();

        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'title' => $faker->sentence(mt_rand(3, 10)),
                'description' => $faker->text(mt_rand(100, 200)),
            ];
        }

        return $data;
    }
}
