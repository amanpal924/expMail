<?php

session_start();
#echo "session started";
if($_SESSION['id'] != ""){
    header("Location: dashboard.php");
}

include_once('connection.php');
error_reporting(1);
if(isset($_POST['next'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $username = $username."@expmail.com";
    if($password == $cpassword){
        $d="SELECT * FROM user_details where username='$username'";
	    if(mysqli_fetch_object($d) == 0){
            #echo "Entered this part."; 
            setcookie("username",$username);
            setcookie("password",$password);
            header("Location: signup_final.php");
        }else{
            echo "<script language='javascript'>";
            echo "alert(Username NOT available.Please try a different one.)";
            echo "</script>";
        }
        
        
    }else{
        echo "<br><center><font color='red' face='ABeeZee'>Password & Confirm Password do not match.<br>Please type again.</font></center>";
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
            <li><a href="login.php">Sign In</a></li>
            </ul>
        </div>
      </div>
    </nav>
      <div class="container">
        <div class="jumbotron"></div>
      <form class="form-signup" action="signup.php" method="post">
          <h2 class="form-signup-heading">Sign Up</h2>
          <div class="small-space"></div>
          <table>
              <tr>
                  <td align="right"> Username :</td>
                  <td align="left"> <input type="name" name="username" class="textbox" onkeypress="return ((event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || event.charCode == 8 || event.charCode == 32 || (event.charCode >= 48 && event.charCode <= 57));" autocomplete="off" required autofocus> </td>
              </tr>
              <tr>
                  <td align="right"> Password :</td>
                  <td align="left"> <input type="password" class="password_layout" name="password" onfocus="this.value=''" required autofocus> </td>
              </tr>
              <tr>
                  <td align="right"> Confirm Password :</td>
                  <td align="left"> <input type="password" class="password_layout" name="cpassword" onfocus="this.value=''" required autofocus> </td>
              </tr>
          </table>
          <div class="space"></div>
          <button class="btn btn-lg btn-primary btn-block" type="submit" name="next">Next</button>
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
