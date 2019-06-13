<?php
  require("functions.php");
  global $description;
  global $dateFrom;
  global $dateTo;
  //kui pole sisse loginud
  if(!isset($_SESSION["userId"])){
	  header("Location: avaleht.php");
	  exit();
  }
  //väljalogimine
  if(isset($_GET["logout"])){
	session_destroy();
	header("Location: avaleht.php");
	exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="pealeht.css">
  <link rel="stylesheet" type="text/css" href="modal.css">
  <script src="modal.js"></script>
  <script src="pealeht.js"></script> 
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Failid</title>
</head>
<body>
<div class="grid-container">
  <div class="grid-sidebar"> 
  <div id="mySidenav" class="sidenav">
    <div id="greeting"> <h1 id="text">Tere, <?php echo $_SESSION["userName"]; ?>!</h1> </div>  
    <div id="menutext">  <a style="font-family: 'digital-clock-font'; cursor:pointer" href="upload.php">Lae üles</a> 
  <br>
  <br>
  <a id="text" style="font-family: 'digital-clock-font';cursor:pointer" href="myfiles.php">Sinu lepingud</a>
  <br>
  <br>
  <a href="?logout=1">Logi välja</a>
  </div>
  </div>  
  </div> 
  <div class="grid-body"> 
  <div id="files" class="files">
  <?php 
$tulemus = showupload($description, $dateFrom, $dateTo);
  echo $tulemus; 
?>
  <div id="myModal" class="modal">
    <!-- The Close Button -->
    <span class="close">&times;</span>

    <!-- Modal Content (The Image) -->
    <img class="modal-content" id="modalImg">

    <!-- Modal Caption (Image Text) -->
    <div id="caption"></div>
</div>  
</div> 
</div>
</div>


</body>
</html>