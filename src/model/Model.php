<?php
declare(strict_types=1);

namespace Src\model;
use Src\app\db\DbFactory as DbFactory;
use Src\app\config\Config as Config;

//Model base class
class Model
{
    protected $database = null;
    public function __construct() {
        $this->database = DbFactory::provider(Config::provider());
    }

    protected function sanitize($data) {

        $args = array(
            'bugTitle'   => FILTER_SANITIZE_SPECIAL_CHARS,
            'bugDescription'    => FILTER_SANITIZE_SPECIAL_CHARS,
            'bugStatus'    => FILTER_SANITIZE_SPECIAL_CHARS,
            'creatorId'    => FILTER_SANITIZE_SPECIAL_CHARS,
            'projectId'    => FILTER_SANITIZE_SPECIAL_CHARS,
            'ownerId'    => FILTER_SANITIZE_SPECIAL_CHARS,
            'priority'    => FILTER_SANITIZE_SPECIAL_CHARS);

        return filter_var_array($data, $args);
    }
}