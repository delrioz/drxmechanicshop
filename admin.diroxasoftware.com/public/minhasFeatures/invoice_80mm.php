<?php

require('fpdf/fpdf.php');

$pdf = new FPDF('P', 'mm', array(80, 200));

//add new page
$pdf->AddPage();

//set font to arial, bold, 16pt
// $pdf->SetFont('Arial', 'B, 16');

//Cell (width, height, text, porder, end line, [align] )
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(60,8,'GOLDWORKS Inc',1,1,'C');

$pdf->Line(7,38,72,38);
// $image1 = '';
// $image1 = ('fpdf/imgs/gwlogo.png');
// $pdf->Cell( 40, 100, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 55), 0, 0, 'L', false );



// /imgs/gwlogo.png

$pdf->SetFont('Arial', 'B', 8);


$pdf->Cell(60,5,'Address : Wembley, London - United Kingdom',0,1,'C');
$pdf->Cell(60,5,'Phone Number: 347-4567-2314',0,1,'C');
$pdf->Cell(60,5,'E-mail Address : giovaniddelrio@gmail.com',0,1,'C');
$pdf->Cell(60,5,'Website: www.gwtradediy.co.uk',0,1,'');

$pdf->Line(7,38,72,38);

$pdf->Ln(1);

$pdf->SetFont('Arial', 'BI', 8);
$pdf->Cell(20,4,'Bill To :',0,0,'');


$pdf->SetFont('Courier', 'BI', 8);
$pdf->Cell(40,4,'G:',0,1,'');



$pdf->SetFont('Arial', 'BI', 8);
$pdf->Cell(20,4,'Invoice No :',0,0,'');



$pdf->SetFont('Courier', 'BI', 8);
$pdf->Cell(40,4,'321',0,1,'');


$pdf->SetFont('Arial', 'BI', 8);
$pdf->Cell(20,4,'Date :',0,0,'');

$pdf->SetFont('Courier', 'BI', 8);
$pdf->Cell(40,4,'03/01/2020',0,1,'');

////
	// Products informations
	$pdf->SetX(7);
	$pdf->SetFont('Courier', 'B', 8);
	$pdf->Cell(34,5,'PRODUCT',1,0,'C');
	$pdf->Cell(11,5,'QTY',1,0,'C');
	$pdf->Cell(8,5,'PRC',1,0,'C');
	$pdf->Cell(12,5,'TOTAL',1,1,'C');

    //DATAS
	$pdf->SetX(7);
	$pdf->SetFont('Helvetica', 'B', 8);
	$pdf->Cell(34,5,'PRODUCT NAME',1,0,'C');
	$pdf->Cell(11,5,'QTY',1,0,'C');
	$pdf->Cell(8,5,'700',1,0,'C');
	$pdf->Cell(12,5,'700 * 1',1,1,'C');


	
	// End Of Products informations
////

$pdf->SetX(7);
$pdf->SetFont('Courier', 'B', 8);
$pdf->Cell(20,5,'',0,0,'L');
$pdf->Cell(25,5,'SUBTOTAL',1,0,'C');
$pdf->Cell(20,5,'SUBTOTAL',1,1,'C');


$pdf->SetX(7);
$pdf->SetFont('Courier', 'B', 8);
$pdf->Cell(20,5,'',0,0,'L');
$pdf->Cell(25,5,'TAX(5%)',1,0,'C');
$pdf->Cell(20,5,'tax',1,1,'C');


$pdf->SetX(7);
$pdf->SetFont('Courier', 'B', 8);
$pdf->Cell(20,5,'',0,0,'L');
$pdf->Cell(25,5,'DISCOUNT',1,0,'C');
$pdf->Cell(20,5,'discount',1,1,'C');

$pdf->SetX(7);
$pdf->SetFont('Courier', 'B', 10);
$pdf->Cell(20,5,'',0,0,'L');
$pdf->Cell(25,5,'GRAND TOTAL',1,0,'C');
$pdf->Cell(20,5,'total',1,1,'C');


$pdf->SetX(7);
$pdf->SetFont('Courier', 'B', 8);
$pdf->Cell(20,5,'',0,0,'L');
$pdf->Cell(25,5,'PAID',1,0,'C');
$pdf->Cell(20,5,'paid',1,1,'C');

$pdf->SetX(7);
$pdf->SetFont('Courier', 'B', 8);
$pdf->Cell(20,5,'',0,0,'L');
$pdf->Cell(25,5,'DUE',1,0,'C');
$pdf->Cell(20,5,'due',1,1,'C');


$pdf->SetX(7);
$pdf->SetFont('Courier', 'B', 8);
$pdf->Cell(20,5,'',0,0,'L');
$pdf->Cell(25,5,'PAYMENT TYPE',1,0,'C');
$pdf->Cell(20,5,'payment type',1,1,'C');

$pdf->Cell(20,5,'',0,1,'');

$pdf->SetX(7);
$pdf->SetFont('Courier','B',8);
$pdf->Cell(25,5,'Important Notice: ',0,1,'');


$pdf->SetX(7);
$pdf->SetFont('Courier','',5);
$pdf->Cell(75,5,'Thanks for choose us! GOLDWORKS WEMBLEY',0,2,'');


$pdf->Output();
?>