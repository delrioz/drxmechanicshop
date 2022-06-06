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

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><strong>PRODUCS REPORTS and BALANCE</strong></h1>
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
                      <div class="h5 mb-0 font-weight-bold"><strong style="color:red;">{{$productsgeneralbalance}}</strong>  </div>actives

                      @else
                      <div class="h5 mb-0 font-weight-bold"><strong style="color:green;">{{$productsgeneralbalance}}</strong>  </div>actives
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

                    ?>


                    <td>{{$name}}</td>
                    <td>{{$product-> category}}</td>
                    <td style="color:green;"><strong>£{{$product-> Sell_Price}}</strong></td>
                    <td style="color:red;"><strong>£{{$product-> Cost_Price}}</strong></td>
                    <td style="color:orange;"><strong>{{$product-> quantity}}</strong></td>
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
