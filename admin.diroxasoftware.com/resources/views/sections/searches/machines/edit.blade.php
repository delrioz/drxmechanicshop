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

            <!-- Page Content -->
      <div class="container">
        <div class="py-5 bg-light">
            <div class="container">
            <h6 class="m-0 font-weight-bold text-primary"><b>Motorcycle's Info</b></h6>
              <div class="row">
                <div class="col-md-6">
                    <div class="card-body">
                      <h3 class="card-title"><p><b>Model: <strong style="color:#060b30;">{{$allmachines->model}}</strong></p></b></h3>
                      <h4><b>Serial Number: <strong style="color:#060b30;">{{$allmachines->serial_number}}</strong></b></h4>
                      <p class="card-text"><b>Serial Number: <strong style="color:#060b30;">{{$allmachines->serial_number}}</strong></b></p>
                    </div>
                </div>
              </div>
            </div>
        </div>


        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><b>Products found on this Motorcycle</b></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <!-- 'name', 'serial_number', 'categorie', 'situation', 'year', 'brand', 'image', 'price', 'discount', 'about' -->

                      <th class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;">Image</th>
                      <th class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;">Name</th>
                      <th class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;">Category</th>
                      <th class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;">Seling Price</th>
                      <th class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;">Cost Price</th>
                      <th class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;">Quantity</th>
                     <th class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;" scope="col">Actions</th>

                    </tr>
                  </thead>

                  <tbody>
                    @foreach($ProductsByMachines as $product)

                    <tr>
                    <?php

                    $max = 10;
                    $str = " $product->productName ";
                    $name=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                    $max = 10;
                    $str = " $product->about ";
                    $about=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                    ?>


                    <td>
                    <img src="/storage/{{$product->image}}" class="img-fluid img-thumbnail"
                    style="width: 100px; height:100px;"alt="Sheep">
                    </td>

                    <td style="font-family:verdana; color:black;"><b>{{$name}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$product-> categoryName}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>£{{$product-> Sell_Price}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>£{{$product-> Cost_Price}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>£{{$product-> quantity}}</b></td>
                    <td>
                        <div class="row">
                          <div class="col-md-4">
                              <!-- <a href="/section/products/view/{{ $product->id }}" class="btn btn-block btn-primary fa fa-eye" style="background-color:#050d80"></a> -->
                              <a href="/section/products/view/{{$product->id }}" style="background-color:#050d80" class="btn btn-block text-white btn-circle" >
                                        <i class="fas fa-eye" ></i>
                              </a>
                              <!-- <a href="/section/products/edit/{{$product->id}}" class="btn btn-block btn-primary btn-group fa fa-edit"></a> -->
                              <a href="/section/products/edit/{{$product->id}}" class="btn btn-block btn-primary btn-circle">
                                        <i class="fas fa-edit"></i>
                              <a href="/section/products/destroy/{{$product->id}}" class="btn btn-block btn-danger btn-circle" 
                               onclick="return confirm('Are you sure that you want delete this Product?');"> 
                                        <i class="fas fa-trash"></i>
                                    </a>
                              </a>
                          </div>
                        </div>  
                    </td>
                    </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
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
