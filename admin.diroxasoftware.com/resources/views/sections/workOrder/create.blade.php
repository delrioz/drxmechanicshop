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
  <link href="{{ asset('quote/css/style.css') }}" rel="stylesheet">

  <link href="{{ asset('jquery/multiselect/chosen.min.css') }}" rel="stylesheet">
  <script type="text/javascript" src="{{ asset('jquery/multiselect/jquery-3.5.1.min.js') }}"></script> 
  <script type="text/javascript" src="{{ asset('jquery/multiselect/chosen.jquery.min.js') }}"></script> 
  <script src="{{ asset('quote/js/extraitems.js') }}" async></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>


</head>

      <span>
            @include('sections.components.topnavbar')
      </span>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-1 text-gray-800"><b>Creating Work Orders</b></h1>
                  

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
                            

                <form action="/section/workOrder/store" method="POST" id="registro" name="registro" enctype="multipart/form-data">
                    @csrf
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Grow In Utility -->
                        <div class="col-lg-6">

                                    <div class="card position-relative">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Motorcycle's Infos</h6>
                                        </div>

                                      <div class="card-body">
                                        
                                      @if(isset($isMachineID))
                                            <div class="row">
                                              <div class="form-group col-md-6">
                                                <label for="" style="color:black;"><b>Motorcycle Selected: </b> </label>
                                                    <select id="machine" name="machine" class="form-control">
                                                          <option value="{{$allmachines->id}}">
                                                            Model: {{$allmachines->model}}
                                                            Serial Number: {{$allmachines->serial_number}}
                                                          </option>
                                                    </select>
                                              </div>
                                            </div>
                                      @else

                                      
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label style="color:black;"><b>Number Plate/Serial Number</b></label>
                                                        <input id="searchBox" name="searchBox"  id="searchBox"  placeholder="Search for a Number Plate/Serial Number"
                                                            class="form-control" type="text" >
                                              </div>

                                              <div class="form-group col-md-6">
                                                <label for="" style="color:black;"><b>Motorcycle found: </b> </label>
                                                    <select id="machine" name="machine" class="form-control">
                                                        @foreach($allmachines as $allmachiness)
                                                        <option value="{{$allmachiness->id}}">
                                                        Model: {{$allmachiness->model}}
                                                        Serial Number: {{$allmachiness->serial_number}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                              </div>
                                            </div>

                                            <button class="btn btn-primary" id="selectCustomer"  name="selectCustomer" type="button">Select Motorcycle</button><br>
                                              <div class="alert">
                                                  <b>
                                                    Couldn't find the motorcycle? <a href="/section/machines/nocustomers/create">Add new Motorcycle</a>
                                                  </b>
                                              </div>
                                      @endif

                                      

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


                                    <hr style="color:black;">
                                    <p style="color:#2f6ed4;"><strong>Work Order Infos</strong></p>

                                    <div class="form-row">
                                    <label for="" style="color:black;"> <b>Job Title:</b> </label>
                                    <!-- 'name', 'customer_report', 'first_observations', 'previous_observations', 'customer', 'vehicle', 'status', 'typeofpayment' -->
                                    <div class="form-group col-md-12">
                                        <input id="title" name="title"  id="title"
                                          value="{{old('title') }}"
                                          placeholder="Title" class="typeahead form-control" type="text">
                                    </div>
                                </div>

                                
                                <div class="form-row">
                                      <label for="" style="color:black;"><b>Customer Observations: </b></label>
                                        <div class="form-group col-md-12">
                                              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                                      name="customer_report" value="{{old('customer_report') }}"
                                                      placeholder="Customer Observations" id="customer_report">{{old('customer_report') }}</textarea>
                                        </div>  
                                </div>  


                                <div class="form-row">
                                          <label for="" style="color:black;"> <b>Customer Note:</b><small>(Will show on the Invoice)</small></label>
                                              <div class="form-group col-md-12">
                                              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                                      name="last_observations" value="{{old('last_observations') }}"
                                                      placeholder="Last Observations" id="last_observations" require>{{old('last_observations') }}</textarea>
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

                                      <div class="row">
                                      @if(count($allproducts)  > 0)
                                      <div class="form-group">
                                          <div class="form-group col-md-12">
                                            <label for="" style="color:black;"><b>Products</b></label><br>
                                            <select id="mselect" multiple style="width:500px;"  name="Productsoptions[]" >
                                              @foreach($allproducts as $product)
                                                <option id="option" value="{{$product->id}}">Id:{{$product->id}} | SKU:{{$product->SKU}} | Name:{{$product->name}}</option>
                                              @endforeach
                                            </select>
                                        </div>
                                      </div>
                                    @endif
                                  </div>


                                  <span id="tableTitle" class="d-none">
                                  <label for="" style="color:black;"><b>Preview Products</b></label><br>

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


                                <label for="" style="color:black;"><b>Extra Costs</b></label><br>
                                <a type="button" class="btn btn-success" id="add-extra-cost-btn" style="color:white;"><b>Add Extra Cost +</b></a>
                                <div id="extra-cost-container"></div>
                                <hr>
                                <div class="form-row">
                                        <div class="col-md-6">
                                            <label for="" style="color:black;"> <b>Work Order / Service price:</b> </label>
                                            <input id="wkservice" name="wkservice"  id="wkservice"  placeholder="work order / service" 
                                              value="0.00"
                                              oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null"
                                              class="form-control" type="text" >
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" style="color:black;"> <b>Discount:</b> </label>
                                            <input id="discount" name="discount"  id="discount"  placeholder="Discount" 
                                              value="0.00"
                                              oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null"
                                              class="form-control" type="text" required>
                                            
                                        </div>
                                  </div><br>  
                                </div>
                            </div>

                            

                            <div class="form-group col-md-6">
                                    <input  id="status" name="status" 
                                        maxlength="191" 
                                        placeholder="status " class="form-control" type="text" value="0" hidden>
                                  </div>
                                   
                            <button type="submit" class="btn btn-warning">
                                <i class="fa fa-plus fa-1x " aria-hidden="true"></i>
                                    <b>Create a Work Order</b></button>
                                      @if($routeBack == "machineViewPage")
                                      <a type="button" href="/section/machines/viewPage/{{$id}}"  class="btn btn-danger"><b>Back</b></a>
                                    @else
                                      <a type="button" href="{{route('workOrder.index') }}"  class="btn btn-danger"><b>Back to Work Order's section</b></a>
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


  <script type="text/javascript">
   
  </script>


  <script type="text/javascript">
      $(document).ready(function(){
          $('#mselect').chosen();
      });
    </script>

  <script>

  function EnableVatPrice(checkbox1)
  {
    var sellpricevat = document.getElementById("Sell_PriceVatView");



    sellpricevat.disabled=checkbox1.checked ? false: true;
    
    if(!sellpricevat.disabled)
    {
      document.getElementById("Sell_PriceVatView").disabled = false;
    }

    else {
      document.getElementById("Sell_PriceVatView").disabled = true;
    }
  }

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
                $(document).on("click", "#addRow", function(e){

                // var comboCidades = document.getElementById("option").value;
                var comboCidades = $('#mselect option:selected').val();
                var data=[];  

                $("#newRows").append(`
                  <div class="row">
                    <div class="col-md-4">
                        <label  style="color:black;"><b>Product Name/ Extra Costs</b></label>
                        <input type="text" id="DescriptionName" name="DescriptionName[]" class="form-control mb-2 mr-sm-2"  placeholder="Product Name/ Extra Cost Description" required>
                    </div>
                    <div class="col-md-2">
                        <label  style="color:black;"><b>Price incl Vat</b></label>
                        <input type="text" id="Sell_PriceVat" name="Sell_PriceVat[]"  class="form-control mb-2 mr-sm-2" onchange="vatToNormalPrice()"  placeholder="Price with Vat" required>
                    </div>
                    <div class="col-md-2">
                          <label  style="color:black;"><b>Options</b></label><br>
                          <a href="" id="removeRow" name="removeRow" class="btn btn-danger">Remove</a>
                    </div>
                  </div>
                `);
                
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




<script>
      $(document).ready(function(){

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
                  url: "{{ url('/home/searchBikeByNumberPlate') }}",
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
                        console.log($resp);
                        $.each($resp, function (key, value){
                              $("#machine").append(`
                                  <option value="`+ value.id + `">
                                    Model: `+ value.model + `
                                    Serial Number: `+ value.serial_number + `
                                  </option>
                          `);
                        });
                    }

                    else{
                        $('#machine').empty();
                        $.each($resp, function (key, value){
                          $("#machine").append(`
                            <option value="`+ value.id + `">
                                  Model: `+ value.model + `
                                  Serial Number: `+ value.serial_number + `
                            </option>                
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
                
                var machine = $('#machine option:selected').val();

               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               $.ajax({
                  url: "{{ url('/home/findCustomerInfos') }}",
                  data: {
                     data: machine,
                     _token: '{{csrf_token()}}'},

                  success: function(result){

                    $resp = result;
                    console.log($resp);

                    if($resp == 0){
                        alert('Nothing was found matching this datas');
                    }

                    else{
                        $('#selectedCustomerInfos').empty();
                          $("#selectedCustomerInfos").append(`
                              <span  id="selectedCustomerInfos" name="selectedCustomerInfos">
                                  <div class="alert">
                                    <div class="row">
                                      <div class="col-md-6">
                                        <h5><b>Name: </b>`+ $resp.customerName + `</h5>
                                        <h5><b>Email: </b> `+ $resp.customerEmail + `</h5>
                                      </div>
                                      <div class="col-md-6">
                                        <h5><b>Telephone: </b> `+ $resp.telephone + `</h5>
                                        <b style="text-color:black;">
                                         Customer Selected</b> <br>
                                         <b> Go to <a href="/section/customers/viewPage/`+ $resp.customerId + `"> Customer Selected View page</a></b> 
                                        
                                    </div>
                                  </div>
                                  </div>
                              </span>              
                      `);
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
              $(document).on("click", "#selectCustomer", function(e){
                
                var machine = $('#machine option:selected').val();

               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               $.ajax({
                  url: "{{ url('/home/findCustomerInfos') }}",
                  data: {
                     data: machine,
                     _token: '{{csrf_token()}}'},

                  success: function(result){

                    $resp = result;
                    console.log($resp);
                    $("#selectedCustomerInfos").removeClass("d-none")

                    if($resp == 0){
                        alert('Nothing was found matching this datas');
                    }

                    else{
                        $('#selectedCustomerInfos').empty();
                          $("#selectedCustomerInfos").append(`
                              <span  id="selectedCustomerInfos" name="selectedCustomerInfos">
                                  <div class="alert">
                                    <div class="row">
                                      <div class="col-md-6">
                                        <h5><b>Name: </b>`+ $resp.customerName + `</h5>
                                        <h5><b>Email: </b> `+ $resp.customerEmail + `</h5>
                                      </div>
                                      <div class="col-md-6">
                                        <h5><b>Telephone: </b> `+ $resp.telephone + `</h5>
                                        <b style="text-color:black;">
                                         Customer Selected</b> <br>
                                         <b> Go to <a href="/section/customers/viewPage/`+ $resp.customerId + `"> Customer Selected View page</a></b> 
                                        
                                    </div>
                                  </div>
                                  </div>
                              </span>              
                      `);
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

  function mudou(e){
    var targetaddress = (e.target);
    console.log(targetaddress);

    var path = "{{ route('home.searchingProductsAjax') }}";
        $('targetaddress.typeahead').typeahead({
            source:  function (query, process) {
            return $.get(path, { query: query }, function (data) {
              alert(4444444);
                    return process(data);
                });
            }
        });

  }
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

