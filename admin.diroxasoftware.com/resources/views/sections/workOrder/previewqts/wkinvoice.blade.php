<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="images/favicon.png" rel="icon" />
<title>Diroxa Software - WORK ORDER INVOICE</title>
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
<script type="text/javascript" src="{{ asset('jquery/multiselect/jquery-3.5.1.min.js') }}"></script>


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
    <!-- <div class="col-sm-6 text-sm-right"> <strong>Invoice No:</strong> #{{$newInvoiceId}}</div> -->

  </div>
  <hr>

  <form action="/section/OpenWorkOrder/" method="POST" id="registro" name="registro" enctype="multipart/form-data">
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
        <address style="color:black;">
        <strong>{{$allworkOrders->customerName}}<br /></strong>

        @if($allworkOrders->customerEmail == 'email@mail.com')
        @else
        {{$allworkOrders->customerEmail}}<br />
        @endif

        @if($allworkOrders->customerTelephone == '77777777777')
        @else
            {{$allworkOrders->customerTelephone}}<br />
        @endif

        @if($allworkOrders->customerAdress == 'Customer Address')
              United Kingdom
        @else
              {{$allworkOrders->customerAdress}}<br />
              United Kingdom
        @endif


        </address>
      </div>
    </div>
    <hr>

    <?php
            $max2 = 80;
            $str = " $last_observations ";
            $observations=  substr_replace($str, (strlen($str) > $max2 ? '...' : ''), $max2);


            $max4 = 40;
            $str = " $machine_model ";
            $machine_model_model=  substr_replace($str, (strlen($str) > $max4 ? '...' : ''), $max4);

            $max4 = 30;
            $str = " $machine_brand ";
            $machine_model_brand=  substr_replace($str, (strlen($str) > $max4 ? '...' : ''), $max4);

            // getting the datetime of   $entry_machine_date 
            $entry_machine_datetime =  date('H:i', strtotime($machine_info->created_at));

    ?>

    <div class="row">
        <div class="col-sm-4 mb-3 mb-sm-0" style="color:black;"> <span class="text-black text-uppercase">MOTORCYCLE</span><br>
          <span class="font-weight-500 text-3" style="color:black;">{{$machine_model_model}}</span> </div>
        <div class="col-sm-4 mb-3 mb-sm-0" style="color:black;"> <span class="text-black text-uppercase">Brand:</span><br>
          <span class="font-weight-500 text-3" style="color:black;">{{$machine_model_brand}}</span> </div>
        <div class="col-sm-4 mb-3 mb-sm-0" style="color:black;"> <span class="text-black text-uppercase">BIKE MILEAGE</span><br>
          <span class="font-weight-500 text-3" style="color:black;">{{$mileage}}</span> </div>
      </div>
    
    <hr>

    <div class="row">
        <div class="col-sm-7 mb-3 mb-sm-0" style="color:black;"> <span class="text-black text-uppercase">Date Entry:</span><br>
          <span class="font-weight-500 text-3" style="color:black;">{{$entry_machine_date}}</span>
          <small>(at {{$entry_machine_datetime}})</small>
        </div>
        <div class="col-sm-5" style="color:black;"> <span class="text-black text-uppercase">Date Exit</span><br>
          <span class="font-weight-500 text-3" style="color:black;">{{$invoicecreatedate}}</span> </div>
      </div>
    <hr>

   <h5 style="color:black;">Observations  <small></small></h5><br>
    <div class="row">
      <div class="col-md-12">
      <p class="mb-1" style="color:black;" id="lastObservations" name="lastObservations">{{$observations}}</p>
      </div>
      </div>
  <hr>


  <div class="row p-3">
        <div class="col-md-12">
        @if(!isset($onlyServiceMsg))
          <strong><p class="font-weight-bold mb-4" style="color:black;">Items Used</p></strong>
              <table class="table">
                  <thead>
                      <tr>
                          <th class="border-0 text-uppercase small font-weight-bold" style="color:black;">SKU</th>
                          <th class="border-0 text-uppercase small font-weight-bold" style="color:black;">Item</th>
                          <th class="border-0 text-uppercase small font-weight-bold" style="color:black;">Quantity</th>
                          <th class="border-0 text-uppercase small font-weight-bold" style="color:black;">Unit Cost</th>
                          <th class="border-0 text-uppercase small font-weight-bold" style="color:black;">Total</th>
                      </tr>
                  </thead>
        @elseif(isset($onlyServiceMsg))
          <div class="alert alert-warning">
            <p><b>This Work Order only have Service/Labour. No Products</b></p>
          </div>
        @endif
      @foreach($ProductsInfo as $prod)
              <?php
                    $tot = $prod->productQuantityPmw * $prod->productSellPrice;
                    $tot = number_format($tot, 2, '.',',');
                    $qtd = number_format($prod->productQuantityPmw, 2, '.',',');
                    $qtd = number_format($prod->productQuantityPmw, 2, '.',',');

                    $Sell_Price = number_format($prod->productSellPrice, 2, '.',',');

                    $max6 = 41;
                    $str = " $prod->productName ";
                    $productName=  substr_replace($str, (strlen($str) > $max6 ? '...' : ''), $max6);

              ?>
                <tbody>
                    <tr>
                        <td style="color:black;">{{$prod->productSku}}</td>
                        <td style="color:black;">{{$productName}}</td>
                        <td style="color:black;">{{$prod->productQuantityPmw}}</td>
                        <td style="color:black;">£{{$Sell_Price}}</td>
                        <td style="color:black;">£{{$tot}}</td>
                    </tr>
                </tbody>
        @endforeach
        @if($totalExtraItemsStatus != "empty")
      @foreach($allextraitems as $extraitems)
              <?php

                 $max = 40;
                 $str = " $extraitems->name ";
                 $extraItemName=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                 $ExtraItemsSalePrice = number_format($extraitems->Sell_Price, 2, '.',',');

              ?>
                <tbody>
                    <tr>
                        <td style="color:black;">SKU</td>
                        <td style="color:black;">{{$extraItemName}}</td>
                        <td style="color:black;">1</td>
                        <td style="color:black;">£{{$ExtraItemsSalePrice}}</td>
                        <td style="color:black;">£{{$ExtraItemsSalePrice}}</td>
                    </tr>
                </tbody>
        @endforeach
    @endif
            </table>

            <div class="row">
              <div class="col-md-6">
                <p class="font-weight-bold" style="color:black;">Payment method: <strong>{{$typeofpayment}}</strong></p>
                <input type="text" name="typeofpayment" id="typeofpayment" value="{{$typeofpayment}}" hidden>
                <input type="text" name="mileage" id="mileage" value="{{$mileage}}" hidden>
                <input type="text" name="lastObservationsinput" id="lastObservationsinput" value="{{$last_observations}}" hidden>

              </div>

              <div class="col-md-6">
              <p class="font-weight-bold" style="color:black;" id="worklabor" name="worklabor">Service/ Labour: <strong> £{{$worklabor}}</strong></p>
              <input type="text" name="worklaborValue" id="worklaborValue" value="{{$worklabor}}" hidden>
              <input type="text" name="workOrderReference" id="workOrderReference" value="{{$workOrderReference}}" hidden>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                    <tr>

                    </tr>
              </div>
            <div class="col-md-6">
            </div>
            </div>


        </div>
    </div>
    <div class="card-body px-2">
      <div class="table-responsive">
        <table class="table">
          <tbody>
            <tr>
              <td colspan="4" class="bg-light-2 text-right" style="color:black;"><strong>Sub Total:</strong></td>
              <td class="bg-light-2 text-right" style="color:black;">£{{$SubTotalFormated}}</td>
            </tr>
            <tr>
              <td colspan="4" class="bg-light-2 text-right" style="color:black;"><strong>Vat:</strong></td>
              <td class="bg-light-2 text-right" style="color:black;">£{{$vat}}</td>
              <small><b>Vat Number: 361286301  | Company No. 12902639 </b></small>
            </tr>
            <tr>
            @if($discount !=0)
            <tr>
              <td colspan="4" class="bg-light-2 text-right" style="color:black;"><strong>Discount:</strong></td>
              <td class="bg-light-2 text-right" style="color:black;">£{{$discount}}</td>
              <input type="text" name="discountValue" id="discountValue" value="{{$discount}}" hidden>
            </tr>
            @endif
            <tr>

            <tr>
              <td colspan="4" class="bg-light-2 text-right" style="color:black;"><strong>Total:</strong></td>
              <td class="bg-light-2 text-right" style="color:black;">£{{$totalWithVAT}}</td>
          </tbody>
        </table>
      </div>
            @csrf
            <div class="btn-group btn-group-sm d-print-none"> <a href="javascript:window.print()" class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-print"></i> Print</a>
            <a href="" id="updateInvoice" name="updateInvoice" class="btn btn-info border text-white-50 shadow-none" style="color:white!important;"><i class="fa fa-back"></i> Update Invoice</a>
            <a href="/section/py/processing/{{$workOrderReference}}" class="btn btn-warning border text-black-50 shadow-none" style="color:white!important;"><i class="fa fa-back"></i> Back</a>
            </div>
       </form>

  </div>
</div>
</main>

  <!-- Footer -->
  <footer class="text-center mt-4">
  <!-- <p class="text-1"><strong>NOTE :</strong> This is computer generated receipt and does not require physical signature.</p> -->
  </footer>
</div>


<script>
      $(document).ready(function(){
            // $('#ajaxSubmit').click(function(e){
              $(document).on("click", "#updateInvoice", function(e){
              var worklaborValue = $('#worklaborValue').val();
              var discountValue = $('#discountValue').val();
              var workOrderReference = $('#workOrderReference').val();
              var typeofpayment = $('#typeofpayment').val();
              var lastObservationsinput = $('#lastObservationsinput').val();
              var mileage = $('#mileage').val();

              // alert(lastObservationsinput);

               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               $.ajax({
                  url: "{{ url('/section/workorder/updateInvoiceAjax') }}",
                  method: 'post',
                  data: {
                      worklaborValue : worklaborValue,
                      discountValue : discountValue,
                      workOrderReference : workOrderReference,
                      typeofpayment : typeofpayment,
                      lastObservationsinput : lastObservationsinput,
                      mileage : mileage,
                     _token: '{{csrf_token()}}'},

                  success: function(result){

                    alert('Invoice updated Successfully');
                    // console.log(result);

                    window.location.href = "/section/py/processing/" + result + "/MachineViewPage";

                  },
                  error: function(jqXHR, textStatus, errorThrown, result) {
                      // console.log(jqXHR.responseJSON.errors)
                      Alert('Something get wrong try again');
                      $msg = 'oi';
                      $resp = jqXHR.responseJSON.errors;
                      $('.prodstables').empty();
                      $('.invalidData').empty();
                      $.each($resp, function (key, value){
                      $(".invalidData").append(`
                          <div class="alert alert-danger">
                              <ul>
                                <li>`+ value +`</li>
                              </ul>
                          </div>
                    `);
                  });
                  }
                  });
               });
            });
</script>



</body>
</html>
