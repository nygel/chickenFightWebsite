<?php

//show logged in user's information
session_start();
include("connect.php");
include("top.php");
?>
<div id='login'>
<?php
if(isset($_SESSION['active'])){
    $sql = "SELECT * FROM person where id = '".$_SESSION['id']."' ";
    $result = mysqli_query($link, $sql); 
    echo "<br>";
    echo "<h3>".$_SESSION['fname']."'s Acount Info</h3>";
    echo "<table >";
    if($result){
        $rowcount=mysqli_num_rows($result);
        if($rowcount >0){
            while ($row = mysqli_fetch_assoc($result)) { // 
              
                echo "<p><b>Name:</b> ".$row['fname']." ".$row['lname']."</p>
                    <p><b>Birthdate:</b> ".$row['dob ']."</p>
                    <p><b>Contact<br>Email:</b> ".$row['email']."<br><b>Phone:</b>".$row['phone']."</p>
                    <p><a href='edit.php'>Edit Account Information</a></p>
                    <p><a href='pdetails.php?t=".$_SESSION['id']."'>Public Profile</a></p>";
            }
        }
        echo "</table> </div>";
    }

}else
    echo"You're logged out<br><a href='login.php'>Login</a>";
//mysqli_close($link);
?>
</div>
