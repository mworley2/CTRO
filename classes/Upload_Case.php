<?php
ini_set('display_errors', 1);
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
        if (isset($_POST["CaseUpload"])) {
            $this->uploadNewCase();
        }
    }

    private function uploadNewCase()
    {
        session_start();

        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        $case_name = $this->db_connection->real_escape_string(strip_tags($_POST['case_name'], ENT_QUOTES));
        $case_style = $this->db_connection->real_escape_string(strip_tags($_POST['case_style'], ENT_QUOTES));
        $case_slides = $this->db_connection->real_escape_string(strip_tags($_POST['slides_pdf'], ENT_QUOTES));

        require_once('fpdf17/fpdf.php');
        require_once('fpdi/fpdi.php');
        $pdf = new FPDI();
        print_r($case_slides);
        $num_slides = $pdf->setSourceFile($case_slides); //TODO once PDF splitting works

        $sql = "INSERT INTO cases (case_id, case_name, style, num_slides, times_taken, avg_time)
                            VALUES(NULL, '" . $case_name . "', '" . $case_style . "', '" . $num_slides . "', '0','0.0');";

        $query_new_owns_insert = $this->db_connection->query($sql);
        //$case_id = 0;

        if ($query_new_owns_insert) {

            $case_id = $this->db_connection->insert_id;

            $sql = "INSERT INTO owns (user_name, case_id)
                            VALUES('". $_SESSION["user_name"] . "', '" . $case_id ."'); ";

            $query_new_owns_insert = $this->db_connection->query($sql);

            if(!$query_new_owns_insert)
                $this->errors[] = 'Sorry, your case upload failed. Please go back and try again. -> Failure to insert into owns table';
            else
            {
                //TODO Make all of the sql entries contingent on eachother
                $this->split_pdf($case_slides, $case_id);
            }

        } else {
            $this->errors[] = "Sorry, your case upload failed. Please go back and try again.";
        }


    }
    // https://gist.github.com/maccath/3981205
    private function split_pdf($filename, $case_id)
    {
        require_once('fpdf17/fpdf.php');
        require_once('fpdi/fpdi.php');

        $base_directory = 'resources/slide_storage/';


        $pdf = new FPDI();
        $pagecount = $pdf->setSourceFile($filename); // How many pages?

        // Split each page into a new PDF
        for ($i = 1; $i <= $pagecount; $i++)
        {
            echo $i;
            $new_pdf = new FPDI();
            $new_pdf->AddPage('L');
            $new_pdf->setSourceFile($filename);
            $new_pdf->useTemplate($new_pdf->importPage($i)); // Is this actually a PDF yet?

            $new_path = $base_directory . "c" . $case_id . "p" . $i . '.pdf';
            $new_pdf->Output($new_path, "F");

           /* $im = new Imagick();
            $im->setResolution(300,300); //TODO wtf res do we want?
            $im->readimage($new_pdf);
            $im->setImageFormat('jpeg');
            $im->writeImage($new_path);
            $im->clear();
            $im->destroy();
           */
        }

    }

}
