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
    <meta charset="uff-8">
    <title>News Portal</title>



  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="navbar-scripts.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC_ZLiuoiFRFyTjcOMLxGiFWE9A9HXcYsI&callback=initMap">
    </script>
  
	<link rel="stylesheet" type="text/css" href="css/animate.css">
  <!-- Normalize -->
	<link rel="stylesheet" type="text/css" href="css/cardio.css">
	    <script src="navbar_scripts.js"></script>
  <link rel="stylesheet" type="text/css" href="stylesheet1.css">
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-111996482-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-111996482-1');
</script>

<script>
  var i = 0;
  var txt = 'LINE NUST WITH INOVATION';
  var speed = 50;

  function typeWriter() {
    if (i < txt.length) {
      document.getElementById("n2").innerHTML += txt.charAt(i);
      i++;
      setTimeout(typeWriter, speed);
    }
  }

</script>

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
	  
<div class = "namee" id = "n1">
<h1>LINUST</h1>
<h2 id = "n2"></h2>

</div>


<div class= "col-md-12 col-xs-12" style="background-color: black"> 
 <div class="w3-bar w3-black">
  <button class="w3-bar-item w3-button" onclick="opentab('New1')">ALUMNI TALK SERIES TCF</button>
  <button class="w3-bar-item w3-button" onclick="opentab('New2')">NUST HOSTS BEACONHOUSE STUDENTS</button>
  <button class="w3-bar-item w3-button" onclick="opentab('New3')">QS ASIAN UNIVERSITY RANKING</button>
  <button class="w3-bar-item w3-button" onclick="opentab('New4')">CSD EARTH-BREAKING CEREMONY AT NUST</button>
</div>

<div id="New1" class="w3-container city" style="color:white" class= "col-md-12 col-xs-12">
  <h2  align="left">ALUMNI TALK SERIES TCF</h2>
  <p  align="left"> Alumni Talk Series: TCF was held on 21st November 2017 at Dhok Chaudhriyan Rawalpindi. This session was meant to be a source of inspiration to the students of TCF; that what they have achieved so far is just a beginning and a beautiful long journey awaits them. </p>
  <img src="new1.jpg" class= "col-md-12 col-xs-12">
</div>

<div id="New2" class="w3-container city" style="display:none; color:white" class= "col-md-12 col-xs-12">
<h2  align="left">NUST HOSTS BEACONHOUSE STUDENTS</h2>
  <p align="left">As part of its initiative to arrange on-campus orientation/exposure visits for the school/college students, National University of Sciences & Technology (NUST) hosted around 50 students of different academic levels from Beaconhouse School System (Main Campus Peshawar Road, Rawalpindi) on Thursday, November 23, 2017. Upon arrival, they were given a detailed briefing on NUST programs of study, research and allied campus facilities, student-managed clubs & societies, etc. Later, Director Student Affairs and Principal NUST School of Mechanical & Manufacturing Engineering (SMME) responded to queries raised by the students regarding the admission criteria, accommodation facilities, etc.</p> 
  <img src="new2.jpg" class= "col-md-12 col-xs-12">
</div>

<div id="New3" class="w3-container city" style="display:none; color:white" class= "col-md-12 col-xs-12">
<h2  align="left">QS ASIAN UNIVERSITY RANKING</h2>
<p  align="left"> According to the Quacquarelli Symonds (QS) Asian Ranking 2018, the National University of Sciences & Technology (NUST), Pakistan, has moved up the ladder to No. 91 in the Asian region – this latest position by NUST is a whopping 38 ranks higher than 2014, and 21 ranks higher than 2017. NUST is the only Pakistani university that stands among the top 100 in Asia.
NUST has been consistently improving its overall position in Asian University Rankings by Quacquarelli Symonds, UK, since 2014. The QS rankings are one of the most influential university rankings in the world; these are carried out on the basis of academic reputation, employer reputation, faculty / student ratio, citation per paper, paper per faculty, staff with PhD, and internationalization.</p>
<img src="new3.jpg" class= "col-md-12 col-xs-12">
</div>
<div id="New4" class="w3-container city" style="display:none; color:white" class= "col-md-12 col-xs-12">
<h2  align="left">CSD EARTH-BREAKING CEREMONY AT NUST</h2>
<p  align="left">NUST held the earth-breaking ceremony of CSD canteen at its H-12 campus on Friday 3rd November 2017. Brig Iqtidar Naseer, Director Commercial and Marketing CSD, and other CSD representatives attended the ceremony, in addition to NUST management and faculty. Lt Gen Naweed Zaman, HI (M), (Retd), Rector NUST, unveiled the plaque and expressed his gratitude to the CSD management for bringing their facility to NUST. The CSD canteen at NUST H-12 campus is likely to be functional within 4-6 months, and will be equipped with household provisions, kitchen appliances, sports equipment, electronics, and much more. </p>
<img src="new4.jpg" class= "col-md-12 col-xs-12">
</div>
</div>
<script>
function opentab(cityName) {
    var i;
    var x = document.getElementsByClassName("city");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    document.getElementById(cityName).style.display = "block";  
}

	</script>
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