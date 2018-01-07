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
    <title>Home</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="navbar_scripts.js"></script>
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC_ZLiuoiFRFyTjcOMLxGiFWE9A9HXcYsI&callback=initMap">
    </script>
  
	<link rel="stylesheet" type="text/css" href="css/animate.css">
  <!-- Normalize -->
  <link rel="stylesheet" type="text/css" href="css/cardio.css">
  
  <link rel="stylesheet" type="text/css" href="stylesheet1.css">
  <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId=1770566756582849";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
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
			header('Location: ' . $home_url);
         
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
                <a href="course1.html" target="null" class="dropdown-toggle" data-toggle="dropdown" style="color:grey;">Seecs</a>
                  <ul class = "dropdown-menu" style="background-color:black;">
                  <li><a href="course1.html" target="null" style="color:grey;">Software Engineering</a></li>
                  <li><a href="course1.html" target="null" style="color:grey;">Electrical Engineering</a></li>
                  <li><a href="course1.html" target="null" style="color:grey;">Computer Science</a></li>
                  </ul>
              </li>
              <li class="dropdown dropdown-submenu" >
                <a href="course1.html" target="null" class="dropdown-toggle" data-toggle="dropdown" style="color:grey;">Nbs</a>
                  <ul class = "dropdown-menu" style="background-color:black;">
                  <li><a href="course1.html" target="null" style="color:grey;">BBA</a></li>
                  <li><a href="course1.html" target="null" style="color:grey;">MBA</a></li>
                  <li><a href="course1.html" target="null"style="color:grey;">ACF</a></li>
                  </ul>
              </li>
              
              <li class="dropdown dropdown-submenu" >
                <a href="course1.html" target="null" class="dropdown-toggle" data-toggle="dropdown" style="color:grey;">SMME</a>
                <ul class = "dropdown-menu" style="background-color:black;">
                    <li><a href="course1.html" target="null" style="color:grey;">Mechanical Engineering</a></li>
                    <li><a href="course1.html" target="null" style="color:grey;">Megatronic Engineering</a></li>
                    <li><a href="course1.html" target="null"style="color:grey;">Material Engineering</a></li>
                </ul>
              </li>
              
              <li class="dropdown dropdown-submenu" >
                <a href="course1.html" target="null" class="dropdown-toggle" data-toggle="dropdown" style="color:grey;">NICE</a>
                <ul class = "dropdown-menu" style="background-color:black;">
                    <li><a href="course1.html" target="null" style="color:grey;">Civil Engineering</a></li>
                    <li><a href="course1.html" target="null" style="color:grey;">Road Engineering</a></li>
                    <li><a href="course1.html" target="null"style="color:grey;">Info Engineering</a></li>
                </ul>
              </li>
        
              <li class="dropdown dropdown-submenu" >
                <a href="course1.html" target="null" class="dropdown-toggle" data-toggle="dropdown" style="color:grey;">SNS</a>
                <ul class = "dropdown-menu" style="background-color:black;">
                    <li><a href="course1.html" target="null" style="color:grey;">Physics</a></li>
                    <li><a href="course1.html" target="null" style="color:grey;">Maths</a></li>
                    <li><a href="course1.html" target="null"style="color:grey;">Fluid Physics</a></li>
                </ul>
              </li>
              
              <li class="dropdown dropdown-submenu" >
                <a href="course1.html" target="null" class="dropdown-toggle" data-toggle="dropdown" style="color:grey;">SCME</a>
              </li>
              
              <li class="dropdown dropdown-submenu" >
                <a href="course1.html" target="null" class="dropdown-toggle" data-toggle="dropdown" style="color:grey;">S3H</a>
              </li>
            </ul>
          </li>
          <li><a href="portal.html">News Portal</a></li>
          <li><a href="contact.html">Contact Us</a></li>
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
            </div>
            </Br></Br>
            <input type="submit" name = "submit" value = "Sign Up" class="btn btn-info btn-xs">
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

<!-- Crousal -->
<div class = "container">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
	
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="co1.jpg" alt="Los Angeles" style="width:100%;">
      </div>

      <div class="item">
        <img src="header.jpg" alt="Chicago" style="width:100%;">
      </div>
    
      <div class="item">
        <img src="vision.jpg" alt="New york" style="width:100%;">
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
</div>
  
	<section id="team" class="section gray-bg" style="background-image:url('b1.jpg'); background-size:cover; margin-top:0.2px;">
		<div class="container">
			<div class="row title text-center">
				<h2 class="margin-top" style="color:grey">Top Users</h2>
				<h4 class="light muted" style="color:grey">There to Help!</h4>
			</div>
			<div class="row" style="color:white">
				<div class="col-md-4">
					<div class="team text-center">
						<div class="cover" style="background:url('img/team/x1.png'); background-size:cover;">
							<div class="overlay text-center">
								<h3 class="white">Software Engineering</h3>
								<h5 class="light light-white">3rd semester</h5>
							</div>
						</div>
						<img src="ashar.jpg" alt="Team Image" class="avatar">
						<div class="title">
							<h4 class=white>Ashar Mehmood</h4>
							<h5 class="muted regular">Database Expert</h5>
						</div>
						<!-- <button data-toggle="modal" data-target="#modal1" class="btn btn-blue-fill">Sign Up Now</button> -->
						<h5 class="muted">cell:+923226627614</h5>
						<h5 class="muted">mail:asharmehmood93@gmail.com</h5>
					</div>
				</div>
				<div class="col-md-4">
					<div class="team text-center">
						<div class="cover" style="background:url('img/team/x2.jpg'); background-size:cover;">
							<div class="overlay text-center">
								<h3 class="white">Software Engineering</h3>
								<h5 class="light light-white">3rd semester</h5>
							</div>
						</div>
						<img src="rana.jpg" alt="Team Image" class="avatar">
						<div class="title">
							<h4 class=white>Ahmed Rana</h4>
							<h5 class="muted regular">C Programer</h5>
						</div>
						<!-- <a href="course1.html" target="null" data-toggle="modal" data-target="#modal1" class="btn btn-blue-fill ripple">Sign Up Now</a> -->
						<h5 class="muted">cell:+923241524963</h5>
						<h5 class="muted">mail:ahmedrana03@gmail.com</h5>
					</div>
				</div>
				<div class="col-md-4">
					<div class="team text-center">
						<div class="cover" style="background:url('img/team/w.png'); background-size:cover;">
							<div class="overlay text-center">
								<h3 class="white">Software Engineering</h3>
								<h5 class="light light-white">3rd semester</h5>
							</div>
						</div>
						<img src="wajahat.jpg" alt="Team Image" class="avatar">
						<div class="title">
							<h4 class=white>Wajahat Hussain</h4>
							<h5 class="muted regular">Fluid Physics Expert</h5>
						</div>
						<h5 class="muted">cell:+923426547852</h5>
						<h5 class="muted">mail:wajahathussain58gmail.com</h5>
					</div>
				</div>
			</div>

	<script>
// This is called with the results from from FB.getLoginStatus().
 function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else {
      // The person is not logged into your app or we are unable to tell.
      document.getElementById('status').innerHTML = ' ' +
        '';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '1770566756582849',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.10' // use graph api version 2.8
  });

 
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  
  function testAPI() {
    console.log(' ');
    FB.api('/me', function(response) {
      console.log('' + response.name);
      document.getElementById('status').innerHTML =
        ' ' + response.name + '!';
    });
  }
</script>
<div id="map"></div>
			

</section>
</body>
<nav id="myfooter" class="navbar navbar-default navbar-inverse navbar-fixed-bottom">
    <div class="container" style="width:100%;padding:0px;">
        <div class="navbar-header">
            <ul>
              <span class="navbar-brand"><a href="about.html" style="text-decoration: none !important;">About Us</a></span>

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
