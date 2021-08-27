<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
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
     * StoreNewsRequest - см в app/Http/Request/...
     *
     * Store a newly created resource in storage.
     *
     * @param StoreNewsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreNewsRequest $request)
    {
        /**
         * Request $request - обертка над супер глобальными массивами типа
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
         *
         * ---
         *
         * Можем написать ...->validated() за место:
         * $data = $request->only(['title', 'description', 'author', 'status']);
         * $news = News::create($data);
         */
        $news = News::create($request->validated());

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
     * @param UpdateNewsRequest $request
     * @param News $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        /**
         * Вернет все отвалидированные данные в виде
         *
         * array:3 [▼
         * "category_id" => "1"
         * "title" => "dd12341"
         * "author" => "gutkowski.kyleigh"
         * ]
         *
         * Команда:
         * dd($request->validated());
         */

        /**
         * запись
         * $news = $news->fill(
         *      $request->only(['category_id', 'title', 'description', 'author', 'status'])
         * )->save();
         *
         * мы можем заменить нашей валидацией из UpdateNewsRequest
         * $request->validated() - будет работать только если мы написали
         * свой \Requests
         */
        $news = $news->fill($request->validated())->save();

        /**
         * trans - хелпер позволяющий обратиться к нашим сообщениям что в
         * ../resources/lang/ru/messages
         *
         * те trans переводит переданный ключ перевода с помощью ваших
         * файлов локализации
         *
         * так же за место trans мы можем писать __(...)
         * это одно и то же, просто разные формы написания
         */
        if ($news) {
            return redirect()->route('admin.news.index')
                ->with('success', trans('messages.admin.news.create.success'));
        }

        return back()->withInput()->with('error', __('messages.admin.news.update.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('admin.news.index');
    }
}
