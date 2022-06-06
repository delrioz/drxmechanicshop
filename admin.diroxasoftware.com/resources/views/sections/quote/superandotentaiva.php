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

  <link href="{{ asset('admlyt/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

  <link href="{{ asset('jquery/multiselect/chosen.min.css') }}" rel="stylesheet">
  <script type="text/javascript" src="{{ asset('jquery/multiselect/jquery-3.5.1.min.js') }}"></script> 
  <script type="text/javascript" src="{{ asset('jquery/multiselect/chosen.jquery.min.js') }}"></script> 

</head>



      <span>
            @include('sections.components.topnavbar')
      </span>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->

          <!-- DataTales Example -->
         <!------ Include the above in your HEAD tag ---------->

            <form action="/section/quote/store" method="POST" id="registro" name="registro" enctype="multipart/form-data">
                            @csrf
            <section class="testimonial py-3" id="testimonial">
                <div class="container"  style="box-shadow: 0 4px 12px 0 rgba(0, 0, 2, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.19)">
                    <div class="row ">
                        <div class="col-md-12 py-5 border">
                            <h4 class="pb-2" style="color:black;"><b>Creating a Quote. Please, fill out the form.</b></h4>
                            <div class="alert alert-warning">
                                <p><b>If you are trying create a quote without products, please select the "only services" on Products input</b></p>
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
                                
                            <label for="" style="color:black;"><b>Title: </b></label>
                                <div class="form-row">
                                <!-- 'name', 'customer_report', 'first_observations', 'previous_observations', 'customer', 'vehicle', 'status', 'typeofpayment' -->
                                <div class="form-group col-md-12">
                                    <input id="title" name="title"  id="title"  placeholder="Title" 
                                    value="{{old('title') }}"
                                    class="form-control" type="text" >
                                </div>
                            </div>

                            <div class="form-row">
                                      <label for="" style="color:black;"><b> Last Observations: </b></label>
                                          <div class="form-group col-md-12">
                                          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                                  name="last_observations" value="{{old('last_observations') }}"
                                                  placeholder="Last Observations" id="last_observations">{{old('last_observations') }}</textarea>
                                    </div>  
                            </div>  

                            <div class="row">
                              <div class="form-group col-md-12">
                              <label for="" style="color:black;"><b> Choose Machine: </b></label>
                                  <select id="machine" name="machine" class="form-control">
                                    @foreach($allmachines as $allmachiness)
                                    <option value="{{$allmachiness->id}}">{{$allmachiness->model}}</option>
                                    @endforeach
                                </select>
                              <a href="/section/machines/create">
                               CREATE NEW MACHINE</a>
                            </div>
                          
                      <div class="row">
                         <div class="col-md-12">
                              @if(count($allproducts)  > 0)
                                <div class="form-group">
                                    <div class="form-group col-md-12">
                                      <label for="" style="color:black;"><b>Products</b></label><br>
                                      <select id="mselect" multiple style="width:300px;"  name="Productsoptions[]">
                                      @foreach($allproducts as $product)
                                      <option id="option" value="{{$product->id}}" >Name: {{$product->name}}  SKU: {{$product->SKU}} </option>
                                      @endforeach
                                      </select>
                                  </div>
                                </div>
                              @endif
                              </div>
                              </div>
                          </div>

                          


                          <span id="tableTitle" class="d-none">
                               <div class="title "><h3 style="text:center; color:black;"><b>Preview Products</b></h3></div>
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
                              <span id="newRows" name="newRows">
                                
                              </span>
                              <hr>

                              
                          <div class="form-row">
                            <div class="col-md-6">
                                <label for="" style="color:black;"><b> Work Order / Service price: </b></label>
                                                  <input id="wkservice" name="wkservice"  id="wkservice"  placeholder="work order / service" 
                                                    value="0.00"
                                                    class="form-control" type="text" >
                                
                            </div>
                            <div class="col-md-6">
                                <label for="" style="color:black;"> <b>Discount:</b> </label>
                                                  <input id="discount" name="discount"  id="discount"  placeholder="Discount" 
                                                    value="0.00"
                                                    class="form-control" type="text" >
                                
                            </div>
                          </div>  


                            <div class="form-group col-md-8">
                              <input  id="status" name="status" 
                                  maxlength="191" 
                                  placeholder="status " class="form-control" type="text" value="0" hidden>
                            </div>
                                <button type="submit" class="btn btn-warning">
                                <i class="fa fa-check fa-1x " aria-hidden="true"></i>
                                  <b>Create a Quote and Add Quantities</b></button>
                                  @if($routeBack == "machineViewPage")
                                    <a type="button" href="/section/machines/viewPage/{{$id}}"  class="btn btn-danger"><b>Back</b></a>
                                  @elseif($routeBack == "welcomePage")
                                    <a type="button" href="{{route('welcome') }}"  class="btn btn-danger">Back</a>
                                  @else
                                    <a type="button" href="{{route('quote.index') }}"  class="btn btn-danger">Back to Quote's section</a>
                                  @endif

                              </form>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </section>



      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Diroxa Software 2020</span>
          </div>
        </div>
      </footer>
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
        <label for="" style="color:black;"><b>Title</b></label>
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

      $("#Sell_Price").on("change",function(){
        $(this).val(parseFloat($(this).val()).toFixed(2));
      });

      $("#Sell_PriceVat").on("change",function(){
        $(this).val(parseFloat($(this).val()).toFixed(2));
      });

      $("#Cost_Price").on("change",function(){
        $(this).val(parseFloat($(this).val()).toFixed(2));
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

                $("#newRows").append(`
                  <div class="row" id="newRowItems" name="newRowItems">
                    <div class="col-md-4">
                        <label  style="color:black;"><b>Product Name/ Extra Costs</b></label>
                        <input type="text" id="DescriptionName" name="DescriptionName[]" class="form-control mb-2 mr-sm-2"  placeholder="Product Name/ Extra Cost Description" required>
                    </div>
                    <div class="col-md-2" id="novatprice">
                        <label  style="color:black;"><b>Price excl </b></label>
                        <input type="text" id="Sell_Price" name="Sell_Price[]"  onchange="myFunction2()" class="form-control mb-2 mr-sm-2"  placeholder="Price without Vat" required>
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
        // $(document).ready(function(){
          
        //       // $('#ajaxSubmit').click(function(e){
        //         $(document).on("change", "#Sell_Price", function(e){
        //         e.preventDefault();
                
        //         // var newRows = document.getElementById("Sell_Price").value;
        //         // // var numberNewRows = newRows.length;
        //         // // console.log(newRows.getElementById("newRows"));
        //         // console.log(newRows);
        //         // $.each(newRows, function (key, value){
        //         //        console.log(1);
        //         // });

                
        //         var sellPrice = document.querySelectorAll("#Sell_Price");
        //         console.log(sellPrice);
        //         // // document.getElementById("Sell_PriceVat").value = sellPrice; 
        //         // var takingVatPrice =   (sellPrice * 1.20).toFixed(2);

        //         // document.getElementById("Sell_PriceVat").value = takingVatPrice; 
        //         // var a  = this.parent().parent().attr('#Sell_Price').remove();
        //         // // var a  = e.parentElement.parentElement.attr('#Sell_Price').remove();
        //         // alert(a);
        //         // this.parentElement.removeChild(this);

        //         });
        //       });
                        
        function myFunction2() {
                  alert(1);
                  var x, i, thatVariable;
                  // id="newRowItems"
                  x = document.querySelectorAll("#newRowItems");

                  for (i = 0; i < x.length; i++) {
                        thatVariable = x[i];
                        var sellPrice = document.getElementById("Sell_Price").value;
                        console.log('oi');
                        var a = x[i].children[1];
                        alert(sellPrice);
                        var sellPrice = document.getElementById("Sell_Price").value = 0;
                        console.log(a);
                        console.log('tchau');
                  }
                  console.log(a);
                }
  </script>



  <script>

  function vatToNormalPrice(){
        var sellPriceVat = document.getElementById("Sell_PriceVat").value;
        var sellPrice = document.getElementById("Sell_Price").value;
        var sellpricelessvat = (sellPriceVat / 1.20).toFixed(2);


        // alert(sellPrice)
        // adicionando valor no campo sellprice TIRANDO OS 20 % DO VAT INCLUSO
        document.getElementById("Sell_Price").value = 0; 
        document.getElementById("Sell_Price").value = sellpricelessvat; 
    }

      


    function myFunction(e)
    {
      
      var sellPrice = document.getElementById("Sell_Price").value;
      // document.getElementById("Sell_PriceVat").value = sellPrice; 
      var takingVatPrice =   (sellPrice * 1.20).toFixed(2);

      document.getElementById("Sell_PriceVat").value = takingVatPrice; 
    }

  </script>



  <script>

      $("#discount").on("change",function(){
        $(this).val(parseFloat($(this).val()).toFixed(2));
      });

      $("#wkservice").on("change",function(){
        $(this).val(parseFloat($(this).val()).toFixed(2));
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

