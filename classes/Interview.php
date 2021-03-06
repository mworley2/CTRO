<?php

class Interview
{

    /**
     * @var object $db_connection The database connection
     */
    private $db_connection = null;
    /**
     * @var array $errors Collection of error messages
     */
    public $interviewCompleted;

    public $errors = array();
    /**
     * @var array $messages Collection of success / neutral messages
     */
    public $messages = array();

    public $myID = -1;


    public function __construct($interview_id)
    {
            $this->Interview($interview_id);
    }

    private function Interview($interview_id)
    {
        session_start();
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->myID = $interview_id;

        $sql = "SELECT interviews.completed FROM interviews WHERE interviews.interview_id = " . $this->myID . "; ";
        $result = $this->db_connection->query($sql);
        $row = mysqli_fetch_array($result);

        $this->interviewCompleted = $row['completed'];

    }

    public function isTaking()
    {
        $sql = "SELECT interviews.taker_username FROM interviews, uses, cases
        		WHERE interviews.interview_id = '" . $this->myID . "' AND uses.interview_id = interviews.interview_id AND cases.case_id =  uses.case_id";

        $results = $this->db_connection->query($sql);
        $row1 = mysqli_fetch_array($results);

        if ($row1["taker_username"] == $_SESSION['user_name']) {
            return true;
        }

        return false;
    }

    public function isGiving()
    {
        $sql = "SELECT interviews.giver_username FROM interviews, uses, cases
        		WHERE interviews.interview_id = '" . $this->myID . "' AND uses.interview_id = interviews.interview_id AND cases.case_id =  uses.case_id";

        $results = $this->db_connection->query($sql);
        $row1 = mysqli_fetch_array($results);

        if ($row1["giver_username"] == $_SESSION['user_name']) {
            return true;
        }

        return false;
    }
}

?>