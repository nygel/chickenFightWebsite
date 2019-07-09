<?php
include('connect.php');
include('top.php');
?>
<div id='b3'>
<h3>Find</h3>
<form method='post' action=''>
<p>Persons  <input type='radio' name='person' ></p>
<p>Chickens <input type='radio' name='chicken' ></p>
<p>Name  <input type='text' name='name'></p>
<p>Rank   <input type='number' name='rank'></p>
<h3>Order By (rank)</h3>
<p>Ascending <input type='radio' name='ad' value='a'>  Descending <input type='radio' name='ad' value='d' ></p>
<input type ='submit' name='submit' value='submit'>
</form>
</div>
<?php
if(isset($_POST['submit'])){
    $sql='';
    if(isset($_POST['chicken'])){
        if(empty($_POST['name']) && empty($_POST['rank'])){
            $sql = "select c.cname,c.rank,c.pic, c.id as cid, p.id as pid, p.fname, p.lname from chicken c, person p 
                where p.id = c.personID";
        }else{
            $sql = "select c.cname,c.rank,c.pic, c.id as cid, p.id as pid,p.fname, p.lname  from chicken c, person p 
                where (p.id = c.personID 
                and ( c.rank = '".$_POST['rank']."' 
                or c.cname = '".$_POST['name']."' 
                or p.lname = '".$_POST['name']."'
                or p.fname = '".$_POST['name']."'))";
        }
        
        if(isset($_POST['ad'])){
            if($_POST['ad']=='d')
                $sql .=" order by c.rank desc";
            else    
                $sql .=" order by c.rank";
        }

    }
    else if(isset($_POST['person'])){
        if(empty($_POST['name'])){
            $sql = "select * from person ";
        }else
            $sql = "select * from person where fname = '".$_POST['name']."' or lname = '".$_POST['name']."'";
    }
    //echo "<br>sql: ".$sql;
    $result = mysqli_query($link, $sql); 
    echo "<div id='b3' style='float:left'><table>";
    if($result){
        $rowcount=mysqli_num_rows($result);
        if($rowcount >0){
            echo "found ".$rowcount;
            if(isset($_POST['person'])){
                echo "<tr><th>Name</th><th>Email</th><tr>";
            }else{
                echo "<tr><th>Rank</th><th></th><th>Name</th><th>Owner</th><tr>";
            }
            while ($row = mysqli_fetch_assoc($result)) { // 
                echo "<tr>";
                if(isset($_POST['person'])){
                    echo "<td><a href='pdetails.php?t=".$row['id']."'>".$row['fname']." ".$row['lname']."</a></td>";
                    echo "<td>".$row['email']."</td>";
                }
                else if(isset($_POST['chicken'])){
                    echo "<td>".$row['rank']."</td>";
                    echo "<td><img src='".$row['pic']."' height=100 width=100></td>";
                    echo "<td><a href='cdetails.php?q=".$row['cid']."'>".$row['cname']."</a></td>";
                    echo "<td><a href='pdetails.php?t=".$row['pid']."'>".$row['fname']." ".$row['lname']."</a></td>";
                }
                echo "</tr>";
            }
            echo "</table></div> ";
        }
    }
}
?>
