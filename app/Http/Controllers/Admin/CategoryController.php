<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

/**
 * ресурс контроллеры - создаются для КРУД операций
 *
 * create
 * read
 * update
 * delete
 *
 * такие контроллеры нужна как правило для
 * управления пользователями, задачами, статистикой итп
 *
 * Class CategoryController
 * @package App\Http\Controllers\Admin
 */
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        // $categories = Category::all();

        /**
         * создаем paginate.php в config/...
         *
         * вызываем пагинацию в .../admin/categories/index.blade
         *
         * подключаем bootstrap для пагинатора в .../app/Providers/AppServiceProvider
         *
         * пагинация без сортировки: Category::paginate...
         *
         * ---
         *
         * orderBy - сортировка, <по какому полю сортируем> , <как сортируем>
         */
        $categories = Category::orderBy('id', $request->query('sort', 'asc'))
            ->paginate(config('paginate.admin.categories'));

        return view('admin.categories.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' =>['required', 'string']
        ]);

        /**
         * Category::create -обращаемся к методу create класса Category
         *
         * если создаст категорию, то вернет объект
         * если НЕ создаст, то вернет false
         */
        $category = Category::create(
            $request->only(['title', 'description'])
        );

        /**
         * в данном случае
         * ->with
         * типа flash с заданным сообщением
         */
        if ($category) {
            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Категория успешно добавлена');
        }

        /**
         * ->withInput() - созраняет пользовательские поля, после редиректа
         */
        return back()
            ->withInput()
            ->with('error', 'Не удалось добавить категорию');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title' =>['required', 'string']
        ]);

        /**
         * ->fill()
         * записывает в таблицу к указанным полям (если есть ->only()) значения
         * из $request
         *
         * аналогично можно записать и сл. образом (но это применимо если у тебя
         * мало полей)
         *
         * $category->title = $request->input('title');
         * $category->description = $request->input('description');
         * $category->save();
         */
        $category->fill($request->only(['title', 'description']))
            ->save();

        if ($category) {
            return redirect()->route('admin.categories.index')
                ->with('success', 'Категория успешно сохранена');
        }

        return back()->withInput()->with('error', 'Не удалось сохранить категорию');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
