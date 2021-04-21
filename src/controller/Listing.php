<?php
declare(strict_types=1);

namespace Src\controller;
use Src\model\ListModel as ListModel;
use Src\app\config\Config;

//Controller for the listing page
class Listing extends Controller
{
    private $listModel = null;

    public function __construct() {
        $this->listModel = new ListModel();
    }

    //Returns the listing view
    public function index() {
        try {
            $path = getcwd().'/src/view/listing.php';
            include $path;
        } catch (Exception $ex) {
            echo $ex;
        }
    }

    //Returns the list of records
    public function list() {      
        try {
            $list = $this->listModel->getList($_POST['pageNo']);
            if($list) {
                $this->response($list,200,'Success');
            } else {
                $this->response('',204,'No content');
            }  
        } catch(Exception $ex) {
            $this->response('',500,'Error');
        }     
    }

    //Returns the html for pagination on listing page
    public function pagination() {
        try {
            $paginationLinkHTML = $this->generatePageLinks($this->listModel->totalRecords(),Config::records());
            $this->response($paginationLinkHTML,200,'Success');
        } catch(Exception $ex) {
            $this->response('',500,'Error');
        }
    }

    //Returns the list of projects
    public function projects() {
        try {
            $this->response($this->listModel->projects(),200,'Success');
        } catch(Exception $ex) {
            $this->response('',500,'Error');
        }
     }
    
     //Returns the list of users stored in the database
     public function users() {
        try {
            $this->response($this->listModel->users(),200,'Success');
        } catch (Exception $ex) {
            $this->response('',500,'Error');
        }
     }

     private function generatePageLinks($totalRecords,$limit): string {
        $paginationLinkHTML = '<tr><td>';
        $totalPages = ceil($totalRecords/$limit);
        for($i=1; $i<=$totalPages; $i++) {
            $paginationLinkHTML = $paginationLinkHTML."<span id='".$i."' class='pageNo'>".$i."</span>";
        }
        $paginationLinkHTML = $paginationLinkHTML.'</tr></td>';
        return $paginationLinkHTML;        
    }
}