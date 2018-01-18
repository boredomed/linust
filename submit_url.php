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

if(!empty($_POST['url'])){
    $uploadedUrl = $_POST['url'];
   // echo $uploadedUrl;

            }

    $mysqli = new mysqli("localhost", "root", "", "linust_f");

    
    //insert form data in the database
    $insert = "INSERT INTO url_upload (user_id,course_name,url_link,u_date) VALUES ('".$_SESSION['user_id']."', 'dbs','".$uploadedUrl."', curdate())";
    $answer = mysqli_query($mysqli, $insert);
    mysqli_query($mysqli, "UPDATE users SET no_of_uploads=no_of_uploads+1 WHERE user_id='".$_SESSION['user_id']."'");

    echo $answer?'ok':'Try Again';
 ?>