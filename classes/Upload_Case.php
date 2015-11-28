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
            ini_set('display_errors', 1);
            if (isset($_POST["CaseUpload"])) {
                $this->uploadNewCase();
            }
        }

        private function uploadNewCase()
        {
            ini_set('display_errors', 1);
            session_start();

            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            //print_r($_FILES); //just for debugging, prints file attributes to screen
            
            $case_slides = $_FILES['slides_pdf']['tmp_name'];  //full path of file uploaded to server

            //error checking- make sure file uploaded correctly
            if($_FILES['slides_pdf']['error'] > 0){
                $this->errors[] = "An error ocurred when uploading.";
            }

            $case_name = $this->db_connection->real_escape_string(strip_tags($_POST['case_name'], ENT_QUOTES));
            $case_style = $this->db_connection->real_escape_string(strip_tags($_POST['case_style'], ENT_QUOTES));
            //$case_slides = $this->db_connection->real_escape_string(strip_tags($_POST['slides_pdf'], ENT_QUOTES));


            require_once('fpdf17/fpdf.php');
            require_once('fpdi/fpdi.php');
            $pdf = new FPDI();
            $num_slides = $pdf->setSourceFile($case_slides); //TODO once PDF splitting works

            $sql = "INSERT INTO cases (case_id, case_name, style, num_slides, times_taken, avg_time)
                                VALUES(NULL, '" . $case_name . "', '" . $case_style . "', '" . $num_slides . "', '0','0.0');";

            $query_new_cases_insert = $this->db_connection->query($sql);

            if ($query_new_cases_insert) {

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
            print('Processing Slides (may take a moment)');
            require_once('fpdf17/fpdf.php');
            require_once('fpdi/fpdi.php');


            $pdf = new FPDI();
            $pagecount = $pdf->setSourceFile($filename); // How many pages?

            // Split each page into a new PDF s
            for ($i = 1; $i <= $pagecount; $i++)
            {
                $new_pdf = new FPDI();
                $new_pdf->AddPage('L');
                $new_pdf->setSourceFile($filename);
                $new_pdf->useTemplate($new_pdf->importPage($i)); // Is this actually a PDF yet?

                $myPath = uniqid(true); // 47 Characters long
                $pdf_file = 'CTRO/resources/slide_storage/' . $myPath . '.pdf';
                $save_to = 'CTRO/resources/slide_storage/' . $myPath . '.jpg'; 
                $new_pdf->Output($pdf_file, "F");

                //execute ImageMagick command 'convert' and convert PDF to JPG with applied settings
                exec('convert "'.$pdf_file.'" -colorspace RGB -resize 800 "'.$save_to.'"', $output, $return_var);
                unlink($pdf_file);


                if($return_var[0] == 0) {              //if exec successfuly converted pdf to jpg
                   print "Conversion OK";
                }
                else print "Conversion failed.<br />".$output;

                $sql = "INSERT INTO slides (case_id, slide_num, path_to_slide)
                                VALUES('". $case_id . "', '" . $i . "', '" . $save_to . "'); "; //should be saving save_to instead of $myPath bc need full path to render image

                $query_insert_slide = $this->db_connection->query($sql);
                if($query_insert_slide)
                {
                    $this->messages[] = 'Slide '. $i . ' Successfully Uploaded!';
                }
                else
                    $this->errors[] = 'A slide failed to upload!';
            }

        }

    }
