<?php
session_start();
include("connect.php");
include("top.php");
?>
<div id='login'>
<?php
if(isset($_SESSION['active'])){
    echo $_SESSION['id'];
    $sql = "SELECT * FROM person where id = '".$_SESSION['id']."' ";
    $result = mysqli_query($link, $sql); // First parameter is just return of "mysqli_connect()" function
    echo "<br>";
    echo "<h3>YOUR ACCOUNT INFO";
    echo "<form method='post' action='#'>";
    echo "<table border='1'>";
    if($result){
        $rowcount=mysqli_num_rows($result);
        if($rowcount >0){
            while ($row = mysqli_fetch_assoc($result)) { // 
                echo "<tr>";
                echo "<td>First Name</td><td><input type='text' name='fname' value='".$row['fname'] ."'></td>";  
                echo "</tr>";
                echo "<tr>";
                echo "<td>Last Name</td><td><input type='text' name='lname' value='".$row['lname'] ."'></td>";  
                echo "</tr>";
                echo "<tr>";
                echo "<td>Password</td><td><input type='text' name='password' value='".$row['password'] ."'></td>";  
                echo "</tr>";
                echo "<tr>";
                echo "<td>Email</td><td><input type='text' name='email' value='".$row['email'] ."'></td>";  
                echo "</tr>";
                echo "<tr>";
                echo "<td>Phone</td><td><input type='text' name='phone' value='".$row['phone'] ."'></td>";  
                echo "</tr>";
            }
        }
    }
    echo "<tr><input type='submit' name='Submit' value='submit'></tr>";
    echo "</table></form> </div>";
}else 
    echo "You're not logged in<br><a href='login.php'>Login</a>";
mysqli_close($link);
?>
<?php
if(isset($_POST['submit'])){
$sql = "update person set 
    fname= '".$_POST['fname']."', lname= '".$_POST['lname']."', 
email='".$_POST['email']."',phone= '".$_POST['phone']."',password= '".$_POST['password']."'
where id='".$_SESSION['id']."'";
if($result = mysqli_query($link, $sql)){
echo "UPDATED!";
}
}
?>
</div>
