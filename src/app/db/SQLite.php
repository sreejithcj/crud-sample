<?php

declare(strict_types=1);

namespace Src\app\db;
use PDO;
use Src\app\db\SQLiteConnection;

//SQLite commands implementation
class SQLite implements IDatabase
{
    public function executeStatement(...$values) {
        $stmt = SQLiteConnection::instance()->prepare($values[0]);
        $stmt->execute($values[1] ?? null);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function executeQuery($query) {
        return SQLiteConnection::instance()->query($query)->fetch(PDO::FETCH_COLUMN);
    }
}