<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $newsList = News::select(News::$allowedFields)
            ->paginate(config('paginate.admin.news'));

        /**
         * join пример:
         * public function index(Request $request) {...
         *
         * $join = DB::table('news')
         * ->join('categories', 'news.category_id', '=', 'categories.id')
         * ->select("news.*", 'categories.title as categoryTitle')
         * ->where('title', '%like%', '%' . $request->query('s') . '%')
         * ->adnWhere('news.status', '<>', 'DRAFT')
         * ->orWhere('news.id', '>', 8)
         * ->whereIn('news.id', [1, 7])
         * ->get();
         */

        return view('admin.news.index', [
            'newsList' => $newsList,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.news.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        /**
         * $request - обертка над супер глобальными массивами типа
         * $_POST, $_REQUEST итп
         *
         * $request->only(['title', 'description']) - получить ТОЛЬКО заданные поля
         * все остальное проигнорируется
         *
         * $request->except(['title', 'description']) - исключить указанные поля
         *
         * $request->input('title', 'some title') - получить только заданное поле,
         * если поля нет то получаем значение по дефолту - some title
         *
         * $request->title - получение данных на прямую (не рекомендуется так делать!)
         *
         * $request->has('title') - проверяет существование поля (вернет true / false)
         */

        $request->validate([
            'title' => ['required', 'string']
        ]);

        $data = $request->only(['title', 'description', 'author', 'status']);
        $news = News::create($data);

        if ($news) {
            return redirect()->route('admin.news.index')
                ->with('success', 'Новость успешно добавлена');
        }

        return back()->withInput()->with('error', 'Не удалось добавить новость');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $categories = Category::all();

        return view('admin.news.edit', [
            'news' => $news,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => ['required', 'string']
        ]);

        $news = $news->fill(
            $request->only(['category_id', 'title', 'description', 'author', 'status'])
        )->save();

        if ($news) {
            return redirect()->route('admin.news.index')
                ->with('success', 'Новость успешно сохранена');
        }

        return back()->withInput()->with('error', 'Не удалось сохранить новость');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
