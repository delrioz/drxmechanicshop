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

    hr {
    background:none;
      clear:both;
      width:100%;
      height:1px;
      border:none;
    }

  </style>



</head>

     <span>
            @include('sections.components.topnavbar')
      </span>


      @if($thisCustomerStatus != 0)
        <?php $from = "customerindexMachine"; ?>
      @else
        <?php $from = "indexMachine"; ?>
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

              @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
              @endif

      @if($thisCustomerStatus != 0)
          <span>
                @include('sections.components.topnavbaroverviewcustomers')
          </span>
      @endif

        <!-- Begin Page Content -->
        <div class="container-fluid">
        @if($thisCustomerStatus != 0)
            <!-- Page Heading -->
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-black-800" style="color:black!important;"><strong> All {{$thisCustomer->name}}'s Motorcycles</strong></h1>
                <a href="/section/customers/createmachineonviewpage/{{$thisCustomer->id}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-plus fa-sm text-white-50"></i> <b>ADD MOTORCYCLES</b></a>
            </div>
            <!-- DataTales Example -->
            @else
              <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-black-800" style="color:black!important;"><strong> CUSTOMER'S Motorcycles</strong></h1>
                  <a href="/section/machines/nocustomers/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                          class="fas fa-plus fa-sm text-white-50"></i> <b>ADD VEHICLES</b></a>
              </div>
            @endif

            <a href="/section/customers/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-eye fa-sm text-white-50"></i> <b>See all Customers</b></a>

          <hr>

          <div class="card shadow mb-4">
         

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->
                        <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Serial Number</b></th>
                        <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Model</b></th>
                        <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Brand</b></th>
                        <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Owner</b></th>
                        <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Created At</b></th>
                        <th style="font-family:verdana; font-size:100%; color:#38393b;" scope="col"><b>Actions</b></th>
                    </tr>
                  </thead>

                  <tbody>
                    @foreach($allmachineswithowner as $machine)

                    <tr>
                    <?php

                    $machine-> serial_number == "standard" ? $machineSerialNumber =  'no serial number' : $machineSerialNumber = $machine->serial_number;
                    $machine-> model == "standard" ? $machineModel =  'no model' : $machineModel = $machine->model;
                    $machine-> brand == "standard" ? $machineBrand =  'no brand' : $machineBrand = $machine->brand;


                    $max = 15;
                    $str = " $machine->customerName";
                    $owner=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                    $max = 15;
                    $str = " $machineBrand";
                    $brand=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                    $max = 15;
                    $str = " $machineSerialNumber";
                    $serial_number=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                    $max = 15;
                    $str = " $machineModel";
                    $model=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                    $start = date('d/m/Y', strtotime($machine->created_at));
                    

                    ?>

                    <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->

                    <td style="font-family:verdana; color:black;"><b>{{$serial_number}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$model}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$brand}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$owner}}</b></td>
                    <td style="font-family:verdana; color:black;">
                        <b hidden>{{$machine->created_at}}</b>
                      <b>{{$start}}</b>
                    </td>

                    <td>
                        <a href="/section/machines/edit/{{$machine->id}}/{{$from}}" class="btn btn-primary btn-group">Edit</a>
                        <a href="/section/machines/destroy/{{$machine->id}}/{{$from}}"  class="btn btn-danger btn-group"
                        onclick="return confirm('Are you sure that you want delete this Motorcycle?');">
                            Remove</a>
                        <a href="/section/machines/viewPage/{{$machine->id}}" class="btn btn-success btn-group">View Page</a>

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
