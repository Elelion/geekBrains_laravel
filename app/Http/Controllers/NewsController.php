<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return view('news.index', [
            'news' => $this->newsList,
        ]);
    }

    public function info()
    {
        return view('news.info');
    }

    public function news()
    {
        return view('news.news');
    }

    public function show(int $id, string $type)
    {
        $newsList = [];

        foreach ($this->newsList as $news) {
            if ($news['id'] === $id) {
                $newsList[] = $news;
            }
        }

        if (empty($newsList)) {
            abort(404);
        }

        return view('news.show', compact(
            'id',
            'type'
        ));
    }
}
