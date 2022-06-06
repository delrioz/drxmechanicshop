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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>


  </head>

        <span>
              @include('sections.components.topnavbar')
        </span>
     

          <!-- Begin Page Content -->
          <div class="container-fluid">
          <!-- Begin Page Content -->

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-black-800"><strong style="color:black;">PRODUCTS REPORTS</strong><br>
              <strong style="color:#050d80;">Here you'll sell all informations about your products: prices, quantities and will be
              <br> warned about the STOCK</strong>
              </h1>
              <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
            </div>

            <!-- Content Row -->
            <div class="row">

              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        <a href="/section/products"> AMOUNT IN STOCK </a>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><strong style="color:green;">£{{$stockPrice}}</strong></div>
                        sum of all products prices
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
                <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        <a href="/section/machines " style="color:green"> AMOUNT SPENT</a>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><strong style="color:blue;">£{{$stockCost}}</strong></div>
                        total money spent in products
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
                <div class="card border-left-info shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        <a href="/section/customers" style="color:blue"> Products Quantity</a>
                        </div>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><strong style="color:orange;">{{$StockTotalQuantity}}</strong></div
                            >PRODUCTS QUANTITY <br> IN STOCK
                          </div>
                          <div class="col">
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

              <!-- Pending Requests Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        <a href="/section/quote" style="color:orange"> GENERAL BALANCE</a>
                        </div>
                        @if($productsgeneralbalance < 0)
                        <div class="h5 mb-0 font-weight-bold"><strong style="color:red;">{{$productsgeneralbalance}}</strong>  </div>Amount in Sock - Amount Spent

                        @else
                        <div class="h5 mb-0 font-weight-bold"><strong style="color:green;">{{$productsgeneralbalance}}</strong>  </div>Amount in Sock - Amount Spent
                        @endif
                      </div>
                      <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
              </div>
              </div>
            </div>



  <!-- Page Heading -->
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">ProductsDataTables</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Image</th>
              <th>Name</th>
              <th>Category</th>
              <th>Sell Price</th>
              <th>Cost Price</th>
              <th>Quantity</th>
              <th>Last Update</th>
              <th scope="col">Actions</th>

            </tr>
          </thead>

          <tbody>
                      @foreach($allproducts as $product)

                      <tr>
                      <?php

                      $max = 19;
                      $str = " $product->name ";
                      $name=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                      $max = 10;
                      $str = " $product->about ";
                      $about=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                      if($product-> quantity <= 5){
                        $statusQuantity = "low quantity";
                      }
                      else{
                        $statusQuantity = "";
                      }
                      ?>

                      <td>
                      <img src="/storage/{{$product->image}}" class="img-fluid img-thumbnail"
                      style="width: 100px; height:100px;"alt="Sheep">
                      </td>
                      <td>{{$name}}</td>
                      <td>{{$product-> categoryName}}</td>
                      <td style="color:green;"><strong>£{{$product-> Sell_Price}}</strong></td>
                      <td style="color:red;"><strong>£{{$product-> Cost_Price}}</strong></td>
                      <td style="color:orange;"><strong>{{$product-> quantity}}</strong><br><h7 style="color:red;">{{$statusQuantity}}</h7></td>
                      <td>£{{$product-> updated_at}}</td>
                      <td>
                          <a href="/section/products/edit/{{$product->id}}" class="btn btn-primary btn-group">Edit</a>
                          <a href="/section/products/destroy/{{$product->id}}"  class="btn btn-danger btn-group"
                          onclick="return confirm('Are you sure that you want delete this Product?');">
                                  Remove</a>
                      </td>
                      </tr>
                  @endforeach
                    </tbody>
        </table>
      </div>
    </div>
  </div>



      <!-- Content Row -->
      <div class="row">

  <!-- Content Column -->
  <div class="col-lg-6 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><h5 style = "color:orange"><strong>STAY ALERT</strong></h5 style="color:orange;"><strong>Products in Low quantity</strong><small> products with 5 or less in stock</small></h6>
      </div>
      <div class="card-body">
      @foreach($allproductsLowQuantity as $lowQuantitys)
        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$lowQuantitys->name}}<small style="color:red;"> only {{$lowQuantitys -> quantity}} itens</small> <a href="/section/products/edit/{{$lowQuantitys->id}}"> add more</a>
        </div>
      @endforeach
        </div>
      </div>
    </div>

  <div class="col-lg-6 mb-4">

    <!-- Illustrations -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">ABOUT THE DASHBOARD</h6>
      </div>
      <div class="card-body">
        <div class="text-center">
        </div>
        <p style="color:black;x">Here, you will see all about your products. How much your spent and gain with it.  Alerts about Low quantity and all this stuffs</p>
      </div>
    </div>
    </div>

    <div class="row">
    <div class="col-lg-6 mb-4">
    <!-- Approach -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success">BEST COST BENEFIT</h6>
      </div>
      <div class="card-body">
          <h5><p style="color:black;">Which product gives you the <strong style="color:green">best return</strong> regarding the <strong style="color:green">Sell price</strong> and the <strong style="color:red">Cost price</strong>. This will help you to know which products you can <strong style="color:orange">earn more money</strong> in the end of the month</p></h5>
          @foreach($allcostbenefit as $costBenefit)
          <h5><p><strong>Product Name: </strong><strong style="color:black"> {{$costBenefit->name}}</strong>
          <br>Sell Price per unity: <strong style="color:green;">£{{$costBenefit->Sell_Price}}</strong>. Cost Price: <strong style="color:red;">£{{$costBenefit->Cost_Price}}</strong>.
          <br> Total Cost Benifit Balance: = <strong style="color:green;">{{$costBenefit->costBenefit}}</strong></p></h5>
          @endforeach
      </div>
    </div>
    </div>
    <div class="col-lg-6 mb-4">
    <!-- Approach -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-danger">WORST COST BENEFIT</h6>
      </div>
      <div class="card-body">
          <h5><p style="color:black;">Which product gives you the <strong style="color:red">worst return</strong> regarding the <strong style="color:green">Sell price</strong> and the <strong style="color:red">Cost price</strong>. This will help you to know which products you can <strong style="color:orange">earn more money</strong> and which one <strong style="color:red;">doesn't worth sell</strong><br></p></h5>
          @foreach($allworstcostbenefit as $worstcostBenefit)
          <h5><p><strong>Product Name: </strong><strong style="color:black"> {{$worstcostBenefit->name}}</strong>
          <br>Sell Price per unity: <strong style="color:green;">£{{$worstcostBenefit->Sell_Price}}</strong>. Cost Price: <strong style="color:red;">£{{$worstcostBenefit->Cost_Price}}</strong>.
          <br> Total Cost Benifit Balance: = <strong style="color:green;">{{$worstcostBenefit->worstcostBenefit}}</strong></p></h5>
          @endforeach
      </div>
    </div>
    <div class="row">

<!-- Area Chart -->
<div class="col-xl-8 col-lg-7">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
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
      <div class="chart-area">
      <canvas id="myChart" width="400" height="400"></canvas>
      </div>
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

  <!-- end of container fluid  -->
  </div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>

</script>
<script>
      var productos =["prod1", "prod2", "prod3", "prod4"];
      var valores =[1,2,3,4];
      $(function(){
          $.ajax({
            url: "{{ route('products.search') }}",
            type: "post",
            data: $(this).serialize(),
            dataType: 'json',
          });
          chartGenerate();
        });

        function chartGenerate(){
          // alert('olá, mundo!');
          var ctx = document.getElementById('myChart').getContext('2d');
          var myChart = new Chart(ctx, {
              type: 'bar',
              data: {
                  labels: productos,
                  datasets: [{
                      label: '# of Votes',
                      data: valores,
                      backgroundColor: [
                          'rgba(255, 99, 132, 0.2)',
                          'rgba(54, 162, 235, 0.2)',
                          'rgba(255, 206, 86, 0.2)',
                          'rgba(75, 192, 192, 0.2)',
                          'rgba(153, 102, 255, 0.2)',
                          'rgba(255, 159, 64, 0.2)'
                      ],
                      borderColor: [
                          'rgba(255, 99, 132, 1)',
                          'rgba(54, 162, 235, 1)',
                          'rgba(255, 206, 86, 1)',
                          'rgba(75, 192, 192, 1)',
                          'rgba(153, 102, 255, 1)',
                          'rgba(255, 159, 64, 1)'
                      ],
                      borderWidth: 1
                  }]
              },
              options: {
                  scales: {
                      yAxes: [{
                          ticks: {
                              beginAtZero: true
                          }
                      }]
                  }
              }
          });
        }
</script>
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
