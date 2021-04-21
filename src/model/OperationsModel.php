<?php
declare(strict_types=1);

namespace Src\model;

//Model class for the actions (add/update)
class OperationsModel extends Model
{  
    public function __construct() {
        parent::__construct();
    }

    //Create a new bug in database
    public function create($data) {
        
        $sqlStatement = "INSERT INTO bugs 
                (title, description, current_status, creator_id, project_id, owner_id, priority) 
                VALUES(:title, :description, :current_status, :creator_id, :project_id, :owner_id, :priority)";
        
        $goodArray = $this->sanitize($data);

        $values = array(':title' => $goodArray['bugTitle'], ':description' => $goodArray['bugDescription'], 
        ':current_status' => $goodArray['bugStatus'],':creator_id' => $goodArray['creatorId'],':project_id' 
        => $goodArray['projectId'],':owner_id' => $goodArray['ownerId'],':priority' => $goodArray['priority'] );

        return $this->database->executeStatement($sqlStatement,$values);
    }

    //Updates a bug
    public function update($data) {

        $sqlStatement = "UPDATE bugs SET 
        title           = :title, 
        description     = :description, 
        current_status  = :current_status, 
        creator_id      = :creator_id, 
        project_id      = :project_id, 
        owner_id        = :owner_id, 
        priority        = :priority
        WHERE id        =".$data['bugId'];

        $goodArray = $this->sanitize($data);

        $values = array(':title' => $goodArray['bugTitle'], ':description' => $goodArray['bugDescription'], ':current_status' => 
        $goodArray['bugStatus'],':creator_id' => $goodArray['creatorId'],':project_id' => 
        $goodArray['projectId'],':owner_id' => $goodArray['ownerId'],':priority' => $goodArray['priority'] );
        
        $this->database->executeStatement($sqlStatement,$values);
    }

    //Returns the bug details
    public function details($id) {

        if(!isset($id)) {
            return false;
        }

        $statement = "SELECT 
        b.id, 
        b.title, 
        b.description,
        b.current_status,
        b.target_resolution_date,
        b.actual_resolution_date,
        b.priority,
        u.first_name || ' ' || u.last_name as 'owner',
        u.id as ownerId,
        us.first_name || ' ' || us.last_name as created_by,
        us.id as creatorId,
        p.project_name,
        p.id as projectId
        from bugs b 
        INNER JOIN users u ON u.id=b.owner_id  
        INNER JOIN users us ON us.id=b.creator_id
        INNER JOIN projects p ON p.id = b.project_id
        WHERE b.id =" .$id;

        return $this->database->executeStatement($statement);
    }
}