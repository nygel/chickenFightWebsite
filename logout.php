<?php
include("connect.php");
include("top.php");
session_start();
session_unset();
session_destroy();
$_SESSION=[];
echo"<div id='login'>";
echo"You have logged out<br>";
//echo"<a herf='./login.php'>Login</a></div>";
echo"<a href='login.php'>Login</a>";
echo"</div>";
//mysqli_close($link);
?>

