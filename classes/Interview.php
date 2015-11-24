<?php

class Interview{
	
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
        if (isset($_POST["interview"])) {
            $this->Interview();
        }
    }

    private function Interview(){
    	session_start();
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        //$interview_id = $_SESSION["interview_id"];
        $interview_id = $this->db_connection->real_escape_string(strip_tags($_POST['interview_id'], ENT_QUOTES));

        //search db for the interview_id and display interview's contents
        $sql = "SELECT interviews.interview_id, interviews.giver_username, interviews.taker_username, cases.case_name FROM interviews, uses, cases 
        		WHERE interviews.interview_id = '".$interview_id."' AND uses.interview_id = interviews.interview_id AND cases.case_id =  uses.case_id";

        $results = $this->db_connection->query($sql);

        if($results === FALSE ){
    		echo"FALSE";
		}
		else{
			echo"<h1>Interview </h1>";
			while($row = mysqli_fetch_array($results))
    		{
    			echo'Interview ID: '. $row["interview_id"] .' <br />
    				Case Name: ' .$row["case_name"].'  <br />
    				Giver: ' .$row["giver_username"].'  <br />
    			 	Taker: '.$row["taker_username"].'<br />';
			
			}

    	}

	}//end func interview()

}//end class interview


?>