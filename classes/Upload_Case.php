<?php

class Upload_Case
{
    /**
     * @var object $db_connection The database connection
     */
    private $db_connection = null;
    /**
     * @var array $errors Collection of error messages
     */
    public $errors = array();
    /**
     * @var array $messages Collection of success / neutral messages
     */
    public $messages = array();


    public function __construct()
    {
        if (isset($_POST["uploadCase"])) {
            $this->uploadNewCase();
        }
    }

    private function uploadNewCase()
    {
        require_once("config/db.php");
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    }

}
