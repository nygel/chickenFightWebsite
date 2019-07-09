<?php
session_start();
include("connect.php");
include("top.php");
echo "<p style ='color:blue'>".session_id()."</p>";
if(isset($_SESSION['active'])){
        header("Location:./home.php");
        exit();
}
else{
    echo "<div id='login'>
        <form action='login.php' method='post'>
        <pre>email</pre> <input type='text' name='email'><br>
        <pre>password</pre> <input type='text' name='password'><br>
        <input style='margin:auto' type ='submit' value='Login' name='submit'>
        </form>
        <hr>
        <a href ='register.php'>Register</a><br>
        </div>";

echo "<div >";
if(isset($_POST['submit'])){
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $sql = "SELECT * FROM person where email = '".$email."' AND password='".$password."'";
    $result = mysqli_query($link, $sql); // First parameter is just return of "mysqli_connect()" function
    echo "<br>";
    echo "<table >";
    if($result){
        $rowcount=mysqli_num_rows($result);
        if($rowcount >0){
            echo "acount found".$rowcount;
            while ($row = mysqli_fetch_assoc($result)) { 
                echo "first name".$row['fname'];
                $_SESSION['active']= true;
                $_SESSION['cart']= array();
                $_SESSION['fname']=$row['fname'];
                $_SESSION['lname']=$row['lname'];
                $_SESSION['email']=$row['email'];
                $_SESSION['phone']=$row['phone'];
                $_SESSION['id']=$row['id'];
                foreach ($row as $field => $value) { 
                    echo "<td>" . $value . "</td>";  
                }
                echo "</tr>";
            }
        }
        echo "</table> </div>";
    }
    if(isset($_SESSION['active'])){
        echo "active";
        header("Location:./home.php");
    }
}
//mysqli_close($link);
}
?>

