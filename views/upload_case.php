<?php
 //show potential errors / feedback (from registration object)
ini_set('display_errors', 1);
if (isset($upload)) {
    if ($upload->errors) {
        foreach ($upload->errors as $error) {
            echo $error;
        }
    }
    if ($upload->messages) {
        foreach ($upload->messages as $message) {
            echo $message;
        }
    }
}
?>

<h1>Upload a new case</h1>
<!-- register form -->
<form method="post" action="upload_case.php" name="Case Upload Form" enctype="multipart/form-data">

    <!-- the user name input field uses a HTML5 pattern check -->
    <label for="upload_input_name">Case Name</label>
    <input id="upload_input_name" class="upload_input" type="text" name="case_name" required />

    <!-- the email input field uses a HTML5 email type check -->
    <label for="upload_input_style">Case Style</label>
    <input id="upload_input_style" class="upload_input" type="text" name="case_style" required />

    <!-- TODO Server side verification on allowable inputs (pdf) -->

    <label for="upload_input_slides"> Slides Upload</label>
    <input type="file" placeholder="Upload file" action="Upload_Case.php"  name="slides_pdf" id="upload_input_slides" class="required" />


    <input type="submit"  name="CaseUpload" value="Upload Case" />
</form>
<!-- backlink -->
<a href="index.php">Back to Home Page</a>