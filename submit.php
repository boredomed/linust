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

if(!empty($_FILES['file']['name'])){
    $uploadedFile = '';
    if(!empty($_FILES["file"]["type"])){
        $fileName = $_FILES['file']['name'];
        $valid_extensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["file"]["name"]);
        $file_extension = end($temporary);
        //echo $_FILES["file"]["type"];
        if((($_FILES["file"]["type"] == "application/pdf"))){
            $sourcePath = $_FILES['file']['tmp_name'];
            $targetPath = "uploads/".$fileName;
            if(move_uploaded_file($sourcePath,$targetPath)){
                $uploadedFile = $fileName;
            }
        }
    }
}
    
    //include database configuration file
    $mysqli = new mysqli("localhost", "root", "", "linust_f");

    
    $insert = "INSERT INTO file_upload (user_id,course_name,file_name,f_date) VALUES ('".$_SESSION['user_id']."', 'dbs','".$uploadedFile."', curdate())";
    $answer = mysqli_query($mysqli, $insert);
    mysqli_query($mysqli, "UPDATE users SET no_of_uploads=no_of_uploads+1 WHERE user_id='".$_SESSION['user_id']."'");

    echo $answer?'ok':'Try Again';
