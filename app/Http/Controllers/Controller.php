<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * Наш список новостей
     *
     * @var array
     */
    protected array $newsList = [
        [
            'id' => 1,
            'title' => 'News 1',
            'description' => 'Desc 1'
        ],
        [
            'id' => 2,
            'title' => 'News 2',
            'description' => 'Desc 3'
        ],
        [
            'id' => 3,
            'title' => 'News 3',
            'description' => 'Desc 3'
        ]
    ];

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
