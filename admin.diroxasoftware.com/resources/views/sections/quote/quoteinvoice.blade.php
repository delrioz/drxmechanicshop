<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="images/favicon.png" rel="icon" />
<title>Diroxa Software - QUOTE</title>
<meta name="author" content="harnishdesign.net">

<!-- Web Fonts
======================= -->
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900' type='text/css'>

<!-- Stylesheet
======================= -->
<link href="{{ asset('admlyt/invoice/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('admlyt/invoice/css/sb-admin-2.min.css') }}" rel="stylesheet">
<link href="{{ asset('admlyt/invoice/vendor/font-awesome/css/all.min.css') }}" rel="stylesheet">
<link href="{{ asset('admlyt/invoice/css/sb-admin-2.min.css') }}" rel="stylesheet">
<link href="{{ asset('admlyt/invoice/css/stylesheet.css') }}" rel="stylesheet">

</head>
<body>
<!-- Container -->
<div class="container-fluid invoice-container">
  <!-- Header -->
  <header>
  <div class="row align-items-center">
    <div class="col-sm-7 text-center text-sm-left mb-3 mb-sm-0">
      <img id="logo" src="{{ asset('admlyt/imgs/gwlogo.png') }}"
                                style="width: 100px; height: 120px;" title="Koice" alt="Koice" />
    </div>
    <div class="col-sm-5 text-center text-sm-right">
      <h4 class="text-7 mb-0">Invoice</h4>
    </div>
  </div>
  <hr>
  <?php
    $todayDate =  date("d-m-Y");
  ?>
  </header>
  
  <!-- Main Content -->
  <main>
  <div class="row">
    <div class="col-sm-6"><strong>Date:</strong> {{$todayDate}}</div>
    <div class="col-sm-6 text-sm-right"> <strong>Invoice No:</strong> #{{$newInvoiceId}}</div>
	  
  </div>
  <hr>
  <div class="row">
    <div class="col-sm-6 text-sm-right order-sm-1"> <strong>Pay To:</strong>
      <address>
      <strong>Gold Works</strong><br />
      1 Cromwell Ct, Ealing Rd, Alperton<br />
      Wembley HA0 1JU<br />
      Gwtradediy@gmail.com
      </address>
    </div>
    <div class="col-sm-6 order-sm-0"> <strong>Invoiced To:</strong>
      <address>
      <strong>{{$allworkOrders->customerName}}<br /></strong>
      {{$allworkOrders->customerEmail}}<br />
      {{$allworkOrders->customerTelephone}}<br />
      {{$allworkOrders->customerAdress}}<br />
      United Kingdom
      </address>
    </div>
  </div> 
  <hr> 

  <div class="row">
      <div class="col-sm-4 mb-3 mb-sm-0"> <span class="text-black-50 text-uppercase">Maachine Model</span><br>
        <span class="font-weight-500 text-3">{{$machine_name}}</span> </div>
      <div class="col-sm-4 mb-3 mb-sm-0"> <span class="text-black-50 text-uppercase">Date Entry:</span><br>
        <span class="font-weight-500 text-3">{{$allworkOrders->created_at}}</span> </div>
      <div class="col-sm-4"> <span class="text-black-50 text-uppercase">Date Exit</span><br>
        <span class="font-weight-500 text-3">{{$invoicecreatedate}}</span> </div>
    </div>
  <hr>
  
   <h5>Customer Report <small> ({{$entry_machine_date}})</small></h5><br>
    <div class="row">
      <div class="col-md-12">
      <p class="mb-1">{{$customer_report}}</p>
      </div>
      </div>
      <hr>
   <h5>First Observations <small> ({{$entry_machine_date}})</small></h5><br>
    <div class="row">
      <div class="col-md-12">
      <p class="mb-1">{{$first_observations}}</p>
      </div>
      </div>
      <hr>
   <h5>Last Observation  <small> ({{$allworkOrders->created_at}})</small></h5><br>
    <div class="row">
      <div class="col-md-12">
      <p class="mb-1">{{$last_observations}}</p>
      </div>
      </div>
  <hr> 

  
  <div class="row p-3">
        <div class="col-md-12">
        <strong><p class="font-weight-bold mb-4">Products Used</p></strong>
            <table class="table">
                <thead>
                    <tr>
                        <th class="border-0 text-uppercase small font-weight-bold">ID</th>
                        <th class="border-0 text-uppercase small font-weight-bold">SKU</th>
                        <th class="border-0 text-uppercase small font-weight-bold">Item</th>
                        <th class="border-0 text-uppercase small font-weight-bold">Quantity</th>
                        <th class="border-0 text-uppercase small font-weight-bold">Unit Cost</th>
                        <th class="border-0 text-uppercase small font-weight-bold">Total</th>
                    </tr>
                </thead>
      @foreach($ProductsInfo2 as $prod)
                <tbody>
                    <tr>
                        <td>{{$prod->product_id}}</td>
                        <td>{{$prod->productSku}}</td>
                        <td>{{$prod->productName}}</td>
                        <td>{{$prod->pmqProductQuantity}}</td>
                        <td>£{{$prod->productSellPrice}}</td>
                        <td>£{{$prod->pmqProductQuantity * $prod->productSellPrice }}</td>
                    </tr>
                </tbody>
        @endforeach
            </table>
            <div class="row">
            <div class="col-md-6">
              <!-- <p class="font-weight-bold">Payment method: <strong>{{$quotepreviewinvoice->typeofpayment}}</strong></p> -->
            </div>
            
            <div class="col-md-6">
              <p class="font-weight-bold">Products Amount (incl VAT):  <strong> £{{$amountProducts}}</strong></p>
            </div>
            
            </div>
        </div>
    </div>
    <div class="card-body px-2">
      <div class="table-responsive">
        <table class="table">
          <tbody>
            <tr>
              <td colspan="4" class="bg-light-2 text-right"><strong>Sub Total:</strong></td>
              <td class="bg-light-2 text-right">£{{$quotepreviewinvoice->amount}}</td>
            </tr>
            <tr>
              <td colspan="4" class="bg-light-2 text-right"><strong>Vat:</strong></td>
              <td class="bg-light-2 text-right">£{{$quotepreviewinvoice->vat}}</td>
            </tr>
            <tr>
            <tr>
              <td colspan="4" class="bg-light-2 text-right"><strong>Discount:</strong></td>
              <td class="bg-light-2 text-right">£{{$quotepreviewinvoice->discount}}</td>
            </tr>
            <tr>
            <tr>
              <td colspan="4" class="bg-light-2 text-right"><strong>Work Labor:</strong></td>
              <td class="bg-light-2 text-right">£{{$quotepreviewinvoice->worklabor}}</td>
            </tr>
            <tr>
              <td colspan="4" class="bg-light-2 text-right"><strong>Total:</strong></td>
              <td class="bg-light-2 text-right">£{{$quotepreviewinvoice->totalWithVAT}}</td>
          </tbody>
        </table>
      </div>
    
      <div class="btn-group btn-group-sm d-print-none"> <a href="javascript:window.print()" class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-print"></i> Print</a>
      <a href="/section/quote" class="btn btn-warning border text-black-50 shadow-none" style="color:white;"><i class="fa fa-back"></i> Back</a>
      <a href="/section/quote/deleteinvoice/{{$newInvoiceId}}/{{$thisQuoteId}}" class="btn btn-danger border text-black-50 shadow-none"><i class="fa fa-back"></i> Delete</a>
      <a href="/section/workOrder" style="color:white;" class="btn btn-success border text-black-50 shadow-none"><i class="fa fa-back"></i> Approve Quotation</a>
       </div>
        
  </div>
</div>
</main>

  <!-- Footer -->
  <footer class="text-center mt-4">
  <!-- <p class="text-1"><strong>NOTE :</strong> This is computer generated receipt and does not require physical signature.</p> -->
  </footer>
</div>
</body>
</html>