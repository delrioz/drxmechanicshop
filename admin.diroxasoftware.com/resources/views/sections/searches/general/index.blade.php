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

      <?php
          $from = "generalSearchPage";
      ?>

        <!-- Page Content -->
  <div class="container">
  <div class="py-5 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-6">

            <h3 style="color:black;"><b>Searching in All tables</b></h3>
            <p><h4><b>Choose which data you want to find !</b></h4></p>
          @if(isset($name))
                <h6 style="color:black;">Searching for :  <strong>{{$name}} </h6></strong>
          @endif

          @if(isset($nameText))
            <h4 style="color:black;"><b><span>Searching for <strong>{{$nameText}}</strong></span></b></h4>
          @endif


          </div>
          <form action="{{ route('general.search') }}" method="POST" class="form form-inline">
              @csrf

              <input type="text" name="nameText" id="" class = "form-control"
                placeholder = "Name or text">

              <!-- <input type="text" name="sobre" id="" class = "form-control" placeholder = "Sobre"> -->

                <select name="searchOption" id="" class = "form-control ml-2" >
                      <option value="general">General</option>
                      <option value="machines">Motorcycles</option>
                      <option value="products">Products</option>
                </select>

               <button type="submit" class="btn btn-primary ml-2" id=btnRoxo>Search</button>
            </form>
        </div>
      </div>
    </div>

            <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><b>Motorcycles</b></h6>
              <p class="mb-2 text-black-800"><b>HERE YOU SEE ALL MOTORCYCLES ON YOUR DATABASE. IF YOU PREFERE YOU CAN </a><a href="/section/machines/create/{{$from}}">CREATE NEW ONE</a></b></p>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->

                      <th style="font-family:verdana; font-size:95%; color:#38393b;" >Serial Number</th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;" >Model</th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;" >Brand</th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;" >Created At</th>
                     <th  style="font-family:verdana; font-size:95%; color:#38393b;" scope="col">Actions</th>

                    </tr>
                  </thead>

                  <tbody>
                    @foreach($allmachines as $machine)

                    <tr>
                    <?php

                    $max = 26;
                    $str = " $machine->owner";
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

                    $start = date('d/m/Y', strtotime($machine->created_at));


                    ?>

                    <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->

                    <td style="font-family:verdana; color:black;"><b>{{$serial_number}}</b><b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$model}}</b><b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$brand}}</b><b></td>
                    <td  style="font-family:verdana; color:black;"><b>{{$start}}</b><b></td>

                    <td>
                        <a href="/section/internalMachines/view/{{$machine->id }}" class="btn btn-primary btn-circle" style="background-color:#050d80"><i class="fas fa-eye"></i></a>
                        <a href="/section/internalMachines/edit/{{$machine->id}}/{{$from}}" class="btn btn-primary btn-group btn-circle"><i class="fas fa-edit"></i></a>
                        <a href="/section/internalMachines/destroy/{{$machine->id}}"  class="btn btn-danger btn-group btn-circle"
                        onclick="return confirm('Are you sure that you want delete this Machine?');">
                        <i class="fas fa-trash"></i></a>
                    </td>
                    </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        <!-- /.container-fluid -->
        <!-- Begin Page Content -->

          <!-- Page Heading -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><b>Products</b></h6>
              <p class="mb-2 text-black-800"><b>HERE YOU SEE ALL PRODUCTS ON YOUR DATABASE. IF YOU PREFERE YOU CAN </a><a href="/section/products/create/{{$from}}">CREATE NEW ONE</a></b></p>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <!-- 'name', 'serial_number', 'categorie', 'situation', 'year', 'brand', 'image', 'price', 'discount', 'about' -->

                      <th style="font-family:verdana; font-size:95%; color:#38393b;" >Image</th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;" >Name</th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;" >Category</th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;" >Seling Price</th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;" >Cost Price</th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;" >Created At</th>
                     <th  style="font-family:verdana; font-size:95%; color:#38393b;" scope="col">Actions</th>

                    </tr>
                  </thead>

                  <tbody>
                    @foreach($allproducts as $product)

                    <tr>
                    <?php

                    $max = 10;
                    $str = " $product->name ";
                    $name=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                    $max = 15; 
                    $str = " $product->categoryName ";
                    $categoryName=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                    $max = 10;
                    $str = " $product->about ";
                    $about=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                    $start2 = date('d/m/Y', strtotime($product->created_at));


                    ?>


                    <td>
                    <img src="/storage/{{$product->image}}" class="img-fluid img-thumbnail"
                    style="width: 100px; height:100px;"alt="Sheep">
                    </td>

                      <td style="font-family:verdana; color:black;"><b>{{$name}}</b></td>
                      <td style="font-family:verdana; color:black;"><b>{{$categoryName}}</b></td>
                      <td style="font-family:verdana; color:black;"><b>£{{$product-> Sell_Price}}</b></td>
                      <td style="font-family:verdana; color:black;"><b>£{{$product-> Cost_Price}}</b></td>
                      <td style="font-family:verdana; color:black;"><b>{{$start2}}</b></td>
                    <td>
                        <a href="/section/products/view/{{ $product->id }}" class="btn btn-primary btn-circle" style="background-color:#050d80"><i class="fas fa-eye"></i></a>
                        <a href="/section/products/edit/{{$product->id}}/{{$from}}" class="btn btn-primary btn-group btn-circle"><i class="fas fa-edit"></i></a>
                        <a href="/section/products/destroy/{{$product->id}}"  class="btn btn-danger btn-group btn-circle"
                        onclick="return confirm('Are you sure that you want delete this Product?');">
                        <i class="fas fa-trash"></i></a>
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
