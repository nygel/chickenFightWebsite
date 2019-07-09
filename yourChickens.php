<?php
session_start();
include("connect.php");
include("top.php");
?>
<div id='login'>
<?php
if(isset($_SESSION['active'])){
    echo $_SESSION['id'];
  /*  $sql = "SELECT c.cname,c.id
        FROM chicken c 
        where 
        (c.personID = '".$_SESSION['id']."')  
        ";
   */
    $sql = "select e.ename, c.cname from event e, fight f, chicken c
        where
        (c.personID = '".$_SESSION['id']."')  
       and (f.chick1 = c.id or f.chick2 = c.id)
       and f.eventID = e=id
        "; 
    $result = mysqli_query($link, $sql); // First parameter is just return of "mysqli_connect()" function
    echo "<br>";
    echo "<h3>CHICKENS ".$_SESSION['fname']." OWN";
    echo "<table border='1'>";
    if($result){
        $rowcount=mysqli_num_rows($result);
        if($rowcount >0){
            echo "<div style='border:solid black 2px;'>";
            echo "found".$rowcount;
                while ($row = mysqli_fetch_assoc($result)) { // 
                    echo "<tr>";
                    foreach ($row as $field => $value) { //  foreach($row as $value) {
                        echo "<td>" . $value . "</td>";  
                    }
                    echo "</tr>";
                }
        }else echo "NO fights have been joined";
        echo "</table> </div>";
    }
}
//mysqli_close($link);
?>
</div>
