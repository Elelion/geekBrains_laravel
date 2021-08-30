<?php


namespace App\Contracts;

/**
 * интерфейс парсера
 */
interface Parser
{
    public function getDate(string $url): array;
}