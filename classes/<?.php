<?

class Interview_Giving{
	
	private $interview_id = -1;

	 public function __construct($int_id)
    {
        if (isset($_POST["interview"])) {
            $this->Interview();
            $this->interview_id = $int_id
        }
    }
}

?>