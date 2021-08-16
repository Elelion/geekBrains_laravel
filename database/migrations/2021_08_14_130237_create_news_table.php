<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * php artisan migrate - накатить
     *
     * ->nullable() - если не заполнять то будет null
     * ->enum() - типа dropdown где можно выбрать из заданных значений
     * ->foreignId - создаем внешний ключ с category_id текущей таблици на поле id
     * таблици categories
     * ->cascadeOnDelete() - когда удаляется наша категория то удаляются и все
     * связанные с ней наши новости
     *
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')
                ->constrained('categories')
                ->cascadeOnDelete();

            $table->string('title', 191)
                ->comment('Заголовок');

            $table->string('author', 191)
                ->nullable()
                ->comment('Автор новости');

            $table->string('image', 255)
                ->nullable()
                ->comment('Картинка новости');

            $table->enum('status', ['DRAFT', 'PUBLISHED', 'BLOCKED'])
                ->default('DRAFT')
                ->comment('Выбор статуса из имеющихся');

            $table->string('description')
                ->nullable()
                ->comment('Содержание новости');

            $table->boolean('isActive')
                ->default(true)
                ->comment('Активно или НЕ активно');

            $table->timestamps();
        });
    }

    /**
     * php artisan migrate:rollback - откатить
     *
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
