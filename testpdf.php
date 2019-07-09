<?php
session_start();
include('connect.php');
require('fpdf.php');

if(isset($_SESSION['active'])){
    $pdf = new FPDF();
    $pdf->AddPage();

    $sql = "SELECT * FROM chicken where personID = '".$_SESSION['id']."' ";
    $result = mysqli_query($link, $sql);  
    $rowcount=mysqli_num_rows($result);
    
    //$pdf->Cell(40,10,$curd);
    $timezone = "Europe/Oslo";
     date_default_timezone_set($timezone);
    $curd = date("m/d/Y");

    $pdf->SetFont('Arial','',10);
    $pdf->Image('logo2.png',10,6,200);
    $pdf->Ln(13);
    $pdf->Cell(40,10,$curd);
    $pdf->Ln(10);
    $pdf->SetFont('Arial','B',20);
    $pdf->SetFillColor(200,220,255); 
    $pdf->Cell(0,8,"    Account Information",0,1,'L',true);
    $pdf->Ln();
    $pdf->Cell(40,10,$_SESSION['fname']." ".$_SESSION['lname']);
    $pdf->SetFont('Arial','',15);
    $pdf->Ln();
    $pdf->Cell(40,10,"email: ".$_SESSION['email']);
    $pdf->SetFont('Arial','B',20);
    $pdf->Ln(20);
    $pdf->SetFillColor(200,220,255); 
    $pdf->Cell(0,8,"    Chicken's Owned by ".$_SESSION['fname']." ".$_SESSION['lname'],0,1,'L',true);
    $pdf->Ln();


        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(20,10,"Image");
        $pdf->Cell(20,10,"Name");
        $pdf->Cell(20,10,"Tier");
        $pdf->Cell(20,10,"Rank");
        $pdf->Cell(20,10,"Health");
        $pdf->Cell(20,10,"Attack");
        $pdf->Cell(20,10,"Defense");

        $dwn = 105;
    while ($row = mysqli_fetch_assoc($result)) { // 
        $pdf->SetFont('Arial','',12);
        $pdf->Ln();
        $pdf->Image($row['pic'],10,$dwn,10);
        $pdf->Cell(20,10," ");
        $pdf->Cell(20,10,$row['cname']);
        $pdf->Cell(20,10,$row['tier']);
        $pdf->Cell(20,10,$row['rank']);
        $pdf->Cell(20,10,$row['health']);
        $pdf->Cell(20,10,$row['attack']);
        $pdf->Cell(20,10,$row['defense']);
        $dwn += 10;

    }
    $pdf->SetFont('Arial','B',12);

$sql = "SELECT e.ename, e.endDate, c1.cname as chicken1, c2.cname as chicken2, c3.cname as chicken3
    FROM fight f 
    inner join chicken c1 on (f.chick1 = c1.id ) 
    inner join chicken c2 on (f.chick2 = c2.id )
    inner join chicken c3 on (f.result = c3.id)  
    inner join event e on (f.eventID = e.id) 
    where
    (c1.personID = '".$_SESSION['id']."'  or c2.personID = '".$_SESSION['id']."')
    ;";
$result = mysqli_query($link, $sql);  
$rowcount=mysqli_num_rows($result);

$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','B',20);
$pdf->SetFillColor(200,220,255); 
$pdf->Cell(0,8,"    Event ".$_SESSION['fname']." ".$_SESSION['lname']." Participated",0,1,'L',true);
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,10,"Fights: ");
$pdf->SetFont('Arial','',12);
$pdf->Cell(60,10,$_SESSION['fights']);
$pdf->Ln();

while ($row = mysqli_fetch_assoc($result)) { // 
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(40,10,"                Event name: ".$row['ename']." | Date: ".$row['endDate']);
    $pdf->Ln();
    $pdf->Cell(40,10, "Chicken 1 ");
    $pdf->Cell(40,10, "Chicken 2 ");
    $pdf->Cell(40,10, "Winner");
    $pdf->Ln();
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(40,10, $row['chicken1']);
    $pdf->Cell(40,10, $row['chicken2']);
    $pdf->Cell(40,10, $row['chicken3']);
    $pdf->Ln(20);

}
$pdf->Ln();
$pdf->Ln();
$sql = "select event.ename, fight.id, event.endDate, chicken.cname from fight, chicken, event where
    (chicken.personID = '".$_SESSION['id']."')  
    and 
    (fight.result = chicken.id)
    and
    (fight.eventID = event.id)";

$result = mysqli_query($link, $sql);  
$pdf->SetFont('Arial','B',20);
$pdf->SetFillColor(200,220,255); 
$pdf->Cell(0,8,"   Event ".$_SESSION['fname']." ".$_SESSION['lname']." Won",0,1,'L',true);
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,10,"Fights Won: ");
$pdf->SetFont('Arial','',12);
$pdf->Cell(60,10,$_SESSION['wins']);
$pdf->Ln();

while ($row = mysqli_fetch_assoc($result)) { // 
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(40,10,"Event name: ".$row['ename']." | Date: ".$row['endDate']);
    $pdf->Ln();
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(60,10, "Winner: ".$row['cname']);
    $pdf->Ln();

}
$pdf->Ln();
$pdf->Ln();
$pdf->SetFillColor(200,220,255); 
$pdf->Cell(0,8,"   Summary",0,1,'L',true);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,10,"Fights: ");
$pdf->SetFont('Arial','',12);
$pdf->Cell(60,10,$_SESSION['fights']);
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,10,"Fights Won: ");
$pdf->SetFont('Arial','',12);
$pdf->Cell(60,10,$_SESSION['wins']);
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,10,"Fights Lost: ");
$pdf->SetFont('Arial','',12);
$pdf->Cell(60,10,$_SESSION['fights']-$_SESSION['wins']);
$pdf->SetFont('Arial','B',12);
$pdf->Ln();
$pdf->Output();
}
?>

