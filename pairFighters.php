<?php
//pair fighters from waitlist
include("top.php");
include("connect.php");
$eid = $_GET['eid'];

echo "yo";
/*$sql = " insert into fight (eventID,chick1,chick2,result,endTime,startTime)
        select 
        '54', w1.chickenID, w2.chickenID,if(rand()*10 >5,w1.chickenID,w2.chickenID)
        ,'08:00:00','09:00:00'
        from waitList w1, waitList w2
        where 
        (w1.eventID = 54 and w2.eventID = 54)
        and w1.chickenID != w2.chickenID
        and mod(w1.id,2) = 1
        and w1.id = w2.id +1 
       
";*/
$sql = "insert into fight (eventID, chick1,chick2,result,endTime,startTime)
select '".$eid."', w1.chickenID, w2.chickenID, if(rand()*10>5,w1.chickenID,w2.chickenID),'08:00:00','09:00:00'
from waitList w1, waitList w2 
where w1.eventID = ".$eid." and w2.eventID = ".$eid." 
and mod(w1.id,2)=1 
and w1.id = w2.id+1
and w2.id = w1.id-1";
$result = mysqli_query($link, $sql);

$sql = "SELECT * FROM fight where eventID = '".$_GET['eid']."' ";
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
    }else
        echo "no fights paired<br>";
    echo "<a href='eventinfo.php?eid=".$eid."'>Return to Event</a>";
    echo "</table> </div>";
}
$sql = "DELETE FROM waitList where eventID = '".$_GET['eid']."' ";
$result = mysqli_query($link, $sql);
?>

