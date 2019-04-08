<?php
ob_start();
$con=mysqli_connect("localhost","root","","institute");
if (!$con)
{
   echo "failed to connect MySQL server!";
}
// check the connection:

if (isset($_POST['Search'])){
    $search_term = $_POST['InputID'];
    $fetchdataquery = "SELECT * from STUDENT WHERE ID = '{$search_term}'";
}

$result = mysqli_query($con,$fetchdataquery);

require('fpdf.php');
$pdf = new FPDF('p','mm','A4');
$pdf->SetTextColor( 255,40,80 );
$pdf->AddPage();
$pdf->SetMargins(20,20,20);
$pdf->Rect(3, 3, 204, 291, 'D');
$pdf->SetFont('Arial','B',14);
$pdf->Ln( 70 );
$pdf->SetFillColor(255,70,70);
$pdf->Rect(65, 7, 71, 90, 'F');
$pdf->Image('C:\wamp\www\project\efg-logo.png',68,10,-200);
$pdf->Ln( 1 );   
$pdf->SetTextColor(255,255,255); 
$pdf->Write(10,'                                       Electronics is passion');
$pdf->Ln( 40 );
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Times','I',15);
$pdf->Write(6, 'This is to certify your active participation and training with us, at EFG Labs. We hope you had, and are having a wonderful experience with us. Your details have been enlisted in a tabular form below.');
$pdf->Ln( 20 );
$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,70,70);
$pdf->Cell(10,10,"ID",1,0,'C',true);
$pdf->Cell(45,10,"Name",1,0,'C',true);
$pdf->Cell(40,10,"Certificate ID",1,0,'C',true);
$pdf->Cell(20,10,"Grade",1,0,'C',true);
$pdf->Cell(49,10,"Topic",1,1,'C',true);

    while($row = mysqli_fetch_array($result))
    {
        $pdf->Cell(10,10,$row['ID'],1,0,'C');
        $pdf->Cell(45,10,$row['Name'],1,0,'C');
        $pdf->Cell(40,10,$row['certificate ID'],1,0,'C');
        $pdf->Cell(20,10,$row['Grade'],1,0,'C');
        $pdf->Cell(49,10,$row['Topic'],1,1,'C');
    }
$pdf->Ln( 80 );
$pdf->Write(6,'Stamp                                                                                            Signature of the Institution');
$pdf->Output();
ob_end_flush();
mysqli_close($con);
?> 
</html>
