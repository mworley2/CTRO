<?php

class Modify_Case
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
        if (isset($_POST["modify"])) {
            $this->ModifyCase();
        }
    }

    private function ModifyCase()
    {
        session_start();

        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        $case_id = $this->db_connection->real_escape_string(strip_tags($_POST['case_id_for_modification'], ENT_QUOTES));
        $new_case_name = $this->db_connection->real_escape_string(strip_tags($_POST['new_name'], ENT_QUOTES));
        $new_case_style = $this->db_connection->real_escape_string(strip_tags($_POST['new_style'], ENT_QUOTES));

        $myUsername = $_SESSION["user_name"]; //Get the username from the current user

        $sql = "SELECT owns.case_id FROM owns WHERE owns.case_id = '".$case_id."' AND owns.user_name = '".$myUsername."';";

        $can_modify = $this->db_connection->query($sql);

        if($can_modify) {
            $sql = "UPDATE cases SET case_name = '".$new_case_name."', style = '".$new_case_style."' WHERE case_id = '".$case_id."';";

            $modification = $this->db_connection->query($sql);

            if($modification)
                echo "SUCCESSFUL MODIFICATION";
            else
                echo "MODIFICATION FAILURE";
        } else {
            $this->errors[] = "Sorry, you do not have access to that case.";
        }
    }
}
