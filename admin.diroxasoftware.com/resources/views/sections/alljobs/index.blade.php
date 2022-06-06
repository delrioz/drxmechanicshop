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
          <!-- Begin Page Content -->

            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-black-800"><strong style="color:black;">MOTORCYCLES REPAIRS REPORT</strong><br></h1>
              <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
            </div>


            <div class="row">

                <?php
                    $totalwkvalue = 0;
                ?>
            
              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        <a style="color:blue">TOTAL WORK LABOUR AMOUNT </a>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><strong style="color:green;" id="totalwkvalue" >£{{$totalwkvalue}}</strong></div>
                        <b>total income from Labour/service</b>
                      </div>
                      <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              
              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        <a style="color:blue">TOTAL WORK LABOUR AMOUNT </a>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><strong style="color:green;" id="totalwkvalue" >£{{$totalwkvalue}}</strong></div>
                        <b>total income from Labour/service</b>
                      </div>
                      <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              
              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        <a style="color:blue">TOTAL WORK LABOUR AMOUNT </a>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><strong style="color:green;" id="totalwkvalue" >£{{$totalwkvalue}}</strong></div>
                        <b>total income from Labour/service</b>
                      </div>
                      <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>



         
  </div>
  <!-- /.container-fluid -->
  </div>
  <!-- End of Main Content -->



    <!-- Bootstrap core JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
    


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
