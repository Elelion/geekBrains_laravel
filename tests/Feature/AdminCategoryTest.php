<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminCategoryTest extends TestCase
{
    public function test_admin_category_index_show()
    {
        $response = $this->get(route('admin.categories.index'));
        $response->assertStatus(200);
    }

    public function test_admin_category_create_show()
    {
        $response = $this->get(route('admin.categories.create'));
        $response->assertStatus(200);
    }

    public function test_admin_category_index_is_view()
    {
        $response = $this->get(route('admin.categories.index'));
        $response->assertViewIs('admin.categories.index');
    }

    public function test_admin_category_create_is_view()
    {
        $response = $this->get(route('admin.categories.create'));
        $response->assertViewIs('admin.categories.create');
    }

    public function test_admin_category_index_is_content()
    {
        $value = 'test_header';
        $response = $this->get(route('admin.categories.create'));
        $response->assertDontSeeText($value, $escaped = true);
    }
}
