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

<div class="jumbotron">
  <h1>Upload a New Case</h1>
  <p class="lead">Select the name of the case, the style of the case, and attach the slides for the case in pdf form</p>
  <form class="form-horizontal" method="post" action="upload_case.php" name="Case Upload Form" enctype="multipart/form-data">
    <div class="form-group">
      <label class="col-md-4 control-label" for="upload_input_name">Case Name</label>  
      <div class="col-md-4">
        <input id="upload_input_name" name="case_name" type="text" placeholder="Case Name" class="form-control input-md" required>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="upload_input_style">Case Style</label>  
      <div class="col-md-4">
        <input id="upload_input_style" name="case_style" type="text" placeholder="Case Style" class="form-control input-md" required>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="upload_input_slides">Upload Slides (as pdf)</label>
      <div class="col-md-4">
        <input id="upload_input_slides" name="slides_pdf" class="input-file" type="file">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="CaseUpload">Upload</label>
      <div class="col-md-4">
        <button id="CaseUpload" name="CaseUpload" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </form>
</div>

<footer class="footer">
  <p>&copy; 2015 CaseMe</p>
</footer>