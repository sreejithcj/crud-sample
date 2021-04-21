<?php
declare(strict_types=1);

namespace Src\controller;

class Controller {

    //Handles the route responses
    protected function response($data,$status,$message) {
        echo json_encode(array('data' => $data,'status' => $status, 'message' => $message));
    }
}