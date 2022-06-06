<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="images/favicon.png" rel="icon" />
<title>Diroxa Software</title>
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
                     style="width: 160px; height: 150px;" title="Koice" alt="Koice" />
            </div>

            <div class="col-5 text-center text-sm-right">
            </div>

            <div class="col-sm-3 text-center text-sm-right">
                <h4 class="text-5 mb-0" style="color:black;">Work Order</h4>
            </div>

        </div>
        <?php
        $todayDate =  date('d/m/Y');
        ?>
    </header>

  <!-- Main Content -->
  <main>


  <h1 style="text-align:center;">Job Sheet</h1><br>



  <div class="row">
    <div class="col-sm-6" style="color:black;"><strong>Date:</strong> {{$todayDate}}</div>
  </div>
  <hr>

  <div class="row">
        <div class="col-sm-7 mb-3 mb-sm-0" style="color:black;"> <span class="text-black text-uppercase">Mechanic(s) doing the Service</span><br>
          <span class="font-weight-500 text-3" style="color:black;"></span> </div>
        <div class="col-sm-5 mb-3 mb-sm-0" style="color:black;"> <span class="text-black text-uppercase">Signature</span><br>
         <span class="font-weight-500 text-3" style="color:black;"></span> </div>
  </div>
  <br>

  <hr>


  <div class="row">
        <div class="col-sm-7 mb-3 mb-sm-0" style="color:black;"> <span class="text-black text-uppercase">Customer Name</span><br>
          <span class="font-weight-500 text-3" style="color:black;">{{$allcustomers->name}}</span> </div>
        <div class="col-sm-5 mb-3 mb-sm-0" style="color:black;"> <span class="text-black text-uppercase">Customer Contact:</span><br>
         <span class="font-weight-500 text-3" style="color:black;">{{$allcustomers->telephone}}</span> </div>
  </div>

  <hr>

  <form action="/section/OpenWorkOrder/" method="POST" id="registro" name="registro" enctype="multipart/form-data">


    <?php
            $max2 = 80;
            $str = " $jobDescription";
            $observations=  substr_replace($str, (strlen($str) > $max2 ? '...' : ''), $max2);


            $max4 = 40;
            $str = " $allmachines->model ";
            $machine_model_model=  substr_replace($str, (strlen($str) > $max4 ? '...' : ''), $max4);

            $max4 = 30;
            $str = " $allmachines->brand ";
            $machine_model_brand=  substr_replace($str, (strlen($str) > $max4 ? '...' : ''), $max4);

            $start = date('d/m/Y', strtotime($allmachines->created_at));


    ?>

    <div class="row">
        <div class="col-sm-7 mb-3 mb-sm-0" style="color:black;"> <span class="text-black text-uppercase">Machine</span><br>
          <span class="font-weight-500 text-3" style="color:black;">{{$machine_model_model}}</span> </div>
        <div class="col-sm-5 mb-3 mb-sm-0" style="color:black;"> <span class="text-black text-uppercase">Brand:</span><br>
          <span class="font-weight-500 text-3" style="color:black;">{{$machine_model_brand}}</span> </div>
      </div>
    <hr>

    <div class="row">
        <div class="col-sm-7 mb-3 mb-sm-0" style="color:black;"> <span class="text-black text-uppercase">Date Machine Entry:</span><br>
          <span class="font-weight-500 text-3" style="color:black;">{{$start}}</span> </div>

    <hr><br>
    </div>
  <hr>
   <h5 style="color:black;">Observations  <small></small></h5><br>
    <div class="row">
      <div class="col-md-12">
      <p class="mb-1" style="color:black;" id="lastObservations" name="lastObservations">{{$observations}}</p>
      </div>
      </div>
  <hr>

    <div id="checkboxes">
      <label>Products Used</label>
      <ul>
      @foreach($ProductsInfo as $product)
        <li><input type="checkbox"> {{$product->productName}} | SKU: {{$product->productSku}}</li>
      @endforeach
      </ul>
    </div>


    <div class="row">
    <h5 style="color:black;">Observations / Extra Informations  <small></small></h5><br>
        <textarea name="" id="" cols="90" rows="10"></textarea>
    </div><br>


  <div class="btn-group btn-group-sm d-print-none">
        <a href="javascript:window.print()" class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-print"></i> Print</a>
        <a href="/section/workorder/jobCart/{{$wkId}}/workOrderIndex" class="btn btn-warning border text-black-50 shadow-none" style="color:white!important;"><i class="fa fa-back"></i> Back</a>
    </div>
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
              var lastObservations = $('.lastObservations').val();

              alert(lastObservations);

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
                      lastObservations : lastObservations,
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
