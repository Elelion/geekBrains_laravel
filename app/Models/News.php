<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';
    public static array $allowedFields = ['id', 'category_id', 'title', 'author', 'status', 'description'];

    /**
     * protected array $allowedFields = ['id', 'title', 'author', 'status', 'description'];
     *
     * контроллер: ..Admin/NewsController:
     * не обязательно писать инстанс модели как в yii2
     * $news = new News();
     * $news->getNews();
     * laravel и так уже знает о этой модели
     *
     * методы не задействованы, оставлены просто рамках примеров
     * что можно делать так...
     */
    /*
    public function getNews(): Illuminate\Support\Collection
    {
        //аналогично записи
        // DB::select("SELECT id, title, description from {$this->table}");
        // НО возвращает уже не массив а коллекцию! (Illuminate\Support\Collection)
        return Illuminate\Support\Facades\DB::table($this->table)
            ->select($this->allowedFields)
            ->get();
    }

    public function getNewsById(int $id): object
    {
        // аналогично записи
        // DB::select("SELECT id, title, description from {$this->table} WHERE id = :id", ['id' => $id]);
        return Illuminate\Support\Facades\DB::table($this->table)
            ->select([$this->allowedFields])
            ->find($id);
    }
    */

    protected $fillable = [
        'category_id', 'title', 'description', 'author', 'status'
    ];

    public function category(): BelongsTo
    {
        /**
         * обратная связь для связи в моделе Category
         */
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
