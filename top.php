<?php
//code for the top section that is attached to each webpage
session_start();
echo"   <head>
     <title>Chicken Fight</title>
    <link rel='stylesheet' href='style.css'>
</head>
<body style='margin:0;'>
    <div id='logo'>   
    <div id='log'>
        <details style='margin-right:10px'>";
if(!isset($_SESSION['active'])){
echo"                <summary>Logged out</summary>
<a href='login.php'>Login</a> <br>";
}else{
echo"                <summary>Profile</summary>
        <a href='logout.php'>Logout</a> <br>
        <a href='yourRecords.php'>Records<a><br>
        <a href='yourInfo.php'>Account Info</a><br>
        <a href='edit.php'>Change Account Info</a><br>";
}
echo"
        </details>
    </div>
    <img src='logo2.png' > 
    </div>
    <div id='topbar'>
        <a href='home.php'>News</a>
        <a href='info.php'>Infomation</a>
        <a href='testEvent.php'>Events</a>

    </div>
    <div id='main'>";
?>
