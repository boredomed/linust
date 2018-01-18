<?php
  session_start();
   error_reporting(E_ERROR | E_PARSE);
  // If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }
?>
<?php

$host = "localhost";
$user = "root";
$pass = "";
$database = "linust_f";

/*Connection Functions*/
$link = mysqli_connect($host,$user,$pass) or die ("Connection was unsuccessful");
mysqli_select_db($link,$database);

$id = $_GET['id'];
$type = $_GET['type'];

if($type=='CourseWork')
	$sqlQuery = "UPDATE file_upload SET status=1 WHERE file_id='$id'";
else if($type=='RelatedLink')
	$sqlQuery = "UPDATE url_upload SET status=1 WHERE url_id='$id'";

mysqli_query($link,$sqlQuery);
header("Location:adminpanel.php");

?>