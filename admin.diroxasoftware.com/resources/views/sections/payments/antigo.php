<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>DIROXA SOFTWARE</title>

  <!-- Custom fonts for this template -->
  <link href="{{ asset('admlyt/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{ asset('admlyt/css/sb-admin-2.min.css') }}" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="{{ asset('admlyt/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">



</head>

<body id="page-top">

      <span>
            @include('sections.components.topnavbar')
      </span>

    <?php

    $amount = 10;
    $discount = 5;
    $vat = 0.2;

    $grandTotal  = ($amount - $discount) * $vat;
    


    ?>
      
        <!-- Begin Page Content -->
        <div class="container-fluid">

        
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row p-5">
                        <div class="col-md-6">
                            <img src="{{ asset('admlyt/imgs/gwlogo.png') }}">
                        </div>
                    <?php
                       $todayDate =  date("d-m-Y");
                    ?>
                        <div class="col-md-6 text-right">
                            <p class="font-weight-bold mb-1">Invoice #550</p>
                            <p class="text-muted">Due to: {{$todayDate}}</p>
                        </div>
                    </div>

                    <hr class="my-5">

                    <div class="row pb-5 p-5">
                        <div class="col-md-6">
                            <p class="font-weight-bold mb-4">Client Information</p>
                            <p class="mb-1">{{$allworkOrders->customerName}}</p>
                            <p class="mb-1">Address</p>
                            <p class="mb-1">6781 45P</p>
                        </div>

                        <div class="col-md-6 text-right">
                            <p class="font-weight-bold mb-4">Payment Details</p>
                            <p class="mb-1"><span class="text-muted">VAT: </span> 20 %</p>
                            <p class="mb-1"><span class="text-muted">Payment Type: </span> {{$typeofpayment}}</p>
                            <p class="mb-1"><span class="text-muted">Date: </span> {{$todayDate}}</p>
                        </div>
                    </div>

                    <div class="row pb-5 p-5">
                        <div class="col-md-12">
                            <p class="font-weight-bold mb-4">Customer Report</p>
                            <p class="mb-1">{{$customer_report}}</p>
                        </div>
                    </div>
                    <div class="row pb-5 p-5">
                        <div class="col-md-12">
                            <p class="font-weight-bold mb-4">First Observation</p>
                            <p class="mb-1">{{$first_observations}}</p>
                        </div>
                    </div>
                    <div class="row pb-5 p-5">
                        <div class="col-md-12">
                            <p class="font-weight-bold mb-4">Last Observation</p>
                            <p class="mb-1">{{$last_observations}}</p>
                        </div>
                    </div>

                    <div class="row p-5">
                     <h3><p class="font-weight-bold mb-4">Machine Model : <strong>{{$machine_name}}</strong></h3></p>
                        <div class="col-md-12">
                        <p class="font-weight-bold mb-4">Products Used</p>
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
                                        <td>{{$prod->id}}</td>
                                        <td>{{$prod->SKU}}</td>
                                        <td>{{$prod->name}}</td>
                                        <td>{{$prod->quantity}}</td>
                                        <td>£{{$prod->Sell_Price}}</td>
                                        <td>£{{$prod->quantity * $prod->Sell_Price }}</td>
                                    </tr>
                                </tbody>
                        @endforeach
                            </table>
                        </div>
                    </div>
            @foreach($showonoverviewworkorders as $overview)
                    <div class="d-flex flex-row-reverse bg-dark text-white p-4">
                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Grand Total</div>
                            <div class="h2 font-weight-light">£{{$overview->grandTotal}}</div>
                        </div>

                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">VAT</div>
                            <div class="h2 font-weight-light">£{{($overview->subtotalwithVAT - $overview->subtotalwithoutVAT)}}</div>
                        </div>

                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Discount</div>
                            <div class="h2 font-weight-light">£{{$overview->totalDiscount}}</div>
                        </div>

        
                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Sub - Total amount (incld VAT)</div>
                            <div class="h2 font-weight-light">£{{$overview->subtotalwithoutVAT}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="text-light mt-5 mb-5 text-center small">by : <a class="text-light" target="_blank" href="http://totoprayogo.com">totoprayogo.com</a></div>

</div>





  </div>
</body>
  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('admlyt/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('admlyt/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


  <!-- Core plugin JavaScript-->
  <script src="{{ asset('admlyt/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('admlyt/js/sb-admin-2.min.js') }}"></script>

  <!-- Page level plugins -->

  <script src="{{ asset('admlyt/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('admlyt/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>


  <!-- Page level custom scripts -->
  <script src="{{ asset('admlyt/js/demo/datatables-demo.js') }}"></script>

</body>

</html>
