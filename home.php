<?php
session_start();
include('top.php');
include('connect.php');

if(isset($_SESSION['active'])){
    echo" <div id='login'>
        <h3> Welcome Back ". $_SESSION['fname']." </h3>
        </div><br style='clear:both'>";

}
else{
    echo" <div id='login' >
        <h3> WELCOME </h3>
        <br>
        <pre>please login</pre> 
        <a href='login.php'> Login </a>
        </div>";
}

//top chickens query
$sql = "SELECT * from chickenTop";
$result = mysqli_query($link, $sql); 
//echo "<br><div id='b1'>";
echo "<br><div id='b3' >";
echo "<h3>TOP CHICKENS BY RANK</h3>";
echo "<table >";
if($result){
    $rowcount=mysqli_num_rows($result);
    if($rowcount >0){
        echo"<tr><th>Rank</th><th>Chicken Name</th><th>Tier</th><th>Health</th><th>Defense</th><th>Attack</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) { // 
            echo "<tr>";
            foreach ($row as $field => $value) { //  foreach($row as $value) {
                echo "<td>" . $value . "</td>";  
            }
            echo "</tr>";
        }
    }
    echo "</table> </div>";
}
//upcoming events
$sql = "SELECT poster, endDate,ename, endDate FROM event WHERE 
    year(endDate)=2019";

//$sql = "SELECT * from eThisMonth";
$result = mysqli_query($link, $sql); 
echo "<div id='b3''>";
echo "<h3>UPCOMING EVENTS FOR THIS YEAR</h3>";
echo "<table >";
if($result){
    $rowcount=mysqli_num_rows($result);
    if($rowcount >0){
       // echo "<tr><th>Event Name</th><th>Start Date</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) { // 
       //     echo "<tr>";
      /* echo "<td> <img src='cf".$row['poster'].".png' width = 100 height =100></div></td> <td><a href='eventinfo.php?eid=".$row['id']."'><h3>".$row['ename']."</h3></a><td>".$row['endDate']."</td>"; 
       //echo "</tr>";
       */
            echo "<p style ='float:left'> <img src='cf".$row['poster'].".png' width = 100 height =100 ></p><p style ='float:left'>
                Event Name: <a href='eventinfo.php?eid=".$row['id']."'>".$row['ename']."</a> <br>Start Date: ".$row['endDate']."</p>"; 
       echo "<br style='clear:both'>";
        }
    }
}
echo "</table></div>";
//welcome back message
//==============

if(isset($_SESSION['active'])){

//upcoming events for person
$sql = "select e.poster, e.ename, e.endDate, c3.cname, c3.pic from waitList w
    inner join chicken c3 on (w.chickenID = c3.id)  
    inner join event e on (w.eventID = e.id) 
where c3.personID = '".$_SESSION['id']."'
";
$result = mysqli_query($link, $sql);
echo "<div id='b3'><h3 >".$_SESSION['fname']."'s Upcoming Events</h3>";
echo "<table >";
$rowcount=mysqli_num_rows($result);
if($result){
    if($rowcount >0){
        while ($row = mysqli_fetch_assoc($result)) { // 
            echo "<p style ='float:left'> <img src='".$row['pic']."' width = 100 height =100 ></p>
                <p style ='float:left'>Event Name: <a href='eventinfo.php?eid=".$row['id']."'>".$row['ename']."</a> <br>Start Date: ".$row['endDate']."<br>Chicken Registered: ".$row['cname']."</p>"; 
       echo "<br style='clear:both'>";
        }
    }else
        echo "no events scheduled";
}
echo "</table> </div> <br>";
}
//=============
?>
<?php
?>
