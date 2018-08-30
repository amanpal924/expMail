<?php

session_start();
if(!($_SESSION['id'] == "")){
    header("Location: dashboard.php");
    exit();
}

include_once('connection.php');
if(isset($_POST['submit'])){
    $d="SELECT * FROM user_details where username='{$_POST['username']}'";
    if($result=mysqli_query($conn,$d)){
        if($row=mysqli_fetch_array($result)){
            $username_d=$row['username'];
            $password_d=$row['password'];
            if($_POST['username']==$username_d && $_POST['password']==$password_d){
                $_SESSION['id'] = $username_d;
                header("Location: dashboard.php");
                exit();
            }
        }else{
            echo '<script language="javascript">';
            echo "alert('Invalid Credentials.Please try again.')";
            echo '</script>';
        }
    }
}

mysqli_close($conn);

if(isset($_POST['new'])){
    header("Location: signup.php");
    exit();
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

    <title>Sign In</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

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
            <li><a href="signup.php">Sign Up</a></li>
            </ul>
        </div>
      </div>
    </nav>
      <div class="container">
    <div class="jumbotron"></div>      
        <form class="form-signin" action="login.php" method="post">
          <h2 class="form-signin-heading">Sign in</h2>
          <div class="small-space"></div>
          <h5 class="form-signin-heading">to continue to <font color="red">Express Mail</font></h5>
          <input type="email" name="username" class="form-control" placeholder="Email address">
          
          <input type="password" name="password" class="form-control" placeholder="Password">
          
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
          <div class="space"></div>
          <div align="center"><font color="red">Or</font></div>
          <div class="space"></div>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="new">Create New Account</button>
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
