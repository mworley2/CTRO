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
    public $errors = array();
    /**
     * @var array $messages Collection of success / neutral messages
     */
    public $messages = array();

    private $myID = -1;


    public function __construct()
    {
        if (isset($_POST["interview"])) {
            $this->Interview();
        }
    }

    private function Interview()
    {
        session_start();
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        $this->myID = $this->db_connection->real_escape_string(strip_tags($_POST['interview_id'], ENT_QUOTES));

        /*if ($results === FALSE) {
            echo "FALSE";
        } else {
            echo "<h1>Interview </h1>";
            while ($row = mysqli_fetch_array($results)) {
                echo 'Interview ID: ' . $row["interview_id"] . ' <br />
    				Case Name: ' . $row["case_name"] . '  <br />
    				Giver: ' . $row["giver_username"] . '  <br />
    			 	Taker: ' . $row["taker_username"] . '<br />';

            }

        }
    */
    }//end func interview()

//end class interview


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


/*
            <div class="flexslider home-slider">
<ul class="slides"><!-- TODO Need to make this longer and user facebook picture -->
	<li><img alt="Joe Kleinhans and David Kleinhans" src="img/JoeDad.jpg" /></li>
	<li><img alt="Graduation with friends" src="img/graduation.jpg" /></li>
	<li><img alt="The Kleinhans Family" src="img/family.jpg" /></li>
</ul>
</div>
*/
?>