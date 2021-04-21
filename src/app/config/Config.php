<?php

declare(strict_types=1);

namespace Src\app\config;
final class Config
{
    //Database
    public static function provider(): string {
        return "SQLite";
    }

    //Number of records per page (used for pagination)
    public static function records(): string {
        return "5";
    }
}