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
        print_r($_POST);
        if (isset($_POST["CaseUpload"])) {
            $this->uploadNewCase();
        }
    }

    private function uploadNewCase()
    {

        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        $case_name = $this->db_connection->real_escape_string(strip_tags($_POST['case_name'], ENT_QUOTES));
        $case_style = $this->db_connection->real_escape_string(strip_tags($_POST['case_style'], ENT_QUOTES));

        $num_slides = 10; //TODO once PDF splitting works

        $sql = "INSERT INTO cases (case_id, case_name, style, num_slides, times_taken, avg_time)
                            VALUES(NULL, '" . $case_name . "', '" . $case_style . "', '" . $num_slides . "', '0','0.0');";

        $query_new_case_insert = $this->db_connection->query($sql);


        if ($query_new_case_insert) {
            $this->messages[] = "Your case has been created successfully.";
        } else {
            $this->errors[] = "Sorry, your case upload failed. Please go back and try again.";
        }
    }
}
