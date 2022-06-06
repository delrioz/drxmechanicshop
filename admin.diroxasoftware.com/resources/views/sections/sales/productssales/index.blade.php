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


        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-2 text-black-800" style="color:black;" ><strong>SALES</strong></h1>
              <a href="/section/buysection/index" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                      class="fas fa-shopping-cart fa-sm text-white-50"></i> <b>GO TO THE CART</b></a>
          </div>

          <?php
            $hoje = date('d/m/Y');
          ?>
          
          
    
          <div class="form-group">
            <form action="{{route('salesallsales.searchajax')}}" method="POST" name="formSearch">
            @csrf
                <label for="start" style="color:black!important;">Start date:</label>
                    <input type="date" id="start" name="dataComecoPadraoDateTime"
                    value="{{$hoje}}"
                    min="{{$hoje}}" max="{{$hoje}}">

                  <label for="start" style="color:black!important;">Final date:</label>
                    <input type="date" id="end" name="dataFimPadraoDateTime"
                    value="{{$hoje}}"
                    min="{{$hoje}}" max="{{$hoje}}">
                  <!-- <input type="submit" value="search"> -->
                  <button type="submit" class="btn btn-info" id="ajaxSubmit" value="Search">Search</button>
            </form>
            <br>
          </div>
    
          <?php
              $start = date('d/m/Y', strtotime($start));
              $end = date('d/m/Y', strtotime($end));
          ?>

          @if(session('error'))
              <div class="alert alert-danger">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                  </button>
              </div>
          @endif
          
          @if($thisCustomerStatus == 0)
                @if($searchDataRange == true)
                  <div class="alert alert-warning">
                      Searching all sales between {{$start}} and {{$end}}
                  </div>
                @else
                  <div class="alert alert-warning">
                      Showing all sales. You can either check <a href="/section/reports/SalesReports">sales reports</a>
                  </div> 
                @endif 
            @endif 

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              @if($thisCustomerStatus == 0)
                @if($Nwaitingpayments > 0)
                    <p class="m-0 font-weight-bold text-prima ry" style="color:blue;"><b><strong>ALL PRODUCT SALES ALREADY PAID</a></b></strong>
                    OR YOU CAN ALSO <a href="/section/sales/pendingSales" style="color:black;">Check the {{$Nwaitingpayments}} sales waiting for payments</a></p>
                @else
                    <p class="m-0 font-weight-bold text-prima ry" style="color:blue;"><b><strong>ALL PRODUCT SALES ALREADY PAID</a></b></strong>
                    OR YOU CAN ALSO <a href="/section/sales/pendingSales" style="color:black;">Check the sales waiting for payments</a></p>
                @endif
              @endif
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->

                      <th style="font-family:verdana; font-size:95%; color:#38393b;"><b>Id</b></th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;"><b>Description</b></th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;"><b>Sales Price (GBP)</b></th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;"><b>Payment Option</b></th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;"><b>Buyer</b></th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;"><b>Status</b></th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;"><b>Created At</b></th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;"><b>Actions</b></th>

                    </tr>
                  </thead>

                  <tbody>
                    @foreach($allsales as $sales)

                    <tr>
                    <?php

                      $max = 26;
                      $str = " $sales->customerName";
                      $owner=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                      $max = 26;
                      $str = " $sales->brand";
                      $brand=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                      $max = 26;
                      $str = " $sales->serial_number";
                      $serial_number=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                      $max = 26;
                      $str = " $sales->model";
                      $model=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                      $max = 26;
                      $str = " $sales->name";
                      $name=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                      $start = date('d/m/Y', strtotime($sales->created_at));

                      // $sales_price = number_format($sales->sales_price, 2, '.',',');
                      $sales_subtotal = number_format($sales->sales_subtotal, 2, '.',',');
                      $sales_discount = number_format($sales->sales_discount, 2, '.',',');
                      $sales_vat = number_format($sales->sales_vat, 2, '.',',');


                      $sales_price = number_format($sales->sales_price, 2, '.',',');
                      
                      $from = "allsalespage";

                      if($sales->status == 0){
                        $statusResult = "PAID";
                      }
                      else if($sales->status == 1){
                         $statusResult = "AWAITING PAYMENT";
                      }

                    ?>

                    <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->

                    <td style="font-family:verdana; color:black;"><b>{{$sales->id}}</b></b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$sales->description}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>£{{$sales_price}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$sales->paymentsOptions}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$name}}</b></td>
                    @if($sales->status == 0)
                      <td style="font-family:verdana; color:black;"><h5><span class="badge badge-success" style="font-family:verdana; color:white;"><b>{{$statusResult}}</b></span></h5></td>
                    @elseif($sales->status == 1)
                      <td style="font-family:verdana; color:black;"><h5><span class="badge badge-danger" style="font-family:verdana; color:white;"><b>{{$statusResult}}</b></span></h5></td>
                    @endif
                    <td style="font-family:verdana; color:black;"><b>{{$start}}</b></td>

                    <td>
                      @if($sales->paymentsOptions != "PAYING TODAY")
                        <a href="/section/sales/allsales/viewsales/{{$sales->id}}" class="btn btn-success btn-group" >View Page</a>
                      @endif

                        <a href="/section/sales/allsales/invoice/{{$sales->id}}/{{$from}}" style="background-color:#050d80" class="btn btn-block text-white btn-circle">
                            <i class="fas fa-eye"></i>
                        </a>

                        <a href="/section/sales/allsales/delete/{{$sales->id}}"  class="btn btn-danger btn-circle btn-group"
                        onclick="return confirm('Are you sure that you want delete this Sale?');">
                            <i class="fas fa-trash"></i>
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
