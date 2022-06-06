<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="images/favicon.png" rel="icon" />
<title>Diroxa Software - HIRE MACHINE INVOICE</title>
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
      <img id="logo" src="{{ asset('admlyt/imgs/gwlogo.png') }}"
                                style="width: 100px; height: 120px;" title="Koice" alt="Koice" />
    </div>

    <div class="col-7 text-center text-sm-right">
      <h4 style="color:#0c4502; font-family: fantasy; font-size: 66px;!important">GOLDWORKS</h4>
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
     <div class="col-sm-4" style="color:black;"><strong>Date:</strong> {{$todayDate}}</div>
    <div class="col-sm-8" style="color:black;"><h3 style="color:black;"><strong>Machine Hiring</strong></h3></div>
  </div>
  <hr>

  <form action="/section/OpenWorkOrder/" method="POST" id="registro" name="registro" enctype="multipart/form-data">
    <div class="row">
      <div class="col-sm-6 text-sm-right order-sm-1" style="color:black;"> <strong>Pay To:</strong>
      <address style="color:black;">
        <strong style="color:black;">GOLDWORKS</strong><br />
          1 Cromwell Ct, Ealing Rd, Alperton<br />
          Wembley HA0 1JU<br />
          goldworks.maintenance@gmail.com<br />
          07367 100022/ 020 3651 3090
        </address>
      </div>
      <div class="col-sm-6 order-sm-0" style="color:black;"> <strong>Quote To:</strong>
        <address style="color:black;">
        <strong style="color:black;">{{$findThisCustomer->name}}<br /></strong>

        @if($findThisCustomer->email == 'email@mail.com')
        @else
        {{$findThisCustomer->email}}<br />
        @endif

        @if($findThisCustomer->telephone == '77777777777')
        @else
            {{$findThisCustomer->telephone}}<br />
        @endif

        @if($findThisCustomer->address == 'Customer Address')
              United Kingdom
        @else
              {{$findThisCustomer->address}}<br />
              United Kingdom
        @endif


        </address>
      </div>
    </div>
    <hr>

    <?php
            $max2 = 80;
            $str = " $about ";
            $abouts=  substr_replace($str, (strlen($str) > $max2 ? '...' : ''), $max2);

            
            $max4 = 40;
            $str = " $findThisMMachine->model ";
            $machine_model_model=  substr_replace($str, (strlen($str) > $max4 ? '...' : ''), $max4);

            $max4 = 30;
            $str = " $findThisMMachine->brand ";
            $machine_model_brand=  substr_replace($str, (strlen($str) > $max4 ? '...' : ''), $max4);

            $MachineCreatedAt = date('d-m-Y', strtotime($findThisMMachine->created_at));

    ?>

    <div class="row">
        <div class="col-sm-7 mb-3 mb-sm-0" style="color:black;"> <span class="text-black text-uppercase">Machine</span><br>
          <span class="font-weight-500 text-3" style="color:black;">{{$machine_model_model}}</span> </div>
        <div class="col-sm-5 mb-3 mb-sm-0" style="color:black;"> <span class="text-black text-uppercase">Brand:</span><br>
          <span class="font-weight-500 text-3" style="color:black;">{{$machine_model_brand}}</span> </div>
      </div>
    <hr>

    
    <div class="row">
        <div class="col-sm-7 mb-3 mb-sm-0" style="color:black;"> <span class="text-black text-uppercase">Starting Date</span><br>
          <span class="font-weight-500 text-3" style="color:black;">{{$startHiringDate}}</span> </div>
        <div class="col-sm-5 mb-3 mb-sm-0" style="color:black;"> <span class="text-black text-uppercase">Finishing Date</span><br>
          <span class="font-weight-500 text-3" style="color:black;">{{$finishHiringDate}}</span> </div>
    </div>
    <hr>
    
    <div class="row">
        <div class="col-sm-7 mb-3 mb-sm-0" style="color:black;"> <span class="text-black text-uppercase">First Deposit payment</span><br>
          <span class="font-weight-500 text-3" style="color:black;">£{{$firstDepositPrice}}</span> </div>
        <div class="col-sm-5 mb-3 mb-sm-0" style="color:black;"> <span class="text-black text-uppercase">Due to be pay on return</span><br>
          <span class="font-weight-500 text-3" style="color:black;">£{{$payOnReturn}}</span> </div>
    </div>

    <hr>




  <div class="row p-3">
        <div class="col-md-12">
        @if(!isset($onlyServiceMsg))
          <!-- <strong><p class="font-weight-bold mb-4" style="color:black;">Products in this Machine</p></strong> -->
              <table class="table">
                  <thead>
                      <tr>
                          <!-- <th class="border-0 text-uppercase small font-weight-bold" style="color:black;">SKU</th> -->
                          <!-- <th class="border-0 text-uppercase small font-weight-bold" style="color:black;">Item</th> -->
                          <!-- <th class="border-0 text-uppercase small font-weight-bold" style="color:black;">Quantity</th>
                          <th class="border-0 text-uppercase small font-weight-bold" style="color:black;">Unit Cost</th>
                          <th class="border-0 text-uppercase small font-weight-bold" style="color:black;">Total</th> -->
                          <div class="alert alert-danger">
                            <p>CUSTOMER NOTICE:
                              If you wish to keep the machine longer than the original hire agreement, please contact us to check availability. 
                            </p>
                            <br>
                            <p>Upon return of the machine, it will be checked by our mechanic to ensure it’s fully working and nothing is broken.<br>
                              Your deposit will be fully refunded once the mechanic gives the approval, however, if there is any damage that needs fixing, your deposit will be held until the repair is completed where the cost will be deducted from the deposit.</p>
                          </div>
                      </tr>
                  </thead>
        @elseif(isset($onlyServiceMsg))
          <div class="alert alert-warning">
            <p><b>This Quote only have Service/Labour. No Products</b></p>
          </div>
        @endif
  @if(count($ProductsInfo) > 0)
      @foreach($ProductsInfo as $prod)
              <?php
                 $totalProdUsed = $prod->pmqProductQuantity * $prod->productSellPrice;
                 $totalProdUsed = number_format($totalProdUsed, 2, '.',',');
                 
                 
                 $max = 40;
                 $str = " $prod->productName ";
                 $productName=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

              ?>
                <tbody>
                    <tr>
                        <td style="color:black;">{{$productName}}</td>
                    </tr>
                </tbody>
        @endforeach
      @endif
            </table>

            <div class="row">
                <div class="col-sm-6 mb-3 mb-sm-0" style="color:black;"> <span class="text-black text-uppercase">Customer name</span><br>
                  <span class="font-weight-500 text-3" style="color:black;">_________________</span> </div>
                <div class="col-sm-6 mb-3 mb-sm-0" style="color:black;"> <span class="text-black text-uppercase">Customer signature</span><br>
                  <span class="font-weight-500 text-3" style="color:black;">________________</span> </div>
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
              <!-- <td colspan="4" class="bg-light-2 text-right" style="color:black;"><strong>Starting Date:</strong></td>
              <td class="bg-light-2 text-right" style="color:black;">{{$startHiringDate}}</td> -->
            </tr>
            <tr>
              <!-- <td colspan="4" class="bg-light-2 text-right" style="color:black;"><strong>Finishing Date:</strong></td>
              <td class="bg-light-2 text-right" style="color:black;">{{$finishHiringDate}}</td> -->
            </tr>
            <!-- <tr>
              <td colspan="4" class="bg-light-2 text-right" style="color:black;"><strong>Machine hire price per day:</strong></td>
              <td class="bg-light-2 text-right" style="color:black;">£{{$priceperday}}</td>
            </tr> -->
            <tr>
              <td colspan="4" class="bg-light-2 text-right" style="color:black;"><strong>Total Hiring Days:</strong></td>
              <td class="bg-light-2 text-right" style="color:black;">{{$totalDaysNumber}}</td>
            </tr>
            <tr>
              <td colspan="4" class="bg-light-2 text-right" style="color:black;"><strong>Vat(20%):</strong></td>
              <td class="bg-light-2 text-right" style="color:black;">{{$vatAmount}}</td>
            </tr>
            @if($discount > 0)
            <tr>
              <td colspan="4" class="bg-light-2 text-right" style="color:black;"><strong>Discount:</strong></td>
              <td class="bg-light-2 text-right" style="color:black;">£{{$discount}}</td>
            </tr>
            @endif
            <tr>
              <td colspan="4" class="bg-light-2 text-right" style="color:black;"><strong>Total:</strong></td>
              <td class="bg-light-2 text-right" style="color:black;">£{{$totalWithExtraCost}}</td>
            <tr>

      
          </tbody>
        </table>
      </div>
            @csrf
          
       </form>
      @if(isset($routebacktoviewpage))
        <div class="btn-group btn-group-sm d-print-none"> <a href="javascript:window.print()" class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-print"></i> Print</a>
              <a href="/section/allhiremachiness/viewPage/{{$allhiremachines->hiringMachineId}}/{{$findThisCustomer->id}}" class="btn btn-danger border text-black-50 shadow-none" style="color:white!important;"><i class="fa fa-back"></i> Back</a>
        </div>
      @else
        <div class="btn-group btn-group-sm d-print-none"> <a href="javascript:window.print()" class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-print"></i> Print</a>
               <a href="/section/customers/viewPage/{{$findThisCustomer->id}}" class="btn btn-danger border text-black-50 shadow-none" style="color:white!important;"><i class="fa fa-back"></i> Back</a>
        </div>
      @endif

  </div>
</div>
</main>

<script>
      $(document).ready(function(){
            // $('#ajaxSubmit').click(function(e){
              $(document).on("click", "#updateInvoice", function(e){
              var worklaborValue = $('#worklaborValue').val();
              var discountValue = $('#discountValue').val();
              var quoteReference = $('#quoteReference').val();

              //  alert(discountValue);
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               $.ajax({
                  url: "{{ url('/section/quote/updateInvoiceAjax') }}",
                  method: 'post',
                  data: {
                      worklaborValue : worklaborValue,
                      discountValue : discountValue,
                      quoteReference : quoteReference,
                     _token: '{{csrf_token()}}'},

                  success: function(result){

                    alert('Quote updated Successfully')
                    // console.log(result)
                    window.location.href = "/section/quote/previewInvoice/" + result + "/MachineViewPage";

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
  <!-- Footer -->
  <footer class="text-center mt-4">
  <!-- <p class="text-1"><strong>NOTE :</strong> This is computer generated receipt and does not require physical signature.</p> -->
  </footer>
</div>
</body>
</html>
