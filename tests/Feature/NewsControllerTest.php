<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsControllerTest extends TestCase
{
    public function test_news_index_show()
    {
        $response = $this->get(route('index'));
        $response->assertStatus(200);
    }


    public function test_news_info_show()
    {
        $response = $this->get(route('news'));
        $response->assertStatus(200);
    }

    public function test_news_news_show()
    {
        $response = $this->get(route('news'));
        $response->assertStatus(200);
    }

    public function test_news_show_show()
    {
        $response = $this->get(route('news'));
        $response->assertStatus(200);
    }
}
