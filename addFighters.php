<?php
include("top.php");
include("connect.php");
$eid = $_GET['eid'];
for($x = 0; $x < 20; $x++){
    $r = rand(1,300);
    $sql = "insert into waitList (eventID, chickenID,id) values ('$eid',".$r.",'$x')";
    $result = mysqli_query($link, $sql); 
}
$sql = "SELECT * FROM waitList where eventID = '".$_GET['eid']."' ";
$result = mysqli_query($link, $sql);
echo "<div id='login'>";
echo "<h3>List of Fighters for event(waiting to be paired for fight)</h3>";
echo "<table border='1'>";
if($result){
    $rowcount=mysqli_num_rows($result);
    if($rowcount >0){
        echo "<div style='border:solid black 2px;'>";
        echo "found ".$rowcount;
        while ($row = mysqli_fetch_assoc($result)) { // 
            echo "<tr>";
            foreach ($row as $field => $value) { 
                echo "<td>" . $value . "</td>";  
            }
            echo "</tr>";
        }
    }
    echo "<a href='eventinfo.php?eid=".$eid."'>Return to Event</a>";
    echo "</table> </div>";
}
?>

