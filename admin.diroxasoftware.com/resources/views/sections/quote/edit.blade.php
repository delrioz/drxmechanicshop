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
                  <h1 class="h3 mb-1 text-gray-800"><b>Edting Work Order</b></h1>
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

                  <form action="/section/quote/update/{{$allQuotes->id}}" method="POST" id="registro" name="registro" enctype="multipart/form-data">
                   @csrf

                  <!-- Content Row -->
                  <div class="row">
                      <!-- Grow In Utility -->
                      <div class="col-lg-6">

                                  <div class="card position-relative">
                                      <div class="card-header py-3">
                                          <h6 class="m-0 font-weight-bold text-primary">Quotes Infos</h6>
                                      </div>


                                      <div class="card-body">
                                        <div class="row">
                                          
                                        <div class="form-group col-md-4">
                                            <label for="" style="color:black;"> <b>Customer:</b> </label>

                                                      <input type="text" value="{{$allQuotes->customerId}}" name ="customer"  class="customer" id="customer" hidden>  
                                                      <select class="form-control" disabled>
                                                        <option selected>{{$allQuotes->customerName}}</option>
                                                    </select>
                                        </div>

                                          <div class="form-group col-md-4">
                                          <label for="" style="color:black;"> <b>Motorcycle:</b> </label>

                                                      <input type="text" value="{{$allQuotes->machineId}}" name ="machine"  class="machine" id="machine" hidden>  
                                                      
                                                      <select id="machine" name="machine" class="form-control" disabled>
                                                      <option selected>{{$allQuotes->machineModel}}</option>
                                                      </select>
                                            </div>

                                            <div class="col-md-4">
                                                  <label for="" style="color:black;"> <b>Bike's Mileage:</b> </label>
                                                  <input id="mileage" name="mileage"  id="mileage"  placeholder="mileage" 
                                                    value="{{$allQuotes->mileage}}"
                                                    class="form-control" type="text" >
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
                                                value = "{{$allQuotes->title}}" required>
                                  </div>
                              </div>

                              
                              <div class="form-row">
                                    <label for="" style="color:black;"><b>Customer Observations: </b></label>
                                      <div class="form-group col-md-12">
                                          <input type="text" value="{{$allQuotes->customer_report}}" name ="customer_report"  class="customer_report" hidden>  
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                                    placeholder="Customer Report" disabled>{{$allQuotes->customer_report}}</textarea>
                                      </div>  
                              </div>  


                              <div class="form-row">
                                        <label for="" style="color:black;"> <b>Customer Note:</b><small>(Will show on the Invoice)</small></label>
                                            <div class="form-group col-md-12">
                                            <textarea class="form-control"  rows="3"
                                                name="last_observations" class="last_observations" value="{{$allQuotes->last_observations}}"
                                                placeholder="Last Observations" id="last_observations">{{$allQuotes->last_observations}}</textarea>
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

                              <div class="form-row">
                                      <div class="col-md-4">
                                          <label for="" style="color:black;"> <b>Work Order / Service price:</b> </label>
                                            <input id="wkservice" name="wkservice"  id="wkservice"  placeholder="work order / service"
                                                  value="{{$allQuotes->wkservice}}"
                                                  class="form-control" type="text" >
                                            
                                      </div>
                                      
                                      <div class="col-md-4">
                                          <label for="" style="color:black;"> <b>Discount:</b> </label>
                                            <input id="discount" name="discount"  id="discount"  placeholder="Discount"
                                                value="{{$allQuotes->discount}}"
                                                class="form-control" type="text" >
                                      </div>

                                

                                      <input type="text" name="from" class="from" id="from" value="{{$from}}" hidden>

                                </div><br>  
                                
                                    <div class="row">
                                    @if(count($allproducts)  > 0)
                                    <div class="form-group">
                                        <div class="form-group col-md-12">
                                          <label for="" style="color:black;"><b>Products</b></label><br>
                                          <select id="mselect" multiple style="width:500px;"  name="Productsoptions[]">
                                                  @if($statusNulo == false)
                                                      @foreach($respostaProducts as $products)
                                                        <option id="option" value="{{$products->id}}">Id:{{$products->id}} | SKU:{{$products->SKU}} | Name:{{$products->name}}</option>
                                                      @endforeach

                                                      @foreach($outrasop as $op)
                                                      <option id="option" value="{{$op->product_id}}" selected>Id:{{$op->product_id}}| SKU:{{$op->product_SKU}} |Name:{{$op->productName}}</option>
                                                      @endforeach
                                                  @endif

                                                  @if($statusNulo == true)
                                                    @foreach($outrasop as $op)
                                                    <option id="option" value="{{$op->product_id}}" selected>Id:{{$op->product_id}}| SKU:{{$op->product_SKU}} |{{$op->productName}}</option>
                                                    @endforeach
                                                  @endif
                                          </select>
                                      </div>
                                    </div>
                                  @else
                                      <div class="alert">
                                        <p>There is no products created in the Products section</p>
                                        <p><a href="/section/products/create/">Add product</a></p>
                                      </div>
                                  @endif
                                </div>


                                <?php

                                  if($allQuotes->status == 0){
                                        $statusName = "OPEN";
                                      }

                                    else if($allQuotes->status == 1){
                                        $statusName = "CLOSE";
                                    }

                                    else if($allQuotes->status == 2){
                                        $statusName = "WAITING FOR COLLECTION";
                                    }

                                ?>


                     
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

                              <div class="title"><h3 style="text:center; color:black;"><b>Extra Costs</b></h3></div>
                                    <a type="button" class="btn btn-success" id="addRow" name="addRow" style="color:white;"><b>Add Extra Cost +</b></a>
                                    <div id="extra-cost-container">
                                    <table>
                                          @foreach($ExtraItems as $extraitems)
                                          
                                          <?php
                                                  $Sell_Price = number_format($extraitems->Sell_Price, 2, '.',',');
                                                  $Sell_PriceVat = number_format($extraitems->Sell_PriceVat, 2, '.',',');

                                              ?>
                                              <span>
                                                <tr>    
                                                    <th>Product Name/Extra Costs</th>  
                                                    <th>Price incl</th>  
                                                    <th>Price incl Vat</th>  
                                                    <th>Options</th>  
                                                </tr>  
                                              </span>
                                              <tr>  
                                                  <td><input type='text' class='product-name' name="DescriptionName[]" value="{{$extraitems->name}}"  placeholder='prod   productCount' required></td>  
                                                  <td><input  class='price' name="Sell_Price[]" value="{{$Sell_Price}}" placeholder='Price' required></td>  
                                                  <td><input  class='price-vat' name="Sell_PriceVat[]" value="{{$Sell_PriceVat}}" placeholder='Price with' required></td>  
                                                  <td>
                                                  <a href="" id="removeRow" name="removeRow" class="btn btn-danger">Remove</a>
                                                  </td>  
                                              </tr>
                                          @endforeach
                                  </table>
                              </div>
                              <br>
                           
                              
                                    @if($updatingWarning != null)
                                      <div class="alert alert-warning">
                                            <p>Confirm the Product's quantities</p>
                                      </div>
                                    @endif

                                    @if(count($ProductsSelected) > 0)
                                          <div class="title"><h3 style="text:center; color:black;"><b>Products on this order</b></h3></div>
                                              @foreach($ProductsSelected as $product)
                                                <div class="row">
                                                  <div class="col-md-4">
                                                      <label for="productName" style="color:black;">Product Name</label>
                                                      <input type="text"  class="form-control mb-2 mr-sm-2" value="{{$product->productName}}" placeholder="Product Name" disabled>
                                                      <input type="hidden"  class="form-control mb-2 mr-sm-2"  name="productName[]" id="productName" value="{{$product->product_id}}" placeholder="Product ID">
                                                      </div>
                                                  <div class="col-md-4">
                                                      <label  for="quantity" style="color:black;">Quantity</label>
                                                      <div class="input-group mb-2 mr-sm-2">
                                                        <div class="input-group-prepend">
                                                        </div>
                                                        <input type="number"  class="form-control" name="quantity[]" id="quantity"  value="{{$product->pmqProductQuantity}}" placeholder="Quantity">
                                                      </div>
                                                    </div>
                                                  <div class="col-md-4">
                                                      <label  style="color:black;">Condition</label>
                                                      <div class="input-group mb-2 mr-sm-2">
                                                        <div class="input-group-prepend">
                                                        </div>
                                                        <input type="number"  class="form-control"  value="{{$product->productCondition}}" placeholder="{{$product->productCondition}}" disabled>
                                                      </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                    @endif
                                    <br>
                                    <div class="row">
                                      <div class="form-group col-md-6">
                                      <strong><h6 style="text-align:center; color:black;" ></strong>
                                        <b> QUOTE STATUS</b>
                                      </h6>
                                      <select id="quotesStatus" name="quotesStatus" class="form-control">
                                              @if($allQuotes->status == 0)
                                                  <option>OPEN</option>
                                                  <option>REFUSED</option>

                                              @elseif($allQuotes->status == 3)
                                              <option>REFUSED</option>
                                              <option>OPEN</option>

                                              @endif
                                          </select>
                                      </div>
                                    </div>



                                    
                                    <div class="row">
                                        <hr>
                                            <input  id="status" name="status" 
                                                  maxlength="191" 
                                                  placeholder="status " class="form-control" type="text" value="0" hidden>
                                            </div>
                                
                                            <input type="number"  class="form-control" name="id" id="id"  value="{{$allQuotes->id}}" placeholder="id" hidden >
                                            <button type="submit" class="btn btn-warning">
                                            <i class="fa fa-save fa-1x " aria-hidden="true"></i>
                                            <b>Save Quote</b></button>

                                            @if($from == "MachineViewPage")
                                                <a href="{{$routeBack}}" type="button" class="btn btn-danger"><b>Back</b></a>
                                            @else
                                              <a href="{{$routeBack}}" type="button" class="btn btn-danger"><b>Back</b></a>
                                            @endif
                                    </div>
                                  </form>
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

  
  <script>
    (function () {
        var addButton = document.getElementById("addRow")
        var tableContainer = document.getElementById("extra-cost-container");
        
        var productCount = 0;
        addButton.addEventListener("click", function (e) {
            e.preventDefault();
            ++productCount;
            var table = document.createElement("table");
            table.innerHTML = 
                "<tr>" + 
                    "<th>Product Name/Extra Costs</th>" + 
                    "<th>Price incl</th>" + 
                    "<th>Price incl Vat</th>" + 
                    "<th>Options</th>" + 
                "</tr>" + 
                "<tr>" + 
                    "<td><input type='text' class='product-name' name='DescriptionName[]' placeholder='prod " + productCount + "' required></td>" + 
                    "<td><input  class='price' placeholder='Price' name='Sell_Price[]' required></td>" + 
                    "<td><input  class='price-vat' placeholder='Price with'  name='Sell_PriceVat[]' required></td>" + 
                    "<td><input type='button' class='remove-btn' value='Remove'></td>" + 
                "</tr>";
            tableContainer.append(table);
        });

        tableContainer.addEventListener("click", function (e) {
            var el = e.target;
            if (el.classList.contains("remove-btn")) {
                while (el.tagName !== "TABLE") {
                    el = el.parentElement;
                }
                el.remove();
            }
        });

        tableContainer.addEventListener("input", function (e) {
            var el = e.target;

            if (el.classList.contains("price")) {
            var tr = el.parentElement.parentElement;
            var priceVatInput = tr.querySelector(".price-vat");
            var priceInput = tr.querySelector(".price");
            var price = Number(el.value);
            var priceVat = price * 1.2;
            if(isNaN(price)){
                price  = 0.00;
                priceVat = 0.00;
                priceInput.value = price.toFixed(2);
                priceVatInput.value = priceVat.toFixed(2);
          }
          else{
            priceVatInput.value = priceVat.toFixed(2);
          }
        } else if (el.classList.contains("price-vat")) {
            var tr = el.parentElement.parentElement;
            var priceInput = tr.querySelector(".price");
            var priceVatInput = tr.querySelector(".price-vat");
            var priceVat = Number(el.value);
            var price = priceVat * (10/12);
          if(isNaN(price)){
                price  = 0.00;
                priceVat = 0.00;
                priceInput.value = price.toFixed(2);
                priceVatInput.value = priceVat.toFixed(2);
          }
          else{
                priceInput.value = price.toFixed(2);
          }
        }
        });
    })();
  </script>

  <script type="text/javascript">
    $(document).ready(function(){
        $('#mselect').chosen();
    });
  </script>



    
  <script>
        $(document).ready(function(){
          
              // $('#ajaxSubmit').click(function(e){
                $(document).on("change", "#mselect", function(e){
                // var comboCidades = document.getElementById("option").value;
                var comboCidades = $('#mselect option:selected').val();
                var data=[];  
                // alert(comboCidades)
                // data.push(comboCidades);
                var valor = $('#mselect').val();
                // var texto = $('#mselect :selected').text();
                
                // alert('valor ' + valor);
                // alert('texto ' + texto);

                
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

                      console.log(result);
                      // alert('PEGOOOOOOOOOOOU!')
                      // $('.prodstables').empty();
                      $("#tableTitle").removeClass("d-none")
                      $resp = result;
                      $('.prodstables').empty();
                      $.each($resp, function (key, value){
                        $(".prodstables").append(`
                              <tr>
                                  <td style="font-family:verdana; color:black;"> <img src="/storage/`+ value.image + `" class="media-photo"
                                    style="width: 70px; height:70px;" alt="/storage/`+ value.image + `"></td>
                                  <td style="font-family:verdana; color:black;">` + value.name + 
                                `<br><span class="badge badge-success" style="font-family:verdana; color:white;"><b> Condition :` + value.condition +`</b></span>
                                  </td>
                                  <td style="font-family:verdana; color:black;">` + value.SKU + `</td>
                                  <td style="font-family:verdana; color:black;">`+ value.Sell_PriceVat + `</td>
                                  <td style="font-family:verdana; color:black;">`+ value.quantity + `</td>
                              </tr>
                      `);
                    });
            
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
                $(document).on("click", "#removeRow", function(e){
                $(this).parent().parent().remove();

        
                
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

      $("#wkservice").on("change",function(){
        var wkservice = document.getElementById("wkservice").value;

        if(isNaN(wkservice)){
              price  = 0.00;
              document.getElementById("wkservice").value = price.toFixed(2);
          }
          else{
            $(this).val(parseFloat($(this).val()).toFixed(2));
          }
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