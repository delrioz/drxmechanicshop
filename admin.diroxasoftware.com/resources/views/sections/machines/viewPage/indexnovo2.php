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

      <span>
            @include('sections.components.topnavbar')
      </span>


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


          @if(session('error'))
            <div class="alert alert-danger">
              {{ session('error') }}
            </div>
          @endif

          @if(session('NoProdsQuotes'))
            <div class="alert alert-warning">
              {{ session('NoProdsQuotes') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

  <?php
      $max = 85;
      $str = " $allmachines->model ";
      $model=  substr_replace($str, (strlen($str) > $max ? '' : ''), $max);

      $max2 = 85;
      $str = " $allmachines->serial_number ";
      $serial_number=  substr_replace($str, (strlen($str) > $max2 ? '' : ''), $max2);

      $from = 'MachineViewPage';
  ?>

        <!-- Page Content -->
  <div class="py-3 bg-light" style="background-color:#75aaff;!important">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
              <div class="card-body">
                <p><b>This machine data's</b></p>
                <h3 class="card-title" style="color:black;"><p>Model: <strong style="color:black;">{{$model}}</strong></p></h3>
                <h4 style="color:black;">Serial Number: <strong style="color:black;">{{$serial_number}}</strong></h4>
                <a href="/section/machines/edit/{{$machineId}}/{{$from}}" style="color:#1da100;"><i class="fas fa-edit"></i><b> Edit this Machine </b></a>
                <a href="/section/machines/destroy/{{$machineId}}" onclick="return confirm('Are you sure that you want delete this Customer?');" style="color:#d90226; text-color:white;">
                <i class="fas fa-trash" style="color:#f00014;"></i><b style="color:#f00014;"> Delete Machine</b></a>
                <!-- <p class="card-text">Owner: <strong style="color:#060b30;">{{$allmachines->nameOwner}}</strong></p> -->
              </div>
          </div>
        </div>
      </div>
    </div>

        <!-- <div class="card-header" style="background-color:#060b30; color:white;">
      Products in this Machine
      </div>
      <div class="card-body">
      @foreach($ProductsByMachines as $machines)
      <ul>
        <li><a href="/section/products/view/{{$machines->productId}}">{{$machines->productName}}</a></li>
      </ul>
      @endforeach
        <hr>
        <a href="/section/reports/machines" class="btn btn-success" style="background-color:#060b30;">Go To Reports Page</a>
      </div> -->
      <div class="container">

       <!-- DataTales Example -->
       <div class="card  mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 mb-2 font-weight-bold text-primary"><b>Quote</b></h6>
              <p class="mb-2 text-black-800" style="color:black;"><b>HERE YOU SEE ALL QUOTE ON YOUR DATABASE. IF YOU PREFERE YOU CAN </a><a href="/section/quote/create/{{$allmachines->id}}">MAKE A NEW ONE</a></b></p>
          <strong> <p class="mb-2 text-black-800" style="color:black;"><b>PLEASE, NOTICE THAT HERE WILL SHOW ONLY THE OPPEN QUOTES AT MOMENT. TO SEE ALL QUOTES ALREADY DONE CLICK  </a><a href="/section/quotesAlreadyDone">HERE</a></b></p></strong>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <!-- 'name', 'customer_report', 'first_observations', 'previous_observations', 'customer', 'vehicle', 'status', 'typeofpayment' -->

                      <th class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;" >Title</th>
                      <th class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;" >Customer</th>
                      <th class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;" >Machine</th>
                      <th class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;" >Customer Report</th>
                      <th class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;" >First Observations</th>
                      <th class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;" >Last Observations</th>
                      <th class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;" >Status</th>
                      <th class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;" >Created At</th>
                     <th  class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;" scope="col">Actions</th>

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
                        $str = " $quote->customerName";
                        $customer=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                        $max = 13;
                        $str = " $quote->machineModel";
                        $machine=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                        $max = 13;
                        $str = " $quote->status ";
                        $status=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);
                        
                        $TypeOfStatus = $quote->status;

                        if ($TypeOfStatus == 0)
                        {
                          $TypeOfStatus = "OPEN";
                        }
                        else 
                        {
                          $TypeOfStatus = "CLOSE";
                        }


                        $max = 2;
                        $str = " $quote->typeofpayment ";
                        $typeofpayment=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                        $start = date('d-m-Y', strtotime($quote->created_at));

                        $WhichStatus  = " $quote->status ";
                        $ShowStatus = 0;
                        $color = "color:red";

                        if ($WhichStatus == 0)
                        {
                            $ShowStatus = "OPEN";
                            $color = "color:green";
                        }
                        else if ($WhichStatus == 1)
                        {
                            $ShowStatus = "CLOSE";
                            $color = "color:red";
                        }
                        else if ($WhichStatus == 2)
                        {
                            $ShowStatus = "MACHINE READY FOR COLLECTION";
                            $color = "color:orange";
                        }


                    ?>

                    <!-- 'name', 'customer_report', 'first_observations', 'previous_observations', 'customer', 'vehicle', 'status', 'typeofpayment' -->


                      <td style="font-family:verdana; color:black;"><b>{{$title}}</b></td>
                      <td style="font-family:verdana; color:black;"><b>{{$customer}}</b></td>
                      <td style="font-family:verdana; color:black;"><b>{{$machine}}</b></td>
                      <td style="font-family:verdana; color:black;"><b>{{$customer_report}}</b></td>
                      <td style="font-family:verdana; color:black;"><b>{{$first_observations}}</b></td>
                      <td style="font-family:verdana; color:black;"><b>{{$last_observations}}</b></td>

                    <td>
                        @if($quote->status == 1 )
                          <h5><span class="badge badge-danger">{{$ShowStatus}}</span></h5>
                        @elseif($quote->status == 0)
                          <h5><span class="badge badge-success">{{$ShowStatus}}</span></h5>
                        @elseif($quote->status == 2)
                         <h5><span class="badge badge-warning">{{$ShowStatus}}</span></h5>
                        @endif
                    </td>


                    <td style="color:black;"><b>{{$start}}</b></td>
                    
                    <td>
                        <a href="/section/quote/edit/{{$quote->id}}" class="btn btn-primary btn-group">Edit</a>
                        <a href="/section/quote/destroy/{{$quote->id}}"  class="btn btn-danger btn-group"
                        onclick="return confirm('Are you sure that you want DELETE this Quote?');">
                                Remove</a>

                        <a href="/section/quote/previewInvoice/{{$quote->id}}/{{$from}}"  class="btn btn-success btn-group">
                                More Options</a>
                    </td>
                    </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><b>WORK ORDERS</b></h6>
              <p class="mb-2 text-black-800" style="color:black;"><b>HERE YOU SEE ALL WORK ORDER ACTIVE ON YOUR DATABASE. IF YOU PREFERE YOU CAN </a><a href="/section/workOrder/create/{{$allmachines->id}}">CREATE NEW ONE</a></b></p>
              <p class="mb-2 text-black-800" style="color:black;"><b>See</a><a href="/section/workOrder/allworkorder"> ALL WORK ORDERS</a></b></p>

            </div>
            <div class="card-body">
              <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <!-- 'name', 'customer_report', 'first_observations', 'previous_observations', 'customer', 'vehicle', 'status', 'typeofpayment' -->

                      <th class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;" >Title</th>
                      <th class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;" >Customer Report</th>
                      <th class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;" >First Observations</th>
                      <th class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;" >Customer</th>
                      <th class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;" >Machine</th>
                      <th class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;" >Status</th>
                      <th class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;" >Created At</th>
                      <th  class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;" scope="col">Actions</th>

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


                        $start = date('d-m-Y', strtotime($workOrder->created_at));

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
                            $ShowStatus = "CLOSE";
                            $color = "color:red";
                        }
                        else if ($WhichStatus == 2)
                        {
                            $ShowStatus = "READY FOR COLLECTION";
                            $color = "color:orange";
                        }


                    ?>

                    <!-- 'name', 'customer_report', 'first_observations', 'previous_observations', 'customer', 'vehicle', 'status', 'typeofpayment' -->


                    <td style="font-family:verdana; color:black;"><b>{{$title}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$customer_report}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$last_observations}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$customer}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$machine}}</b></td>
                    <td>
                        @if($workOrder->status == 1 )
                          <h5><span class="badge badge-danger"><b>{{$ShowStatus}}</b></span></h5>
                        @elseif($workOrder->status == 0)
                          <h5><span class="badge badge-success"><b>{{$ShowStatus}}</b></span></h5>
                        @elseif($workOrder->status == 2)
                         <h5><span class="badge badge-warning"><b>{{$ShowStatus}}</b></span></h5>
                        @endif
                    </td>
                    <td style="font-family:verdana; color:black;"><b>{{$start}}</b></td>
                    
                    <td>
                        <a href="/section/workOrder/edit/{{$workOrder->id}}" class="btn btn-primary btn-group">Edit</a>
                        <a href="/section/workOrder/destroy/{{$workOrder->id}}"  class="btn btn-danger btn-group"
                        onclick="return confirm('Are you sure that you want delete this Work Order?');">
                                Remove</a>
                        <a href="/section/py/processing/{{$workOrder->id}}/{{$from}}"  class="btn btn-success btn-group">
                        More Options</a>
                    </td>

                    
                    </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>


            <!-- DataTales Example -->
            <div class="card shadow mb-4">
            <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><b>PAYMENTS ALREADY DONE</b></h6>
            <p class="mb-2 text-black-800" style="color:black;"><b>HERE YOU SEE ALL WORK ORDERS PAYMENTS FOR THIS MACHINE</a></b></p>


            </div>
            <div class="card-body">
              <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <!-- 'name', 'customer_report', 'first_observations', 'previous_observations', 'customer', 'vehicle', 'status', 'typeofpayment' -->

                      <th style="font-family:verdana; font-size:100%; color:#38393b;" style="font-family:verdana; color:black;" >Type of Payment</th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;" style="font-family:verdana; color:black;" >Discount</th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;" style="font-family:verdana; color:black;" >Total</th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;" style="font-family:verdana; color:black;" >Vat</th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;" style="font-family:verdana; color:black;" >Status</th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;" style="font-family:verdana; color:black;" >Created At</th>
                     <th  style="font-family:verdana; font-size:100%; color:#38393b;" style="font-family:verdana; color:black;" scope="col">Actions</th>

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


                        $max = 2;
                        $str = " $workorder_payments->typeofpayment ";
                        $typeofpayment=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                        $start = date('d-m-Y', strtotime($workorder_payments->created_at));

                        $workOrderReference = number_format($workorder_payments->workOrderReference, 2, '.',',');
                        $discount = number_format($workorder_payments->discount, 2, '.',',');
                        $totalWithVAT = number_format($workorder_payments->totalWithVAT, 2, '.',',');
                        $vat = number_format($workorder_payments->vat, 2, '.',',');



                    ?>

                    <!-- 'name', 'customer_report', 'first_observations', 'previous_observations', 'customer', 'vehicle', 'status', 'typeofpayment' -->


                    <td style="font-family:verdana; color:black;"><b>{{$workOrderReference}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$discount}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$totalWithVAT}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$vat}}</b></td>
                    <td style="font-family:verdana; color:black;"style="color:red;"><b>CLOSE</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$start}}</b></td>
                    
                    
                    <td>
                        <a href="/section/machines/viewpage/viewinvoice/{{$workorder_payments->workOrderReference}}" class="btn btn-info btn-group"><b>View Invoice</b></a>
                        <a href="/section/py/destroy/{{$workorder_payments->id}}" 
                        onclick="return confirm('Are you sure that you want DELETE this Quote?');"
                        class="btn btn-danger btn-group"><b>Delete</b></a>
                        
                    </td>
                    </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          </div>

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Diroxa Software 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

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
