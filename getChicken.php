<?php
//opening this page while logged in will add a randomly generated chicken with the name Meeps to the user's account
session_start();
include("connect.php");
include("top.php");
?>
<div id='login'>
<?php
if(isset($_SESSION['active'])){
    
    $sql = "insert into chicken (pic,personID,cname,attack,defense,health,tier,rank) 
        select CONCAT(floor(rand()*9+1),'.jpg'),".$_SESSION['id'].",'Meeps',floor(rand()*10),floor(rand()*10),floor(rand()*10),
        floor((attack +defense+ health)/10), count(rank)+1 from chicken";
    $result = mysqli_query($link, $sql); 
    $sql = "SELECT * FROM chicken where personID = '".$_SESSION['id']."' and health >0";
    $result = mysqli_query($link, $sql); 
    echo "<br>";
    echo "<h3>Chickens Owned</h3>";
    echo "<table border='1'>";
    echo "<a href='yourInfo.php'>Return to Account Information</a>";
    if($result){
        $rowcount=mysqli_num_rows($result);
        if($rowcount >0){
            echo "found".$rowcount;
            echo "<tr><th>picture</th><th>chicken name</th><th>health</th><th>attack</th><th>defense</th><th>tier</th><th>rank</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) { // 
                echo "<tr>";
                echo "<td><img src='" .$row['pic'] . "' height=50 width=50></td>";
                echo "<td>" .$row['cname'] . "</td>
                    <td>".$row['health']."</td>
                    <td>".$row['attack']."</td>
                    <td>".$row['defense']."</td>
                    <td>".$row['tier']."</td>
                    <td>".$row['rank']."</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
}

?>
</div>
