<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Diroxa Software - Balance PAGE</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="{{ asset('admlyt/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <script type="text/javascript" src="{{ asset('jquery/multiselect/jquery-3.5.1.min.js') }}"></script> 
        <script type="text/javascript" src="{{ asset('jquery/multiselect/chosen.jquery.min.js') }}"></script> 

  <!-- Custom styles for this template-->
  <link href="{{ asset('admlyt/css/sb-admin-2.min.css') }}" rel="stylesheet">
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:black;"><b>Balance</b></h3></div>
                                    <div class="card-body">
                                        <form>
                                            <div class="form-group">
                                                <label class="big mb-1" for="inputEmailAddress"><h3 style="color:black;text-align:center;"><b style="color:black;text-align:center;">AMOUNT TO RECEIVE: </b></h3></label>
                                                   <h1 style="color:black;text-align:center;">
                                                   £
                                                    <span style="color:black;text-align:center;!important"><b  name="amountPrice" id="amountPrice">{{$sales_price}}</b></span>
                                                   </h1>
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <label class="big mb-1" style="color:black;text-align:center;"><b style="color:black;text-align:center!important;">TOTAL RECEIVED</b></label>
                                                <input class="form-control py-4" id="totalReceived" name="totalReceived" type="text" onchange="myFunction()" placeholder="Enter the amount received" />
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <label class="big mb-1" for="inputEmailAddress"><h3 style="color:black;"><b>CLIENT CHANGE </b></h3></label>
                                                
                                                  <h1 style="color:black;text-align:center;">£    
                                                    <b  id="moneyToReceive" name="moneyToReceive">0.00</b></h1> 
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                @if($from == "extrasales")
                                                <a class="btn btn-danger" href="/">Home Page</a>
                                                @else
                                                <a class="btn btn-danger" href="/">Home Page</a>
                                                <a class="btn btn-primary" href="/section/carrito/invoice/{{$salesId}}" style="color:white;" >Check Invoice</a>
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
               
            </div>
        </div>
 
 <script>
   $("#totalReceived").on("change",function(){
    $(this).val(parseFloat($(this).val()).toFixed(2));
  });

  
  var amountPrice = document.getElementById("amountPrice").innerHTML; 

 </script>


 <script>
  function myFunction(){
      var amountPrice = document.getElementById("amountPrice").innerHTML;
      var totalReceived = document.getElementById("totalReceived").value;
      var moneyToReceive = document.getElementById("moneyToReceive").innerHTML;

      var totalToBePaid = ( totalReceived - amountPrice).toFixed(2);


      var moneyToReceive = document.getElementById("moneyToReceive").innerHTML = 0;
      var moneyToReceive = document.getElementById("moneyToReceive").innerHTML = totalToBePaid;
 }
 </script>

  <!-- Bootstrap core JavaScript-->
  <link href="{{ asset('admlyt/vendor/jquery/jquery.min.js') }}" rel="stylesheet">
  <link href="{{ asset('admlyt/vendor/bootstrap/js/bootstrap.bundle.min.js') }}" rel="stylesheet">

  <!-- Core plugin JavaScript-->
  <link href="{{ asset('admlyt/vendor/jquery-easing/jquery.easing.min.js') }}" rel="stylesheet">

  <!-- Custom scripts for all pages-->
  <link href="{{ asset('admlyt/js/sb-admin-2.min.js') }}" rel="stylesheet">
    </body>
</html>
