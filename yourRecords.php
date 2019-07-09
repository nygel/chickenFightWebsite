<?php
session_start();
include("connect.php");
include("top.php");
?>
<?php
if(isset($_SESSION['active'])){
    $sql = "SELECT c.pic,c.cname,c.tier,c.rank,c.health,c.attack,c.defense FROM chicken c where personID = '".$_SESSION['id']."' ";
    $result = mysqli_query($link, $sql); // First parameter is just return of "mysqli_connect()" function
    echo "<br><div id='b3'>";
    echo "<h3>CHICKENS ".$_SESSION['fname']." OWN";
    echo "<table >";
    if($result){
        $rowcount=mysqli_num_rows($result);
        if($rowcount >0){
            echo "found ".$rowcount;
            echo"<tr><th>pic</th><th>Name</th><th>Tier</th><th>Rank</th><th>Health</th><th>Attack</th><th>Defense</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) { // 
                echo "<tr>";
                //foreach ($row as $field => $value) { //  foreach($row as $value) {
                //}
                    echo "<td><img src='" . $row['pic'] . "' height='75' width='75' ></td>";  
                    echo "<td>".$row['cname']."</td>";  
                    echo "<td>".$row['tier']."</td>";  
                    echo "<td>".$row['rank']."</td>";  
                    echo "<td>".$row['health']."</td>";  
                    echo "<td>".$row['attack']."</td>";  
                    echo "<td>".$row['defense']."</td>";  
                echo "</tr>";
            }
    }
        }else
            echo "No chickens found<br></div>";
        echo "</table>";
echo "<a href ='getChicken.php'><b>Get Chicken</b></a></div>";


echo"<div id='b3'>";

if(isset($_SESSION['active'])){
    //fights==================================================
    //(chicken.id = 3  or chicken.id = 103  or chicken.id = 203)  
/*    $sql = "select event.ename,event.endDate, fight.chick1,fight.chick2,fight.result  
        from fight, chicken, event 
        where
        (chicken.personID = '".$_SESSION['id']."')  
        and 
        (fight.chick1 = chicken.id or fight.chick2 = chicken.id)
        and
        (fight.eventID = event.id)";
 */
$sql = "SELECT e.ename, e.endDate, c1.cname as chicken1, c2.cname as chicken2, c3.cname as chicken3
    FROM fight f 
    inner join chicken c1 on (f.chick1 = c1.id ) 
    inner join chicken c2 on (f.chick2 = c2.id )
    inner join chicken c3 on (f.result = c3.id)  
    inner join event e on (f.eventID = e.id) 
    where
(c1.personID = '".$_SESSION['id']."' or c2.personID = '".$_SESSION['id']."')
    ;";
$result = mysqli_query($link, $sql);
echo "<br>";
echo "<h3> FIGHTS ".$_SESSION['fname']."'S CHICKEN PARTICIPATED";
echo "<table id='tab1'>";
$rowcount1=mysqli_num_rows($result);
echo "<br>found ".$rowcount1."<br>";
if($result){
    if($rowcount1 >0){
            echo "<tr><th>Event Name</th><th>Event Date</th><th>Chicken 1</th><th>Chicken 2 </th><th>Result</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) { // 
            echo "<tr>";
            foreach ($row as $field => $value) { //  foreach($row as $value) {
                echo "<td>" . $value . "</td>";  
            }
            echo "</tr>";
        }
}
    }else
        echo "No fights participated as of yet<br></div>";
echo "</table>";
$sql = "select e.ename, e.endDate, c3.cname from fight f
    inner join chicken c3 on (f.result = c3.id)  
    inner join event e on (f.eventID = e.id) 
where c3.personID = '".$_SESSION['id']."'
";
$result = mysqli_query($link, $sql);
echo "<br>";
echo "<h3> FIGHTS ".$_SESSION['fname']."'S CHICKEN WON";
echo "<table>";
$rowcount2=mysqli_num_rows($result);
echo "<br>found ".$rowcount2 ."<br>";
if($result){
    if($rowcount2 >0){
            echo "<tr><th>Event Name</th><th>Event Date</th><th>Chicken</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) { // 
            echo "<tr>";
            foreach ($row as $field => $value) { 
                echo "<td>" . $value . "</td>";  
            }
            echo "</tr>";
        }
    }else echo"</div>";
     //   echo "No wins found<br>";
}
echo "</table>";
//(chicken.id = 3  or chicken.id = 103  or chicken.id = 203)  
//(chicken.personID = '".$_SESSION['id']."')  
//and (award.winner = chicken.id)";
echo "<br>";
echo "<h3> AWARDS ".$_SESSION['fname']."'S CHICKEN RECIEVED";
echo "<table>";
$sql = "select award.name, chicken.name from awards
    inner join chicken on (awards.winner = chicken.id) 
where
    (chicken.personID = '".$_SESSION['id']."')  
   
    ";

echo "<table border='1'>";
$result = mysqli_query($link, $sql);
$rowcount=mysqli_num_rows($result);
//echo "<br>found ".$rowcount."<br>";
if($result){
    if($rowcount >0){
        while ($row = mysqli_fetch_assoc($result)) { // 
            echo "<tr>";
            foreach ($row as $field => $value) { //  foreach($row as $value) {
                echo "<td>" . $value . "</td>";  
            }
            echo "</tr>";
        }
    }else
        echo"<br>nothing found :(<br></div>";

}
echo "</table> </div>";
}
$loss = $rowcount1 - $rowcount2;
$_SESSION['fights']=$rowcount1;
$_SESSION['wins']=$rowcount2;
echo"<div id='b3'>";

echo "<br>";
echo "<h3>Stats</h3>";
echo "<table >";
echo "<tr><th>Fight</th><th>Wins</th><th>Loss</th></tr>";
echo "<tr><td>".$rowcount1."</td><td>".$rowcount2."</td><td>".$loss."</td></tr>";
echo "<tr><th>Win ratio</th></tr>";
echo "<tr><td>".$rowcount2/$rowcount1."</td></tr>";
echo "<tr><th>Win/Loss ratio</th></tr>";
echo "<tr><td>".$rowcount2/$loss."</td></tr>";
echo "<tr><th>PDF</th></tr>";
echo "<tr><td><a href='testpdf.php'>PDF</a></td></tr>";
echo "</table> </div>";
///upcoming================================================

/*$sql="select c.id, e.name, e.endDate from waitList w, chicken c,person p, event e where 
 (p.id = '".$_SESSION['id']."') and
 (p.id = c.personID) and
 (c.id = w.chickenID) and
 (w.eventID = e.id)";
 */
$sql = "select e.ename, e.endDate, c3.cname from waitList w
    inner join chicken c3 on (w.chickenID = c3.id)  
    inner join event e on (w.eventID = e.id) 
where c3.personID = '".$_SESSION['id']."'
";
$result = mysqli_query($link, $sql);
echo "<br><div id='b3'><h3 >".$_SESSION['fname']."'s Upcoming Events</h3>";
echo "<table >";
$rowcount=mysqli_num_rows($result);
if($result){
    if($rowcount >0){
        echo "<tr><th>Chicken name</th><th>Event name</th><th>Start Date</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) { // 
            echo "<tr>";
            foreach ($row as $field => $value) { //  foreach($row as $value) {
                echo "<td>" . $value . "</td>";  
            }
            echo "</tr>";
        }
    }else
        echo "no events schedualed";
}
echo "</table></div> <br>";

}else 
    echo"You're logged out<br><a href='login.php'>Login</a>"
?>
</div>
</div>
<br>
