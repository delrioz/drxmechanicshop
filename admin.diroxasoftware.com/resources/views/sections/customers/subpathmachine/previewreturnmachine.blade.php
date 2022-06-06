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
      <img id="logo" src="{{ asset('admlyt/imgs/gwlogo.png') }}"
                                style="width: 100px; height: 120px;" title="Koice" alt="Koice" />
    </div>

    <div class="col-7 text-center text-sm-right">
      <h4 style="color:#0c4502; font-family: fantasy; font-size: 66px;!important">GOLDWORKS</h4>
    </div>

    <div class="col-sm-3 text-center text-sm-right">
      <h4 class="text-7 mb-0" style="color:black;">Note</h4>
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
      <div class="col-sm-6 order-sm-0" style="color:black;"> <strong>Invoiced To:</strong>
        <address style="color:black;">
        <strong>{{$allmachines->customerName}}<br /></strong>

        @if($allmachines->customerEmail == 'email@mail.com')
        @else
        {{$allmachines->customerEmail}}<br />
        @endif

        @if($allmachines->customerTelephone == '77777777777')
        @else
            {{$allmachines->customerTelephone}}<br />
        @endif

        @if($allmachines->customerAdress == 'Customer Address')
              United Kingdom
        @else
              {{$allmachines->customerAdress}}<br />
              United Kingdom
        @endif


        </address>
      </div>
    </div> 
    <hr> 

    <?php

    ?>

    <div class="row">
        <div class="col-sm-7 mb-3 mb-sm-0" style="color:black;"> <span class="text-black text-uppercase">Machine</span><br>
          <span class="font-weight-500 text-3" style="color:black;">{{$allmachines->model}}</span> </div>
        <div class="col-sm-5 mb-3 mb-sm-0" style="color:black;"> <span class="text-black text-uppercase">Brand:</span><br>
          <span class="font-weight-500 text-3" style="color:black;">{{$allmachines->brand}}</span> </div>
      </div>
    <hr>
    
    <?php
        $start = date('d/m/Y', strtotime($allmachines->created_at));
    ?>
    
    <div class="row">
    
        <div class="col-sm-7 mb-3 mb-sm-0" style="color:black;"> <span class="text-black text-uppercase">Date Entry:</span><br>
          <span class="font-weight-500 text-3" style="color:black;">{{$start}}</span> </div>
      </div>
    <hr>
  
   <h5 style="color:black;">Observations  <small></small></h5><br>
    <div class="row">
      <div class="col-md-12">
      <h4 style="color:red!important;">This is an agreement note</h4>
      <h6 style="color:black;!important"><b style="color:black;!important">
        <p>We will be now quoting your machine and you will soon be contacted to be informed of the charging amount.</p>

        <p>Once it’s approved by you, we’ll begin the service and you’ll be contacted again to collect your machine.</p>

        <p>Please note:
        You’ll have 7 days to collect it once it’s ready, if not, we’ll charge £10 a day to keep the machine safe in the shop.</p> 
        <p>If you decide not to fix your machine after it is quoted, you’ll only be charged £20 for the diagnosis.</p>
        <p>Once the quote is approved, you’ll only be charged for the service.</p>

        <p>Thank you for trusting our services.</p>
        Goldworks Team.
    </b></h6>   
      </div>
  <hr> 
    </div>
    <hr> 
    <div class="row">
        <div class="col-sm-6 mb-3 mb-sm-0" style="color:black;"> <span class="text-black text-uppercase">Customer name</span><br>
          <span class="font-weight-650 text-3" style="color:black;">_________________</span> </div>
        <div class="col-sm-6 mb-3 mb-sm-0" style="color:black;"> <span class="text-black text-uppercase">Customer signature</span><br>
          <span class="font-weight-650 text-3" style="color:black;">________________</span> </div>
    </div>
    <hr> 
        <div class="btn-group btn-group-sm d-print-none"> <a href="javascript:window.print()" class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-print"></i> Print</a>
        <a href="/section/machines/viewPage/{{$allmachines->id}}" class="btn btn-success border text-white-50 shadow-none" style="color:white!important;"><i class="fa fa-back"></i> Continue</a>
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

              // alert(typeofpayment);

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
                     _token: '{{csrf_token()}}'},

                  success: function(result){

                    alert('Invoice updated Successfully')
                   
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