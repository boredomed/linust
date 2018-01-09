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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  
  <title>Linust - View Profile</title>
  <!-- Bootstrap -->
  <link rel="stylesheet" type="text/css" href="bootstrap.css">
  <link rel="stylesheet" type="text/css" href="cardio.css">
</head>
<body style="background-image:url(b1.jpg);background-size:cover;">
  <h2 class=white jumbotron style="background-color:black;"><center><i>VIEW PROFILE </i></center></h2>


<?php
  require_once('appvars.php');
  require_once('connectvars.php');

  // Make sure the user is logged in before going any further.

  if (!isset($_SESSION['user_id'])) {
    echo '<h3 class="white">Please <a href="login.php">log in</a> to access this page.</h3>';
    exit();
  }
  else {
    echo('<br><br><h3 class="white">You are logged in as ' . $_SESSION['username'] . '. <a href="logout.php">Log out</a></p>.');
  }

  // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  // Grab the profile data from the database
  if (!isset($_GET['user_id'])) {
    $query = "SELECT username, first_name, last_name, gender, birthdate, department, program, picture, email FROM linust_f.users WHERE user_id = '" . $_SESSION['user_id'] . "'";
  }
  else {
    $query = "SELECT username, first_name, last_name, gender, birthdate, department, program, picture,email FROM linust_f.users WHERE user_id = '" . $_GET['user_id'] . "'";
  }
  $data = mysqli_query($dbc, $query);

  if (mysqli_num_rows($data) == 1) {
    // The user row was found so display the user data
    $row = mysqli_fetch_array($data);
    echo '<table>';
    if (!empty($row['username'])) {
      echo '<tr><td class="label">Username:</td><td style="padding-left:100px;">' . $row['username'] . '</td></tr>';
    }
    if (!empty($row['first_name'])) {
      echo '<tr><td class="label">First name:</td><td style="padding-left:100px;">' . $row['first_name'] . '</td></tr>';
    }
    if (!empty($row['last_name'])) {
      echo '<tr><td class="label">Last name:</td><td style="padding-left:100px;">' . $row['last_name'] . '</td></tr>';
    }
	if (!empty($row['email']) ) {
      echo '<tr><td class="label">Email:</td><td style="padding-left:100px;">' . $row['email']  . '</td></tr>';
    }
    if (!empty($row['gender'])) {
      echo '<tr><td class="label">Gender:</td><td style="padding-left:100px;">';
      if ($row['gender'] == 'M') {
        echo 'Male';
      }
      else if ($row['gender'] == 'F') {
        echo 'Female';
      }
      else {
        echo '?';
      }
      echo '</td></tr style="padding-left:100px;">';
    }
    if (!empty($row['birthdate'])) {
      if (!isset($_GET['user_id']) || ($_SESSION['user_id'] == $_GET['user_id'])) {
        // Show the user their own birthdate
        echo '<tr><td class="label">Birthdate:</td><td style="padding-left:100px;">' . $row['birthdate'] . '</td></tr>';
      }
      else {
        // Show only the birth year for everyone else
        list($year, $month, $day) = explode('-', $row['birthdate']);
        echo '<tr><td class="label">Enrolement Year:</td><td style="padding-left:100px;">' . $year . '</td></tr>';
      }
    }
    if (!empty($row['department']) ) {
      echo '<tr><td class="label">Department:</td><td style="padding-left:100px;">' . $row['department']  . '</td></tr>';
    }
	 if (!empty($row['program'])) {
      echo '<tr><td class="label">Program:</td><td style="padding-left:100px;">' . $row['program'] . '</td></tr>';
    }
    if (!empty($row['picture'])) {
      echo '<tr><td class="label">Picture:</td><td style="padding-left:100px;"><img src="' . MM_UPLOADPATH . $row['picture'] .
        '" alt="Profile Picture" /></td></tr>';
    }
    echo '</table>';
    if (!isset($_GET['user_id']) || ($_SESSION['user_id'] == $_GET['user_id'])) {
      echo '<h3 class="white">Would you like to <a href="editprofile.php">edit your profile</a>?</h3>';
    }


  } // End of check for a single row of user results
  else {
    echo '<h2 class="error white">There was a problem accessing your profile.</p>';
  }
    mysqli_close($dbc);
?>


<center><h3 method = "get"><form action = "home.php"><input type="submit"class="btn btn-warning btn-block" style="padding-left:150px;" value="Home" name="submit" /></h3></form></center>
</body>
</html>
