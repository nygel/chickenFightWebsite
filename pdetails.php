<?php
//person public profile page
include("top.php");
include("connect.php");

echo "<br><div id='login'>";
echo "<h3>Person Public Info </h3>";
$sql = "SELECT * FROM person where id = ".$_GET['t']." ";
$result = mysqli_query($link, $sql); 
$row = mysqli_fetch_assoc($result);
echo "<b>Name: </b> ".$row['fname']." ".$row['lname'];
echo "<b><br>Contact Me At<br>Email: </b> ".$row['email']." <br>";
echo "<b>Phone: </b> ".$row['phone']." <br>";

$sql = "SELECT * FROM chicken c where personID = '".$_GET['t']."' ";
$result = mysqli_query($link, $sql);
echo "<h3>CHICKENS OWNED";
echo "<table >";
if($result){
    $rowcount=mysqli_num_rows($result);
    if($rowcount >0){
        echo"<tr><th>pic</th><th>Name</th><th>Tier</th><th>Rank</th><th>Health</th><th>Attack</th><th>Defense</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) { // 
            echo "<tr>";
            echo "<td><img src='" . $row['pic'] . "' height='75' width='75' ></td>";  
            echo "<td><a href='cdetails.php?q=".$row['id']."'>".$row['cname']."</a> </td>";
            echo "<td>".$row['tier']."</td>";  
            echo "<td>".$row['rank']."</td>";  
            echo "<td>".$row['health']."</td>";  
            echo "<td>".$row['attack']."</td>";  
            echo "<td>".$row['defense']."</td>";  
            echo "</tr>";
        }
        echo "</table> ";
    }
}else
    echo "No chickens found<br>";

$sql = "SELECT e.ename, e.endDate, c1.cname as chicken1, c2.cname as chicken2, c3.cname as chicken3
    FROM fight f 
    inner join chicken c1 on (f.chick1 = c1.id ) 
    inner join chicken c2 on (f.chick2 = c2.id )
    inner join chicken c3 on (f.result = c3.id)  
    inner join event e on (f.eventID = e.id) 
    where
    (c1.personID = '".$_GET['t']."' or c2.personID = '".$_GET['t']."')
    ;";
$result = mysqli_query($link, $sql);
echo "<br>";
echo "<h3> FIGHTS ".$_GET['t']."'S CHICKEN PARTICIPATED";
echo "<table id='tab1'>";
$rowcount1=mysqli_num_rows($result);
if($result){
    if($rowcount1 >0){
        echo "<tr><th>Event Name</th><th>Event Date</th><th>Chicken 1</th><th>Chicken 2 </th><th>Result</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) { // 
            echo "<tr>";
            foreach ($row as $field => $value) { 
                echo "<td>" . $value . "</td>";  
            }
            echo "</tr>";
        }
    }
}else
    echo "No fights participated as of yet<br>";
?>

