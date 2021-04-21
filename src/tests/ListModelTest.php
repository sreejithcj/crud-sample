<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Src\model\ListModel;

//Unit test class for ListModel class
class ListModelTest extends TestCase
{
    public function testGetList() {
        $expected ='[{"id":"53","title":"Heading not visible","description":"The heading in add to cart page is not visible","current_status":"new","target_resolution_date":null,"actual_resolution_date":"2021-02-17 08:45:54","priority":"1","owner":"Josje Leyson","created_by":"Jhanvi Ram","project_name":"Little treats website"},{"id":"54","title":"The  product name should be in different color","description":"Need more prominent font color for product name","current_status":"new","target_resolution_date":null,"actual_resolution_date":"2021-02-17 08:47:13","priority":"2","owner":"Brian Larson","created_by":"Jhanvi Ram","project_name":"The healthy options mobile application"},{"id":"55","title":"Unable to add bundle product to cart","description":"Unable to add bundle product to cart when one of the product is already present in the cart","current_status":"new","target_resolution_date":null,"actual_resolution_date":"2021-02-17 08:48:10","priority":"1","owner":"Brian Larson","created_by":"Jhanvi Ram","project_name":"The healthy options mobile application"}]';
        $listObj = new ListModel();
        $this->assertEquals($expected, json_encode($listObj->getList(1)));
    }

    public function testProjects() {
        $expected = '[{"id":"1","project_name":"Little treats website","start_date":"2021-02-13 10:58:26","end_date":null},{"id":"2","project_name":"The healthy options mobile application","start_date":"2021-02-13 11:00:07","end_date":null}]';
        $listObj = new ListModel();
        $this->assertEquals($expected, json_encode($listObj->projects()));
    }

    public function testUsers() {
        $expected = '[{"id":"1","name":"Jhanvi Ram"},{"id":"2","name":"Josje Leyson"},{"id":"3","name":"Brian Larson"}]';
        $listObj = new ListModel();
        $this->assertEquals($expected, json_encode($listObj->users()));
    }
}