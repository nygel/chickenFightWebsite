<?php
$link = mysqli_connect("127.0.0.1", "naton", "dev2Zovc", "naton");

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}//else
    //echo "your're connected";


?>

