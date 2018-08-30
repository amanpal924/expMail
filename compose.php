<?php

session_start();
if($_SESSION['id'] == ""){
    header("Location: login.php");
    exit();
}

include_once('connection.php');
if(isset($_POST['send'])){
    $senderMail = mysqli_real_escape_string($conn, $_SESSION['id']);
    $recieverMail = mysqli_real_escape_string($conn, $_POST['recieverMail']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    if($recieverMail=="" || $subject=="" || $message==""){
        echo "You have not entered the proper details.";
    }else{
        $test="SELECT * FROM user_details where username='{$recieverMail}'";
        $result=mysqli_query($conn, $test);
        $test_result=mysqli_fetch_object($result);
        if($test_result){
            $sql = "SELECT COUNT(*) as msg_id FROM `message_details`";
            $result1=mysqli_query($conn, $sql);
            $row = mysqli_fetch_object($result1);
            #echo "<center>".$row->msg_id."</center>";
            $id = $row->msg_id;
            $id = $id+1;
            $sql = "INSERT INTO `message_details` (`msg_id`, `sender_mail`, `reciever_mail`, `subject`, `message`) values('$id','$senderMail','$recieverMail','$subject','$message')";
            if (mysqli_query($conn, $sql)) {
                header("Location: dashboard.php");
                exit();
            } else {
                echo "<script language='javascript'>";
                echo "alert('Message NOT sent. Please try again.')";
                echo "</script>";
            }
        }else{
            echo "<script language='javascript'>";
            echo "alert('Invalid mail id. Please enter a valid mail id.')";
            echo "</script>";
        }
    }
}

if(isset($_POST['back'])){
    header("Location: dashboard.php");
    exit();
}

if(isset($_POST['draft'])){
    $senderMail = mysqli_real_escape_string($conn, $_SESSION['id']);
    $recieverMail = mysqli_real_escape_string($conn, $_POST['recieverMail']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    if($recieverMail=="" && $subject=="" && $message==""){
        echo '<script language="javascript">';
        echo "alert('You have entered nothing to save.')";
        echo '</script>';
        header("Lcation: compose.php");
    }else{
        if($recieverMail != ""){
            $test="SELECT * FROM user_details where username='{$recieverMail}'";
            $result3=mysqli_query($conn, $test);
            $test_result=mysqli_fetch_object($result3);
            if($test_result){
                $sql = mysqli_query($conn, "SELECT COUNT(*) as msg_id FROM `message_details`");
                $row = mysqli_fetch_object($sql);
                #echo "<center>".$row->msg_id."</center>";
                $id = $row->msg_id;
                $id = $id+1;
                $sql = "INSERT INTO `message_details` (`msg_id`, `sender_mail`, `reciever_mail`, `subject`, `message`, `draft`) values('$id','$senderMail','$recieverMail','$subject','$message',1)";
                if (mysqli_query($conn, $sql)) {
                    echo "alert('Message Saved Successfully.')";
                    header("Location: dashboard.php");
                    exit();
                } else {
                    echo '<script language="javascript">';
                    echo "alert('Message NOT saved. Please try again.')";
                    echo '</script>';
                }
            }else{
                echo '<script language="javascript">';
                echo "alert('Invalid mail id. Please enter a valid mail id.')";
                echo '</script>';
            }
        }else{
            $sql = mysqli_query($conn, "SELECT COUNT(*) as msg_id FROM `message_details`");
            $row = mysqli_fetch_object($sql);
            #echo "<center>".$row->msg_id."</center>";
            $id = $row->msg_id;
            $id = $id+1;
            $sql = "INSERT INTO `message_details` (`msg_id`, `sender_mail`, `subject`, `message`, `draft`) values('$id','$senderMail','$subject','$message',1)";
            if (mysqli_query($conn, $sql)) {
                echo '<script language="javascript">';
                echo "alert('Message Saved Successfully.')";
                echo '</script>';
                header("Location: dashboard.php");
                exit();
            } else {
                echo '<script language="javascript">';
                echo "alert('Message NOT saved. Please try again.')";
                echo '</script>';
            }
        }
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
    <title>Dashboard</title>
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
          <h2 class="page-header">Compose</h2>
             <form action="compose.php?message_id=none&type=none" method="post">
                 <input type="email" name="senderMail" class="form-control" value=<?php echo $_SESSION['id']; ?> readonly required><br>
                 <?php
                 
                 if($_GET['type']=="draft"){
                     $message_id = $_GET['message_id'];
                     include_once('connection.php');
                     $d=mysqli_query($conn, "SELECT * FROM message_details where msg_id='$message_id'");
                     $row=mysqli_fetch_object($d);
                     echo "<input type='email' name='recieverMail' required class='form-control' value=".$row->reciever_mail."><br>";
                     echo "<input type='text' name='subject' class='form-control' value=".$row->subject." required><br>";
                     echo "<textarea class='form-control' rows='10' name='message'>".$row->message."</textarea><br>";
                 }else{
                     echo "<input type='email' name='recieverMail' class='form-control' placeholder='To'><br>";
                     echo "<input type='text' name='subject' class='form-control' placeholder='Subject'><br>";
                     echo "<textarea class='form-control' placeholder='Type your message here.' rows='10' name='message'></textarea><br>";
                 }
                 
                 ?>
                 <table class="table table-stripped">
                     <thead>
                         <tr>
                             <td><input type="submit" value="Back" class="btn btn-lg" type="submit" name="back"></td>
                             <td  align="right"><input type="submit" class="btn btn-lg" value="Save as Draft" type="submit" name="draft">&nbsp;&nbsp;<input type="submit" class="btn btn-lg" value="Send" type="submit" name="send"></td> 
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
