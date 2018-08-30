<?php

session_start();
$_SESSION['id'] = "";
header("Location: login.php");
session_destroy();

setcookie("id","",3600);

?>