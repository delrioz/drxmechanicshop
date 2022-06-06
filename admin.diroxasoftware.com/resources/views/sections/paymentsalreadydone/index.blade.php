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
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,950,950i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{ asset('admlyt/css/sb-admin-2.min.css') }}" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="{{ asset('admlyt/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

</head>

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

          <!-- Page Heading -->
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h4 style="color:black;"><b>All Work Order's payments made.</b></h4>
              <a href="/section/buysection/index" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                      class="fas fa-shopping-cart fa-sm text-white-50"></i> <b>GO TO THE CART</b></a>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">

            </div>
            <div class="card-body">
              <div class="table-responsive">
              <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
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
