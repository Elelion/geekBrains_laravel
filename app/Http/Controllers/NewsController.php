<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();

        return view('news.index', [
            'newsList' => $news,
        ]);
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function info()
    {
        return view('news.info');
    }

    public function news()
    {
        return view('news.news');
    }

    public function show(News $news)
    {
        $newsList = [];



        return view('news.show', [
            'news' => $news
        ]);
    }
}
