<?php
declare(strict_types=1);

namespace Src\app\db;

interface IDatabase {
    public function executeStatement(...$values);
    public function executeQuery($query);  
}
