<?php

session_start();
if(($_SESSION['id'] == "")){
    header("Location: login.php");
    exit();
}

include_once('connection.php');
if(isset($_POST['update'])){
    $d=mysqli_query($conn, "SELECT * FROM user_details where username='{$_SESSION['id']}'");
	$row=mysqli_fetch_object($d);
    if($row){
        if($_POST['opassword']==$row->password){
            if($_POST['npassword']==$_POST['cpassword']){
                $sql = "UPDATE user_details set password='{$_POST['npassword']}' where username='{$_SESSION['id']}'";
                if (mysqli_query($conn, $sql)) {
                    header("Location: dashboard.php");
                    exit();
                } else {
                    echo '<script language="javascript">';
                    echo "alert('Something went wrong.Please try again.')";
                    echo '</script>';
                }
            }else{
                echo '<script language="javascript">';
                echo "alert('Password do NOT match.Please try again.')";
                echo '</script>';
            }
        }
    }else{
        echo '<script language="javascript">';
        echo "alert('Invalid Credentials.Please try again.')";
        echo '</script>';
    }
}

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

    <title>Update Password</title>
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
          <a class="navbar-brand" href="index.html">Express Mail</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="dashboard.php">Dashboard</a></li>
            </ul>
        </div>
      </div>
    </nav>
      <div class="container">
    <div class="jumbotron"></div>      
        <form class="form-signin" action="update_password.php" method="post">
          <h2 class="form-signin-heading">Update Password</h2>
          <div class="small-space"></div>
          <div class="space"></div>
          <br>
          <input type="password" name="opassword" class="form-control" placeholder="Old Password">
          <br>
          <input type="password" name="npassword" class="form-control" placeholder="New Password">
          <br>
          <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password">
          <br>
          <button class="btn btn-lg btn-primary btn-block" type="submit" name="update">Update</button>
          
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
