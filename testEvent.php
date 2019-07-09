<?php
//search page of for event 
//displays events and their quick summaries grouped by decade
//clicking on event's name redirects to the event's information
include('connect.php');
include('top.php');
?>
<label>
<h3>Search Events</h3>
<form action'#' method='post'>
<select name="year">
  <option value="2019">This Year</option>
  <option >Archive</option>
  <option value='2010'>2018-2010</option>
  <option value='2000'>2009-2000</option>
  <option value='1990'>1999-1990</option>
  <option value='1980'>1989-1980</option>
  <option value='1970'>1979-1970</option>
</select>
<input type="submit" name="submit" value="find">
</form>
</label>
<br>
<?php
echo $_SESSION['id'];
$top = $_POST['year'] + 10;
if($top == 2020)$top = 2018;
$sql = "SELECT * FROM event where 
    year(endDate) < '".$top."'
    and year(endDate) >= '".$_POST['year']."'";
$result = mysqli_query($link, $sql); 
echo "<br>";
echo "<h3>EVENTS</h3> ";
if($top == 2029){
    echo "DISPLAYING: ".$_POST['year']."- ...<br>";
}else if($top==10){
    echo "Please Select A Year<br>";
}else{
    echo "DISPLAYING: ".$_POST['year']."-".$top."<br>";
}
if($result){
    $rowcount=mysqli_num_rows($result);
    if($rowcount >0){
        while ($row = mysqli_fetch_assoc($result)) { // 
            echo"<div id='b3'>"; 
            echo "<a href='eventinfo.php?eid=".$row['id']."'><h3>".$row['ename'] . "</h3></a><br> 
                City: ".$row['city'] . "<br> 
                Registration Start: ".$row['startDate'] . "<br> 
                Event Date: ".$row['endDate'] . "<br>";
            echo"</div>";
        }
    }
}
?>
