<?php 

session_start();
if($_COOKIE['username']=="" ||$_COOKIE['password']==""){
    header("Location: signup.php");
}


include_once('connection.php');
if(isset($_POST['signup'])){
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $postalCode = mysqli_real_escape_string($conn, $_POST['postalCode']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $mobileNumber = mysqli_real_escape_string($conn, $_POST['mobileNumber']);
    $recoveryMail = mysqli_real_escape_string($conn, $_POST['recoveryMail']);
    
    $sql = "INSERT INTO `user_details` (`first_name`, `last_name`, `username`, `password`, `mobile_no`, `gender`, `postal_code`, `address`, `recovery_mail`) values('$firstName','$lastName','$username','$password','$mobileNumber','$gender','$postalCode','$address','$recoveryMail')";
    
    if (mysqli_query($conn, $sql)) {
        $_SESSION['id'] = $username;
        setcookie("username", "", time()-1);
        setcookie("password", "", time()-1);
        header("Location: dashboard.php");
    } else {
        
        header("Location: signup.php");
    }
    
}

?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="minor-logo.png">

    <title>Sign Up</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
    <link href="css/signup.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
      <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Express Mail</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            </ul>
        </div>
      </div>
    </nav>
      
      <div class="container">
        <div class="jumbotron"></div>
      <form class="form-signup" action="signup_final.php" method="post">
          <h2 class="form-signup-heading">Sign Up</h2>
          <div class="small-space"></div>
          <table>
              <tr>
                  <td name="normaltext" align="right">First Name :</td>
                  <td align="left"> <input type="name" name="firstName" class="textbox" required autofocus> </td>
              </tr>
              <tr>
                  <td align="right"> Last Name :</td>
                  <td align="left"> <input type="name" name="lastName" class="textbox"> </td>
              </tr>
              <tr>
                  <td align="right"> Address :</td>
                  <td align="left"> <input type="name" name="address" class="textbox" required autofocus> </td>
              </tr>
              <tr>
                  <td align="right"> Postal Code :</td>
                  <td align="left"> <input type="name" name="postalCode" class="textbox" required autofocus> </td>
              </tr>
              <tr>
                  <td align="right"> Gender :</td>
                  <td align="left"> <input type="name" name="gender" class="textbox" placeholder="Male/Female" required autofocus> </td>
              </tr>
              <tr>
                  <td align="right">Mobile Number:</td>
                  <td align="left"> <input type="name" name="mobileNumber" class="textbox" required autofocus> </td>
              </tr>
              <tr>
                  <td align="right"> Recovery Mail :</td>
                  <td align="left"> <input type="email" name="recoveryMail" class="textbox" required autofocus> </td>
              </tr>
          </table>
          <div class="space"></div>
          <button class="btn btn-lg btn-primary btn-block" type="submit" name="signup">Create Account</button>
        </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/holder.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>

