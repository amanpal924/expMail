<?php

session_start();
if($_SESSION['id'] == ""){
    header("Location: login.php");
    exit();
}

include_once('connection.php');
if(isset($_POST['reply'])){
    header("Location: compose.php");
    exit();
}

if(isset($_POST['back'])){
    if($_GET['form'] == "draft"){
        header("Location: draft.php");
        exit();
    }
    if($_GET['form'] == "sent"){
        header("Location: sent.php");
        exit();
    }
    if($_GET['form'] == "inbox"){
        header("Location: inbox.php");
        exit();
    }
}

if(isset($_POST['delete'])){
    $a = $_GET['message_id'];
    if($_GET['form']=="inbox"){
        $qry = "UPDATE message_details SET reciever_delete=1 WHERE msg_id='$a'";
        if(mysqli_query($conn, $qry)){
            header("Location: inbox.php");
            exit();
        }
    }
    if($_GET['form']=="sent"){
        $qry = "UPDATE message_details SET sender_delete=1 WHERE msg_id='$a'";
        if(mysqli_query($conn, $qry)){
            header("Location: sent.php");
            exit();
        }
    }
    if($_GET['form']=="draft"){
        $qry = "UPDATE message_details SET sender_delete=1, draft=0 WHERE msg_id='$a'";
        if(mysqli_query($conn, $qry)){
            header("Location: draft.php");
            exit();
        }
    }
}

if(isset($_POST['edit'])){
    header("Location: compose.php?message_id={$_GET['message_id']}&type=draft");
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
    <title>Message</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
    
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
            <li><a href="dashboard.php">Dashboard</a></li>
            </ul>
        </div>
      </div>
    </nav>
     <div class="container-fluid">  
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="compose.php">Compose</a></li>
            <li><a href="inbox.php">Inbox</a></li>
            <li><a href="sent.php">Sent Mail</a></li>
            <li><a href="draft.php">Draft</a></li>
            <li><a href="comingsoon.php">Spam</a></li>
          </ul>
        </div>
         <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h2 class="page-header">Message</h2>
             <form action="message.php?message_id=<?php echo $_GET['message_id']; ?>&form=<?php echo $_GET['form']; ?>" method="post">
                 <?php
                 
                 $message_id = $_GET['message_id'];
                 include_once('connection.php');
                 $d=mysqli_query($conn, "SELECT * FROM message_details where msg_id='$message_id'");
	             $row=mysqli_fetch_object($d);
                 
                 echo "<input type='text' class='form-control' value='From&nbsp;:&nbsp;$row->sender_mail' readonly><br>";
                 echo "<input type='text' class='form-control' value='To&nbsp;:&nbsp;$row->reciever_mail' readonly><br>";
                 echo "<input type='text' class='form-control' value='Subject&nbsp;:&nbsp;$row->subject' readonly><br>";       
                 echo "<input type='text' class='form-control' value='Date&nbsp;&&nbsp;Time&nbsp;:&nbsp;$row->time' readonly><br>";
                 echo "<textarea class='form-control'  rows='10' name='message' readonly>$row->message</textarea><br>";
                 
                 ?>
                 <table class="table table-stripped">
                     <thead>
                         <tr>
                             <td><input type="submit" value="Back" class="btn btn-lg" type="submit" name="back"></td>
                             <td  align="right">
                                 <input type='submit' class='btn btn-lg' value='Delete' type='submit' name='delete'>
                                 <?php
                                 if($row->reciever_mail == $_SESSION['id']){
                                     echo "<input type='submit' class='btn btn-lg' value='Reply' type='submit' name='reply'>";
                                 }
                                 ?>
                                 <?php
                                 if($_GET['form'] == "draft"){
                                     echo "<input type='submit' class='btn btn-lg' value='Edit' type='submit' name='edit'>";
                                 }
                                 ?>
                             </td>  
                         </tr>
                     </thead>
                 </table>  
          </form>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/holder.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
