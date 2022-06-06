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
  <link href="{{ asset('quote/css/style.css') }}" rel="stylesheet">

</head>

<body id="page-top">

      <span>
            @include('sections.components.topnavbar')
      </span>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                  <!-- Page Heading -->
                  <h1 class="h3 mb-1 text-gray-800"><b>Confirm All Work Order Informations before Continue</b></h1>
                  @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                              @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                              @endforeach
                            </ul>
                        </div>
                    @endif

                  @if(session('warning'))
                        <div class="alert alert-info">
                            {{ session('warning') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                  @endif

                  <form action="/section/workOrder/checarInvoiceSemCadastrar" method="POST" id="registro" name="registro" enctype="multipart/form-data">
                   @csrf

                  <!-- Content Row -->
                  <div class="row">
                      <!-- Grow In Utility -->
                      <div class="col-lg-6">

                                  <div class="card position-relative">
                                      <div class="card-header py-3">
                                          <h6 class="m-0 font-weight-bold text-primary">Work Order Infos</h6>
                                      </div>


                                      <div class="card-body">
                                        <div class="row">
                                          
                                        <div class="form-group col-md-4">
                                            <label for="" style="color:black;"> <b>Customer:</b> </label>
                                            <input type="text" value="{{$allworkOrders->customerId}}" name ="customerName" hidden>
                                                      <select id="customer" name="customer" class="form-control" disabled>
                                                          <option selected>{{$allworkOrders->customerName}}</option>
                                                      </select>
                                        </div>

                                          <div class="form-group col-md-4">
                                              <label for="" style="color:black;"> <b>Motorcycle:</b> </label>
                                              <input type="text" value="{{$allworkOrders->machineId}}" name ="machine" hidden>
                                                      <select id="machine" name="machine" class="form-control" disabled>
                                                        <option selected>{{$allworkOrders->machineModel}}</option>
                                                      </select>
                                          </div>

                                            <div class="col-md-4">
                                                  <label for="" style="color:black;"> <b>Bike's Mileage:</b> </label>
                                                    <input  id="mileage" name="mileage"
                                                      maxlength="191"  value="{{$allworkOrders->mileage}}"
                                                      placeholder="ENTER THE MILEAGE " class="form-control" type="text">
                                            </div>

                                       </div>
                                       

                                    

                                      <span class="d-none" id="selectedCustomerInfos" name="selectedCustomerInfos">
                                        <div class="alert">
                                          <div class="row">
                                            <div class="col-md-6">
                                              <h5><b>Name:</b> Giovani</h5>
                                              <h5><b>Email:</b> 07774444</h5>
                                            </div>
                                            <div class="col-md-6">
                                              <h5><b>Address:</b> 07774444</h5>
                                              <b style="text-color:black;">Customer Selected</b>
                                          </div>
                                        </div>
                                        </div>
                                      </span>
                                
                                  <div class="form-row">
                                  <label for="" style="color:black;"> <b>Job Title:</b> </label>
                                  <!-- 'name', 'customer_report', 'first_observations', 'previous_observations', 'customer', 'vehicle', 'status', 'typeofpayment' -->
                                  <div class="form-group col-md-12">
                                          <input id="title" name="title"  id="title"  placeholder="title" class="form-control" type="text"
                                              value = "{{$allworkOrders->title}}" required>
                                  </div>
                              </div>

                              
                              <div class="form-row">
                                    <label for="" style="color:black;"><b>Customer Observations: </b></label>
                                      <div class="form-group col-md-12">
                                          <input type="text" value="{{$allworkOrders->customer_report}}" name ="customer_report" hidden>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                                        name="customer_report"
                                                        placeholder="Customer Report" id="customer_report" disabled>{{$allworkOrders->customer_report}}</textarea>
                                      </div>  
                              </div>  


                              <div class="form-row">
                                        <label for="" style="color:black;"> <b>Customer Note:</b><small>(Will show on the Invoice)</small></label>
                                            <div class="form-group col-md-12">
                                            <textarea class="form-control last_observations"  rows="3"
                                                    name="last_observations"  value="{{$allworkOrders->last_observations}}"
                                                      placeholder="last_observations" id="last_observations">{{$allworkOrders->last_observations}}</textarea>
                                      </div>
                              </div>

                            
                              </div>
                          </div>

                      </div>

                      <!-- Fade In Utility -->
                      <div class="col-lg-6">

                          <div class="card position-relative">
                              <div class="card-header py-3">
                                  <h6 class="m-0 font-weight-bold text-primary">Products & Pricing</h6>
                              </div>
                              <div class="card-body">

                     
                              <span id="tableTitle" class="d-none">
                               <div class="title "><h3 style="text:center;color:black;">Preview Products</h3></div>
                                  <div class="row">
                                  <table class="table">
                                      <thead>
                                        <tr>
                                          <th class="mb-0 text-black-800" style="font-family:verdana; font-size:90%; color:#38393b;">Image</th>
                                          <th class="mb-0 text-black-800" style="font-family:verdana; font-size:90%; color:#38393b;">Name</th>
                                          <th class="mb-0 text-black-800" style="font-family:verdana; font-size:90%; color:#38393b;">SKU</th>
                                          <th class="mb-0 text-black-800" style="font-family:verdana; font-size:90%; color:#38393b;">Sell Price</th>
                                          <th class="mb-0 text-black-800" style="font-family:verdana; font-size:90%; color:#38393b;">Quantity</th>
                                        </tr>
                                      </thead>
                                      <tbody class="prodstables" id="prodstables">

                                      </tbody>
                                    </table>
                                </div>
                              </span>


                              <div class="form-row">
                                      <div class="col-md-4">
                                          <label for="" style="color:black;"> <b>Work Labour:</b> </label>
                                            <input  id="worklabor" name="worklabor"
                                              maxlength="191"  value="{{$allworkOrders->worklabor}}"
                                              placeholder="ENTER THE WORK LABOUR / SERVICE AMOUNT " class="form-control" type="text">
                                      </div>

                                      <div class="col-md-4">
                                          <label for="" style="color:black;"> <b>Discount:</b> </label>
                                            <input  id="discount" name="discount"
                                              maxlength="191"  value="{{$allworkOrders->discount}}"
                                              placeholder="ENTER THE DISCOUNT " class="form-control" type="text">
                                      </div>

                                      <div class="form-group col-md-4">
                                          <strong><h6 style="text-align:center; color:black;" ></strong>
                                            <b>Payment Method</b>
                                          </h6>
                                          <select id="typeofpayment" name="typeofpayment" class="form-control">
                                                  @if($allworkOrders->typeofpayment == 'none')
                                                      <option>CASH</option>
                                                      <option>CARD</option>

                                                      @elseif($allworkOrders->typeofpayment == 'CARD')
                                                      <option id="option" value="{{$allworkOrders->typeofpayment}}" selected>{{$allworkOrders->typeofpayment}}</option>
                                                      <option>CASH</option>

                                                      @elseif($allworkOrders->typeofpayment == 'CASH')
                                                      <option id="option" value="{{$allworkOrders->typeofpayment}}" selected>{{$allworkOrders->typeofpayment}}</option>
                                                      <option>CARD</option>
                                                  @endif
                                              </select>
                                    </div>



                                      <input type="text" name="from" class="from" id="from" value="{{$from}}" hidden>


                                      <input  id="amount" name="amount"
                                                  maxlength="191" value="0"
                                                  placeholder="ENTER THE AMOUNT " class="form-control" type="text" hidden>

                                      <input  id="status" name="status"
                                            maxlength="191" value="1"
                                            placeholder="ENTER THE STATUS " class="form-control" type="text" hidden>

                                      <input  id="id" name="id"
                                                    maxlength="191"  value="{{$allworkOrders->id}}"
                                                    placeholder="ENTER THE id "  class="form-control" type="text" hidden>

                                </div>

                            

                            <span id="tableTitle" class="d-none">
                               <div class="title "><h3 style="text:center;color:black;">Preview Products</h3></div>
                                  <div class="row">
                                  <table class="table">
                                      <thead>
                                        <tr>
                                          <th class="mb-0 text-black-800" style="font-family:verdana; font-size:90%; color:#38393b;">Image</th>
                                          <th class="mb-0 text-black-800" style="font-family:verdana; font-size:90%; color:#38393b;">Name</th>
                                          <th class="mb-0 text-black-800" style="font-family:verdana; font-size:90%; color:#38393b;">SKU</th>
                                          <th class="mb-0 text-black-800" style="font-family:verdana; font-size:90%; color:#38393b;">Sell Price</th>
                                          <th class="mb-0 text-black-800" style="font-family:verdana; font-size:90%; color:#38393b;">Quantity</th>
                                        </tr>
                                      </thead>
                                      <tbody class="prodstables" id="prodstables">

                                      </tbody>
                                    </table>
                                </div>
                              </span>

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
                                          <label  for="quantity" style="color:black;"><b>Quantity</b></label>
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
                                      <b>Preview Invoice</b>
                                  </button>


                                  @if(($allworkOrders->status)  == 0)
                                      <button type="submit" class="btn btn-success approveQuotation" id="approveQuotation">
                                        <i class="fa fa-check fa-1x " aria-hidden="true"></i>
                                        <b>Conclude Order and Get Invoice</b>
                                      </button>

                                      <button type="submit" class="btn btn-info readyforcollection" id="readyforcollection">
                                        <b>Ready and waiting for collection</b>
                                      </button>

                                      <hr>

                                      <a  href="/section/workOrder/edit/{{$id}}" type="submit" class="btn btn-primary" style="color:white;"><b>Edit</b></a>
                                      
                                      @if($from =='MachineViewPage')
                                      <a  href="/section/machines/viewPage/{{$allworkOrders->machineId}}" type="submit" class="btn btn-danger" style="color:white;"><b>Back</b></a>
                                      @else
                                          <a href="/section/workOrder/index/"  class="btn btn-danger btn-group">
                                            Back
                                          </a>
                                      @endif
                                  @else
                                          @if($from =='MachineViewPage')
                                          <a  href="/section/machines/viewPage/{{$allworkOrders->machineId}}" type="submit" class="btn btn-danger" style="color:white;"><b>Back</b></a>
                                          @else
                                              <a href="/section/workOrder/index/"  class="btn btn-danger btn-group">
                                                Back
                                              </a>
                                          @endif
                                  @endif

                                  @if(($allworkOrders->status) != 0)
                                      <button  class="btn btn-success markascollected " id="markascollected">
                                          <i class="fa fa-check fa-1x " aria-hidden="true"></i>
                                          <b>Mark as Collected</b>
                                      </button>
                                  @endif

                            </form>
                      </div>

                  </div>

                  </div>
                  <!-- /.container-fluid -->

                  </div>
                  <!-- End of Main Content -->

                      

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




<script>
      $(document).ready(function(){
            // $('#ajaxSubmit').click(function(e){
              $(document).on("click", "#approveQuotation", function(e){
              // alert('teste');

              var worklabor = $('#worklabor').val();
              var quoteReference = $('#quoteReference').val();
              var discount = $('#discount').val();
              var amount = $('#amount').val();
              var status = $('#status').val();
              var id = $('#id').val();
              var typeofpayment = $('#typeofpayment').val();
              var machine = $('#machine').val();
              var productName = $('#productName').val();
              var productQuantity = $('#productQuantity').val();
              var title = $('#title').val();
              var last_observations = $('#last_observations').val();

              // alert(id);

               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               $.ajax({
                  url: "{{ url('/section/py/confirmPaymentAjax') }}",
                  method: 'post',
                  data: {
                      worklabor : worklabor,
                      quoteReference : quoteReference,
                      discount : discount,
                      amount : amount,
                      status : status,
                      id : id,
                      typeofpayment : typeofpayment,
                      machine : machine,
                      productName : productName,
                      productQuantity : productQuantity,
                      title : title,
                      last_observations : last_observations,
                     _token: '{{csrf_token()}}'},

                  success: function(result){
                    // alert('criooooooooooooooou');
                    // console.log(result);
                    wkId = result;
                    window.location.replace("/section/workOrder/showinvoice/" + wkId);


                    // window.location.href = "{{ route('customer.index') }}";
                    //  console.log(result);
                  },
                  error: function(jqXHR, textStatus, errorThrown, result) {
                      // console.log(jqXHR.responseJSON.errors)
                      $msg = 'oi';
                      $resp = jqXHR.responseJSON.errors;
                      $('.prodstables').empty();
                      $('.invalidData').empty();
                      $.each($resp, function (key, value){
                      $(".invalidData").append(`
                          <div class="alert alert-danger">
                              <ul>
                                <li>`+ value +`</li>
                              </ul>
                          </div>
                    `);
                  });
                  }
                  });
               });
            });
</script>


<script>
      $(document).ready(function(){
            // $('#ajaxSubmit').click(function(e){
              $(document).on("click", "#readyforcollection", function(e){
              // alert('teste');

              var worklabor = $('#worklabor').val();
              var quoteReference = $('#quoteReference').val();
              var discount = $('#discount').val();
              var amount = $('#amount').val();
              var status = $('#status').val();
              var id = $('#id').val();
              var typeofpayment = $('#typeofpayment').val();
              var machine = $('#machine').val();
              var productName = $('#productName').val();
              var productQuantity = $('#productQuantity').val();
              var title = $('#title').val();
              var last_observations = $('#last_observations').val();

              // alert(id);

               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               $.ajax({
                  url: "{{ url('/section/py/waitingforcollection') }}",
                  method: 'post',
                  data: {
                      worklabor : worklabor,
                      quoteReference : quoteReference,
                      discount : discount,
                      amount : amount,
                      status : status,
                      id : id,
                      typeofpayment : typeofpayment,
                      machine : machine,
                      productName : productName,
                      productQuantity : productQuantity,
                      title : title,
                      last_observations : last_observations,
                     _token: '{{csrf_token()}}'},

                  success: function(result){
                    // alert('criooooooooooooooou');
                    // console.log(result);
                    wkId = result;
                    window.location.replace("/section/workOrder/showinvoice/" + wkId);


                    // window.location.href = "{{ route('customer.index') }}";
                    //  console.log(result);
                  },
                  error: function(jqXHR, textStatus, errorThrown, result) {
                      // console.log(jqXHR.responseJSON.errors)
                      $msg = 'oi';
                      $resp = jqXHR.responseJSON.errors;
                      $('.prodstables').empty();
                      $('.invalidData').empty();
                      $.each($resp, function (key, value){
                      $(".invalidData").append(`
                          <div class="alert alert-danger">
                              <ul>
                                <li>`+ value +`</li>
                              </ul>
                          </div>
                    `);
                  });
                  }
                  });
               });
            });
</script>


<script>
      $(document).ready(function(){
            // $('#ajaxSubmit').click(function(e){
              $(document).on("click", "#markascollected", function(e){
              // alert('teste');

              var worklabor = $('#worklabor').val();
              var quoteReference = $('#quoteReference').val();
              var discount = $('#discount').val();
              var amount = $('#amount').val();
              var status = $('#status').val();
              var id = $('#id').val();
              var typeofpayment = $('#typeofpayment').val();
              var machineId = $('#machineId').val();
              var productName = $('#productName').val();
              var productQuantity = $('#productQuantity').val();
              var title = $('#title').val();
              var last_observations = $('#last_observations').val();

              // alert(id);

               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               $.ajax({
                  url: "{{ url('/section/allhiremachiness/markascollected') }}",
                  method: 'post',
                  data: {
                      worklabor : worklabor,
                      quoteReference : quoteReference,
                      discount : discount,
                      amount : amount,
                      status : status,
                      id : id,
                      typeofpayment : typeofpayment,
                      machineId : machineId,
                      productName : productName,
                      productQuantity : productQuantity,
                      title : title,
                      last_observations : last_observations,
                     _token: '{{csrf_token()}}'},

                  success: function(result){
                    // alert('criooooooooooooooou');
                    // console.log(result);

                    machineId = result;
                    window.location.replace("/section/machines/viewPage/" + machineId);
                  },
                  error: function(jqXHR, textStatus, errorThrown, result) {
                      // console.log(jqXHR.responseJSON.errors)
                      $msg = 'oi';
                      $resp = jqXHR.responseJSON.errors;
                      $('.prodstables').empty();
                      $('.invalidData').empty();
                      $.each($resp, function (key, value){
                      $(".invalidData").append(`
                          <div class="alert alert-danger">
                              <ul>
                                <li>`+ value +`</li>
                              </ul>
                          </div>
                    `);
                  });
                  }
                  });
               });
            });
</script>


<script type="text/javascript" src="{{ asset('jquery/multiselect/jquery-3.5.1.min.js') }}"></script>


<script>

    $("#discount").on("change",function(){

      var discount = document.getElementById("discount").value;

      if(isNaN(discount)){
            price  = 0.00;
            document.getElementById("discount").value = price.toFixed(2);
        }
        else{
          $(this).val(parseFloat($(this).val()).toFixed(2));
        }
    });

    $("#worklabor").on("change",function(){
      var worklabor = document.getElementById("worklabor").value;

      if(isNaN(worklabor)){
            price  = 0.00;
            document.getElementById("worklabor").value = price.toFixed(2);
        }
        else{
          $(this).val(parseFloat($(this).val()).toFixed(2));
        }
    });

</script>



  </body>

  </html>