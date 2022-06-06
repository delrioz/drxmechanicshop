<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>DIROXA SOFTWARE - WORK ORDER</title>

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
            <form action="/section/workOrder/checarInvoiceSemCadastrar" method="POST" id="registro" name="registro" enctype="multipart/form-data">
              @csrf

                  <section class="testimonial py-3" id="testimonial">
                    <div class="container"  style="box-shadow: 0 4px 12px 0 rgba(0, 0, 2, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.19)">
                        <div class="row ">
                            <div class="col-md-12 py-5 border">
                                    <h5 class="pb-2" style="color:black;"><b>Confirm all Work Order Information to Collect the payment and Generate the invoice.</b></h5>
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
                                        <label for="" style="color:black;"> <b>Customer Report:</b> </label>
                                            <div class="form-group col-md-12">
                                            <input type="text" value="{{$allworkOrders->customer_report}}" name ="customer_report" hidden>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                                    name="customer_report"
                                                    placeholder="Customer Report" id="customer_report" disabled>{{$allworkOrders->customer_report}}</textarea>
                                      </div>
                                </div>


                                <div class="form-row">
                                          <label for="" style="color:black;"> <b>Last Observations:</b> </label>
                                              <div class="form-group col-md-12">
                                              <textarea class="form-control last_observations"  rows="3"
                                                    name="last_observations"  value="{{$allworkOrders->last_observations}}"
                                                      placeholder="last_observations" id="last_observations">{{$allworkOrders->last_observations}}</textarea>
                                </div>


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
                                          <label  for="quantity" style="color:black;"><b>Quantity Used</b></label>
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



                                <div class="row">

                              <div class="form-group col-md-3">
                                    <strong><h6 style="text-align:center; color:black;" ></strong>
                                      <b>WORK LABOUR / SERVICE (GBP)</b>
                                    </h6>
                                    <input  id="worklabor" name="worklabor"
                                      maxlength="191"  value="{{$allworkOrders->worklabor}}"
                                      placeholder="ENTER THE WORK LABOUR / SERVICE AMOUNT " class="form-control" type="text">
                              </div>

                              <input  id="amount" name="amount"
                                                  maxlength="191" value="0"
                                                  placeholder="ENTER THE AMOUNT " class="form-control" type="text" hidden>

                              <input  id="status" name="status"
                                    maxlength="191" value="1"
                                    placeholder="ENTER THE STATUS " class="form-control" type="text" hidden>

                              <input  id="id" name="id"
                                            maxlength="191"  value="{{$allworkOrders->id}}"
                                            placeholder="ENTER THE id "  class="form-control" type="text" hidden>


                                <div class="col-md-3">
                                <strong><h6 style="text-align:center; color:black;" ></strong>
                                <b>DISCOUNT (GBP)</b>
                                </h6>
                                  <input  id="discount" name="discount"
                                      maxlength="191"  value="{{$allworkOrders->discount}}"
                                      placeholder="ENTER THE DISCOUNT " class="form-control" type="text">
                                  </div>

                                  <div class="form-group col-md-3">
                                    <strong><h6 style="text-align:center; color:black;" ></strong>
                                      <b>PAYMENT METHOD</b>
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
                                    
                                    <div class="col-md-3">
                                        <strong><h6 style="text-align:center; color:black;" ></strong>
                                        <b>BIKE'S MILEAGE</b>
                                        </h6>
                                          <input  id="mileage" name="mileage"
                                              maxlength="191"  value="{{$allworkOrders->mileage}}"
                                              placeholder="ENTER THE MILEAGE" class="form-control" type="text">
                                    </div>
                                      
                                  </div>

                                  
                                  @if(($allworkOrders->status)  == 1)
                                      @if($paymentDone == false)
                                        <div class="alert alert-warning" class="">
                                              <p>This Work Order hasn't been paid</p>
                                        </div>
                                      @else
                                        <div class="alert alert-success" class="">
                                                <p>This Work Order its already paid</p>
                                        </div>
                                      @endif
                                  @endif
                                  
                                  
                                  @if(($allworkOrders->status)  == 0)

                                      <button  class="btn btn-warning previewInvoice" id="previewInvoice">
                                          <i class="fa fa-eye fa-1x " aria-hidden="true"></i>
                                          <b>Preview Invoice</b>
                                      </button>

                                      <a type="button" class="btn btn-success" href="/section/allinvoices/index" data-toggle="modal" data-target="#exampleModalConcludingWK">
                                        <i class="fas fa-fw fa-chart-area"></i>
                                        <span>Conclude Work Order</span>
                                      </a>

                                      <button type="submit" class="btn btn-info readyforcollection" id="readyforcollection">
                                        <b>Ready and waiting for collection</b>
                                      </button>

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

                                  @if(($allworkOrders->status)  == 2)
                              
                                      @if($paymentDone == true)
                                        <a class="btn btn-success" type="button" href="/section/machines/viewpage/viewinvoice/{{$id}}">View Invoice</a>
                                      @else
                                    
                                      <a class="btn btn-success approveQuotation" id="approveQuotation" type="button" 
                                              href="/section/machines/viewpage/viewinvoice/{{$id}}"
                                              onclick="return confirm ('Are you sure that you want to collect this Payment?');" >Pay now</a>
                                      @endif
                                  @endif


                                  @if(($allworkOrders->status)  == 2)
                                    @if($paymentDone == true)
                                      <a class="btn btn-primary" 
                                        onclick="return confirm ('Are you sure you want mark as collected and close the Work Order?');" 
                                        type="button" href="/section/workOrder/finishWK/{{$id}}">Mark as collected
                                      </a>
                                    @endif
                                  @endif
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



  <!-- Modal -->
  <div class="modal fade" id="exampleModalConcludingWK" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 style="text-align:center;">Concluding Work Order</h4>
          <div class="row">
            <div class="col-md-6">
              <a href="/section/workOrder/finishWK/{{$allworkOrders->id}}" type="button" class="btn btn-primary">Finish Work Order</a>
            </div>
          <div class="col-md-6">
              <a href="/section/buysection/index/" type="button" class="btn btn-success approveQuotation" id="approveQuotation">Finish Work Order and Get the Payment </a>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!-- end of invoice span -->



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
                    wkId = result;
                    console.log(wkId);

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
