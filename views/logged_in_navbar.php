<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="index.php"><img src="assets/logosmall.png" style="height:50px;"></a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="comingsoon.php">About</a></li>
        <li><a href="comingsoon.php">Contact</a></li>
        <li class="dropdown">
          <a href="signin.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cases<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="upload_case.php">Upload Case</a></li>
            <li><a href="view_cases.php">View Cases</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php?logout">Logout</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>