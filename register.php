<?php
session_start();
include("connect.php");
include("top.php");
?>
<div id='login'>
<?php
if(isset($_SESSION['active'])){
    echo "Already logged in, cannot register";
}else{
    echo "<br>";
    echo "<h3>CREATE NEW ACCOUNT</h3>";
    echo "<form method='post' action='#'>";
    echo "<table border='1'>";
    echo "<tr>";
    echo "<td>First Name</td><td><input type='text' name='fname' required='required' ></td>";  
    echo "</tr>";
    echo "<tr>";
    echo "<td>Last Name</td><td><input type='text' name='lname' required='required'></td>";  
    echo "</tr>";
    echo "<tr>";
    echo "<td>Password</td><td><input type='text' name='password'required='required'></td>";  
    echo "</tr>";
    echo "<tr>";
    echo "<td>Email</td><td><input type='text' name='email'required='required'></td>";  
    echo "</tr>";
    echo "<tr>";
    echo "<td>Date of Birth('YYYY-DD-MM')</td><td><input type='text' name='dob'></td>";  
    echo "</tr>";
    echo "<tr><input type='submit' name='Submit' value='submit'></tr>";
    echo "</table></form> </div>";
}
//mysqli_close($link);
?>
<?php

  echo $fname." ". $_POST['fname'];
if(isset($_POST['Submit'])){
  echo $lname." ".$_POST['lname'];
  $psw = $_POST['password'];
  $dob = $_POST['dob'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];

  // Insert record
  $insert_query = "INSERT INTO 
                 person(fname,lname,email,dob, password) 
                 VALUES('".$fname."','".$lname."','".$email."','".$dob."','".$psw."')";
  mysqli_query($link,$insert_query);

  // Redirect to another page
  //header('location: login.php');
header('Location: login.php');

}
?>
                </div>
