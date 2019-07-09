<?php
include("top.php");
include("connect.php");
//event info
echo "<br><div id='b3'>";
echo "<h3>EVENT INFO ";
echo "<table border='1'>";
$sql = "SELECT * FROM event where id = ".$_GET['eid']." ";
$result = mysqli_query($link, $sql); 
$rowcount=mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);
echo "<div style='border:solid black 2px;padding:2px;'>
    <img src='cf".$row['poster'].".png'></div>";
echo "<tr><th>Name</th><td> ".$row['ename']."</td></tr>";
echo "<tr><th>Location</th><td> ".$row['address'].", ".$row['city']." </td></tr>";
echo "<tr><th>Registration Start</th><td>".$row['startDate']."</td></tr>";
echo "<tr><th>Event Date</th><td> ".$row['endDate']."</td></tr>";

$today = date("Y-m-d");
$today_dt = new DateTime($today);
$expire_dt = new DateTime($row['endDate']);
//fight list

if($today < $row['endDate'])echo "before current Date</table></div>";
else echo "after current Date</table></div>";
echo "<div id='b3'>";
echo "<h3>FIGHTS</h3> ";
echo "<table >";


$sql = "SELECT 
    c1.id as c1i, c1.pic as c1p, c1.cname as chicken1,c1.tier as c1t, c1.rank as c1r, c1.health as c1h, c1.defense as c1d, c1.attack as c1a, 
    c2.id as c2i, c2.pic as c2p,  c2.cname as chicken2,c2.tier as c2t, c2.rank as c2r, c2.health as c2h, c2.defense as c2d, c2.attack as c2a, 
    c3.id as c3i, c3.pic as c3p, c3.cname as chicken3
    FROM fight f 
    inner join chicken c1 on (f.chick1 = c1.id) and f.eventID = ".$_GET['eid']."
    inner join chicken c2 on (f.chick2 = c2.id) and f.eventID = ".$_GET['eid']."
    inner join chicken c3 on (f.result = c3.id) and f.eventID = ".$_GET['eid']."

    ;";
$result = mysqli_query($link, $sql); 
$rowcount=mysqli_num_rows($result);
echo "found ".$rowcount;
//=========================================this is suppose to be not show in the actual page just show in presentation
//if($today > $row['endDate'])
    echo "<tr><th>Chicken 1</th><th>Chicken 2</th><th>Winner</th></tr>";
echo "<tr>";
$w=0;
if($rowcount >0){
    while($row = mysqli_fetch_assoc($result)){

        echo "<td><details>";     
        echo "<summary><img src='".$row['c1p']."'height=90 width=90> ".$row['chicken1']."</summary>";
        echo "<p>Tier: ".$row['c1t']." Rank: ".$row['c1r']."</p>";
        echo "<p>Health: ".$row['c1h']." Defense: ".$row['c1d']." Attack ".$row['c1a']."</p>";
        echo "<a href='cdetails.php?q=".$row['c1i']."'>Chicken's page</a>";
        echo "</details>";
        echo "</td>";
        echo "<td><details>";
        echo "<summary><img src='".$row['c2p']."'height=90 width=90> ".$row['chicken2']."</summary>";
        echo "<p>Tier: ".$row['c2t']." Rank: ".$row['c2r']."</p>";
        echo "<p>Health: ".$row['c2h']." Defense: ".$row['c2d']." Attack ".$row['c2a']."</p>";
        echo "<a href='cdetails.php?q=".$row['c2i']."'>Chicken's page</a>";
        echo "</details>";
        echo "</td>";
        echo "<td><a href='cdetails.php?q=".$row['c3i']."'><img src='".$row['c3p']."'height=90 width=90></a> ".$row['chicken3']."</td>";

        // }
        echo "</tr>";
        $w++;
    }
    echo "</table>";
}
//waitList

else if($today < $row['endDate']){
    //else{
    echo"<a href='chickenRegister.php?eid=".$_GET['eid']."'>Register</a>  |";
    echo "<a href='addFighters.php?eid=".$_GET['eid']."'>Add Fighters</a>  |";
    echo "<a href='pairFighters.php?eid=".$_GET['eid']."'>Pair Fighters</a>";

    echo "<h3>FIGHTERS</h3> ";
    echo "<table >";
    $sql = "SELECT Ch.cname,Ch.tier, Ch.health, Ch.attack, Ch.defense 
        FROM waitList Wl, chicken Ch 
        where Wl.eventID = '".$_GET['eid']."' and
        Wl.chickenID = Ch.id";
$result = mysqli_query($link, $sql); 
$rowcount=mysqli_num_rows($result);
echo "<tr><th>Chicken name</th><th>Tier</th><th>Health</th><th>Attack</th><th>Defense</th></tr>";
echo "<tr>";
while($row = mysqli_fetch_assoc($result)){
    foreach ($row as $field => $value) { 
        echo "<td>" . $value . "</td>";  
    }
    echo "</tr>";
}

echo "</table>";

echo "</table> </div>";
}
?>

