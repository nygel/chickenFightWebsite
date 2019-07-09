R u working?
<?php
session_start();
$_SESSION['why']= 'becuase I love u';
if(isset($_SESSION['why']))
    echo "not working becuase i hate u";
else
    echo "u r working ".$_SESSION['why'];
echo"<br>";
$_SESSION['returnURL'] = "/store/checkout/onepage";
echo '<a href="second.php">Pass session to another page</a><br>';
echo 'returnURL = ' . $_SESSION['returnURL']."<br>";
if(isset($_SESSION['returnURL']))
    echo "u r working ".$_SESSION['why'];
else
    echo "not working becuase i hate u";

?>
