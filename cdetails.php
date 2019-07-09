<?php
include("top.php");
include("connect.php");
//chicken info
echo "<br><div id='login'>";
echo "<h3>Chicken INFO </h3>";
$sql = "SELECT chicken.*, person.fname,person.lname FROM chicken, person
    where chicken.id = ".$_GET['q']." 
    and chicken.personID = person.id 
 ";
$result = mysqli_query($link, $sql); 
$row = mysqli_fetch_assoc($result);
echo "<img src='".$row['pic']."' height='200px' width='200px'><br>";
echo "<b>Name: </b> ".$row['cname'];
echo "<b>  Tier: </b> ".$row['tier']." <br>";
echo "<b>Stats</b><br>";
echo "<b>Health: </b> ".$row['health'];
echo "<b> Defense: </b> ".$row['defense'];
echo "<b> Attack: </b> ".$row['attack']."<br>";
echo "<b> Owner: </b> ".$row['fname']." ".$row['lname']."<br>";
echo "<a href='pdetails.php?t=".$row['personID']."'><h3>Owner Public Details</h3></a>"; 

//echo "<a href='pdetails.php?t=".$row['personID']."'>Chicken's page</a>";
$sql = "SELECT e.ename, e.endDate, c1.cname as chicken1, c2.cname as chicken2, c3.cname as chicken3
    FROM fight f 
    inner join chicken c1 on (f.chick1 = c1.id ) 
    inner join chicken c2 on (f.chick2 = c2.id )
    inner join chicken c3 on (f.result = c3.id)  
    inner join event e on (f.eventID = e.id) 
    where
    (f.chick1=".$_GET['q']." or f.chick2=".$_GET['q'].")
";

$result = mysqli_query($link, $sql);
echo "<h3> CHICKEN PARTICIPATED IN</h3>";
echo "<table >";
$rowcount1=mysqli_num_rows($result);
echo "found ".$rowcount1."<br>";
if($result){
    if($rowcount1 >0){
        echo "<tr><th>Event Name</th><th>Event Date</th><th>Chicken 1</th><th>Chicken 2</th><th>Result</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) { // 
            echo "<tr>";
            foreach ($row as $field => $value) { //  foreach($row as $value) {
                echo "<td>" . $value . "</td>";  
            }
            echo "</tr>";
        }
    }
}
?>

