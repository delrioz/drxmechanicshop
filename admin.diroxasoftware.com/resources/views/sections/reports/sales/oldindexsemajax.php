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
        
        @if (session('status'))
          <div class="alert alert-danger">
              {{ session('status') }}
          </div>
        @endif

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"> Reports Sales Dashboard</h1>            
            <div class="dropdown mb-4">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Data Range
                    </button>
                  
                    <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">

                    <form action="{{route('sales.reports.index')}}" method="GET"> 
                    @csrf
                      <button class="dropdown-item" name="QuicklyOption" value="sevenDays">General Overview</button>
                    </form>

                    <form action="{{route('sales.reports.searchIt')}}" method="POST"> 
                        @csrf
                      <button class="dropdown-item" name="QuicklyOption" value="sevenDays">Last week</button>
                    </form>

                    <form action="{{route('sales.reports.searchIt')}}" method="POST"> 
                        @csrf
                      <button class="dropdown-item" name="QuicklyOption" value="lastmonth">Last Month</button>
                    </form>
                    
                    <form action="{{route('sales.reports.searchIt')}}" method="POST"> 
                        @csrf
                      <button class="dropdown-item" name="QuicklyOption" value="lastday">Last Day</button>
                    </form>
                    

                    <form action="{{route('sales.reports.searchIt')}}" method="POST"> 
                        @csrf
                      <button class="dropdown-item" name="QuicklyOption" value="today">Today</button>
                    </form>
                    
                      <a class="dropdown-item" name="QuicklyOption" value="sevenDays">Another action</a>
                      <a class="dropdown-item" name="QuicklyOption" value="1month">Something else here</a>
                    </div>
                  </form>
                  </div>
          </div>

      <form action="{{route('sales.reports.searchIt')}}" method="POST">
      @csrf
          <label for="start">Start date:</label>
              <input type="date" id="start" name="dataComecoPadraoDateTime"
              value="2020-09-30"
              min="2018-01-01" max="2020-12-31">

            <label for="start">Final date:</label>
              <input type="date" id="start" name="dataFimPadraoDateTime"
              value="2020-09-30"
              min="2018-01-01" max="2020-12-31">
            <!-- <input type="submit" value="search"> -->
            <button type="submit" class="btn btn-info" value="Search">Search</button>
       </form>
       <br>

          <!-- Content Row -->
          <div class="row">

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Earnings Today</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
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
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings So far</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">£{{$totalEarnings}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Number of Sales</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$NumberOfSales}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Avarege sale amount</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                        <div class="h5 mb-0 font-weight-bold text-gray-800">£{{$AVGtotalEarnings}}</div>

                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <!-- Content Row -->
          @if(isset($start))
            <div class="alert alert-warning">
              <h4>Searchig for sales reports between {{$start}} - {{$end}}</h4>
            </div>
            @endif
        <div class="show-range">
        <div class="alert alert-warning">
              <h4>Searchig for sales reports between {{$start}} - {{$end}}</h4>
            </div>
        </div>


          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Earnings Overview (By month)</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" a>Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                <div class="chart-pie pt-3 pb-2">
                  <canvas id="line-chart-earnings"x></canvas>
                </div>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Payments Overview</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col"><strong>Method Payment</strong></th>
                  <th scope="col"><strong>Number of Payments</strong></th>
                  <th scope="col"><strong>Amount Payment</strong></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row"></th>
                  <td>CARD</td>
                  <td>{{$qtdSellByCard}}</td>
                  <td>£{{$AmountSalesWithVAT}}</td>
                </tr>
                <tr>
                  <th scope="row"></th>
                  <td>CASH</td>
                  <td>{{$qtdSellByCash}}</td>
                  <td>£{{$AmountSalesCashWithVAT}}</td>
                </tr>
              </tbody>
            </table>
            <hr>
            <div class="row">
            <div class="col-md-5">
            <h3>Total VAT: </h3>
            </div>
            <div class="col-md-7">
              <h3 style="text-aling:center;">£{{$totalEarnings}}</h3>
            </div>
            </div>
                  </div>
                </div>
              </div>
            </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">CARDS PAYMENTS OVERVIEW</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" a>Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                <div class="row">
                <div class="col-md-12">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Number Sales</th>
                      <th scope="col">Amount With VAT</th>
                      <th scope="col">Amount Without VAT</th>
                      <th scope="col">VAT Amount</th>
                      <th scope="col">Discount Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row"></th>
                      <td>{{$qtdSellByCard}}</td>
                      <td>£{{$AmountSalesWithVAT}}</td>
                      <td>£{{$AmountSalesWithoutVAT}}</td>
                      <td>£{{$AmountSalesCardVAT}}</td>
                      <td>£{{$AmountSalesCardDiscount}}</td>

                    </tr>
                  </tbody>
                </table>
                </div>
                <!-- <div class="col-lg-3">
                  <h2>{{$qtdSellByCard}}</h2>
                  <hr>
                  <h2>£{{$AmountSalesWithVAT}}</h2>
                </div> -->
                
                </div>
                </div>
              </div>
            </div>

           


             <!-- discount amount  -->
             

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">CASH PAYMENTS OVERVIEW</h6>
                  <div class="dropdown no-arrow">
             
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                <div class="row">
                <div class="col-md-12">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Number Sales</th>
                      <th scope="col">Amount With VAT</th>
                      <th scope="col">Amount Without VAT</th>
                      <th scope="col">VAT Amount</th>
                      <th scope="col">Discount Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row"></th>
                      <td>{{$qtdSellByCash}}</td>
                      <td>£{{$AmountSalesCashWithVAT}}</td>
                      <td>£{{$AmountSalesCashWithoutVAT}}</td>
                      <td>£{{$AmountSalesCashVAT}}</td>
                      <td>£{{$AmountSalesCashDiscount}}</td>

                    </tr>
                  </tbody>
                </table>
                </div>
                <!-- <div class="col-lg-3">
                  <h2>{{$qtdSellByCard}}</h2>
                  <hr>
                  <h2>£{{$AmountSalesWithVAT}}</h2>
                </div> -->
                
                </div>
                </div>
              </div>
            </div>
            </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">VAT Overview</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col"><strong>Method Payment</strong></th>
                  <th scope="col"><strong>Amount VAT</strong></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row"></th>
                  <td>CARD</td>
                  <td>£{{$AmountSalesCardVAT}}</td>
                </tr>
                <tr>
                  <th scope="row"></th>
                  <td>CASH</td>
                  <td>£{{$AmountSalesCashVAT}}</td>
                </tr>
              </tbody>
            </table>
            <hr>  
             <?php 

                $totalamountfromVAT = ($AmountSalesCardVAT + $AmountSalesCashVAT);
             ?>
            <div class="row">
            <h3>Total: £{{$totalamountfromVAT}}</h3>
            </div>
                </div>
              </div>
            </div>
             <!-- fim da row -->

             <div class="col-lg-6">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Discount Overview</h6>
                  <div class="dropdown no-arrow">
     
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col"><strong>Method Payment</strong></th>
                  <th scope="col"><strong>Amount Discount</strong></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row"></th>
                  <td>CARD</td>
                  <td>£{{$AmountSalesCardDiscount}}</td>
                </tr>
                <tr>
                  <th scope="row"></th>
                  <td>CASH</td>
                  <td>£{{$AmountSalesCashDiscount}}</td>
                </tr>
              </tbody>
            </table>
            <hr>  
             <?php 

                $totalamountDiscount = ($AmountSalesCardDiscount + $AmountSalesCashDiscount);
             ?>
            <div class="row">
            <h3>Total: £{{$totalamountDiscount}}</h3>
            </div>
                </div>
              </div>
            </div>
             <!-- fim da row -->
            
            
            </div>
          </div>
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
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


    <!-- Bootstrap core JavaScript-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
    

    <script src="{{ asset('admlyt/js/demo/chart-pie-demo.js') }}"></script>
    <script src="{{ asset('admlyt/js/demo/chart-earnings-demo.js') }}"></script>


    <script src="{{ asset('admlyt/js/demo/chart-bar-demo.js') }}"></script>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
   
  </body>

  </html>
