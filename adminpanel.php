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

<html>
<head>
<title> Admin Panel </title>
<head>
    <!-- media queries -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="navbar_scripts.js"></script>
  <link rel="stylesheet" type="text/css" href="css/animate.css">
  <!-- Normalize -->
  <link rel="stylesheet" type="text/css" href="css/cardio.css">
  
  <link rel="stylesheet" type="text/css" href="stylesheet1.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
  <!-- Global Site Tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-111996482-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-111996482-1');
  </script>

  <style type="text/css">
    @import "http://fonts.googleapis.com/css?family=Raleway";
  
    #my_div {
      width:100%;
      height:100%;
      opacity:.95;
      top:0;
      left:0;
      display:none;
      position:fixed;
      background-color:#313131;
      overflow:auto;
      z-index: 1000;
    }

    #my_div1 {
      width:100%;
      height:100%;
      opacity:.95;
      top:0;
      left:0;
      display:none;
      position:fixed;
      background-color:#313131;
      overflow:auto;
      z-index: 1000;
    }

    div#my_popup {
      position:absolute;
      left:50%;
      top:200%;
      align-content: center;
      overflow: visible;
      margin-left:-202px;
      font-family:'Raleway',sans-serif
    }

    form#fupForm {
      max-width:300px;
      min-width:250px;
      padding:10px 50px;
      border:2px solid gray;
      border-radius:10px;
      font-family:raleway;
      background-color:#fff;
      margin-left: 40%;
      margin-top:20%;
    }

    form#URLForm {
      max-width:300px;
      min-width:250px;
      padding:10px 50px;
      border:2px solid gray;
      border-radius:10px;
      font-family:raleway;
      background-color:#fff;
      margin-left: 40%;
      margin-top:20%;
    }


    .sortable {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    border:0px;
    width: 100%;
    color:#222222;
    }

    .sortable tr:nth-child(even){background-color: #f2f2f2;}

    .sortable tr:hover {background-color: #ddd;}

    .sortable td, .sortable th {
        border: 1px solid #ddd;
        padding: 8px;
        color: #222222;
    }

    .sortable th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: #222222;
        color: white;
    }
    .headers{
      padding-left: 5%; 
      padding-right: 5%;
      opacity: 0.9;
    }
    .tableContainer{
      background-color: #f5f2f1;
      border-radius: 0px 0px 5px 5px;
      margin-left: 2%; 
      margin-right: 2%;
      padding: 2% 
    }
    .headers >h3{
      margin-bottom: 0px;
    }
    .comment{
      opacity: 0.9;
      background-color: #303030;
    }
    .comment > p{
      margin-bottom: 3px;
    }
  </style>

</head>
<?php
  require_once('connectvars.php');
  
  // Start the session
  session_start();
  // Clear the error message
  $error_msg = "";
  // If the user isn't logged in, try to log them in
  if (!isset($_SESSION['user_id'])) {
    if (isset($_POST['submit'])) {
      // Connect to the database
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
      // Grab the user-entered log-in data
      $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
      $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));
      if (!empty($user_username) && !empty($user_password)) {
        // Look up the username and password in the database
        $query = "SELECT user_id, username FROM users WHERE username = '$user_username' AND password = SHA('$user_password')";
        $data = mysqli_query($dbc, $query);
        if (mysqli_num_rows($data) == 1) {
          // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
          $row = mysqli_fetch_array($data);
          $_SESSION['user_id'] = $row['user_id'];
          $_SESSION['username'] = $row['username'];
          setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
          setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
      // Redirect to the home page
      $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/home.php';
         
        }
        else {
          // The username/password are incorrect so set an error message
          
          //<h5 style = 'color:white; margin-top:1cm; margin-bottom:-2cm; float:right'>Sorry, you must enter a valid username and password to log in.</h5>
       echo "<script>alert('Sorry, you must enter a valid username and password to log in');</script>";
    }
      }
      else {
        // The username/password weren't entered so set an error message
        echo "<span style = 'color:white; margin-top:3cm;'>Sorry, you must enter your username and password to log in.</span>";
      }
    }
  }
?>
<script>
$(document).ready(function(){    
    $("div.headers h3").click(function(){
      console.log("asdasd");
        $(this).siblings("*").not("h3").toggle();
    });
/*    $("input[type='button']").click(function(e){
      e.preventDefault();
      return false; 
    });
*/
    $('table').DataTable( {
        fixedHeader: true
    } );
  $("#courseProgress");
  $("#linkProgress");
});

</script>

<body onload = "typeWriter()">
<section id="team" class="section gray-bg" style="background-image:url(b1.jpg); background-size:cover;";">
  <!-- Nav Bar -->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <img src = "logo.png" width = "40px" height = "40px" id = "imm">
        <button id="navbarCollapseButton" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
        </button>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li ><a href="home.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span><b>&nbsp Home</b></a></li>
          <li class = "dropdown">
            <a href="#intro" class="dropdown-toggle" data-toggle="dropdown" style="color:white;">Schools</a>
            <ul class="dropdown-menu" style="background-color:black">
        
              <li class="dropdown dropdown-submenu" >
                <a href="course1.php" target="null" class="dropdown-toggle" data-toggle="dropdown" style="color:grey;">Seecs</a>
                  <ul class = "dropdown-menu" style="background-color:black;">
                  <li><a href="course1.php" target="null" style="color:grey;">Software Engineering</a></li>
                  <li><a href="course1.php" target="null" style="color:grey;">Electrical Engineering</a></li>
                  <li><a href="course1.php" target="null" style="color:grey;">Computer Science</a></li>
                  </ul>
              </li>
              <li class="dropdown dropdown-submenu" >
                <a href="course1.php" target="null" class="dropdown-toggle" data-toggle="dropdown" style="color:grey;">Nbs</a>
                  <ul class = "dropdown-menu" style="background-color:black;">
                  <li><a href="course1.php" target="null" style="color:grey;">BBA</a></li>
                  <li><a href="course1.php" target="null" style="color:grey;">MBA</a></li>
                  <li><a href="course1.php" target="null"style="color:grey;">ACF</a></li>
                  </ul>
              </li>
              
              <li class="dropdown dropdown-submenu" >
                <a href="course1.php" target="null" class="dropdown-toggle" data-toggle="dropdown" style="color:grey;">SMME</a>
                <ul class = "dropdown-menu" style="background-color:black;">
                    <li><a href="course1.php" target="null" style="color:grey;">Mechanical Engineering</a></li>
                    <li><a href="course1.php" target="null" style="color:grey;">Megatronic Engineering</a></li>
                    <li><a href="course1.php" target="null"style="color:grey;">Material Engineering</a></li>
                </ul>
              </li>
              
              <li class="dropdown dropdown-submenu" >
                <a href="course1.php" target="null" class="dropdown-toggle" data-toggle="dropdown" style="color:grey;">NICE</a>
                <ul class = "dropdown-menu" style="background-color:black;">
                    <li><a href="course1.php" target="null" style="color:grey;">Civil Engineering</a></li>
                    <li><a href="course1.php" target="null" style="color:grey;">Road Engineering</a></li>
                    <li><a href="course1.php" target="null"style="color:grey;">Info Engineering</a></li>
                </ul>
              </li>
        
              <li class="dropdown dropdown-submenu" >
                <a href="course1.php" target="null" class="dropdown-toggle" data-toggle="dropdown" style="color:grey;">SNS</a>
                <ul class = "dropdown-menu" style="background-color:black;">
                    <li><a href="course1.php" target="null" style="color:grey;">Physics</a></li>
                    <li><a href="course1.php" target="null" style="color:grey;">Maths</a></li>
                    <li><a href="course1.php" target="null"style="color:grey;">Fluid Physics</a></li>
                </ul>
              </li>
              
              <li class="dropdown dropdown-submenu" >
                <a href="course1.php" target="null" class="dropdown-toggle" data-toggle="dropdown" style="color:grey;">SCME</a>
              </li>
              
              <li class="dropdown dropdown-submenu" >
                <a href="course1.php" target="null" class="dropdown-toggle" data-toggle="dropdown" style="color:grey;">S3H</a>
              </li>
            </ul>
          </li>
          <li><a href="portal.php">News Portal</a></li>
        </ul><!-- Login Button !-->
        <ul class="nav navbar-nav navbar-right">
          <li>
            <ul class="nav">
              <li>
                <form id="searchContainer">
                  <input list="list" id="name" placeholder="Search.." class="search" onclick="search()">
                  <datalist id="list"> 
                  </datalist>
                </form>
              </li>
              <li>
                <button style="margin:0px;margin:12px 0px 12px 0px ;padding: 0px;" class="searchGo">>> </button>
        &nbsp
              </li>
            </ul>
          </li><?php if (isset($_SESSION['username'])){  ?>
      
      <li><span class="glyphicon glyphicon-edit" style = "color:white; margin-top: .5cm;"></span>
        <a href="viewprofile.php" style="margin-top: -.75cm; color:white;"><?php echo '&nbsp'.strtoupper($_SESSION['username']).''; ?>
      </li>
      
         <?php } else {?>
      <li><a data-toggle="modal" data-target="#signupModal"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
          <li><a data-toggle="modal" data-target="#loginModal"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
     <?php } ?>
        </ul>
      </div>
    </div>
  </nav>
  
  <!-- Login Form !-->
  <div id="loginModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"> &times;</button>
          <h3><b>Login<b></h3sss>
        </div>
        <div class="modal-body">
        <!-- Form for collection of data from the sign-up form -->
          <form class="form-inline" method = 'post' action = ''>
            <div class="form-group">
              <label class="sr-only" for="email">Username</label>
              <input type="text" class="form-control input-sm" placeholder="username" id="username" name="username" required>
            </div>
            <div class="form-group">  
              <label class="sr-only" for="password" >Password</label>
              <input type="password" class="form-control input-sm" placeholder="Password" id="password" name="password" required>
            </div>
            <input type="submit" value = "Sign in" name = "submit" class="btn btn-info btn-xs">
      
            </Br></Br>
            <div class="checkbox">
              <label>
                <input type="checkbox" id = "rememberme" name = "rememberme"> Remember me
              </label><br><br>
        <div align="center" class="fb-login-button" data-max-rows="1" data-size="small" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false"></div>
            </div>  
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <!-- SignUp Form !-->
<?php
  require_once('appvars.php');
  require_once('connectvars.php');
  // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
    $username = mysqli_real_escape_string($dbc, trim($_POST['username1']));
    $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
    $password2 = mysqli_real_escape_string($dbc, trim($_POST['repassword']));
    $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
    $fname = mysqli_real_escape_string($dbc, trim($_POST['fname']));
    $lname = mysqli_real_escape_string($dbc, trim($_POST['lname']));
    if (!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2) && (!empty($email)) && (!empty($fname)) && (!empty($lname)) ) {
      // Make sure someone isn't already registered using this username
      $query = "SELECT * FROM users WHERE username = '$username'";
      $data = mysqli_query($dbc, $query);
      if (mysqli_num_rows($data) == 0) {
        // The username is unique, so insert the data into the database
        $query = "INSERT INTO users (username, password, join_date, first_name, last_name, email) VALUES ('$username', SHA('$password1'), NOW(), '$fname', '$lname', '$email')";
        mysqli_query($dbc, $query);
        // Confirm success with the user
        echo '<p>Your new account has been successfully created. You\'re now ready to <a href="login.php">log in</a>.</p>';
        mysqli_close($dbc);
      }
      else {
        // An account already exists for this username, so display an error message
        echo '<p class="error">An account already exists for this username. Please use a different address.</p>';
        $username = "";
      }
    }
    else {
      echo '<p class="error">You must enter all of the sign-up data, including the desired password twice.</p>';
    }
  }
  mysqli_close($dbc);
?>
 
  <div id="signupModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"> &times;</button>
          <h3><b>Sign Up</b></h3>
        </div>
        <div class="modal-body">
          <form class="form-inline"  method="post" action="">
            <h5>
              <div class="form-group" id = "fn">
                  <b>Name</b>
                  <label class="sr-only" for="fname">First Name</label>
                  <input type="text" class="form-control input-sm" placeholder="First Name" id="fname" name="fname" required>
              </div>
              &nbsp;
              &nbsp;
              <div class="form-group" id ="ln">
                <label class="sr-only" for="lname">Last Name</label>
                <input type="text" class="form-control input-sm" placeholder="Last Name" id="lname" name="lname">
              </div>
            </h5>
            </Br>
            </Br>
            <h5>
              <div class="form-group" style="margin-left: 0cm">
                <b>Username</b>
                <label class="sr-only" for="username1">Username</label>
                <input type="text" class="form-control input-sm" placeholder="username" id="username1" name="username1" required>
                &nbsp 
                <a href="#" data-toggle="tooltip" title="No spaces should be included">
                  <span class="glyphicon glyphicon-question-sign" aria-hidden="true">
                  </span>
                </a>
              </div>
            </h5>
            </Br>
            </Br>
            <div class="form-group" id = "em">
              <h5>
                <b>E-mail</b>
                <label class="sr-only" for="email">Email</label>
                <input type="text" class="form-control input-sm" placeholder="Email" id="email" name="email" required>
              </h5>
            </div>
            </Br>
            </Br>
            <h5>
              <div class="form-group" id = "pw">
                  <b>Pasword</b>
                  <label class="sr-only" for="password1" >Password</label>
                  <input type="password" class="form-control input-sm" placeholder="Password" id="password1" name="password1" onkeyup = "func_p()" required>
              </div>
              &nbsp;
              &nbsp;
              <div class="form-group">  
                <label class="sr-only" for="repassword" style="margin-left: 0cm">Re-Enter Password</label>
                <input type="password" class="form-control input-sm" placeholder="Re-Enter Password" id="repassword" name="repassword" onkeyup = "pass_match()" required>
              </div>
            </h5>
            </Br>
            <p id = "demo1" style= "display:inline; margin-left: 1.7cm;"></p>
            <p style= "display:inline; margin-left: 0cm" id = "demo"></p>
            <p style= "display:inline; margin-left: 2.5cm; color:red" id = "demo2"></p>
            <p style= "display:inline; margin-left: 2.5cm; color:blue" id = "demo3"></p>
            </Br></Br>
            <div class="form-group">
              <input type="checkbox" id="accept-terms">
              <label for="accept-terms">I agree to the 
                <a href="#" title="User Terms and Conditions" data-toggle="popover" data-placement="right" data-content="Personal information collection
  Using personal information
  Securing your data
  Cross-border data transfers
  Updating this statement
  Other websites
  Contact
  This privacy statement">Terms</a>
              </label>
              <div class="g-recaptcha" data-sitekey="6Lfcoj8UAAAAAF9XCT-RWY4Dm_dHTi3iYZYreEzm"></div>
            </div>
            </div>
            </Br></Br>
            <input type="submit" name = "submit" value = "Sign Up" class="btn btn-info btn-xs">
            
<div align="center" class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false"></div>
            </Br>
            </Br>
          </form>
        </div>
      </div>
    </div>
  </div>


<?php if (isset($_SESSION['username']) && $_SESSION['username']=='admin'){ ?>
<div class="headers" style="margin-top: 100px"><h3>Course Work</h3>
  <div class="tableContainer">
  <table class="sortable">
    <thead style="color:black;background-color: white;">
      <tr>
        <th style="padding: 0px;width:30px;">ID</th>
        <th>Title</th>
        <th>Uploader</th>
        <th>Time</th>
        <th style="padding: 0px;width:40px;"><span class="glyphicon glyphicon-thumbs-up"></span></th>
        <th style="padding: 0px;width:40px;"><span class="glyphicon glyphicon-Trash"></span></th>
      </tr>
    </thead>
    <tbody>
      <?php
        $mysqli = new mysqli("localhost", "root", "", "linust_f");
        $result = $mysqli->query("SELECT * FROM file_upload as f1 NATURAL JOIN users as u1 WHERE f1.course_name='dbs';");

        
        while($row = $result->fetch_assoc()){
          echo "<tr>";
            echo "<td>";
              echo $row['file_id'];
            echo "</td>";
            echo "<td>";
              echo $row['file_name'];
            echo "</td>";
            echo "<td>";
              echo $row['first_name'].' '.$row['last_name'].' ('.$row['username'].')';
            echo "</td>";
            echo "<td>";
              echo $row['f_date'];
            echo "</td>";


            echo "<td>";
            if($row['status']==0){
              echo '<a href="approve.php?id='.$row['file_id'].'&type=CourseWork"><span class="glyphicon glyphicon-ok"></span></a>';
            }
            echo "</td>";

            echo "<td>";
              echo '<a href="delete.php?id='.$row['file_id'].'&type=CourseWork"><span class="glyphicon glyphicon-remove"></span></a>';
            echo "</td>";
            echo "</tr>";
        }
      ?>
    </tbody>
  </table>
</div>
</div>
<div class="headers" ><h3>Related links</h3>
<div class="tableContainer">
<table class="sortable">
    <thead style="color:black;background-color: white;">
      <tr>
        <th style="padding: 0px;width:30px;">ID</th>
        <th>Link</th>
        <th>Uploader</th>
        <th>Time</th>
        <th style="padding: 0px;width:40px;"><span class="glyphicon glyphicon-thumbs-up"></span></th>
        <th style="padding: 0px;width:40px;"><span class="glyphicon glyphicon-Trash"></span></th>
      </tr>
    </thead>
    <tbody>
      <?php
        $mysqli = new mysqli("localhost", "root", "", "linust_f");
        $result = $mysqli->query("SELECT * FROM url_upload as f1 NATURAL JOIN users as u1 WHERE f1.course_name='dbs';");

        while($row = $result->fetch_assoc()){
          echo "<tr>";
            echo "<td>";
              echo $row['url_id'];
            echo "</td>";
            echo "<td>";
              echo $row['url_link'];
            echo "</td>";
            echo "<td>";
              echo $row['first_name'].' '.$row['last_name'].' ('.$row['username'].')';
            echo "</td>";
            echo "<td>";
              echo $row['u_date'];
            echo "</td>";


            echo "<td>";
            if($row['status']==0){
              echo '<a href="approve.php?id='.$row['url_id'].'&type=RelatedLink"><span class="glyphicon glyphicon-ok"></span></a>';
            }
            echo "</td>";
              

            echo "<td>";
              echo '<a href="delete.php?id='.$row['url_id'].'&type=RelatedLink"><span class="glyphicon glyphicon-remove"></span></a>';
            echo "</td>";
          echo "</tr>";
        }
      ?>
    </tbody>
  </table>
</div>
</div>
  <div class="headers"><h3>Users</h3>
  <div class="tableContainer">
    <table class="sortable">
      <thead style="color:black;background-color: white;">
        <tr>
          <th style="padding: 0px;width:40px;">ID</th>
          <th>Name</th>
          <th>Username</th>
          <th>Email</th>
          <th style="padding: 0px;width:80px;">Uploads</th>
          <th style="padding: 0px;width:80px;">Comments</th>
          <th style="padding: 0px;width:40px;"><span class="glyphicon glyphicon-Trash"></span></th>
        </tr>
      </thead>
      <tbody>
        <?php
          $mysqli = new mysqli("localhost", "root", "", "linust_f");
          $result = $mysqli->query("SELECT * FROM users;");

          while($row = $result->fetch_assoc()){
            echo "<tr>";
              echo "<td>";
                echo $row['user_id'];
              echo "</td>";
              echo "<td>";
                echo $row['first_name'].' '.$row['last_name'];
              echo "</td>";
              echo "<td>";
                echo $row['username'];
              echo "</td>";
              echo "<td>";
                echo $row['email'];
              echo "</td>";
              echo "<td>";
                echo $row['no_of_uploads'];
              echo "</td>";
              echo "<td>";
                echo $row['no_of_comments'];
              echo "</td>";

              echo "<td>";
              echo '<a href="delete.php?id='.$row['user_id'].'&type=user"><span class="glyphicon glyphicon-remove"></span></a>';
              echo "</td>";
            echo "</tr>";
          }
        ?>
      </tbody>
    </table>
  </div>
  </div>
<?php } 
  else
    echo "<h1>RESTRICTED AREA!<br>PLEASE STEP BACK</h1>";
  ?>

</body>
<nav id="myfooter" class="navbar navbar-default navbar-inverse navbar-fixed-bottom">
    <div class="container" style="width:100%;padding:0px;">
        <div class="navbar-header">
            <ul>
              <span class="navbar-brand"><a href="about.php" style="text-decoration: none !important;">About Us</a></span>
        <span class="navbar-brand">
            <a href="logout.php" class="btn btn-white-fill" style="margin-top: -0.1cm; text-decoration: none">LOGOUT<?php if (isset($_SESSION['username'])) {
            echo "<span style = 'color:white'> ("  . $_SESSION['username'] . ")</span>"; } ?></a>
                                                                    
        </span>
        
            </ul>
        </div>
        <p class="navbar-text navbar-right" style="font-weight: normal !important;font-size: 12;">BESE-6B - SEECS &emsp;|&emsp;Ahmed Rana &emsp; Sohaib Zahid &emsp; Mana Tariq &emsp; Zara Malik &emsp; </p>
    </div>
</nav>
</html>