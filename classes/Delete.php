<?php

class Delete
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
        if (isset($_POST["delete"])) {
            $this->deleteCase();
        }
    }

    private function deleteCase()
    {
        session_start();

        //TODO check that username,case_id exists in the owns table or else its ilelegal deletion and we say you failed
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $deletionID = $_POST["case_id_for_deletion"];
        $sql = "DELETE FROM cases WHERE cases.case_id= '". $deletionID ."';";
        $sql2 = "DELETE FROM owns WHERE owns.case_id= '". $deletionID ."';";

        $querydeletion = $this->db_connection->multi_query($sql . " " . $sql2);

        if ($querydeletion) {
            $this->messages[] = "Successful deletion";
            echo "Deletion Successful";

        } else {
            echo "Deletion Failed";
        }
    }
}
