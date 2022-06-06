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

  <style>
  #titleLetter{
      color:#050d80;
  }
  #paragsStyle{
      color:black;
      font-size:17px;
  }
  #BlackTypeStyle{
      color:black;
      font-size:22px;
  }

  </style>
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

      $from = 'viewPage';

    ?>

     <!-- Begin Page Content -->
     <div class="container-fluid">

         <!-- Page Heading -->
         <div class="d-sm-flex align-items-center justify-content-between">
           <h3 class="h3 mb-0 text-black-800" style="color:black;"><strong><b>{{$thisCustomer->name}}'s</b> Page</strong></h3>
           <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
           <ul class="nav justify-content-center">
              <li class="nav-item">
                <a  class="btn btn-block btn-info btn-group nav-link" href="/section/customers/edit/{{$thisCustomer->id}}/{{$from}}"><b>Edit Profile </b></a>
              </li>
              <li class="nav-item">
                <a  class="btn btn-block btn-primary btn-group nav-link" href="/section/customers/"> All Customer's</a>
              </li>
           </ul>
         </div>
   <br>

   <!-- Begin Page Content -->
   <div class="container-fluid">
     <!-- Begin Page Content -->

     @if(isset($thisCustomer) )
      <!-- Heading Row -->
            <div class="row align-items-center my-3" style="text-align:center;">
              <div class="col-lg-6">
                          <img class="img-fluid"  src="/storage/{{$thisCustomer->image}}"
                          style="width: 150; height: 200px;">
              </div>
              <!-- /.col-lg-8 -->
              <div class="col-lg-3">
                  <h4 style="color:black;" ><small><b>This Customer Data:</b></small></h4>
                  <h4 style="color:black;" >Name:  <small>{{$thisCustomer->name}}</small></h4>
                  <h4 style="color:black;">Contact Number: <small>{{$thisCustomer->telephone}}</small> </h4>
                  <h4 style="color:black;">Email:  <small>{{$thisCustomer->email}}</small></h4>
                  <h4 style="color:black;">Address:  <small>{{$thisCustomer->address}}</small></h4>  
                  <a href="/section/customers/edit/{{$thisCustomer->id}}/{{$from}}"><i class="fas fa-edit"></i><b> Edit Profile </b></a>
                  <a href="/section/customers/destroy/{{$thisCustomer->id}}" onclick="return confirm('Are you sure that you want delete this Customer?');" style="color:#eb2a1c; text-color:white;">
                  <i class="fas fa-trash"></i><b> Remove Profile</b></a>
              </div>
              <!-- /.col-md-4 -->
            </div>
       <!-- /.row -->
      @endif



<!-- Begin Page Content -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">ALL MACHINES FROM {{$thisCustomer->name}}
      @foreach($allworkOrders as $wk)
        @if($wk->status == 2)
            <div class="alert alert-warning">
                These Follow Machines are waiting for a <b>COLLECTION IN STORE</b>. When the cliente comes, please go to More Options page and conclude the order to get the payment.
                  <ul>
                    <li><a href="/section/machines/viewPage/{{$wk->machineId}}">{{$wk->machineModel}}</a></li>
                  </ul>
            </div>
        @endif
      @endforeach

     <a  class="m-0 font-weight-bold text-success"href="/section/customers/createmachineonviewpage/{{$thisCustomer->id}}">ADD NEW MACHINE</a></h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
          <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->

            <th class="mb-0 text-black-800" style="color:black;">Status</th>
            <th class="mb-0 text-black-800" style="color:black;">Id</th>
            <th class="mb-0 text-black-800" style="color:black;">Serial Number</th>
            <th class="mb-0 text-black-800" style="color:black;">Model</th>
            <th class="mb-0 text-black-800" style="color:black;">Brand</th>
            <th class="mb-0 text-black-800" style="color:black;">Created At</th>
           <th scope="col">Actions</th>

          </tr>
        </thead>
@if(count($allmachineswithowner) > 0)
        <tbody>
      @foreach($allmachineswithowner as $machine)
        @foreach($allworkOrders as $wk)
         @if($wk->status == 2)

          <tr>
          <?php


          $max = 26;
          $str = " $machine->id";
          $machineId=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

          $max = 26;
          $str = " $machine->customerName";
          $owner=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


          $max = 26;
          $str = " $machine->brand";
          $brand=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

          $max = 26;
          $str = " $machine->serial_number";
          $serial_number=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

          $max = 26;
          $str = " $machine->model";
          $model=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

          $start = date('d-m-Y', strtotime($machine->created_at))

      
          ?>

          <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->

          <td><b>{{$wk->status}}</b></td>
          <td>{{$machineId}}</td>
          <td>{{$serial_number}}</td>
          <td>{{$owner}}</td>
          <td>{{$model}}</td>
          <td>{{$brand}}</td>
          <td>{{$start}}</td>

          <td>
              <a href="/section/machines/edit/{{$machine->id}}" class="btn btn-primary btn-group">Edit</a>
              <a href="/section/machines/destroy/{{$machine->id}}"  class="btn btn-danger btn-group"
              onclick="return confirm('Are you sure that you want delete this Machine?');">
                  Remove</a>
              <a href="/section/machines/viewPage/{{$machine->id}}" class="btn btn-success btn-group">View Page</a>
          </td>
          </tr>
        @endif
        @endforeach
      @endforeach
    </tbody>
@endif 

@if(count($allmachineswithowner) <= 0)
    <div class="alert alert-danger">
        <h5>{{$thisCustomer->name}} has no machines created his name</h5>
    </div>
@endif
      </table>
    </div>
  </div>
</div>



            <!-- DataTales Example -->
            <div class="card shadow mb-4">
            <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">PAYMENTS ALREADY DONE</h6>
            <p class="mb-4">HERE YOU SEE ALL WORK ORDERS FROM THIS MACHINE IN  ON YOUR DATABASE. IF YOU PREFERE YOU CAN </a><a href="/section/machines/create">CREATE NEW ONE</a></p>

            </div>
            <div class="card-body">
              <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <!-- 'name', 'customer_report', 'first_observations', 'previous_observations', 'customer', 'vehicle', 'status', 'typeofpayment' -->

                      <th class="mb-0 text-black-800" style="color:black;" >Type of Payment</th>
                      <th class="mb-0 text-black-800" style="color:black;" >Discount</th>
                      <th class="mb-0 text-black-800" style="color:black;" >Total</th>
                      <th class="mb-0 text-black-800" style="color:black;" >Vat</th>
                      <th class="mb-0 text-black-800" style="color:black;" >Status</th>
                      <th class="mb-0 text-black-800" style="color:black;" >Created At</th>
                     <th  class="mb-0 text-black-800" style="color:black;" scope="col">Actions</th>

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

                        $start2 = date('d-m-Y', strtotime($workorder_payments->created_at));

                        $discount = number_format($workorder_payments->discount, 2, '.',',');
                        $totalWithVAT = number_format($workorder_payments->totalWithVAT, 2, '.',',');
                        $vat = number_format($workorder_payments->vat, 2, '.',',');

                    ?>

                    <!-- 'name', 'customer_report', 'first_observations', 'previous_observations', 'customer', 'vehicle', 'status', 'typeofpayment' -->


                    <td>{{$workorder_payments->typeofpayment}}</td>
                    <td>{{$discount}}</td>
                    <td>{{$totalWithVAT}}</td>
                    <td>{{$vat}}</td>
                    <td style="color:red;">CLOSE</td>
                    <td>{{$start2}}</td>
                    
                    
                    <td>
                        <a href="/section/machines/viewpage/viewinvoice/{{$workorder_payments->workOrderReference}}" class="btn btn-info btn-group">View Invoice</a>
                        <a href="/section/py/destroy/{{$workorder_payments->id}}" class="btn btn-danger btn-group">Delete</a>
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
