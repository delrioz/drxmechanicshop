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

  <link href="{{ asset('jquery/multiselect/chosen.min.css') }}" rel="stylesheet">
  <script type="text/javascript" src="{{ asset('jquery/multiselect/jquery-3.5.1.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('jquery/multiselect/chosen.jquery.min.js') }}"></script>

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

         <form action="/section/quote/confirmQuantity" method="POST" id="registro" name="registro" enctype="multipart/form-data">
          @csrf
            <section class="testimonial py-3" id="testimonial">
                <div class="container"  style="box-shadow: 0 4px 12px 0 rgba(0, 0, 2, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.19)">
                    <div class="row ">
                        <div class="col-md-12 py-5 border">
                            <h4 class="pb-2" style="color:black;"><b>Editing a Quote. Please, fill out the form.</b></h4>
                            <div class="form-row">
                            <label for="" style="color:black;"> <b>Title: </b></label>
                                <!-- 'name', 'customer_report', 'first_observations', 'previous_observations', 'customer', 'vehicle', 'status', 'typeofpayment' -->
                                <div class="form-group col-md-12">
                                    <input id="title" name="title"  id="title"  placeholder="title" class="form-control" type="text"
                                           value = "{{$allQuotes->title}}" disabled required>
                                </div>
                            </div>
                            <div class="form-row">
                                    <label for="" style="color:black;"> <b>Customer Report:</b> </label>
                                        <div class="form-group col-md-12">
                                        <input type="text" value="{{$allQuotes->customer_report}}" name ="customer_report" hidden>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                                name="customer_report"
                                                placeholder="Customer Report" id="customer_report" disabled>{{$allQuotes->customer_report}}</textarea>
                                  </div>
                            </div>


                            <div class="form-row">
                                      <label for="" style="color:black;"> <b>Customer Note:</b> </label>
                                          <div class="form-group col-md-12">
                                          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                                name="last_observations"
                                                placeholder="Last Observations" id="last_observations" disabled>{{$allQuotes->last_observations}}</textarea>
                              </div>


                            <div class="form-group col-md-6">
                                        <label for="" style="color:black;"><b>Customer</b></label><br>
                                        <input type="text" value="{{$name}}" name ="customer" hidden>
                                        <select id="customer" name="customer" class="form-control" disabled>
                                          <option selected>{{$allQuotes->customerName}}</option>
                                      </select>
                              </div>


                            <div class="form-group col-md-6">
                                        <label for="" style="color:black;"><b>Motorcycle</b></label><br>
                                        <input type="text" value="{{$allQuotes->machineId}}" name ="machine" hidden>
                                        <select id="machine" name="machine" class="form-control" disabled>
                                         <option selected>{{$allQuotes->machineModel}}</option>
                                        </select>
                              </div>
                            </div>

                            <div class="row">
                                    @if(count($allproducts)  > 0)
                                        <div class="form-group">
                                            <div class="form-group col-md-12">
                                              <label for="" style="color:black;"><b>Products</b></label><br>
                                              <select id="mselect" multiple style="width:500px;"  name="Productsoptions[]">
                                            @if($statusNulo == false)
                                              @foreach($respostaProducts as $products)
                                                <option id="option" value="{{$products->id}}">Id:{{$products->id}} | SKU:{{$products->SKU}} | Name:{{$products->name}}  </option>
                                              @endforeach

                                            @foreach($outrasop as $op)
                                              <option id="option" value="{{$op->product_id}}" selected>Id:{{$op->product_id}} | SKU:{{$op->product_SKU}} | Name:{{$op->productName}}</option>
                                              @endforeach
                                            @endif

                                            @if($statusNulo == true)
                                              @foreach($outrasop as $op)
                                              <option id="option" value="{{$op->product_id}}" selected>Id:{{$op->product_id}} | SKU:{{$op->product_SKU}} | Name:{{$op->productName}}</option>
                                              @endforeach
                                            @endif
                                              </select>
                                          </div>
                                        </div>
                                      @endif
                            </div>
                            
                            @if($statusNulo2 == true)
                            @foreach($productsonthisWorkOrder as $product)
                                  <div class="row">
                                  <div class="col-md-4">
                                      <label for="productName" style="color:black;"><b>Product Name</b></label>
                                      <input type="text"  class="form-control mb-2 mr-sm-2" value="{{$product->name}}" placeholder="Product Name">
                                      <input type="hidden"  class="form-control mb-2 mr-sm-2"  name="productName[]" id="productName" value="{{$product->id}}" placeholder="Product ID">
                                      </div>
                                  <div class="col-md-4">
                                      <label  for="quantity" style="color:black;"><b>Quantity</b></label>
                                      <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                        </div>
                                        <input type="number"  class="form-control" name="quantity[]" id="quantity"  value="1" placeholder="Quantity">
                                      </div>
                                    </div>
                                  <div class="col-md-4">
                                      <label  style="color:black;"><b>Condition</b></label>
                                      <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                        </div>
                                        <input type="text"  class="form-control mb-2 mr-sm-2"   value="{{$product->condition}}" placeholder="{{$product->condition}}" disabled>
                                      </div>
                                    </div>
                                </div>
                               @endforeach
                               @endif
                               <input type="number"  class="form-control" name="id" id="id"  value="{{$id}}" placeholder="id" hidden >
                                <button type="submit" class="btn btn-warning">
                                <i class="fa fa-check fa-1x " aria-hidden="true"></i>
                                <b>Create Quote</b>
                                </button>
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
  <a class="scroll-to-top rounded" href="#page-top"><b>
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

  <script type="text/javascript">
    $(document).ready(function(){
        $('#mselect').chosen();
    });
  </script>

  <!-- Bootstrap core JavaScript-->
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
