<div class="jumbotron">
  <?php

  $db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  $myUsername = $_SESSION["user_name"];

  ?>
  <h2 class="sub-header">My Cases</h2>
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Case ID</th>
          <th>Name</th>
          <th>Style</th>
          <th>View the Case</th>
        </tr>
      </thead>
          <?php 
              //show cases
          $sql = "SELECT cases.case_id, cases.case_name, cases.style FROM cases, owns WHERE cases.case_id = owns.case_id AND owns.user_name = '" . $myUsername . "';";

          $results = $db_connection->query($sql);
          $row = NULL;

          echo "<tbody>";
          while ($row = mysqli_fetch_array($results)) {
              echo '<tr><td>' . $row["case_id"] . '</td><td>' . $row["case_name"] . '</td><td>' . $row["style"] . '</td><td><a href="http://web.engr.illinois.edu/~ctrocs411/case.php?case_id=' . $row["case_id"] .'"><button class="btn btn-primary">View Case</button></a></td></tr>';
          }
          echo "</tbody>";
          ?>
    </table>
  </div>

  <h2 class="sub-header">MyInterviews</h2>
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Interview ID</th>
          <th>Interviewer</th>
          <th>Interviewee</th>
          <th>Enter Interview</th>
        </tr>
      </thead>
      <?php
        //show interviews
        $sql_interview = "SELECT interviews.interview_id, interviews.giver_username, interviews.taker_username FROM interviews WHERE interviews.taker_username = '" . $myUsername . "' OR interviews.giver_username = '" . $myUsername . "';";

        $results = $db_connection->query($sql_interview);
        $row2 = NULL;
        if ($results === FALSE) {
          echo "FALSE";
        } else {
          echo "<tbody>";
          while ($row = mysqli_fetch_array($results))
          {
            echo '<tr><td>' . $row["interview_id"] .'</td><td>' . $row["giver_username"] . '</td><td>' . $row["taker_username"] . '</td><td><a href="http://web.engr.illinois.edu/~ctrocs411/interview.php?interview_id=' . $row["interview_id"] .'"><button class="btn btn-primary">Enter Interview</button></a></td></tr>';
          }
          echo "</tbody>";
        }
      ?>
    </table>
  </div>
</div>