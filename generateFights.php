<?php
include("top.php");
include("connect.php");
echo "eid= ".$_GET['eid']."<br>";
$eid = $_GET['eid'];
$sql = "SELECT * FROM waitList where eventID = '".$_GET['eid']."' ";
$result = mysqli_query($link, $sql);
echo "<div id='login'>";
echo "<h3>List of Fighters for event(waiting to be paired for fight)</h3>";
echo "<table border='1'>";
if($result){
    $rowcount=mysqli_num_rows($result);
    if($rowcount >0){
        echo "<div style='border:solid black 2px;'>";
        echo "found".$rowcount;
        while ($row = mysqli_fetch_assoc($result)) { // 
            echo "<tr>";
            foreach ($row as $field => $value) { 
                echo "<td>" . $value . "</td>";  
            }
            echo "</tr>";
        }
    }
    echo "<a href='eventifo.php?eid=".$eid."'>Return to Event</a>";
    echo "</table> </div>";
}

$sql = "SELECT id FROM waitList where eventID = '".$_GET['eid']."' and max(id); ";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
echo "max id for event".$row['id'];
for($x = $row['id']; $x < $row['id']/2; $x+=2){
    $sql = "insert into fight (id, eventID) values (max(id),'$eid')";

    //$sql = "select chickenID from waitList where eventID='".$_GET['eid']."')";
    $result = mysqli_query($link, $sql); 
    $row = mysqli_fetch_assoc($result)
    $r = rand(1,300);
    /*$sql = "insert into fight (chick1,chick2) 
        select chickenID where id='".$x."'  
        from waitList 
        where eventID='".$_GET['eid']."' and id = '".$x."'";
     */
    //sql insert into fight with max id and event id
    //then update to put in the chick1 and chic2
    $sql ="insert into fight (id,eventID)
        values(max(id)+1,".$_GET['eid'].")";
    $result = mysqli_query($link, $sql); 
    $sql= "update fight 
        set fight.chick1 = w.chickenID 
        from waitList w inner join ";
    $result = mysqli_query($link, $sql); 
}
?>

