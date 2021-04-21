<?php

declare(strict_types=1);

namespace Src\app\db;

class DbFactory
{
    //Create the db provider object
    public static function provider(string $provider): object {
        $withNamespace = 'Src\app\db\\' . $provider;
        return new $withNamespace();
    }
}