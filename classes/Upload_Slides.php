<?php

class Upload_Slides
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
        if (isset($_POST["register"])) {
            $this->uploadNewSlides();
        }
    }
    private function uploadNewSlides()
    {
        require_once("config/db.php");
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        $myPDF = 'imaginary string';
        $nextCaseID = 9;

       // $this->split_pdf($myPDF, $nextCaseID, $this->db_connection);
        /**
         * Split PDF file and upload pieces
         * partial: https://gist.github.com/maccath/3981205
         */

        require_once('../libraries/PDFTools/fpdf17/fpdf.php');
        require_once('../libraries/PDFTools/fpdi/fpdi.php');
        if (!$this->db_connection)
            die("Can't connect to MySQL: " . mysqli_connect_error());

        $pdf = new FPDI();
        $pagecount = $pdf->setSourceFile($myPDF); // How many pages?

        if ($pagecount > 20)
            die("That PDF is too many pages and will clog our database");

        /**
         * https://blogs.oracle.com/oswald/entry/php_s_mysqli_extension_storing For perpared statements
         */

        // Split each page into a new PDF
        for ($i = 1; $i <= $pagecount; $i++) {
            $new_pdf = new FPDI();
            $new_pdf->AddPage();
            $new_pdf->setSourceFile($myPDF);
            $new_pdf->useTemplate($new_pdf->importPage($i));

            $new_pdf->Output('unused', "R");

            $stmt = $this->db_connection->prepare("INSERT INTO slides (image) VALUES(?)");
            $null = NULL;
            $stmt->bind_param("b", $null);
            $stmt->send_long_data(0, $new_pdf);
            $stmt->execute();

        }
    }

/** refactor this out later
    private function split_pdf($filename, $caseUploadID, $mysqli)
    {

    }

 */
 }
