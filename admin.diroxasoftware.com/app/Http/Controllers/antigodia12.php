<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use FPDF;
use Crabbly\Fpdf\FpdfServiceProvider;
use App\Product;
use App\tabelaTeste;
use App\sales;
use App\productsSales;
use App\allinfosproductssales;
use App\productsales_payments;
use App\productsallinfos;
use App\sales_invoice;
use DB;

class CustomersReceiptController extends Controller
{
    public function indexInvoice80mm($id)
    {

        $todayDate =  date('d/m/Y');

            // dados da ordem
            $salesId = $id;
             // products in this sale
            $ProductsInfos2 = allinfosproductssales::where('salesId', 'LIKE', "%{$salesId}%")->get();
            // puxando da tabela sales onde ficam todas  as vendas ja realizadas
            $salesInfos = sales::find($salesId);
            $sales_price = $salesInfos->sales_price;
            $sales_subtotal  = $salesInfos->sales_subtotal;
            $sales_discount = $salesInfos->sales_discount;
            $sales_vat = $salesInfos->sales_vat;
            $totalSalesWithVat = $salesInfos->totalSalesWithVat;
            $totalSalesDiscount = $salesInfos->totalSalesDiscount;
            $methodPayment = $salesInfos->methodPayment;
            $description = $salesInfos->description;

            $typesales = 0;


            if($description == 'standard'){
                $typesales = 0;
                }
                else{
                    $typesales = 1 ;
                }
            

            $sales_subtotal = number_format($sales_subtotal, 2, '.',',');
            $sales_vat = number_format($sales_vat, 2, '.',',');
            $sales_discount = number_format($sales_discount, 2, '.',',');
            $sales_price = number_format($sales_price, 2, '.',',');

                 
        // fim dos dados da ordem

        // PDF
        // require('fpdf/fpdf.php');
        require('minhasFeatures/fpdf/fpdf.php');

        $pdf = new FPDF('P', 'mm', array(80, 200));


        //add new page
        $pdf->AddPage();

        //set font to arial, bold, 16pt
        // $pdf->SetFont('Arial', 'B, 16');

        //Cell (width, height, text, porder, end line, [align] )
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(60,8,'GOLDWORKS',1,1,'C');

        $pdf->Line(7,38,72,38);



        $pdf->SetFont('Arial', 'B', 8);


        $pdf->Cell(60,5,'Address : 1 Cromwell Ct, Ealing Rd, Alperton ',0,1,'C');
        $pdf->Cell(60,5,'Wembley HA0 1JU, United Kingdom',0,1,'C');
        $pdf->Cell(60,5,'Phone Number: 07367 100022',0,1,'C');
        $pdf->Cell(60,5,'E-mail Address : Gwtradediy@gmail.com',0,1,'C');
        $pdf->Cell(60,5,'Website: www.gwtradediy.co.uk',0,1,'');

        $pdf->Line(7,38,72,38);

        $pdf->Ln(1);

        $pdf->SetFont('Arial', 'BI', 8);
        $pdf->Cell(20,4,'Bill To :',0,0,'');


        $pdf->SetFont('Courier', 'BI', 8);
        $pdf->Cell(40,4,'Internal Product Sales',0,1,'');



        $pdf->SetFont('Arial', 'BI', 8);
        $pdf->Cell(20,4,'Invoice No :',0,0,'');



        $pdf->SetFont('Courier', 'BI', 8);
        $pdf->Cell(40,4, $salesId,0,1,'');


        $pdf->SetFont('Arial', 'BI', 8);
        $pdf->Cell(20,4,'Date :',0,0,'');

        $pdf->SetFont('Courier', 'BI', 8);
        $pdf->Cell(40,4,$todayDate,0,1,'');

        ////
            // Products informations
            $pdf->SetX(7);
            $pdf->SetFont('Courier', 'B', 8);
            $pdf->Cell(34,5,'PRODUCT',1,0,'C');
            $pdf->Cell(11,5,'QTY',1,0,'C');
            $pdf->Cell(8,5,'PRC',1,0,'C');
            $pdf->Cell(12,5,'TOTAL',1,1,'C');

            //DATAS

            if($description == 'standard'){
                foreach ($ProductsInfos2 as $product) {
                    $updatedPrice = number_format($product->totalSalesWithoutVat, 2, '.',',');

                    $total = $product->quantity * $updatedPrice;
                    $updatedTotal = number_format($total, 2, '.',',');

                    $max = 20;
                    $str = " $product->name ";
                    $result2=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                    $pdf->SetX(7);
                    $pdf->SetFont('Helvetica', 'B', 8);
                    $pdf->Cell(34,5,$result2,1,0,'C');
                    $pdf->Cell(11,5,$product->quantity,1,0,'C');
                    $pdf->Cell(8,5, $updatedPrice,1,0,'C');
                    $pdf->Cell(12,5, $updatedTotal,1,1,'C');
                }
            }
            else {

                $max = 20;
                $str = " $description ";
                $descp=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                    $pdf->SetX(7);
                    $pdf->SetFont('Helvetica', 'B', 8);
                    $pdf->Cell(34,5,$descp,1,0,'C');
                    $pdf->Cell(11,5,1,1,0,'C');
                    $pdf->Cell(8,5, $sales_subtotal,1,0,'C');
                    $pdf->Cell(12,5,$sales_subtotal,1,1,'C');
            }

            
            // End Of Products informations
        ////

        $pdf->SetX(7);
        $pdf->SetFont('Courier', 'B', 8);
        $pdf->Cell(20,5,'',0,0,'L');
        $pdf->Cell(25,5,'SUBTOTAL',1,0,'C');
        $pdf->Cell(20,5,$sales_subtotal,1,1,'C');


        $pdf->SetX(7);
        $pdf->SetFont('Courier', 'B', 8);
        $pdf->Cell(20,5,'',0,0,'L');
        $pdf->Cell(25,5,'VAT(20%)',1,0,'C');
        $pdf->Cell(20,5,$sales_vat,1,1,'C');


        $pdf->SetX(7);
        $pdf->SetFont('Courier', 'B', 8);
        $pdf->Cell(20,5,'',0,0,'L');
        $pdf->Cell(25,5,'DISCOUNT',1,0,'C');
        $pdf->Cell(20,5,$sales_discount,1,1,'C');

        $pdf->SetX(7);
        $pdf->SetFont('Courier', 'B', 10);
        $pdf->Cell(20,5,'',0,0,'L');
        $pdf->Cell(25,5,'GRAND TOTAL',1,0,'C');
        $pdf->Cell(20,5,$sales_price,1,1,'C');


        $pdf->SetX(7);
        $pdf->SetFont('Courier', 'B', 8);
        $pdf->Cell(20,5,'',0,0,'L');
        $pdf->Cell(25,5,'PAYMENT METHOD',1,0,'C');
        $pdf->Cell(20,5, $methodPayment,1,1,'C');

        $pdf->Cell(20,5,'',0,1,'');

        $pdf->SetX(7);
        $pdf->SetFont('Courier','B',8);
        $pdf->Cell(25,5,'Important Notice: ',0,1,'');

        // image
            // $image1 = '';
            $image1 = ('minhasFeatures/fpdf/imgs/gwlogo.png');
            // $pdf->Cell( 40, 100, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 55), 0, 0, 'L', false );

            $pdf->Image($image1,36,-0.12,-563);

            // $pdf->Image($image1,15,20);
            // https://www.plus2net.com/php_tutorial/pdf-image.php

             // /imgs/gwlogo.png
        // end of image


        $pdf->SetX(7);
        $pdf->SetFont('Courier','',5);
        $pdf->Cell(75,5,'Thanks for choose our services! GOLDWORKS LONDON, WEMBLEY - UK',0,2,'');


        $pdf->Output();
        exit;
        // return view('sections.printcustomer2');

    }
}
