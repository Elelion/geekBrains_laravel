<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Создаем модель для нашей таблици Категории
 * php artisan make:model Category
 *
 * HasFactory - позволяют нам генерировать на основе модели какие то данные
 */
class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected array $allowedFields = ['id', 'title', 'description'];

    public function getCategories(): Collection
    {
        /**
         * аналогично записи
         * DB::select("SELECT id, title, description from {$this->table}");
         *
         * НО возвращает уже не массив а коллекцию! (Illuminate\Support\Collection)
         */
        return DB::table($this->table)
            ->select($this->allowedFields)
            ->get();
    }

    public function getCategoryById(int $id): object
    {
        /**
         * аналогично записи
         * DB::select("SELECT id, title, description from {$this->table} WHERE id = :id", ['id' => $id]);
         */
        return DB::table($this->table)
            ->select($this->allowedFields)
            ->find($id);
    }
}
