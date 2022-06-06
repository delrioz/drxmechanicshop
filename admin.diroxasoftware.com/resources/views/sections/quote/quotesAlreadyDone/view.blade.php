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

<?php

$qt = $allQuotes->status;
$ShowStatus = 0;

if ($qt == 1)
{
    $ShowStatus = "CLOSE";
}
else
{
    $ShowStatus = "OPEN";
}

//payment method 

$pm = $allQuotes->typeofpayment;
$ShowTypeOfPayment = 0;

if ($pm == 1)
{
    $ShowTypeOfPayment = "CARD";
}
else
{
    $ShowTypeOfPayment = "CASH";
}


?>

<body id="page-top">

      <span>
            @include('sections.components.topnavbar')
      </span>
      
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->

          <!-- DataTales Example -->
         <!------ Include the above in your HEAD tag ---------->

            <form action="/section/quotesAlreadyDone" method="GET" id="registro" name="registro" enctype="multipart/form-data">
                            @csrf
            <section class="testimonial py-3" id="testimonial">
                <div class="container"  style="box-shadow: 0 4px 12px 0 rgba(0, 0, 2, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.19)">
                    <div class="row ">
                        <div class="col-md-12 py-5 border">
                            <h4 class="pb-2" style="color:black;">Editing a Quote. Please, fill out the form.</h4>
                            <div class="form-row">
                                <!-- 'name', 'customer_report', 'first_observations', 'previous_observations', 'customer', 'vehicle', 'status', 'typeofpayment' -->
                                <div class="form-group col-md-12">
                                <label for="" style="color:black;"> Title: </label>
                                    <input id="title" name="title"  id="title"  placeholder="title" class="form-control" type="text"
                                           value = "{{$allQuotes->title}}" readonly required>
                                </div>
                            </div>
                            <div class="form-row">
                                    <label for="" style="color:black;"> Customer Report: </label>
                                        <div class="form-group col-md-12">
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                                name="customer_report"
                                                placeholder="customer_report" id="customer_report" readonly required>{{$allQuotes->customer_report}}
                                        </textarea>
                                  </div>
                            </div>

                            <div class="form-row">
                                    <label for="" style="color:black;"> First Observations: </label>
                                        <div class="form-group col-md-12">
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                              name="first_observations" 
                                                placeholder="first_observations" id="first_observations" readonly required>{{$allQuotes->first_observations}}
                                        </textarea>
                                  </div>
                            </div>

                            <div class="form-row">
                                      <label for="" style="color:black;"> Last Observations: </label>
                                          <div class="form-group col-md-12">
                                          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                                name="last_observations" 
                                                  placeholder="last_observations" id="last_observations" readonly required>{{$allQuotes->last_observations}}
                                          </textarea>
                                    </div>

                                
                            <div class="form-group col-md-6">
                                    <label for="" style="color:black;">Customer Name: </label>
                                  <select id="customer" name="customer" class="form-control" readonly>
                                      <option selected >{{$allQuotes->customerName}}</option>
                                  </select>
                              </div>


                            <div class="form-group col-md-6">
                                      <label for="" style="color:black;">Machine Model: </label>
                                    <select id="machine" name="machine" class="form-control" readonly>
                                        <option selected>{{$allQuotes->machineModel}}</option>
                                    </select>
                              </div>


                                  <div class="form-group col-md-6">
                                  <label for="" style="color:black;">Status: </label>
                                    <input  id="status" name="status" 
                                        maxlength="191" value="{{$ShowStatus}}"
                                        placeholder="status " class="form-control" type="text" value="0"
                                        readonly required>
                                  </div>

                                        <div class="form-group col-md-6">
                                        <label for="" style="color:black;">Type of Payment: </label>
                                            <input  id="typeofpayment" name="typeofpayment" 
                                            maxlength="191" value="{{$ShowTypeOfPayment}}"
                                            placeholder="typeofpayment" class="form-control" type="text" 
                                            readonly required>
                                        </div>
                                    </div>


                                    <div class="title"><h3 style="text:center;">Products on this quotation</h3></div>
                                @foreach($ProductsInfo as $product)
                                <div class="row">
                                  <div class="col-md-6">
                                      <label for="productName">Product Name</label>
                                      <input type="text"  class="form-control mb-2 mr-sm-2" value="{{$product->productName}}" placeholder="Product Name" disabled>
                                      <input type="hidden"  class="form-control mb-2 mr-sm-2"  name="productName[]" id="productName" value="{{$product->product_id}}" placeholder="Product ID">
                                      </div>
                                  <div class="col-md-6">
                                      <label  for="quantity">Price for each</label>
                                      <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                        </div>
                                        <input type="number"  class="form-control" name="quantity[]" id="quantity"  value="{{$product->productSellPrice}}" placeholder="Quantity" disabled>
                                        <input type="hidden"  class="form-control" name="quantity[]" id="quantity"  value="{{$product->productSellPrice}}" placeholder="Quantity" >
                                      </div>
                                    </div>
                                </div>
                               @endforeach
                                <button type="submit" class="btn btn-danger">BACK</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

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
