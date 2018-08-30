<?php

session_start();
if($_SESSION['id'] == ""){
    header("Location: login.php");
}

?>

<!DOCTYPE html>
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
            <li><a href="compose.php?message_id=none&type=none">Compose</a></li>
            <li><a href="inbox.php">Inbox</a></li>
            <li><a href="sent.php">Sent Mail</a></li>
            <li><a href="draft.php">Draft</a></li>
            <li><a href="comingsoon.php">Spam</a></li>
          </ul>
        </div>
         <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h3 class="page-header">Inbox</h3>
              <table class="table table-striped">
                  <thead>
                    <tr>
                      <th width="5%">Id</th>
                      <th width="10%">From</th>
                      <th width="10%">Subject</th>
                      <th width="55%">Message</th>
                      <th width="20%">Date & Time</th>
                    </tr>
                    </thead>
                    <tbody>
                          <?php
                      
                          include_once('connection.php');
                          $d="SELECT * FROM message_details where reciever_mail='{$_SESSION['id']}' and reciever_delete = false and draft=false";
                          $result = mysqli_query($conn, $d);
                          while($temp = mysqli_fetch_assoc($result)) {
                              #print_r($temp);
                              $d1="SELECT first_name,last_name FROM user_details where username='{$temp['sender_mail']}'";
                              $result1 = mysqli_query($conn, $d1);
                              $q=mysqli_fetch_object($result1);
                              echo "<tr>";
                              echo "<td><a href='message.php?message_id=".$temp['msg_id']."&form=inbox'>".$temp['msg_id']."</a></td>";
                              echo "<td>".$q->first_name." ".$q->last_name."</td>";
                              echo "<td>".$temp['subject']."</td>";
                              echo "<td>".$temp['message']."</td>";
                              echo "<td>".$temp['time']."</td>";
                              echo "</tr>";
                          }
                          mysqli_close($conn);
                      ?>
                    </tbody>
              </table>
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
