<?php
declare(strict_types=1);

namespace Src\controller;
use Src\model\OperationsModel;

class Operations extends Controller {

    private $operationsModel = null;

    public function __construct() {
        $this->operationsModel = new OperationsModel();
    }

    //Create a new bug
    public function create() {
        $this->operationsModel->create($_POST);
        $this->response('',200,'Success');
    }

    //Update a bug
    public function update() {
        if($this->operationsModel->update($_POST)) {
            $this->response('',200,'Success');
        } else {
            $this->response('',204,'Error');
        }
    }

    //Return the bug details for edit popup
    public function details() {
        try {
            $details = $this->operationsModel->details($_POST['bugId']);
            if($details) {
                $this->response($details,200,'Success');
            } else {
                $this->response('',204,'Error');
            }
        } catch(Exception $ex) {
            $this->response('',500,'Error');
        }  
    }
}