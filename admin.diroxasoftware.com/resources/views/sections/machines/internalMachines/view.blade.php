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
      <div class="container-fluid">
        <div class="py-5 bg-light">
            <div class="container">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="h3 m-0 font-weight-bold text-primary"><b>Machine Info's</b></h6>
              <a href="/section/internalMachines" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                      class="fas fa-eye fa-sm text-white-50"></i> <b>ALL MACHINES</b></a>
          </div>
              <div class="row">
                  <div class="col-md-6">
                      <img class="img-fluid"  src="/storage/{{$allmachines->image}}"
                                style="width:150; height:300px;">
                  </div>
                  <?php
                    $max = 45;
                    $str = " $allmachines->model";
                    $model=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                    $max = 26;
                    $str = " $allmachines->serial_number";
                    $serial_number=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                    $max = 26;
                    $str = " $allmachines->brand";
                    $brand=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                    $max = 26;
                    $str = " $allmachines->brand";
                    $brand=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);



                    $thisMachineCondition = $allmachines->condition;
                    if($thisMachineCondition == 0){
                      $statusName = "AVAILABLE FOR HIRING";
                    }

                    else if($thisMachineCondition == 1){
                        $statusName = "UNAVAILABLE FOR HIRING";
                    }

                    else if($thisMachineCondition == 2){
                        $statusName = "WAITING FOR COLLECTION";
                    }

                    $thisTypeMachine = $allmachines->typemachine;
                    if($thisTypeMachine == 0){
                      $typeMachine = "INTERNAL MACHINE";
                    }

                    else if($thisTypeMachine == 1){
                        $typeMachine = "CROSS HIRING MACHINE";
                    }

                    $price = number_format($allmachines->price, 2, '.',',');
                    $priceper2days = number_format($allmachines->priceper2days, 2, '.',',');
                    $priceper3days = number_format($allmachines->priceper3days, 2, '.',',');
                    $priceper1week = number_format($allmachines->priceper1week, 2, '.',',');

                  ?>

                  <div class="col-md-6">
                    <div class="card-body">
                      <h3 class="card-title"><p><b>Status: </b><small><strong style="color:#060b30;">{{$statusName}}</strong></p></small></h3>
                  </div>
                </div>


                </div>

              <div class="row">
                <div class="col-md-6">
                    <div class="card-body">
                      <h3 class="card-title"><p><b>Model: </b><small><strong style="color:#060b30;">{{$model}}</strong></p></small></h3>
                      <h3><b>Serial Number: </b><small><strong style="color:#060b30;">{{$serial_number}}</strong></small></h3>
                      <h3><b>Brand: </b><small><strong style="color:#060b30;">{{$brand}}</strong></small></h3>
                      <h3><b>Type Machine: </b><small><strong style="color:#060b30;">{{$typeMachine}}</strong></small></h3>
                        @if($thisMachineCondition == 1)
                          <h3><b>Cross Hiring Price: </b><small><strong style="color:#060b30;">£{{$allmachines->crossHireMachinePrice}}</strong></small></h3>
                        @endif
                      <h3><b>Machine Value: </b><small><strong style="color:#060b30;">£{{$allmachines->valueMachine}}</strong></small></h3>

                      <!-- <h3><b>Status: </b><small><strong style="color:#060b30;">{{$statusName}}</strong></small></h3> -->
                  </div>
                </div>
                <div class="col-md-6">
                        <h3><b>Suggested Deposit: </b><small><strong style="color:#060b30;">£{{$allmachines->depositSuggest}}</strong></small></h3>
                        <h3><b>Price per Day:</b> <strong style="color:#060b30;">£{{$allmachines->price}}</strong></small></h3>
                        <h3><b>Price per 2 Days: </b><small><strong style="color:#060b30;">£{{$allmachines->priceper2days}}</strong></small></h3>
                        <h3><b>Price per 3 Days: </b><small><strong style="color:#060b30;">£{{$allmachines->priceper3days}}</strong></small></h3>
                        <h3><b>Price per 1 week: </b><small><strong style="color:#060b30;">£{{$allmachines->priceper1week}}</strong></small></h3>

                  </div>
              </div>
            </div>
        </div>

        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><b>Products found in this machine</b></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <!-- 'name', 'serial_number', 'categorie', 'situation', 'year', 'brand', 'image', 'price', 'discount', 'about' -->

                      <th style="font-family:verdana; font-size:95%; color:#38393b;">Image</th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;">Name</th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;">Category</th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;">Seling Price</th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;">Cost Price</th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;">Quantity</th>
                     <th style="font-family:verdana; font-size:95%; color:#38393b;" scope="col">Actions</th>

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

                    $Sell_Price = number_format($product->Sell_Price, 2, '.',',');
                    $Cost_Price = number_format($product->Cost_Price, 2, '.',',');

                    ?>


                    <td>
                    <img src="/storage/{{$product->image}}" class="img-fluid img-thumbnail"
                    style="width: 100px; height:100px;"alt="Sheep">
                    </td>

                    <td style="font-family:verdana; color:black;"><b>{{$name}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$product->categoryName}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>£{{$Sell_Price}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>£{{$Cost_Price}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>£{{$product->quantity}}</b></td>
                    <td>
                        <a href="/section/products/view/{{ $product->productId }}" class="btn btn-primary btn-circle" style="background-color:#050d80"><i class="fas fa-eye"></i></a>
                        <a href="/section/products/edit/{{$product->productId}}" class="btn btn-primary btn-group btn-circle"><i class="fas fa-edit"></i></a>
                        <a href="/section/products/destroy/{{$product->productId}}"  class="btn btn-danger btn-group btn-circle"
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
