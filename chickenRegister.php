<?php
session_start();
include("connect.php");
include("top.php");
?>
<div id='login'>
<?php
if(isset($_SESSION['active'])){
    $sql = "SELECT * FROM chicken where personID = '".$_SESSION['id']."' and health >0";
    $result = mysqli_query($link, $sql); 
    echo "<br>";
    echo "<h3>Chickens Avalible to Register</h3>";
    echo "<table border='1'>";
    if($result){
        $rowcount=mysqli_num_rows($result);
        if($rowcount >0){
            echo "<form action='' method='post'>";
            echo "found ".$rowcount."<br>";
            echo "<tr><th>picture</th><th>chicken name</th><th>health</th><th>attack</th><th>defense</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) { // 
                echo "<tr>";
                echo "<td><img src='" .$row['pic'] . "' height=50 width=50></td>";
                echo "<td>" .$row['cname'] . "</td>
                    <td>".$row['health']."</td>
                    <td>".$row['attack']."</td>
                    <td>".$row['defense']."</td>
                    <td><input type='checkbox' name='chick[]' value='".$row['id']."'> </td>";  
                echo "</tr>";
            }
            $eid = $_GET['eid'];
            echo "<a href='eventinfo.php?eid=".$eid."'>Return to Event</a>";
            echo "</table>";
            echo "<input name='submit' type='submit'></form> ";
        }
    }
}

//mysqli_close($link);
?>
<?php
if(isset($_POST['submit'])){
    $eid = $_GET['eid'];
    $temp='';
    foreach ($_POST['chick'] as $key => $value) {
        //echo $value . "<br>";
        $temp += " ".strval($value).",";
        $sql = "insert into waitList (eventID, chickenID,id) select '$eid','$value', count(*)+1 from waitList where eventID = ".$eid;

        $result = mysqli_query($link, $sql); 
    }
    $cids = $_POST['chick'];
    $ids = implode(',',$cids); 
    //echo $ids;
    $sql = "SELECT * FROM chicken WHERE id IN (".$ids.")";
    $result = mysqli_query($link, $sql);
    echo "<h4>Chickens Registered</h4>";
    if($result){
        $rowcount=mysqli_num_rows($result);
        if($rowcount >0){
            while ($row = mysqli_fetch_assoc($result)) { // 
                echo "<p style='float:left'><img src='" .$row['pic'] . "' height=50 width=50></p>";
                echo "<p style='float:left'>  Name: " .$row['cname'] . "<br>  Health: ".$row['health']." Attack: ".$row['attack']." Defense: ".$row['defense']."
                    </p><br>";  
            }
            $eid = $_GET['eid'];
            echo "<br style='clear:both'><a href='eventinfo.php?eid=".$eid."'>Return to Event</a>";
            echo "</table>";
        }
    }
}
?>
</div>
</div>
