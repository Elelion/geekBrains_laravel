<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Если вы хотите создать контроллер только с одним действием,
     * вы можете использовать метод __invoke() и даже создать
     * «вызываемый» (invokable) контроллер.
     *
     * Метод __invoke() вызывается, когда скрипт пытается выполнить
     * объект как функцию.
     */
    public function __invoke(Request $request)
    {
        return view('admin.index', [
            'countNews' => News::count(),
            'countCategories' => Category::count(),
        ]);
    }
}
