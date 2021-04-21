<?php
declare(strict_types=1);

namespace Src\model;
use Src\app\config\Config;

//Model class for the listing controller
class ListModel extends Model
{
    public function __construct() {
        parent::__construct();
    }

    //Returns the bugs list
    public function getList($pageNo) {

        if (!isset($pageNo)) {
            return false;
        }

        $offset = ($pageNo - 1 ) * Config::records();
        $statement = "SELECT 
            b.id, 
            b.title, 
            b.description,
            b.current_status,
            b.target_resolution_date,
            b.actual_resolution_date,
            b.priority,
            u.first_name || ' ' || u.last_name as 'owner',
            us.first_name || ' ' || us.last_name as created_by,
            p.project_name
            from bugs b 
            INNER JOIN users u ON u.id=b.owner_id  
            INNER JOIN users us ON us.id=b.creator_id
            INNER JOIN projects p ON p.id = b.project_id limit ". $offset .",". Config::records();
        return $this->database->executeStatement($statement);
    }

    public function totalRecords() {
        return $this->database->executeQuery("SELECT count(*) FROM bugs");
    }

    public function projects() {
        return $this->database->executeStatement("SELECT * from projects");
    }

    public function users() {
        return $this->database->executeStatement("SELECT id, first_name || ' ' ||last_name as 'name' from users");
    }
}