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

      @if($thisCustomerStatus != 0)
          <span>
                @include('sections.components.topnavbaroverviewcustomers')
          </span>
      @endif

   <!-- Begin Page Content -->
   <div class="container-fluid">
              @if(session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                  </button>
              </div>
          @endif
              @if(session('warning'))
              <div class="alert alert-warning">
                  {{ session('warning') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                  </button>
              </div>
          @endif

          <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-black-800" style="color:black;" ><strong>WORK ORDERS</strong></h1><br>

          <a href="/section/workOrder/create/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-plus fa-sm text-white-50"></i> <b>CREATE WORK ORDER</b></a>
          </div>


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <p class="mb-4 font-weight-bold"  style="color:black;"><b>HERE YOU SEE ALL WORK ORDER ACTIVE ON YOUR DATABASE.</b></p>
                <p>To see all closed Work Orders click <a href="/section/workOrder/allworkorder/">here</a></p>
            </div>

            



            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <!-- 'name', 'customer_report', 'first_observations', 'previous_observations', 'customer', 'vehicle', 'status', 'typeofpayment' -->

                      <th style="font-family:verdana; font-size:100%; color:#38393b;">Title</th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;"hidden >Customer Report</th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;"hidden >Last Observations</th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;">Customer</th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;">Motorcycle</th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;">Status</th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;">Created At</th>

                     <th style="font-family:verdana; font-size:100%; color:#38393b;" scope="col">Actions</th>

                    </tr>
                  </thead>

                  <tbody>
                    @foreach($allworkOrders as $workOrder)

                    <tr>
                    <?php

                        $max = 13;
                        $str = " $workOrder->title ";
                        $title=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                        $max = 13;
                        $str = " $workOrder->customer_report ";
                        $customer_report=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                        $max = 13;
                        $str = " $workOrder->first_observations ";
                        $first_observations=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                        $max = 13;
                        $str = " $workOrder->last_observations ";
                        $last_observations=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                        $max = 13;
                        $str = " $workOrder->customerName ";
                        $customer=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                        $max = 13;
                        $str = " $workOrder->machineModel ";
                        $machine=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                        $max = 13;
                        $str = " $workOrder->status ";
                        $status=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                        $max = 2;
                        $str = " $workOrder->typeofpayment ";
                        $typeofpayment=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                        $start = date('d/m/Y', strtotime($workOrder->created_at));

                        $WhichStatus  = " $workOrder->status ";
                        $ShowStatus = 0;
                        $color = "color:red";

                        if ($WhichStatus == 0)
                        {
                            $ShowStatus = "OPEN";
                            $color = "color:green";
                        }
                        else if ($WhichStatus == 1)
                        {
                            $ShowStatus = "CLOSED";
                            $color = "color:red";
                        }
                        else if ($WhichStatus == 2)
                        {
                            $ShowStatus = "READY FOR COLLECTION";
                            $color = "color:orange";
                        }



                    ?>

                      @if($thisCustomerStatus != 0)
                        <?php $from = "customerworkOrderIndex"; ?>
                      @else
                        <?php $from = "workOrderIndex"; ?>
                      @endif

                    <!-- 'name', 'customer_report', 'first_observations', 'previous_observations', 'customer', 'vehicle', 'status', 'typeofpayment' -->

                    <td style="font-family:verdana; color:black;"><b>{{$title}}</b></td>
                    <td style="font-family:verdana; color:black;" hidden><b>{{$customer_report}}</b></td>
                    <td style="font-family:verdana; color:black;" hidden><b>{{$last_observations}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$customer}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$machine}}</b></td>
                    <td>
                            @if($workOrder->status == 1 )
                                  <h5><span class="badge badge-danger" style="font-family:verdana; color:white;"><b>{{$ShowStatus}}</b></span></h5>
                                @elseif($workOrder->status == 0)
                                  <h5><span class="badge badge-success" style="font-family:verdana; color:white;"><b>{{$ShowStatus}}</b></span></h5>
                                @elseif($workOrder->status == 2)
                                <h5><span class="badge badge-warning" style="font-family:verdana; color:white;"><b>{{$ShowStatus}}</b></span></h5>
                            @endif
                    </td>
                    <td style="font-family:verdana; color:black;">
                     <b hidden>{{$workOrder->created_at}}</b>
                     <b>{{$start}}</b>
                    </td>

                    <td>
                        @if($workOrder->status != 1 )
                            <a href="/section/workOrder/edit/{{$workOrder->id}}/{{$from}}" class="btn btn-primary btn-group">Edit</a>
                        @endif
                            <a href="/section/workOrder/destroy/{{$workOrder->id}}"  class="btn btn-danger btn-group"
                            onclick="return confirm('Are you sure that you want delete this Vehicle?');">
                                    Remove</a>
                        @if($workOrder->status != 1 )
                            <a href="/section/py/processing/{{$workOrder->id}}"  class="btn btn-success btn-group">
                            More Options</a>
                        @endif

                        @if($workOrder->status == 1 )
                          <a href="/section/machines/viewpage/viewinvoice/{{$workOrder->id}}" class="btn btn-primary btn-group"><b>View Invoice</b></a>
                        @endif

                        @if($workOrder->status != 1 )
                          <a href="/section/workorder/jobCart/{{$workOrder->id}}/{{$from}}"  class="btn btn-success btn-group">
                            <b>Job Sheet</b></a>
                        @endif

                    </td>
                    </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          @if($WKpaymentsStatus == 1)
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
            <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><b>WORK ORDERS - PAYMENTS ALREADY DONE</b></h6>
            </div>


            
            <div class="card-body">
              <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <!-- 'name', 'customer_report', 'first_observations', 'previous_observations', 'customer', 'vehicle', 'status', 'typeofpayment' -->
                      <th style="font-family:verdana; font-size:100%; color:#38393b;">Model</th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;">Brand</th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;" >Type of Payment</th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;" >Total</th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;" >Vat</th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;" >Discount</th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;" >Status</th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;" >Created At</th>
                     <th  style="font-family:verdana; font-size:100%; color:#38393b;" scope="col">Actions</th>

                    </tr>
                  </thead>

                  <tbody>
                    @foreach($workorder_payments as $workorder_payments)

                    <tr>

                    <?php

                          $max = 13;
                          $str = " $workorder_payments->title ";
                          $title=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                          $max = 13;
                          $str = " $workorder_payments->customer_report ";
                          $customer_report=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                          $max = 13;
                          $str = " $workorder_payments->first_observations ";
                          $first_observations=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                          $max = 13;
                          $str = " $workorder_payments->last_observations ";
                          $last_observations=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                          $max = 13;
                          $str = " $workorder_payments->customerName ";
                          $customer=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                          $max = 13;
                          $str = " $workorder_payments->machineModel ";
                          $machine=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                          $max = 13;
                          $str = " $workorder_payments->status ";
                          $status=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                          $max = 13;
                          $str = "$workorder_payments->model ";
                          $model=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                          $max = 13;
                          $str = " $workorder_payments->brand ";
                          $brand=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                          $max = 2;
                          $str = " $workorder_payments->typeofpayment ";
                          $typeofpayment=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                          $start2 = date('d/m/Y', strtotime($workorder_payments->created_at));

                          $discount = number_format($workorder_payments->discount, 2, '.',',');
                          $totalWithVAT = number_format($workorder_payments->totalWithVAT, 2, '.',',');
                          $vat = number_format($workorder_payments->vat, 2, '.',',');

                    ?>

                      <!-- 'name', 'customer_report', 'first_observations', 'previous_observations', 'customer', 'vehicle', 'status', 'typeofpayment' -->


                      <td style="font-family:verdana; color:black;"><b>{{$model}}</b></td>
                      <td style="font-family:verdana; color:black;"><b>{{$brand}}</b></td>
                      <td style="font-family:verdana; color:black;"><b>{{$workorder_payments->typeofpayment}}</b></td>
                      <td style="font-family:verdana; color:black;"><b>£{{$totalWithVAT}}</b></td>
                      <td style="font-family:verdana; color:black;"><b>£{{$vat}}</b></td>
                      <td style="font-family:verdana; color:black;"><b>£{{$discount}}</b></td>
                      <td><h5><span class="badge badge-danger">CLOSED</span></h5></td>
                      <td style="font-family:verdana; color:black;"><b>{{$start2}}</b></td>


                    <td>
                        <a href="/section/machines/viewpage/viewinvoice/{{$workorder_payments->workOrderReference}}" class="btn btn-info btn-group">
                          <i class="fas fa-eye" ></i>
                        </a>
                        <a href="/section/py/destroy/{{$workorder_payments->id}}" onclick="return confirm('Are you sure that you want delete this payment?');" class="btn btn-danger btn-group">
                          <i class="fas fa-trash" ></i>
                        </a>
                    </td>
                    </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          </div>
          @endif
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
