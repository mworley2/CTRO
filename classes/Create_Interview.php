<?php
ini_set('display_errors', 1);
class Create_Interview{
	
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
        if (isset($_POST["create"])) {
            $this->CreateInterview();
        }
    }

    private function CreateInterview(){
    	//insert giver_username, taker_username, permissions into interviews
    	//then insert case_id and interview_id into uses
    	session_start();
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        $case_id = $this->db_connection->real_escape_string(strip_tags($_POST['case_id_for_creation'], ENT_QUOTES));
        //TODO if the other user doesnt exist
        $taker_username = $this->db_connection->real_escape_string(strip_tags($_POST['interviewee_name'], ENT_QUOTES));
        $giver_username = $_SESSION["user_name"]; //gets username from current session
        $permissions = $this->db_connection->real_escape_string(strip_tags($_POST['slide_num_end'], ENT_QUOTES));

        $sql = "INSERT INTO interviews (interview_id, permissions, giver_username, taker_username, notes, timeTaken)
                            VALUES(NULL, '" . $permissions . "', '" . $giver_username . "', '" . $taker_username . "', NULL,'0.0');";

        $query_new_interviews_insert = $this->db_connection->query($sql);

        if($query_new_interviews_insert){
        	$interview_id = $this->db_connection->insert_id;

        	$sql_uses = "INSERT INTO uses (interview_id, case_id)
                            VALUES('". $interview_id . "', '" . $case_id ."'); ";

            $query_uses_insert = $this->db_connection->query($sql_uses);

            if($query_uses_insert)
                header('Location: http://web.engr.illinois.edu/~ctrocs411/view_cases.php');
            else
                echo "FAIL IN USES";

        }
        else {
            $this->errors[] = "Sorry, your interview creation failed. Please go back and try again.";
        }


    }



}

?>