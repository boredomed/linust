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

if(!empty($_POST['Comment'])){
    $uploadedComment = $_POST['Comment'];
   // echo $uploadedUrl;
    }

    $mysqli = new mysqli("localhost", "root", "", "linust_f");

    //insert form data in the database
    $insert = "INSERT INTO comments (user_id,course_name,comment,c_date) VALUES ('".$_SESSION['user_id']."', 'dbs','".$uploadedComment."', curdate())";
    $answer = mysqli_query($mysqli, $insert);
    mysqli_query($mysqli, "UPDATE users SET no_of_comments=no_of_comments+1 WHERE user_id='".$_SESSION['user_id']."'");
    if($answer)
		header("Location:CoursePage.php");
    else
    	echo "Error:comment could not be submitted";
 ?>