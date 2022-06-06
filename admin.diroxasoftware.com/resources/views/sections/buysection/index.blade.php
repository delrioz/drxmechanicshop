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
  <link href="{{ asset('carrito/css/sweetalert2.min.css') }}" rel="stylesheet">

  


    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>



</head>

      <span>
            @include('sections.components.topnavbar')
      </span>

        <!-- Begin Page Content -->
        <div class="container-fluid">

        <!-- Page Heading -->

        <!-- DataTales Example -->
         <!------ Include the above in your HEAD tag ---------->

            <form action="/section/buysection/finishingbuy" method="POST" id="registro" name="registro" enctype="multipart/form-data">
              @csrf

            <section class="testimonial py-3" id="testimonial">
            <div class="container"  style="box-shadow: 0 4px 12px 0 rgba(0, 0, 2, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.19)" >
                    <div class="row "  >
                        <div class="col-md-12 py-5 border" id="lista-productos">
                            <h4 class="pb-2" style="color:black;"><b>Selecting Products. Please, choose them all to finish the buy.</b></h4>
                            <div class="alert alert-warning">
                                <p>
                                  <a href="/section/sales/allsales">See all sales</a>
                                </p>
                            </div>
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
                            

                            <div class="row">
                                    <div class="form-group col-md-6">
                                        <label style="color:black;"><b>Search for a Customer</b></label>
                                            <input id="searchBox2" name="searchBox2"  id="searchBox2"  placeholder="Search for a Customer"
                                            class="form-control" type="text" >
                                    </div>
                          
                                <div class="form-group col-md-6">
                                    <label style="color:black;"><b>Customer</b></label>
                                        <select id="chooseCustomer" name="chooseCustomer" class="form-control categoriesOptions2">
                                            <option value="0">Choose the Customer</option>
                                        </select>
                                </div>
                            </div>

                            <tbody class="dataTable" id="dataTable">

                            </tbody>

                            <hr>

                            <span id="addProductBtnSpan">
                               <a href="#" class="btn btn-primary" id="addProductBtnSpan" onclick="addproductFunction();"><b>Add a Product</b></a>
                            </span>

                            <span id="chooseProductSpan" class="d-none">

                            <div class="row">
                                    <div class="form-group col-md-6">
                                        <label style="color:black;"><b>Search for a product</b></label>
                                            <!-- <input id="searchBox" name="searchBox"  id="searchBox"  placeholder="Search for a product"
                                                class="form-control" type="text" > -->
                                            <input class="typeahead form-control" name="searchBox"  id="searchBox"  placeholder="Search for a product" type="text">

                                    </div>
                       
                                <div class="form-group col-md-6">
                                    <label style="color:black;"><b>Product</b></label>
                                        <select id="chooseProduct" name="chooseProduct" class="form-control categoriesOptions">
                                            <option value="0">Choose the product</option>
                                        </select>
                                </div>
                            </div>

                            <tbody class="dataTable" id="dataTable">

                            </tbody>

                        <!-- <span id="tableTitle" class="d-none">
                                <div class="title ">
                                    <div class="alert alert-warning">
                                        <h5>Customers Found</h5>
                                    </div>
                                </div>

                                    <div class="row">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Contact Number:</th>
                                            <th>Email</th>
                                            <th scope="col">Actions</th>

                                        </tr>
                                        </thead>
                                        <tbody class="dataTable" id="dataTable">

                                        </tbody>
                                    </table>
                                </div>
                        </span> -->

                                <div class="row">
                                        <div class="form-group col-md-4">
                                        <label style="color:black;"><b>Quantity</b></label>
                                            <input id="quantity" name="quantity"  id="quantity"  placeholder="Search for a product"
                                                value ="1" type="number" >
                                        </div>
                                </div>
                               <button type="button" class="btn btn-success"  id="addToTheCart">Add to the cart</button>
                                    <p>Can't find the product?
                                    <a href="" data-toggle="modal" data-target=".bd-example-modal-lg"> Create product</a></p>
                            </span>

                            </form>
                        </div>
                    </div>

              


                   <main>
                      <div class="container">
                          <div class="row mt-3">
                              <div class="col">
                                  <h2 class="d-flex justify-content-center mb-3">Finalizing Purchase</h2>
                                  <form id="procesar-pago" action="#" method="post">
                                  @csrf


                                      <div id="carrito" class="form-group table-responsive" >
                                          <table class="table" id="lista-compra" >
                                              <thead>
                                                  <tr>
                                                      <th scope="col">Image</th>
                                                      <th scope="col">Name</th>
                                                      <th scope="col">Unit Price (GBP)<br>Including VAT</br></th>
                                                      <th scope="col">Quantity</th>
                                                      <th scope="col" hidden>Total</th>
                                                      <th scope="col" hidden>Sub Total (GBP)<br>(incl Vat)</th>
                                                      <th scope="col">Clean</th>
                                                  </tr>

                                              </thead>
                                              <tbody >

                                              </tbody>
                                              <tr>
                                                  <th colspan="4" scope="col" class="text-right"><b>Sub Total :</b></th>
                                                  <th scope="col">
                                                      <p id="subtotal"></p>
                                                  </th>
                                                  <!-- <th scope="col"></th> -->
                                              </tr>
                                              <tr>
                                                  <th colspan="4" scope="col" class="text-right"><b>Tax :</b></th>
                                                  <th scope="col">
                                                      <p id="igv"></p>
                                                  </th>
                                                  <!-- <th scope="col"></th> -->
                                              </tr>
                                              <tr>
                                                  <th colspan="4" scope="col" class="text-right"><b>Discount (GBP):</b></th>
                                                  <th scope="col">
                                                      <input type="number"  id="discount" class="form-control cantidad" min="0"  value="0">
                                                  </th>
                                                  <!-- <th scope="col"></th> -->
                                              </tr>



                                              <tr>
                                                  <th colspan="4" scope="col" class="text-right">Total :</th>
                                                  <th scope="col">
                                                      <input id="total" name="monto" class="font-weight-bold border-0" readonly style="background-color: white;"></input>
                                                  </th>
                                                  <!-- <th scope="col"></th> -->
                                              </tr>



                                              <tr>
                                                  <th colspan="4" scope="col" class="text-right">Payment Method :</th>
                                                          <th scope="col">
                                                                      <div class="row">
                                                                              <form class="form-inline">
                                                                                  <select class="custom-select my-1 mr-sm-2" id="paymentMethod">
                                                                                      <option value="card">Card</option>
                                                                                      <option value="cash">Cash</option>
                                                                                  </select>
                                                                              </form>
                                                                      </div>
                                                          </th>
                                                  <!-- <th scope="col"></th> -->
                                              </tr>
                                          </table>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Payments</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h2 style="color:black; text-align:center;">Order Amount:</h2>
                                                         <h4 style="color:black; text-align:center;" id="orderAmount" name="orderAmount" class="orderAmount">
                                                         </h4>
                                                         
                                                        <br>

                                                        <div class="form-group">
                                                            <label for="paymentsOptions">Payment Option</label>
                                                            <select class="form-control" id="paymentsOptions">
                                                                <option id=payingToday>PAYING TODAY</option>
                                                                <option id=payingWeekly>PAYING WEEKLY</option>
                                                                <option id=payingMonthly>PAYING MONTHLY</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-row d-none" id="upfrontsection" name="upfrontsection">
                                                            <label for="" style="color:black;"><b> Upfront: </b></label>
                                                                <div class="form-group col-md-12">
                                                                    <input type="number"  id="upfront" class="form-control" min="0"  value="0">
                                                                </div>
                                                        </div>

                                                                            
                                                    <div class="form-row d-none" id="intialpaymentsDateSection" name="intialpaymentsDateSection">
                                                    <label for=""><b>Choose the first payment date</b></label>
                                                            <div class="col-md-12">
                                                                <input type="date" name="intialpaymentsDate" id="intialpaymentsDate">
                                                                <button type="button" class="btn btn-success"  onclick="calculatePayments()" id="calculatePayments" name="calculatePayments"  id="calculatePayments"  >Calculate</button> 
                                                            </div>
                                                        </div><br>

                                                        <span class="upfrontinicial" hidden>
                                                            <input id="upfrontBox" name="upfrontBox"  id="upfrontBox"  
                                                                value="1"
                                                                placeholder="NumberPayments" class="form-control" type="text"
                                                                required >
                                                        </span>


                                                        <input type="text" id="primeiraDatadoPagamento" name="primeiraDatadoPagamento" value="0" hidden>
                                                        
                                                        <span id="NumberPayments" class="NumberPayments">
                                                        </span>

                                                        <span id="datePayments" class="datePayments">

                                                        </span>
                                                        <?php
                                                            $todayDate2 = date("d/m/Y");

                                                        ?>

                                                            <input type="text" id="finalPaymentFix" class="finalPaymentFix" name="finalPaymentFix"
                                                            value="{{$todayDate2}}" hidden>

                                                            <input type="text" id="finalPayment" class="finalPayment" name="finalPayment"
                                                            value="{{$todayDate2}}" hidden>


                                                            <input type="text" id="firstAmountPaid" class="firstAmountPaid" name="firstAmountPaid"
                                                            value="0" hidden>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary btn-block" id="procesar-compra">Confirm Buy</button>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                      </div>

                                      <div class="row justify-content-between">
                                          <div class="col-md-4 mb-2">
                                              <a href="#" ></a>
                                              <a name="atipobutton"  href="/section/sales/allsales" type="button" class="btn btn-danger btn-block redirectKeepBuying" id="redirectKeepBuying">
                                                  Back
                                              </a>
                                          </div>
                                          <div class="col-xs-12 col-md-4">
                                              <button type="button" class="btn btn-success btnBuy btn-block" id="btnBuy" data-toggle="modal" data-target="#exampleModal">Buy</button>
                                          </div>
                                      </div>
                                  </form>
                                  <div class="row text-center" id="h5" >
                              </div>
                              </div>
                          </div>
                      </div>
                  </main>
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



        <!-- add product modal -->
            <!-- Large modal -->
                <div class="modal fade bd-example-modal-lg"  id="modalproduct" name="modalproduct" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="container-fluid">
                        <form action="/section/products/store" method="POST" id="registro" name="registro" enctype="multipart/form-data">
                            @csrf
                            <section class="testimonial py-3" id="testimonial">
                                    <div class="container"  style="box-shadow: 0 4px 12px 0 rgba(0, 0, 2, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.19)">
                                        <div class="row ">
                                            <div class="col-md-12 py-5 border">
                                                <h4 class="pb-2" style="color:black;"><b>Creating a Product</b></h4>

                                        @if($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                        @endif


                                        <div class="invalidData" role="alert">
                                        </div>

                                        @if(session('warning'))
                                                    <div class="alert alert-info">
                                                        {{ session('warning') }}
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                        @endif

                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                        <label for="" style="text-align:center;color:black;"><b>Name</b></label>
                                                            <input id="Formname" name="Formname"  id="Formname"
                                                            value="{{ old('Formname') }}"
                                                            placeholder="Name" class="form-control" type="text"
                                                            required>
                                                        </div>

                                            <div class="form-group col-md-6">
                                                <label for="" style="text-align:center;color:black;"><b>SKU</b></label>
                                                        <input id="FormSKU" name="FormSKU"
                                                            value="{{ old('FormSKU') }}"
                                                                maxlength="191"
                                                                placeholder="SKU" class="form-control" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                            <label for="" style="color:black;"><b>Category</b></label>
                                                                <select id="Formcategory" name="Formcategory" class="form-control categoriesOptions5" >
                                                                        @foreach($allcategories as $allcategory)
                                                                        <option value="{{$allcategory->id}}">{{$allcategory->name}}</option>
                                                                        @endforeach
                                                                </select>

                                                            or <a href="/newone" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><b>Add new Category</b></a>
                                                </div>
                                                
                                                <div class="form-group col-md-6">
                                                <label for="" style="text-align:center;color:black;"><b>Brand</b></label>
                                                <input id="Formbrand" name="Formbrand"
                                                                maxlength="191"
                                                                value="{{ old('Formbrand') }}"
                                                                placeholder="brand" class="form-control" type="text">
                                                </div>
                                            </div>

                                                    <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                    <label for="" style="text-align:center;color:black;"><b>Sell Price (GBP)</b></label>
                                                    <input id="FormSell_Price" name="FormSell_Price"
                                                            value="{{ old('FormSell_Price') }}"
                                                            maxlength="191" onchange="myFunction()"
                                                            placeholder="Sell Price " class="form-control" type="text"
                                                                required>
                                                    </div>

                                                    <div class="form-group  col-md-6" id="divPriceWithVat" name="divPriceWithVat">
                                                    <label for="" style="text-align:center;color:black;"><b>Sell Price with 20% vat</b></label>
                                                        <input id="FormSell_PriceVat" name="FormSell_PriceVat"
                                                                maxlength="191"
                                                                placeholder="Sell Price Vat" class="form-control"
                                                                type="text"  value="{{ old('FormSell_PriceVat') }}"
                                                                onchange="vatToNormalPrice()"
                                                                required>
                                                    </div>

                                                    <div>
                                                    </div>
                                                </div>

                                            <div>
                                            <input type="checkbox" id="vatFree" name="vatFree">
                                            <label for="vatFree">Vat Free</label>
                                            </div>
                                                
                                            <div class="form-row">

                                                <div class="form-group col-md-6">
                                                <label for="" style="text-align:center;color:black;"><b>Quantity</b></label>
                                                       <input id="Formqtd" name="Formqtd"  id="Formqtd"
                                                            value="{{ old('Formqtd') }}"
                                                            placeholder="Quantity" class="form-control" type="text"
                                                            required>
                                                </div>

                                    
                                                <div class="form-group col-md-6">
                                                        <label for="" style="text-align:center;color:black;"><b>Cost Price (GBP)</b></label>
                                                        <input id="FormCost_Price" name="FormCost_Price"
                                                                maxlength="191" value="{{ old('FormCost_Price') }}"
                                                                placeholder="Cost Price" class="form-control" type="text"
                                                                required>
                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="form-group col-md-6">
                                                <label for="" style="color:black;"><b>Supplier</b></label>
                                                    <select id="Formsupplier" name="Formsupplier" class="form-control" >
                                                            @foreach($allSuppliers as $allsupplier)
                                                            <option value="{{$allsupplier->id}}">{{$allsupplier->name}}</option>
                                                            @endforeach
                                                    </select>
                                                or <a href="/section/suppliers/create" ><b>Add new Supplier</b></a>
                                    </div>

                                                 <div class="form-group col-md-6">
                                                       <label for="" style="color:black;"><b>Condition</b></label>
                                                                <select id="Formcondition" name="Formcondition" class="form-control" >
                                                                <option >NEW</option>
                                                                <option>USED</option>
                                                            </select>
                                                </div>
                                </div>


                                                <!-- <div class="form-group">
                                                    <div class="form-group col-md-12">
                                                @if(count($allmachines)  > 0)
                                                    <label for="">Machines</label>
                                                        @foreach($allmachines as $machines)
                                                        <div class="checkbox">
                                                    <input type="checkbox" name="Machinesoptions[]"  id="option" value="{{$machines->id}}">{{$machines->model}}
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                @endif
                                                </div> -->


                                                <input type="checkbox" id="outgoingcheck" name="outgoingcheck">
                                                <label for="vehicle1"> Add to outgoing tables</label><br>

                                                    <button type="button" class="btn btn-success" id="createProductAjax">
                                                    <i class="fa fa-check fa-1x " aria-hidden="true"></i>
                                                    <b>Create Product</b></button>
                                                    <a type="button" href="{{route('welcome') }}"  class="btn btn-danger"><b>Back</b></a>
                                            </form>
                        </div>
                    </div>
                </div>
        </div>
<!-- end add product modal -->



<script>
      $(document).ready(function(){
        // alert(1);

            // $('#ajaxSubmit').click(function(e){
              $(document).on("change", "#searchBox", function(e){

                var inputSearch = searchBox.value;
                // alert(inputSearch);
                // var comboCidades = $('#mselect option:selected').val();

               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               $.ajax({
                  url: "{{ url('/home/searchingProductsAjax') }}",
                  method: 'post',
                  data: {
                     data: inputSearch,
                     _token: '{{csrf_token()}}'},

                  success: function(result){


                    $resp = result;
                    console.log('777');
                    console.log($resp);

                    if($resp == 0){
                        alert('Nothing was found matching this datas');
                        $('#dataTable').empty();
                        $("#tableTitle").addClass("d-none")
                        document.getElementById('searchBox').value = '';
                    }

                    else{

                      $("#tableTitle").removeClass("d-none");
                      $('#dataTable').empty();

                    $('.categoriesOptions').empty();
                        $resp = result;
                        // console.log(result);

                        $.each($resp, function (key, value){
                        var sellpriceformated = (value.Sell_PriceVat).toFixed(2);
                        $(".categoriesOptions").append(`
                        <option value="`+ value.id + `">`+ value.name + "| Price with Vat:  £" + sellpriceformated + `</option>
                    `);
                  });
                  } // fim do else
                  },
                  error: function(jqXHR, textStatus, errorThrown, result) {
                      // console.log(jqXHR.responseJSON.errors)

                      Alert('Some ERROR try again');
                      $msg = 'oi';
                      $resp = jqXHR.responseJSON.errors;
                      $('.dataTable').empty();
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
        // alert(1);

            // $('#ajaxSubmit').click(function(e){
              $(document).on("click", "#btnBuy", function(e){
                  e.preventDefault();
                    //   alert(1);
                  total = document.getElementById("total").value;

                  var newtotalvalue = document.title = total.replace('£/. ', ''); // vai mudar o titulo removendo "STACK"
                   //   document.getElementById('orderAmount').value = newtotalvalue; 
                  // document.getElementById('orderAmount').value = '';
                  //  $('#orderAmount').empty();
                 document.getElementById('orderAmount').innerHTML = "£" + newtotalvalue;

               });
            });
</script>

<script>
      $(document).ready(function(){
        // alert(1);

            // $('#ajaxSubmit').click(function(e){
              $(document).on("change", "#upfront", function(e){
                  e.preventDefault();
                    upfront = document.getElementById("upfront").value;
                    var totalvalue = document.getElementById('total').value;
                    var newtotalvalue = document.title = total.replace('£/. ', ''); // vai mudar o titulo removendo "STACK"
                    
                    // alert(upfront);
                    // alert(newtotalvalue);
                    //   var newtotalvalue = document.title = total.replace('£/. ', ''); // vai mudar o titulo removendo "STACK"
                    //    //   document.getElementById('orderAmount').value = newtotalvalue; 
                    //   // document.getElementById('orderAmount').value = '';
                    //   //  $('#orderAmount').empty();
                    //  document.getElementById('orderAmount').innerHTML = "£" + newtotalvalue;
               });
            });
</script>







<script>
      $(document).ready(function(){
        // alert(1);

            // $('#ajaxSubmit').click(function(e){
              $(document).on("change", "#searchBox2", function(e){

                var inputSearch2 = searchBox2.value;
                // alert(inputSearch2);
                // var comboCidades = $('#mselect option:selected').val();

               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               $.ajax({
                url: "{{ url('/home/searchingCustomerAjaxByBuySection') }}",
                  method: 'post',
                  data: {
                     data: inputSearch2,
                     _token: '{{csrf_token()}}'},

                  success: function(result){

                    $resp = result;
                    console.log($resp);

                    if($resp == 0){
                        alert('Nothing was found matching this datas');
                        $('#dataTable').empty();
                        $("#tableTitle").addClass("d-none")
                        document.getElementById('searchBox').value = '';
                    }

                    else{

                    //   $("#tableTitle").removeClass("d-none")
                    //   $('#dataTable').empty();

                    $('.categoriesOptions2').empty();
                        $resp = result;
                        // console.log(result);

                        $.each($resp, function (key, value){
                        $(".categoriesOptions2").append(`
                         <option value="`+ value.id + `">`+ value.name + `</option>
                    `);
                  });
                  } // fim do else
                  },
                  error: function(jqXHR, textStatus, errorThrown, result) {
                      // console.log(jqXHR.responseJSON.errors)
                      Alert('Some ERROR try again');
                      $msg = 'oi';
                      $resp = jqXHR.responseJSON.errors;
                      $('.dataTable').empty();
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
              $(document).on("change", "#searchBox", function(e){
                var inputSearch = searchBox.value;

                var newtotalvalue = document.title = total.replace('£/. ', ''); // vai mudar o titulo removendo "STACK"
                document.getElementById('firstAmountPaid').value = newtotalvalue; 

                // alert(inputSearch);
                // var comboCidades = $('#mselect option:selected').val();

               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               $.ajax({
                  url: "{{ url('/home/searchingProductsAjax') }}",
                  method: 'post',
                  data: {
                     data: inputSearch,
                     _token: '{{csrf_token()}}'},

                  success: function(result){

                    $resp = result;
                    // console.log($resp);

                    if($resp == 0){
                        alert('Nothing was found matching this datas');
                        $('#dataTable').empty();
                        $("#tableTitle").addClass("d-none")
                        document.getElementById('searchBox').value = '';
                    }

                    else{

                    //   $("#tableTitle").removeClass("d-none")
                    //   $('#dataTable').empty();

                    $('.categoriesOptions').empty();
                        $resp = result;
                        // console.log(result);

                        $.each($resp, function (key, value){
                        var sellpriceformated = (value.Sell_PriceVat).toFixed(2);
                        $(".categoriesOptions").append(`
                        <option value="`+ value.id + `">`+ value.name + "| Price with Vat:  £" + sellpriceformated + `</option>
                    `);
                  });
                  } // fim do else
                  },
                  error: function(jqXHR, textStatus, errorThrown, result) {
                      // console.log(jqXHR.responseJSON.errors)
                      Alert('Some ERROR try again');
                      $msg = 'oi';
                      $resp = jqXHR.responseJSON.errors;
                      $('.dataTable').empty();
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

      function zeroFill(n){
          return n < 9? `0${n}` : `${n}`;
      }

      function  formatDate(date){
          const d = zeroFill(date.getDate());
          const mo = zeroFill(date.getMonth() + 1);
          const y = zeroFill(date.getFullYear());
          const h = zeroFill(date.getHours());
          const mi = zeroFill(date.getMinutes());
          const s = zeroFill(date.getSeconds());

          return `${d}/${mo}/${y}`;
      }

</script>


<script>
      $(document).ready(function(){
        // alert(1);
            // $('#ajaxSubmit').click(function(e){
              $(document).on("change", "#paymentsOptions", function(e){

                var inputSearch2 = searchBox2.value;
                // alert(inputSearch2);
                var paymentsOptions = $('#paymentsOptions option:selected').val();
                let allpaymentsDates = [];

                // var todayDate  = new Date();


                e.preventDefault();
                // <input type="text" id="primeiraDatadoPagamento" name="primeiraDatadoPagamento" value="0">

              
                if(paymentsOptions == "PAYING TODAY"){

                        $('#upfrontsection').empty();
                        $('.NumberPayments').empty();
                        $('.datePayments').empty();
                        $("#upfrontsection").classList.add("d-none");
                        $("#intialpaymentsDateSection").classList.add("d-none");
                        $("#intialpaymentsDateSection").removeClass("d-none");


                        $("#upfrontsection").append(`
                                    <div class="form-group col-md-12" hidden>
                                        <input type="number"  id="upfront" class="form-control" min="0"  value="0">
                                    </div>
                    `);

                        
                        var todayDate = $('#finalPaymentFix').val();
                        var firstAmountPaid = $('#firstAmountPaid').val();
                        document.getElementById('finalPayment').value = todayDate;
                        // var newtotalvalue = document.title = total.replace('£/. ', ''); // vai mudar o titulo removendo "STACK"
                        // document.getElementById('firstAmountPaid').value = newtotalvalue;
                        allpaymentsDates.push(todayDate);
                        // alert(allpaymentsDates);

                        $(".NumberPayments").append(`
                                    <input id="upfrontBox" name="upfrontBox"  id="upfrontBox"   hidden
                                        value="1"
                                        placeholder="NumberPayments" class="form-control" type="text"
                                        required>
                            `);
                }

                else {
                
                    $('.NumberPayments').empty();
                    $('.upfrontinicial').empty();

                    $('#upfrontsection').empty();

                    $("#upfrontsection").append(`
                            <label for="" style="color:black;"><b> Upfront: </b></label>
                                    <div class="form-group col-md-12">
                                        <input type="number"  id="upfront" class="form-control" min="0"  value="0">
                                    </div>
                    `);

                        
                        $(".NumberPayments").append(`
                     
                            <label> Number of Payments? </label>
                                <input id="upfrontBox" name="upfrontBox"  id="upfrontBox"  
                                    value="1"
                                    placeholder="NumberPayments" class="form-control" type="text"
                                    required>
                        `);

                        var Npayments = upfrontBox.value;
                        total = document.getElementById("total").value;
                        var newtotalvalue = document.title = total.replace('£/. ', ''); // vai mudar o titulo removendo "STACK"
                        upfront = document.getElementById("upfront").value;
                        var newValueWithUpfront = newtotalvalue - upfront;
                        var tot = newValueWithUpfront / Npayments;

                        // alert(tot);

                        const date = new Date();

                        // var dateFormated = formatDate(date);

                        // alert(123);
                        if(paymentsOptions == "PAYING WEEKLY"){
                        // alert(7777);

                        $('.Npayments').empty();
                        $('.datePayments').empty();
                        $("#upfrontsection").removeClass("d-none");
                        $("#intialpaymentsDateSection").removeClass("d-none");

                   

                        for(a =0; a<=Npayments-1; a++){
                            newA = Number(a+1);
                            newTot = Number(tot).toFixed(2);

                            if(a == 0){
                                const date = new Date();
                                var dateFormated = formatDate(date);
                            }
                            else{
                                formatedDate = date.setDate(date.getDate() + 7);
                                var dateFormated = formatDate(date);
                            }

                            
                            document.getElementById('finalPayment').value = dateFormated;
                            document.getElementById('firstAmountPaid').value = newTot;
                            allpaymentsDates.push(dateFormated);
                            // alert(allpaymentsDates);
          

                            $(".datePayments").append(`
                                    <ul>
                                        <li> Amount: £`+ newTot   +`| `+ newA +`º payment will be: `+ dateFormated + `</li>
                                    </ul>
                                `);
                       
                        }
                    }

                    else if(paymentsOptions == "PAYING MONTHLY"){

                        $('.datePayments').empty();
                        $('.Npayments').empty();
                        $("#upfrontsection").removeClass("d-none");
                        $("#intialpaymentsDateSection").removeClass("d-none");



                        for(a =0; a<=Npayments-1; a++){
                            newA = Number(a+1);
                            newTot = Number(tot).toFixed(2);

                            if(a == 0){
                                const date = new Date();
                                var dateFormated = formatDate(date);
                            }
                            else{
                                formatedDate = date.setMonth(date.getMonth() + 1);
                                var dateFormated = formatDate(date);
                            }


                            document.getElementById('finalPayment').value = dateFormated;
                            document.getElementById('firstAmountPaid').value = newTot;
                            allpaymentsDates.push(dateFormated);

                            // alert(allpaymentsDates);

                            $(".datePayments").append(`
                                <ul>
                                    <li> Amount: £`+ newTot   +`| `+ newA +`º payment will be: `+ dateFormated + `</li>
                                </ul>
                            `);
                        }
                     }
                }
               });
            });
</script>

<script>
      $(document).ready(function(){
        // alert(1);

            // $('#ajaxSubmit').click(function(e){
              $(document).on("click", "#calculatePayments", function(e){
                var paymentsOptions = $('#paymentsOptions option:selected').val();

                // var Npayments = upfrontBox.value;
                // total = document.getElementById("total").value;
                // var newtotalvalue = document.title = total.replace('£/. ', ''); // vai mudar o titulo removendo "STACK"
                // var tot = newtotalvalue / Npayments;

                var Npayments = upfrontBox.value;
                total = document.getElementById("total").value;
                var newtotalvalue = document.title = total.replace('£/. ', ''); // vai mudar o titulo removendo "STACK"
                upfront = document.getElementById("upfront").value;
                var newValueWithUpfront = newtotalvalue - upfront;
                var tot = newValueWithUpfront / Npayments;
                
                intialpaymentsDate = document.getElementById("intialpaymentsDate").value;
                // alert(intialpaymentsDate);

                if(intialpaymentsDate == "" || intialpaymentsDate == NaN)
                {
                    intialpaymentsDate = new Date();
                }
                else 
                {
                    intialpaymentsDate = intialpaymentsDate;
                }

                var outraData = new Date(intialpaymentsDate);
                var newDay = outraData.getDate();
                var newMonth = outraData.getMonth() + 1; // pois a contagem dos meses começa do 0
                var newYear = outraData.getFullYear();
                if(newDay < 10){
                      newDay = `0${newDay}`;
                }

                if(newMonth < 10){
                    newMonth = `0${newMonth}`;
                }
                var dateJustCreated = `${newDay}/${newMonth}/${newYear}`;


                const date = dateJustCreated;
                // var dateFormated = formatDate(date);
                

                let allpaymentsDates = [];


                if(paymentsOptions == "PAYING WEEKLY"){
                    $('.Npayments').empty();
                    $('.datePayments').empty();
                    var outraData2 = new Date(intialpaymentsDate);


                    for(a =0; a<=Npayments-1; a++){
                        newA = Number(a+1);
                        newTot = Number(tot).toFixed(2);

                        if(a == 0){
                             var dateFormated = date;
                             var  primeiraDatadoPagamento = date;
                        }
                        else{
                            formatedDate = outraData2.setDate(outraData2.getDate() + 7);
                            var dateFormated = formatDate(outraData2);
                        }



                        allpaymentsDates.push(dateFormated);
                        
                        document.getElementById('primeiraDatadoPagamento').value = primeiraDatadoPagamento;
                        document.getElementById('finalPayment').value = dateFormated;
                        document.getElementById('firstAmountPaid').value = newTot;

                        $(".datePayments").append(`
                                <ul>
                                    <li> Amount: £`+ newTot   +`| `+ newA +`º payment will be: `+ dateFormated + `</li>
                                </ul>
                            `);
                    }
                }

                else if(paymentsOptions == "PAYING MONTHLY"){
                    $('.datePayments').empty();
                    $('.Npayments').empty();
                    var outraData3 = new Date(intialpaymentsDate);

                    for(a =0; a<=Npayments-1; a++){
                        newA = Number(a+1);
                        newTot = Number(tot).toFixed(2);

                        if(a == 0){
                            var dateFormated = date;
                            var  primeiraDatadoPagamento = date;
                        }
                        else{
                            formatedDate = outraData3.setMonth(outraData3.getMonth() + 1);
                            var dateFormated = formatDate(outraData3);
                        }

                        // alert(12);

                        allpaymentsDates.push(dateFormated);
                        // alert(primeiraDatadoPagamento);
                        // alert(allpaymentsDates);
                        
                        document.getElementById('primeiraDatadoPagamento').value = primeiraDatadoPagamento;
                        document.getElementById('finalPayment').value = dateFormated;
                        document.getElementById('firstAmountPaid').value = newTot;

                        $(".datePayments").append(`
                            <ul>
                                <li> Amount: £`+ newTot   +`| `+ newA +`º payment will be: `+ dateFormated + `</li>
                            </ul>
                        `);
                    }
                }
                
                e.preventDefault();


               });
            });
</script>





<script>
      $(document).ready(function(){
        // alert(1);

            // $('#ajaxSubmit').click(function(e){
              $(document).on("click", "#addToTheCart", function(e){

                var chooseProduct = $('#chooseProduct option:selected').val();
                var quantity = $('#quantity').val();
                var inputSearch = chooseProduct;

               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               $.ajax({
                  url: "{{ url('/home/searchingProductsAjaxById') }}",
                  method: 'post',
                  data: {
                     data: inputSearch,
                     _token: '{{csrf_token()}}'},

                  success: function(result){
                    
                    $resp = result;
                    // console.log($resp);

                    if($resp == 0){
                        alert('Nothing was found matching this datas');
                        $('#dataTable').empty();
                        $("#tableTitle").addClass("d-none")
                        document.getElementById('searchBox').value = '';
                    }

                    else{

                        $("#tableTitle").removeClass("d-none")
                        $resp = result;
                        let productos;
                        // console.log(result.id);

                        const infoProducto = {
                            imagen : result.image,
                            titulo: result.name,
                            precio: result.Sell_Price,
                            id: result.id,
                            //pega  quantidade
                            cantidad: quantity,
                            SKU: result.SKU,
                            // discount: 0,
                            precioConVAT: result.Sell_PriceVat,
                            // cantidad: producto.getElementById('cantidadContent').textContent,
                        }

                        leerDatosProducto(infoProducto); // EBDCAQUI
                        // alert(sellpricetot);
                     } // fim do else
                  },
                  error: function(jqXHR, textStatus, errorThrown, result) {
                        // console.log(jqXHR.responseJSON.errors)
                        Alert('Some ERROR try again');
                        $msg = 'oi';
                        $resp = jqXHR.responseJSON.errors;
                        $('.dataTable').empty();
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
        // alert(1);
            // $('#ajaxSubmit').click(function(e){
              $(document).on("click", "#createProductAjax", function(e){
                // alert('123 brrando');
            });
        });
</script> 



<script>
      $(document).ready(function(){
        // alert(1);

            // $('#ajaxSubmit').click(function(e){
              $(document).on("click", "#createProductAjax", function(e){
                // alert(inputSearch);

                var Formname = $('#Formname').val();
                var FormSKU = $('#FormSKU').val();
                var Formcategory = $('#Formcategory option:selected').val();
                var Formbrand = $('#Formbrand').val();
                var FormSell_Price = $('#FormSell_Price').val();
                var FormSell_PriceVat = $('#FormSell_PriceVat').val();
                var Formquantity = $('#Formqtd').val();
                var Formcondition = $('#Formcondition').val();    
                var Formsupplier = $('#Formsupplier option:selected').val();
                var FormCost_Price = $('#FormCost_Price').val();
                var about = $('#exampleFormControlTextarea1').val();
                var image = $('#exampleFormControlFile1').val();
                var outgoingcheck = document.getElementById("outgoingcheck").checked;


                // var outgoingcheck = $('#outgoingcheck option:selected').val();
                // var outgoingcheck = $('#outgoingcheck').val();

               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               $.ajax({
                  url: "{{ url('/section/products/addProductsAjax') }}",
                  method: 'post',
                  data: {
                     Formname: Formname,
                     FormSKU:FormSKU,
                     Formcategory:Formcategory,
                     Formbrand:Formbrand,
                     FormSell_Price:FormSell_Price,
                     FormSell_PriceVat:FormSell_PriceVat,
                     Formquantity:Formquantity,
                     Formcondition:Formcondition,
                     Formsupplier:Formsupplier,
                     FormCost_Price:FormCost_Price,
                     outgoingcheck:outgoingcheck,

                     _token: '{{csrf_token()}}'},

                  success: function(result){

                    $resp = result;

                    // $('#modalproduct').modal('toggle');
                    $('#modalproduct').modal('hide');
                    $('#modal-content').modal('toggle');
                    $('.invalidData').empty();


                    var padrao = "";
                  
                    document.getElementById('Formname').value = padrao;
                    document.getElementById('FormSKU').value = padrao;
                    document.getElementById('Formbrand').value = padrao;
                    document.getElementById('FormSell_Price').value = padrao;
                    document.getElementById('FormSell_PriceVat').value = padrao;

                    document.getElementById('Formqtd').value = padrao;
                    document.getElementById("FormCost_Price").value = padrao;

                    

                    // document.getElementById('serial_number').value = '';
                    //   document.getElementById('model').value = '';
                    //   document.getElementById('brand').value = '';
                    //   document.getElementById('mileage').value = '';
                    //   document.getElementById('observations').value = '';

                    // var FormSKU = $('#FormSKU').val();
                    // var Formcategory = $('#Formcategory option:selected').val();
                    // var Formbrand = $('#Formbrand').val();
                    // var FormSell_Price = $('#FormSell_Price').val();
                    // var FormSell_PriceVat = $('#FormSell_PriceVat').val();
                    // var Formquantity = $('#Formqtd').val();
                    // var Formcondition = $('#Formcondition').val();    
                    // var Formsupplier = $('#Formsupplier option:selected').val();
                    // var FormCost_Price = $('#FormCost_Price').val();
                    // var about = $('#exampleFormControlTextarea1').val();
                    // var image = $('#exampleFormControlFile1').val();
                    // var outgoingcheck = document.getElementById("outgoingcheck").checked;


                    // once the new product is added

                    
                        $("#tableTitle").removeClass("d-none");
                        $('#dataTable').empty();

                        $('.categoriesOptions').empty();
                        // console.log(777);
                        // console.log($resp);

                        var sellpriceformated = ($resp.Sell_PriceVat);

                        $(".categoriesOptions").append(`
                                <option value="`+ $resp.id + `">`+ $resp.name + "| Price with Vat:  £" + sellpriceformated + `</option>
                        `);
                  },
                  error: function(jqXHR, textStatus, errorThrown, result) {
                        // console.log(jqXHR.responseJSON.errors)
                        
                        // alert('Some ERROR try again');
                        $msg = 'oi';
                        $resp = jqXHR.responseJSON.errors;
                        $('.dataTable').empty();
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
                $(document).on("click", "#removeRow", function(e){
                $(this).parent().parent().remove();
                e.target.parentElement.parentElement.remove();
                producto = e.target.parentElement.parentElement;
                productoID = producto.querySelector('a').getAttribute('data-id');
                productoID2 = Number(productoID);
                // alert(productoID2);
                eliminarProductoLocalStorage(productoID2);


                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/section/products/getProdsAjax') }}",
                    method: 'post',
                    data: {
                      data: valor,
                      _token: '{{csrf_token()}}'},

                    success: function(result){

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

    //Leer datos del producto
    function leerDatosProducto(infoProducto){

        let productosLS;
        productosLS = this.obtenerProductosLocalStorage();
        productosLS.forEach(function (productoLS){
            if(productoLS.id === infoProducto.id){
                // console.log(productoLS);
                productosLS = productoLS.id;
            }
        });

        if(productosLS === infoProducto.id){
            // alert('olá, mundo');
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'This product is already added in your basket, try another one',
                showConfirmButton: false,
                timer: 2000
            })
        }
        else {
            this.insertarCarrito(infoProducto);
        }
    }

    //muestra producto seleccionado en carrito
    // O CARRINHO É AQUI

    function insertarCarrito(producto){
        this.guardarProductosLocalStorage(producto);
    }

     //Comprobar que hay elementos en el LS
     function obtenerProductosLocalStorage(){
        let productoLS;

        //Comprobar si hay algo en LS
        if(localStorage.getItem('productos') === null){
            productoLS = [];
        }
        else {
            productoLS = JSON.parse(localStorage.getItem('productos'));
        }
        return productoLS;
    }

    //Almacenar en el LS
    function guardarProductosLocalStorage(producto)
    {
        let productos;
        //Toma valor de un arreglo con datos del LS
        productos = this.obtenerProductosLocalStorage();
        //Agregar el producto al carrito
        var a = productos.push(producto);
        //Agregamos al LS
        // console.log(a);
        // console.log('a');
        // console.log(a);
        localStorage.setItem('productos', JSON.stringify(productos));

        const listaCompra = document.querySelector("#lista-compra tbody");

        let productosLS;
            const row = document.createElement('tr');
            var vatsubtotales = producto.precio * 0.20;
            var vatsubtotalesArredondado = parseFloat(vatsubtotales.toFixed(2));


            var subtotales = (producto.precio * producto.cantidad) + producto.precio * 0.20;
            var subtotalesArredondado = parseFloat(subtotales.toFixed(2));
            var novosubtotal = (producto.precio * 1.20).toFixed(2);
            var precioConVAT = (producto.precioConVAT).toFixed(2);

            // console.log(producto);

            row.innerHTML = `
                <td>
                    <img src="/storage/${producto.imagen}" style="width: 140px; height: 140px;!important">
                </td>
                <td>${producto.titulo}</td>
                <td>${precioConVAT}</td>
                <td>
                    <input type="number" class="form-control cantidad" id="quantity"  min="1" value=${producto.cantidad}>
                </td>

                <td id='vatsubtotales' hidden>${vatsubtotalesArredondado}</td>
                <td id='subtotales' hidden>${novosubtotal}</td>
                <td>

                    <a href="#" class="removeRow fas fa-times-circle"  id="removeRow" name="removeRow"  style="font-size:30px" data-id="${producto.id}"></a>
                </td>
            `;
            listaCompra.appendChild(row);
            calcularTotal();
    }


    function  leerLocalStorageCompra(){
        let productosLS;
        productosLS = this.obtenerProductosLocalStorage();
        productosLS.forEach(function (producto){
            const row = document.createElement('tr');
            var vatsubtotales = producto.precio * 0.20;
            var vatsubtotalesArredondado = parseFloat(vatsubtotales.toFixed(2));


            var subtotales = (producto.precio * producto.cantidad) + producto.precio * 0.20;
            var subtotalesArredondado = parseFloat(subtotales).toFixed(2);

            var novosubtotal = (producto.precio * 1.20).toFixed(2);
            var precioConVAT = (producto.precioConVAT).toFixed(2);


            row.innerHTML = `
                <td>
                    <img src="/storage/${producto.imagen}" width=100>

                </td>
                <td>${producto.titulo}</td>
                <td>${precioConVAT}</td>
                <td>
                    <input type="number" class="form-control cantidad" id="quantity"  min="1" value=${producto.cantidad}>
                </td>

                <td id='vatsubtotales' hidden>${vatsubtotalesArredondado}</td>
                <td id='subtotales' hidden>${novosubtotal}</td>
                <td>

                    <a href="#" class="removeRow fas fa-times-circle"  id="removeRow" name="removeRow"  style="font-size:30px" data-id="${producto.id}"></a>
                </td>
            `;
            const listaCompra = document.querySelector("#lista-compra tbody");
            listaCompra.appendChild(row);
        });
    }


    function calcularTotal(){

        let productosLS;
        let total = 0, igv = 0, subtotal = 0, vat = 0, discount = 0 ;
        productosLS = this.obtenerProductosLocalStorage();
        discount = document.getElementById("discount").value;
        for(let i = 0; i < productosLS.length; i++){
         // Total dos discontos
            // let elementDiscount = Number(productosLS[i].discount);
            // discount = discount + elementDiscount;

          // subtotal, SEM O VAT
            let element = Number(productosLS[i].precio * productosLS[i].cantidad);
            subtotal = subtotal + element;

          // total com vat
           let elementVAT = Number(productosLS[i].precioConVAT) *  Number(productosLS[i].cantidad);
            total = total + elementVAT;

          // total DO vat
            let elementTotalVAT = Number((productosLS[i].precioConVAT - productosLS[i].precio) *  Number(productosLS[i].cantidad));
            vat = vat + elementTotalVAT;

        }


        var totalWithDiscount = total  - discount;


        igv = parseFloat(total * 0.20).toFixed(2);
        // subtotal = parseFloat(total-igv).toFixed(2);

        document.getElementById('subtotal').innerHTML = "£/. " + subtotal.toFixed(2);
        document.getElementById('igv').innerHTML = "£/. " + vat.toFixed(2);
        // document.getElementById('discount').value = "£/. " + discount.toFixed(2);
        document.getElementById('total').value = "£/. " + totalWithDiscount.toFixed(2);
    }

      //Eliminar producto por ID del LS
      function eliminarProductoLocalStorage(productoID){
        let productosLS;
        // alert('ja passou');
        // alert(productoID);

        //Obtenemos el arreglo de productos
        productosLS = this.obtenerProductosLocalStorage();
        // console.log(productosLS);

        //Comparar el id del producto borrado con LS
        productosLS.forEach(function(productoLS, index){
            if(productoLS.id === productoID){
                productosLS.splice(index, 1);
            }
        });

        //Añadimos el arreglo actual al LS
        localStorage.setItem('productos', JSON.stringify(productosLS));
        calcularTotal();
    }


    function obtenerEvento(e) {
        // alert('obtenerEvento');
        e.preventDefault();
        let id, cantidad, producto, productosLS;
        if (e.target.classList.contains('cantidad')) {
            // alert('fdsfsdfsdfsd');
            producto = e.target.parentElement.parentElement;
            id = producto.querySelector('a').getAttribute('data-id');
            cantidad = producto.querySelector('input').value;
            let actualizarMontos = document.querySelectorAll('#subtotales');
            let actualizarVatMontos = document.querySelectorAll('#vatsubtotales');
            // let actualizarDiscountMontos = document.querySelectorAll('#discountsubtotales');
            productosLS = this.obtenerProductosLocalStorage();

            // console.log(productosLS);
            productosLS.forEach(function (productoLS, index) {
                if (productoLS.id == id) {
                    // aparece o vat e o preço na tela
                    productoLS.cantidad = cantidad;
                    actualizarMontos[index].innerHTML = Number(cantidad * productosLS[index].precio);

                    // productoLS.discount = discount;
                    // actualizarMontos[index].innerHTML = Number(discount * productosLS[index].precio);

                    // LOGICA PARA O SUBTOTAL INCLUINDO VAT
                    var vatInprods= Number(cantidad * productosLS[index].precio * 0.20);
                    actualizarVatMontos[index].innerHTML = (productosLS[index].precio * 0.20).toFixed(2);

                    // actualizarMontos[index].innerHTML = (cantidad * productosLS[index].precio + vatInprods).toFixed(2); // antes
                    actualizarMontos[index].innerHTML = ((productosLS[index].precio * 1.20)).toFixed(2); // antes

                }
                // else{
                //     alert('productoLS.id');
                //     alert(productoLS.id);
                //     alert('id');
                //     alert(id);
                // }
            });

            localStorage.setItem('productos', JSON.stringify(productosLS));
            calcularTotal();

        }
        else {
            console.log("click afuera");
        }
    }


    calcularTotal();
    leerLocalStorageCompra();

</script>

<script>

    (function () {
        var addButton = document.getElementById("discount");
        // var addToTheCart = document.getElementById("borrar-producto");
        var removeButton = document.getElementById("borrar-producto");
        var quantityInput = document.getElementById("quantity");
        const productos = document.getElementById('lista-productos');
        const carrito = document.getElementById('carrito');

        addButton.addEventListener("change", function () {
            // alert(1); // soma novamente o total de acordo com o desconto
            calcularTotal();
    });



    productos.addEventListener('click', (e)=>{comprarProducto(e)});

    carrito.addEventListener('change', (e) => {obtenerEvento(e) });
    carrito.addEventListener('keyup', (e) => {obtenerEvento(e) });

    // removeButton.addEventListener('click', (e) => { eliminarProducto(e) });

    })();

</script>




<script>

function procesarCompra() {
        // e.preventDefault();

        alert('Purchase Completed!');
        data = obtenerProductosLocalStorage();
        localStorage.clear();

                dataPurchases = []
                // var sellPrice = document.getElementById("Sell_Price").value;
                // // document.getElementById("Sell_PriceVat").value = sellPrice;
                // var takingVatPrice =   (sellPrice * 0.20).toFixed(2);

                // document.getElementById("Sell_PriceVat").value = Number(sellPrice) + Number(takingVatPrice);
                // document.getElementById("Sell_PriceVatView").value = Number(sellPrice) + Number(takingVatPrice);

                // tirando os sinais das libras na frente dos nomes
                var subtotalvalue = document.getElementById('subtotal').innerHTML;
                var newsubtotalvalue = document.title = subtotalvalue.replace('£/. ', ''); // vai mudar o titulo removendo "STACK"

                var totalvalue = document.getElementById('total').value;
                var newtotalvalue = document.title = totalvalue.replace('£/. ', ''); // vai mudar o titulo removendo "STACK"

                var vat = document.getElementById('igv').innerHTML;
                var newvatvalue = document.title = vat.replace('£/. ', ''); // vai mudar o titulo removendo "STACK"


                var paymentMethod = document.getElementById('paymentMethod').value;

                var sales_discount = document.getElementById('discount').value;
                var newtotalvalue = document.title = totalvalue.replace('£/. ', ''); // vai mudar o titulo removendo "STACK"
                var paymentsOptions = $('#paymentsOptions option:selected').val();
                var upfrontBox = document.getElementById('upfrontBox').value;
              
                var lastPaymentDate = $('#finalPayment').val();
                var chooseCustomer = $('#chooseCustomer option:selected').val();
                var firstAmountPaid = $('#firstAmountPaid').val();
                var paymentsDays = $('#paymentsDays').val();
                var upfront = $('#upfront').val();
                var primeiraDatadoPagamento = $('#primeiraDatadoPagamento').val();

                // alert(upfront);

                for(var i=0; i<data.length; i++) {
                    var dataPurchase = {

                        imagen : data[i].imagen,
                        titulo: data[i].titulo,
                        precio: data[i].precio,
                        id: data[i].id,
                        cantidad:data[i].cantidad,
                        precioconVAT:data[i].precio,
                        SKU:data[i].SKU,
                        subtotalvalue: newsubtotalvalue,
                        totalvalue: newtotalvalue,
                        vat: newvatvalue,
                        paymentMethod:paymentMethod,
                        sales_discount: sales_discount,
                        paymentsOptions: paymentsOptions,
                        Npayments: upfrontBox,  
                        lastPaymentDate: lastPaymentDate,  
                        chooseCustomer: chooseCustomer,  
                        firstAmountPaid: firstAmountPaid,  
                        paymentsDays: paymentsDays,  
                        upfront: upfront,  
                        primeiraDatadoPagamento: primeiraDatadoPagamento,  
                    }
                    dataPurchases.push(dataPurchase);
                }

                // data = JSON.stringify(dataPurchases)
                data = dataPurchases;
                return (data);

            }

</script>





    <script>
        function addproductFunction(){
            $("#chooseProductSpan").removeClass("d-none");
            $('#addProductBtnSpan').empty();
        }
    </script>




    <script>
            $(function(){
                // alert(123456);
                $('button[id="procesar-compra"]').click(function(e){

                e.preventDefault();

                var dataPurchase = (procesarCompra());
                // alert(dataPurchase);
                var dados = dataPurchase;

                // var imageSrc = $(this).find('input#imageSrc').val();

                // alert('oi') ;              

                $.ajax({
                url: "{{ route('carrito.invoiceAjax') }}",
                type: 'post',
                data: {data: dados,  _token: '{{csrf_token()}}'},
                success:function(response){              
                    //   alert('here') ;              
                    //   console.log(response);
                    var idSales = response;
                    //   window.location.replace("/section/carrito/invoice/" + idSales);
                    window.location.replace("/section/carrito/balance/" + idSales);
                    // alert(1)
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(' Something get wrong' + jqXHR + textStatus + errorThrown)
                }
                });
            });
            });
    </script>

    

<script>

$("#FormSell_Price").on("change",function(){

  var Sell_Price = document.getElementById("FormSell_Price").value;

  if(isNaN(Sell_Price)){
          price  = 0.00;
          document.getElementById("FormSell_Price").value = price.toFixed(2);
      }
      else{
        $(this).val(parseFloat($(this).val()).toFixed(2));
      }
});

$("#FormSell_PriceVat").on("change",function(){

  var Sell_PriceVat = document.getElementById("FormSell_PriceVat").value;
  if(isNaN(Sell_PriceVat)){
          price  = 0.00;
          document.getElementById("FormSell_PriceVat").value = price.toFixed(2);
      }
      else{
        $(this).val(parseFloat($(this).val()).toFixed(2));
      }
});


$("#FormCost_Price").on("change",function(){
  var Cost_Price = document.getElementById("FormCost_Price").value;
  
  if(isNaN(Cost_Price)){
          price  = 0.00;
          document.getElementById("FormCost_Price").value = price.toFixed(2);
      }
      else{
        $(this).val(parseFloat($(this).val()).toFixed(2));
      }
});


function myFunction()
{

  // sell price to sell price with vat
    var sellPrice = document.getElementById("FormSell_Price").value;
      //muda a casa decimal dos valores

    // document.getElementById("Sell_PriceVat").value = sellPrice;
    var takingVatPrice =   (sellPrice * 1.20).toFixed(2);

    if(isNaN(takingVatPrice)){
          price  = 0.00;
          document.getElementById("FormSell_PriceVat").value = price.toFixed(2);
      }
      else{
        document.getElementById("FormSell_PriceVat").value = takingVatPrice;
      }

}

</script>



<script>
    $(document).ready(function(){

          $('#ajaxSubmit').click(function(e){
             e.preventDefault();
             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
             $.ajax({
                url: "{{ url('/section/categories/storeAjax') }}",
                method: 'post',
                data: {
                   name: $('#categoryName').val(),
                   about: $('#categoryAbout').val(),
                   _token: '{{csrf_token()}}'},
                  success: function(result){
                  alert('Supplier Added!');
                  // window.location.href = "{{ route('customer.index') }}";
                    // console.log(result);
                    document.getElementById('categoryName').value = '';
                    document.getElementById('categoryAbout').value = '';
                    document.getElementById('categoryAbout').value = 'Nothing to add';
                    $('.categoriesOptions').empty();
                    $resp = result;
                    console.log($resp);

                  $.each($resp, function (key, value){
                  $(".categoriesOptions").append(`
                       <option value="`+ value.id + `">`+ value.name + `</option>
                  `);
                });

                },
                error: function(jqXHR, textStatus, errorThrown, result) {
                  $msg = 'oi';
                    $resp = jqXHR.responseJSON.errors;
                    console.log(jqXHR, textStatus, errorThrown, result);

                    $('.messageBox').empty();
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

          $('#vatFree').change(function(e){

            var vatFree = document.getElementById("vatFree").checked;

            if(vatFree == true){
              $('#divPriceWithVat').empty();
            }
            else{
              $('#divPriceWithVat').empty();
              
              $("#divPriceWithVat").append(`
              <label for="" style="text-align:center;color:black;"><b>Sell Price with 20% vat</b></label>
                  <input id="FormSell_PriceVat" name="FormSell_PriceVat"
                          maxlength="191"
                          placeholder="FormSell_PriceVat" class="form-control"
                          type="text"  value="{{ old('Sell_PriceVat') }}"
                          onchange="vatToNormalPrice()"
                            required>
              `);
            }
             });
          });

</script>


    <script type="text/javascript">
        var path = "{{ route('home.searchingProductsAjax') }}";
        $('input.typeahead').typeahead({
            source:  function (query, process) {
            return $.get(path, { query: query }, function (data) {
                    return process(data);
                });
            }
        });
    </script>



<script>
    function vatToNormalPrice(){
        // Sell price vat to sell price without vat

        var sellPriceVat = document.getElementById("FormSell_PriceVat").value;
        var sellPrice = document.getElementById("FormSell_Price").value;

        var sellpricelessvat = (sellPriceVat / 1.20).toFixed(2);


        // alert(sellPrice)
        // adicionando valor no campo sellprice TIRANDO OS 20 % DO VAT INCLUSO
        document.getElementById("FormSell_Price").value = 0;

        if(isNaN(sellpricelessvat)){
                price  = 0.00;
                document.getElementById("FormSell_Price").value = price.toFixed(2);;
            }
            else{
                document.getElementById("FormSell_Price").value = sellpricelessvat;
        }
    }
</script>



<!-- // after add a new product -->



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

    <script src="{{ asset('carrito/js/sweetalert2.min.js') }}"></script>



  </body>

  </html>
