<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * для запуска тестов пишем:
 * php artisan test
 */
class AdminNewsTest extends TestCase
{
    /**
     * Тестирует есть ли главная страница новостей и нормально ли она работает
     * те проверяет на статус 200
     *
     * php artisan make:test NewsTest
     *
     * @return void
     */
    public function test_admin_news_list_show()
    {
        $response = $this->get(route('admin.news.index'));
        $response->assertStatus(200);
    }

    public function test_admin_create_news_status()
    {
        $response = $this->get(route('admin.news.create'));
        $response->assertStatus(200);
    }

    /**
     * проверяем вьюху
     */
    public function test_admin_news_list_is_view()
    {
        $response = $this->get(route('admin.news.index'));
        $response->assertViewIs('admin.news.index');
    }

    /**
     * проверяет что данного текста НЕТ на странице те
     * admin.news.create - проверяется на ОТСУТСТВИе News
     * тк его нет в таком url - тест пройдет на ок
     *
     */
    public function test_admin_create_news_dont_see_news()
    {
        $response = $this->get(route('admin.news.create'));
        $response->assertDontSee('News');
    }
}
