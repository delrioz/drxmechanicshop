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

<body id="page-top">

      <span>
            @include('sections.components.topnavbar')
      </span>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->

          <!-- DataTales Example -->
         <!------ Include the above in your HEAD tag ---------->

            <!-- <form action="/section/py/confirmPayment" method="POST" id="registro" name="registro" enctype="multipart/form-data"> -->
            <form action="/section/workOrder/printJobCart" method="POST" id="registro" name="registro" enctype="multipart/form-data">
              @csrf

                  <section class="testimonial py-3" id="testimonial">
                    <div class="container"  style="box-shadow: 0 4px 12px 0 rgba(0, 0, 2, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.19)">
                        <div class="row ">
                            <div class="col-md-12 py-5 border">
                                    <h4 class="pb-2" style="color:black;"><b>JOB CART DESCRIPTION</b></h4>
                                    <p>Job cart is to print one page with Job instructions for the mechanics.</p>
                                @if (session('status'))
                                  <div class="alert alert-danger">
                                      <h4>{{ session('status') }}</h4>
                                  </div>
                                @endif
                                @if (session('warning'))
                                  <div class="alert alert-warning">
                                      <h4>{{ session('warning') }}</h4>
                                  </div>
                                @endif
                                <div class="form-row">
                                    <!-- 'name', 'customer_report', 'first_observations', 'previous_observations', 'customer', 'vehicle', 'status', 'typeofpayment' -->
                                    <label for="" style="color:black;"><b>Title:</b> </label>
                                    <div class="form-group col-md-12">
                                        <input id="title" name="title"  id="title"  placeholder="title" class="form-control" type="text"
                                              value = "{{$allworkOrders->title}}" required>
                                    </div>
                                </div>



                                <div class="form-row">
                                          <label for="" style="color:black;"> <b>Job Description:</b> </label>
                                              <div class="form-group col-md-12">
                                              <textarea class="form-control jobDescription"  rows="3"
                                                    name="jobDescription"  value="{{$allworkOrders->jobDescription}}"
                                                      placeholder="jobDescription" id="jobDescription">Job Description</textarea>
                                </div>


                                <input type="text" value="{{$id}}" id="wkId" name="wkId" hidden>


                                <div class="form-group col-md-6">
                                <label for="" style="color:black;"> <b>Customer:</b> </label>
                                <input type="text" value="{{$allworkOrders->customerId}}" name ="customerName" hidden>

                                            <select id="customer" name="customer" class="form-control" disabled>
                                              <option selected>{{$allworkOrders->customerName}}</option>
                                          </select>
                                  </div>


                                <div class="form-group col-md-6">
                                <label for="" style="color:black;"> <b>Motorcycle:</b> </label>
                                <input type="text" value="{{$allworkOrders->machineId}}" name ="machine" hidden>
                                            <select id="machine" name="machine" class="form-control" disabled>
                                            <option selected>{{$allworkOrders->machineModel}}</option>
                                          </select>
                                  </div>
                      </div><br>

                                <input type="text" name="machineId" id="machineId" value="{{$allworkOrders->machineId}}" hidden>
                              @if(count($ProductsInfo) > 0)
                                        <div class="title"><h3 style="text:center;color:black;"><b>Products on this order</b></h3></div>
                                  @foreach($ProductsInfo as $product)
                                    <div class="row">
                                      <div class="col-md-4">
                                          <label for="productName" style="color:black;"><b>Product Name</b></label>
                                          <input type="text"  class="form-control mb-2 mr-sm-2" value="{{$product->productName}}" placeholder="Product Name" disabled>
                                          <input type="hidden"  class="form-control mb-2 mr-sm-2"  name="productName[]" id="productName" value="{{$product->product_id}}" placeholder="Product ID">
                                          </div>
                                      <div class="col-md-4">
                                          <label  for="quantity" style="color:black;"><b>Price for each with VAT(GBP)</b></label>
                                          <div class="input-group mb-2 mr-sm-2">
                                            <div class="input-group-prepend">
                                            </div>
                                            <input type="number"  class="form-control" name="quantity[]" id="productQuantity"  value="{{$product->productSellPriceVat}}" placeholder="Quantity" disabled>
                                            <input type="hidden"  class="form-control" name="quantity[]" id="productQuantity"  value="{{$product->productSellPriceVat}}" placeholder="Quantity" >
                                          </div>
                                        </div>

                                    <div class="col-md-2">
                                          <label  for="quantity" style="color:black;"><b>Quantity being Used</b></label>
                                          <div class="input-group mb-2 mr-sm-2">
                                            <div class="input-group-prepend">
                                            </div>
                                            <input type="number"  class="form-control" name="quantity[]" id="productQuantity"  value="{{$product->productQuantityPmw}}" placeholder="Quantity" disabled>
                                            <input type="hidden"  class="form-control" name="quantity[]" id="productQuantity"  value="{{$product->productQuantityPmw}}" placeholder="Quantity" >
                                          </div>
                                        </div>

                                        <div class="col-md-2">
                                          <label  for="quantity" style="color:black;"><b>Condition</b></label>
                                          <div class="input-group mb-2 mr-sm-2">
                                            <div class="input-group-prepend">
                                            </div>
                                            <input type="number"  class="form-control" name="condition" id="condition"  value="{{$product->productCondition }}" placeholder="{{$product->productCondition }}" disabled>
                                          </div>
                                        </div>
                                    </div>
                                  @endforeach
                                @endif

                                  <hr>
                                @if(count($ExtraItems)  > 0)
                                  <div class="title"><h3 style="text:center; color:black;"><b>Extra Costs</b></h3></div>
                                  @foreach($ExtraItems as $extraitems)
                                  <?php
                                      $Sell_PriceFormated = number_format($extraitems->Sell_Price, 2, '.',',');
                                      $Sell_PriceVatFormated = number_format($extraitems->Sell_PriceVat, 2, '.',',');
                                  ?>
                                      <div class="row">
                                        <div class="col-md-4">
                                            <label  style="color:black;"><b>Product Name/ Extra Costs</b></label>
                                            <input type="text" id="DescriptionName" name="DescriptionName[]" value="{{$extraitems->name}}" class="form-control mb-2 mr-sm-2"  placeholder="Product Name/ Extra Cost Description" disabled required>
                                        </div>
                                        <div class="col-md-4">
                                            <label  style="color:black;"><b>Price excl Vat</b></label>
                                            <input type="text"  id="Sell_Price" name="Sell_Price[]" value="{{$Sell_PriceFormated}}" class="form-control mb-2 mr-sm-2"  onchange="myFunction()" placeholder="Price without vat" disabled required>
                                        </div>
                                        <div class="col-md-4">
                                            <label  style="color:black;"><b>Price incl Vat</b></label>
                                            <input type="text" id="Sell_PriceVat" name="Sell_PriceVat[]" value="{{$Sell_PriceVatFormated}}" class="form-control mb-2 mr-sm-2" onchange="vatToNormalPrice()"  placeholder="Price with Vat" disabled required>
                                        </div>

                                      </div>
                                  @endforeach
                                @endif

                                  <button  class="btn btn-warning previewInvoice" id="previewInvoice">
                                      <i class="fa fa-eye fa-1x " aria-hidden="true"></i>
                                      <b>Open Note</b>
                                  </button>

                                    <a href="/section/workOrder/index/"  class="btn btn-danger btn-group">
                                        Back
                                    </a>

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


<script type="text/javascript" src="{{ asset('jquery/multiselect/jquery-3.5.1.min.js') }}"></script>

<script>

        //muda a casa decimal dos valores
        $("#discount").on("change",function(){
        $(this).val(parseFloat($(this).val()).toFixed(2));
        });

        //muda a casa decimal dos valores
        $("#worklabor").on("change",function(){
        $(this).val(parseFloat($(this).val()).toFixed(2));
        });

</script>

</body>

</html>
