<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="images/favicon.png" rel="icon" />
<title>Diroxa Software - SALES</title>
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
    <div class="col-sm-2 text-center text-sm-left mb-3 mb-sm-0">
      <img id="logo" src="{{ asset('admlyt/imgs/wwslogo.jpeg') }}"
                                style="width: 230px; height: 200px;" title="Koice" alt="Koice" />
    </div>

    <div class="col-5 text-center text-sm-right">
    </div>

    <div class="col-sm-3 text-center text-sm-right">
      <h4 class="text-7 mb-0" style="color:black;">Invoice</h4>
    </div>

  </div>
  <hr>
  <?php
    $todayDate =  date('d/m/Y');
  ?>
  </header>
  
  <!-- Main Content -->
  <main>
  <div class="row">
    <div class="col-sm-6" style="color:black;"><strong>Date:</strong> {{$todayDate}}</div>
    <div class="col-sm-6 text-sm-right" style="color:black;"> <strong>Invoice No:</strong>#{{$salesId}}</div>
	  
  </div>
  <hr>
  <div class="row">
    <div class="col-sm-6 text-sm-right order-sm-1" style="color:black;"> <strong>Pay To:</strong>
      <address style="color:black;">
            <strong style="color:black;">WWS</strong><br />
            Lockleaze Rd<br />
            Bristol BS7 9RU<br />
            wwsmotorcycle@gmail.com<br />
      </address>
    </div>
    <div class="col-sm-6 order-sm-0" style="color:black;"> <strong>Invoiced To:</strong>
    @if($salesInfos->chooseCustomer == 0 )
      <address style="color:black;">
      United Kingdom
      </address>
    @else
    <address style="color:black;">
    @if(isset($msgThisCustomer))
      @if($msgThisCustomer == "CustomerFounded")
                <strong>{{$thisCustomer->name}}<br /></strong>
                @if($thisCustomer->email == 'email@mail.com')
                    @else
                    {{$thisCustomer->email}}<br />
                    @endif

                    @if($thisCustomer->telephone == '77777777777')
                    @else
                        {{$thisCustomer->telephone}}<br />
                    @endif

                    @if($thisCustomer->address == 'Customer Address')
                          United Kingdom
                    @else
                          {{$thisCustomer->address}}<br />
                          United Kingdom
                    @endif
                </address>
                @endif
        @endif
    @endif  

    @if(isset($msgThisCustomer))
      @if($msgThisCustomer == "NotFound")
      <p>Deleted User</p>
      @endif
    @endif
    </div>
  </div> 
  <hr> 


  
@if($typesales == 0)
  <div class="row p-2">
        <div class="col-md-12">
        <strong><p class="font-weight-bold mb-4" style="color:black;">Products Selected</p></strong>
            <table class="table">
                <thead>
                    <tr>
                          <th class="border-0 text-uppercase small font-weight-bold" style="color:black;">SKU</th>
                          <th class="border-0 text-uppercase small font-weight-bold" style="color:black;">Item</th>
                          <!-- <th class="border-0 text-uppercase small font-weight-bold" style="color:black;">Condition</th> -->
                          <th class="border-0 text-uppercase small font-weight-bold" style="color:black;">Quantity</th>
                          <th class="border-0 text-uppercase small font-weight-bold" style="color:black;">SUB TOTAL<br>(excl VAT)</th>
                    </tr>
                </thead>
      @foreach($ProductsInfos2 as $product)
             <?php
                    $max = 36;
                    $str = " $product->name ";
                    $name=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);
                    $totalSalesWithoutVat = number_format($product->totalSalesWithoutVat, 2, '.',',');

                    $totalPaidSoFar = $salesInfos->sales_price;

                    $upfrontValue = number_format($salesInfos->upfrontValue, 2, '.',',');
                    $totalPaidSoFar = number_format($totalPaidSoFar, 2, '.',',');

                    if($salesInfos->paymentsOptions == "PAYING WEEKLY"){
                        $paymentTime ="weekly";
                    }
                    if($salesInfos->paymentsOptions == "PAYING MONTHLY"){
                        $paymentTime ="Monthly";
                    }
                    else {
                        $paymentTime ="Pay Today";
                    }

                    $created_at = date('d/m/Y', strtotime($salesInfos->created_at));

              ?>
                <tbody>
                    <tr>
                    <td style="color:black;">{{$product->SKU}}</td>
                    <td style="color:black;">{{$name}}</td>
                    <!-- <td style="color:black;">{{$product->condition }}</td> -->
                    <td style="color:black;">{{$product->quantity}}</td>
                    <td style="color:black;"></td>
                    <td style="color:black;">£{{$totalSalesWithoutVat}}</td>
                    </tr>
                </tbody>
        @endforeach
            </table>

            <p class="font-weight-bold mb-4" style="color:black;">Payment method: <strong>{{$methodPayment}}</strong></p>
            @if($NpaymentsLeft != 0)
              @if($paymentsOptions != "PAYING TODAY")
                @if($salesInfos->status != 0)
                  <div class="alert alert-info">
                  @if($paymentsOptions == "PAYING WEEKLY")
                    @if($salesInfos->upfrontValue !=0)
                          <p> This bill will be paid in {{$Npayments}} Weeks /£{{$firstAmountPaid}} every Week. <br>
                            The amount of £{{$upfrontValue}} was paid as Upfront on: {{$salesDate}}</p>
                      @else
                          <p> This bill will be paid in {{$Npayments}} Weeks /£{{$firstAmountPaid}} every Week.</p>
                      @endif
                  @elseif($paymentsOptions == "PAYING MONTHLY")
                    @if($salesInfos->upfrontValue !=0)
                        <p> This bill will be paid in {{$Npayments}} Months /£{{$firstAmountPaid}} every Month. <br>
                          The amount of £{{$upfrontValue}} was paid as Upfront on: {{$salesDate}}</p>
                    @else
                        <p> This bill will be paid in {{$Npayments}} Months /£{{$firstAmountPaid}} every Month.</p>
                    @endif
                  @endif
                      <div class="row">
                          <div class="col-md-5">
                            First Bill is due to {{$salesInfos->firstPaymentDate}}
                          </div>
                          <div class="col-md-7">
                            Last Bill will be charged on: {{$salesInfos->lastPaymentDate}}
                          </div>
                      </div>
                      @if(isset($payToday))
                        <div class="row">
                            <div class="col-md-5">
                              Paid today £{{$payToday}} on {{$created_at}}
                            </div>
                        </div>
                      @endif
                  </div>
                  @endif
                @endif
                @else
                
                @if($paymentsOptions != "PAYING TODAY")
                    <div class="alert alert-info">
                      @if($paymentsOptions == "PAYING WEEKLY")
                          @if($salesInfos->upfrontValue !=0)
                                <p> This bill was paid in {{$Npayments}} Weeks /£{{$firstAmountPaid}} every Week. <br>
                                  The amount of £{{$upfrontValue}} was paid as Upfront on: {{$salesDate}}</p>
                            @else
                                <p> This bill was paid in {{$Npayments}} Weeks /£{{$firstAmountPaid}} every Week.</p>
                            @endif
                        @elseif($paymentsOptions == "PAYING MONTHLY")
                          @if($salesInfos->upfrontValue !=0)
                              <p> This bill was paid in {{$Npayments}} Months /£{{$firstAmountPaid}} every Month. <br>
                                The amount of £{{$upfrontValue}} was paid as Upfront on: {{$salesDate}}</p>
                          @else
                              <p> This bill was paid in {{$Npayments}} Months /£{{$firstAmountPaid}} every Month.</p>
                          @endif
                        @endif

                        <div class="row">
                          <div class="col-md-5">
                            First Bill was  charged on: {{$salesInfos->firstPaymentDate}}
                          </div>
                        <div class="col-md-7">
                          Last Bill was  due to: {{$salesInfos->lastPaymentDate}}
                        </div>
                        </div>
                    </div>
                @endif
              @endif
        </div>
    </div>
@elseif($typesales == 1)
    <div class="row p-3">
            <div class="col-md-12">
            <!-- <strong><p class="font-weight-bold mb-4" style="color:black;">Products Selected</p></strong> -->
                <table class="table">
                    <thead>
                        <tr>
                              <th class="border-0 text-uppercase small font-weight-bold" style="color:black;">Description</th>
                              <th class="border-0 text-uppercase small font-weight-bold" style="color:black;">SUB TOTAL<br>(excl VAT)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                          <td style="color:black;">{{$description}}</td>
                          <td style="color:black;">{{$sales_subtotal}}</td>
                        </tr>
                    </tbody>
                </table>
                <p class="font-weight-bold mb-4" style="color:black;">Payment method: <strong>{{$methodPayment}}</strong></p>
            </div>
        </div>
        @endif

        <div class="card-body px-2">
        <div class="table-responsive">
          <table class="table">
            <tbody>
              <tr>
                <td colspan="4" class="bg-light-2 text-right" style="color:black;"><strong>Sub Total Amount (VAT excl):</strong></td>
                <td class="bg-light-2 text-right" style="color:black;">£{{$sales_subtotal}}</td>
              </tr>
              <tr>
                  <td colspan="4" class="bg-light-2 text-right" style="color:black;"><strong>Vat:</strong></td>
                  <td class="bg-light-2 text-right" style="color:black;">£{{$sales_vat}}</td>
                  @if($salesInfos->status == 1)
                  <div class="col-md-6">
                    <small>
                        <b style="color:red;">This bill still overdue.</b>
                        <b style="color:black:">Awaiting Payments: {{$NpaymentsLeft}}</b><br>
                        <b style="color:black:">Total Paid So far: £{{$totalPaidSoFar}} from £{{$totalToBePaid}}</b>
                    </small>
                  </div>
                  @else
                  <div class="col-md-6">
                    <small>
                        <b style="color:green;">This bill was totally paid.</b>
                    </small>
                  </div>
                  @endif
            
              </tr>
              <tr>
              @if($sales_discount != 0)
              <tr>
                <td colspan="4" class="bg-light-2 text-right" style="color:black;"><strong>Discount:</strong></td>
                <td class="bg-light-2 text-right" style="color:black;">£{{$sales_discount}}</td>
              </tr>
              @endif
              <tr>
                <td colspan="4" class="bg-light-2 text-right" style="color:black;"><strong>Total:</strong></td>
                <td class="bg-light-2 text-right" style="color:black;">£{{$totalToBePaid}}</td>
              </tr>
            </tbody>
          </table>
        </div>
      
        <div class="btn-group btn-group-sm d-print-none"> <a href="javascript:window.print()" class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-print"></i> Print</a>
          @if(isset($from))
              @if($from == "allsalespage")
                <a href="/section/sales/allsales/" class="btn btn-danger border text-white-50 shadow-none" style="color:white!important;"><i class="fa fa-back"></i>Back</a>
              @elseif($from == "viewsalespage")
                <a href="/section/sales/allsales/viewsales/{{$salesId}}" class="btn btn-danger border text-white-50 shadow-none" style="color:white!important;"><i class="fa fa-back"></i>Back</a>
              @endif
          @else
              <a href="/section/carrito/balance/{{$salesId}}" class="btn  btn-info border text-black-50 shadow-none" style="color:white!important;"><i class="fa fa-back"></i> Back to Balance</a>
              <a href="/" class="btn btn-danger border text-black-50 shadow-none" style="color:white!important;"><i class="fa fa-back"></i>Back</a>
          @endif
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