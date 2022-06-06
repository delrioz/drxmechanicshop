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

        <!-- Begin Page Content -->
        <div class="container-fluid">


        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">
            {{ session('error') }}
            </div>
            @endif
            <!-- Page Headi


          <!-- Page Heading -->

          @if(isset($getQuotesOwnerInfos))
            <h1 class="h3 mb-2 text-gray-800" style="color:black;"><small style="color:black;">
            <strong>ALL CLOSED QUOTES FROM <b>{{$getQuotesOwnerInfos->customerName}}</b></small></strong>
              <a class="btn btn-primary" href="/section/customers/viewPage/{{$getQuotesOwnerInfos->customerId}}"> View All Customer Motorcycles</a><br>
            </h1>

          @else
            <h1 class="h3 mb-2 text-black-800" style="color:black;"><strong>ALL CLOSED QUOTES </strong></h1>
          @endif


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <p class="mb-4 font-weight-bold" style="color:black;">HERE YOU SEE ALL  CLOSE QUOTES  ON YOUR DATABASE. IF YOU PREFERE YOU CAN </a><a href="/section/quote/create">MAKE A NEW ONE</a></p>
          <strong> <p class="mb-4 font-weight-bold" style="color:black;">PLEASE, NOTICE THAT HERE WILL SHOW ONLY THE OPPEN QUOTES AT MOMENT. TO SEE ALL QUOTES ALREADY DONE CLICK  </a><a href="/section/quotesAlreadyDone">HERE</a></p></strong>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <!-- 'name', 'customer_report', 'first_observations', 'previous_observations', 'customer', 'vehicle', 'status', 'typeofpayment' -->

                      <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Title</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Motorcycle</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;" hidden><b>Customer Report</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;" hidden><b>Last Observations</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Created At</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Status</b></th>
                     <th  style="font-family:verdana; font-size:100%; color:#38393b;" scope="col"><b>Actions</b></th>

                    </tr>
                  </thead>

                  <tbody>
                    @foreach($allQuotes as $quote)

                    <tr>
                    <?php

                        $max = 10;
                        $str = " $quote->title ";
                        $title=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                        $max = 13;
                        $str = " $quote->customer_report ";
                        $customer_report=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                        $max = 13;
                        $str = " $quote->first_observations ";
                        $first_observations=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                        $max = 13;
                        $str = " $quote->last_observations ";
                        $last_observations=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                        $max = 13;
                        $str = " $quote->customerName ";
                        $customer=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                        $max = 13;
                        $str = " $quote->machineModel ";
                        $machine=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                        $max = 13;
                        $str = " $quote->status ";
                        $status=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                        $max = 2;
                        $str = " $quote->typeofpayment ";
                        $typeofpayment=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                        $start = date('d/m/Y', strtotime($quote->created_at));



                        $WhichStatus  = " $quote->status ";
                        $ShowStatus = 0;
                        $color = "color:red";

                        if ($WhichStatus == 1)
                        {
                            $ShowStatus = "CLOSED";
                            $color = "color:red";
                        }
                        else
                        {
                            $ShowStatus = "OPEN";
                            $color = "color:green";
                        }


                    ?>

                    <!-- 'name', 'customer_report', 'first_observations', 'previous_observations', 'customer', 'vehicle', 'status', 'typeofpayment' -->


                    <td style="font-family:verdana; color:black;"><b>{{$title}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$machine}}</b></td>
                    <td style="font-family:verdana; color:black;" hidden><b>{{$customer_report}}</b></td>
                    <td style="font-family:verdana; color:black;" hidden><b>{{$last_observations}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$start}}</b></td>
                    <!-- <td style="{{$color}}"><strong>{{$ShowStatus}}</strong></td> -->
                    @if($ShowStatus == "CLOSED" )
                       <td><h5><span class="badge badge-danger"><b>{{$ShowStatus}}</b></span></h5></td>
                    @elseif($ShowStatus == "OPEN")
                       <td><h5><span class="badge badge-success"><b>{{$ShowStatus}}</b></span></h5></td>
                    @endif

                    <td>
                        <a href="/section/quotesAlreadyDone/viewpage/viewinvoice/{{$quote->id}}" class="btn btn-success btn-group"><b>View Preview Invoice</b></a>
                        <!-- <a href="/section/quotes/viewpage/viewinvoice/{{$quote->id}}" class="btn btn-primary btn-group">View</a> -->

                        <a href="/section/quote/destroy/{{$quote->id}}"  class="btn btn-danger btn-group"
                        onclick="return confirm('Are you sure that you want DELETE this Quote?');">
                               <b>Remove</b></a>
                    </td>
                    </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

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
