<?php


namespace App\Services;

use App\Contracts\Parser;
use XmlParser;

/**
 * тут будет наш парсер
 * а его интерфейс будет в Contact/Parser
 */
class ParserService implements Parser
{
    protected string $url;

    public function getDate(string $url): array
    {
        /**
         * прогоняем нашу ссылку с *.rss через библиотеку парса и загружаем
         * результат в переменную $load
         */
        $load = XmlParser::load($url);

        /**
         * парсим документ
         * channel - родительский атрибут в нем содержатся title итп
         * title итп - поля документа
         *
         * return ... возвращаем массив который мы получаем с парсинга
         */
        return $load->parse([
            'title' => [
                'uses' => 'channel.title',
            ],

            'link' => [
                'uses' => 'channel.link',
            ],

            'description' => [
                'uses' => 'channel.description',
            ],

            'image' => [
                'uses' => 'channel.image.url',
            ],

            'news' => [
                'uses' => 'channel.item[title,link,guid,description,pubDate]'
            ],
        ]);
    }
}
