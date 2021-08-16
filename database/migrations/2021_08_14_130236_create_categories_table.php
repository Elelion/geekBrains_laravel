<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * php artisan make:migration create_categories_table --create=categories
 * где
 * make:migration create_categories_table - создать миграцию - имя миграции
 * --create=categories - указать имя таблици явно
 */
class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title', 191)
                ->comment('Заголовок');

            $table->text('description')
                ->nullable()
                ->comment('Содержание категории');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
