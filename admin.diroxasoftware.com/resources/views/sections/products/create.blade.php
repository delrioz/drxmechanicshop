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
      <span>
            @include('sections.components.topnavbar')
      </span>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->

          <!-- DataTales Example -->
         <!------ Include the above in your HEAD tag ---------->



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
                                        <input id="name" name="name"  id="name"
                                         value="{{ old('name') }}"
                                         placeholder="Name" class="form-control" type="text"
                                         required>
                                    </div>

                        <div class="form-group col-md-6">
                              <label for="" style="text-align:center;color:black;"><b>SKU</b></label>
                                    <input id="SKU" name="SKU"
                                           value="{{ old('SKU') }}"
                                            maxlength="191"
                                            placeholder="SKU" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-row">
                                        <div class="form-group col-md-6">
                                        <label for="" style="color:black;"><b>Category</b></label>
                                            <select id="category" name="category" class="form-control categoriesOptions" >
                                                    @foreach($allcategories as $allcategory)
                                                    <option value="{{$allcategory->id}}">{{$allcategory->name}}</option>
                                                    @endforeach
                                            </select>
                                        or <a href="/newone" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><b>Add new Category</b></a>
                              </div>
                              <div class="form-group col-md-6">
                              <label for="" style="text-align:center;color:black;"><b>Brand</b></label>
                              <input id="brand" name="brand"
                                            maxlength="191"
                                            value="{{ old('brand') }}"
                                            placeholder="brand" class="form-control" type="text"
                                             >
                              </div>
                          </div>

                              <div class="form-row">
                                  <div class="form-group col-md-6">
                                  <label for="" style="text-align:center;color:black;"><b>Sell Price (GBP)</b></label>
                                  <input id="Sell_Price" name="Sell_Price"
                                          value="{{ old('Sell_Price') }}"
                                          maxlength="191" onchange="myFunction()"
                                          placeholder="Sell_Price " class="form-control" type="text"
                                            required>
                              </div>

                              <div class="form-group  col-md-6" id="divPriceWithVat" name="divPriceWithVat">
                                <label for="" style="text-align:center;color:black;"><b>Sell Price with 20% vat</b></label>
                                    <input id="Sell_PriceVat" name="Sell_PriceVat"
                                            maxlength="191"
                                            placeholder="Sell_PriceVat" class="form-control"
                                            type="text"  value="{{ old('Sell_PriceVat') }}"
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
                                    <label for="" style="text-align:center;color:black;"><b>Cost Price (GBP)</b></label>
                                      <input id="Cost_Price" name="Cost_Price"
                                              maxlength="191" value="{{ old('Cost_Price') }}"
                                              placeholder="Cost_Price" class="form-control" type="text"
                                                required>
                            </div>

                            <div class="form-group col-md-6">
                              <label for="" style="text-align:center;color:black;"><b>Quantity</b></label>
                              <input id="quantity" name="quantity"
                                      maxlength="191" value="{{ old('quantity') }}"
                                      placeholder="quantity " class="form-control"
                                      type="number"
                                      required>
                              </div>

                          </div>

                          <div class="row">

                            <div class="form-group col-md-6">
                            <label for="" style="color:black;"><b>Supplier</b></label>
                                <select id="supplier" name="supplier" class="form-control" >
                                        @foreach($allSuppliers as $allsupplier)
                                        <option value="{{$allsupplier->id}}">{{$allsupplier->name}}</option>
                                        @endforeach
                                </select>
                            or <a href="/section/suppliers/create" ><b>Add new Supplier</b></a>
                  </div>


                            <div class="form-group col-md-4">

                                <label for="" style="color:black;"><b>Condition</b></label>
                                      <select id="condition" name="condition" class="form-control" >
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


                  <div class="form-row">
                                  <label for="" style="color:black;"><b> About: </b></label>
                                      <div class="form-group col-md-12">
                                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                          name="about" placeholder="about"
                                          value="{{ old('about') }}" id="about" ></textarea>
                              </div>

                              <div class="form-group col-md-6">
                                  <input type="file" class="form-control-file" id="exampleFormControlFile1"
                                  name="image" >
                              </div>
                    </div>

                            <input type="checkbox" id="outgoingcheck" name="outgoingcheck">
                            <label for="vehicle1"> Add to outgoing tables</label><br>

                              <button type="submit" class="btn btn-success">
                              <i class="fa fa-check fa-1x " aria-hidden="true"></i>
                              <b>Create Product</b></button>
                                  @if($backRoute == 'welcomePage')
                                      <a type="button" href="{{route('welcome') }}"  class="btn btn-danger"><b>Back</b></a>
                                  @elseif($backRoute == 'generalSearchPage')
                                      <a type="button" href="{{route('general.search') }}"  class="btn btn-danger"><b>Back</b></a>
                                  @else
                                      <a type="button" href="{{route('product.index') }}"  class="btn btn-danger"><b>Back</b></a>
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





      <!-- minha modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add new Supplier</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form  id="myForm" enctype="multipart/form-data" >
                            @csrf
              <div class="row">
                  <div class="col-md-12">
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Supplier name:</label>
                          <input id="categoryName" categoryName="categoryName"  id="categoryName"  placeholder="categoryName" class="form-control" type="text" required>
                        </div>
                  </div>
              </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">About / Description: *(NOT REQUIRED)*</label>
                  <textarea class="form-control" id="categoryAbout" rows="3"
                  name="categoryAbout"
                  placeholder="categoryAbout" id="categoryAbout" required>Nothing to add</textarea>
                </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button type="submit" id="ajaxSubmit" class="btn btn-success ajaxSubmit ">Add Supplier</button>

            </div>
          </form>
          </div>

          <!-- end of modal -->


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

function vatToNormalPrice(){
    // Sell price vat to sell price without vat

      var sellPriceVat = document.getElementById("Sell_PriceVat").value;
      var sellPrice = document.getElementById("Sell_Price").value;

      var sellpricelessvat = (sellPriceVat / 1.20).toFixed(2);


      // alert(sellPrice)
      // adicionando valor no campo sellprice TIRANDO OS 20 % DO VAT INCLUSO
      document.getElementById("Sell_Price").value = 0;

      if(isNaN(sellpricelessvat)){
              price  = 0.00;
              document.getElementById("Sell_Price").value = price.toFixed(2);;
          }
          else{
            document.getElementById("Sell_Price").value = sellpricelessvat;
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

      var Sell_Price = document.getElementById("Sell_Price").value;

      if(isNaN(Sell_Price)){
              price  = 0.00;
              document.getElementById("Sell_Price").value = price.toFixed(2);
          }
          else{
            $(this).val(parseFloat($(this).val()).toFixed(2));
          }
    });

    $("#Sell_PriceVat").on("change",function(){

      var Sell_PriceVat = document.getElementById("Sell_PriceVat").value;
      if(isNaN(Sell_PriceVat)){
              price  = 0.00;
              document.getElementById("Sell_PriceVat").value = price.toFixed(2);
          }
          else{
            $(this).val(parseFloat($(this).val()).toFixed(2));
          }
    });


    $("#Cost_Price").on("change",function(){
      var Cost_Price = document.getElementById("Cost_Price").value;

      if(isNaN(Cost_Price)){
              price  = 0.00;
              document.getElementById("Cost_Price").value = price.toFixed(2);
          }
          else{
            $(this).val(parseFloat($(this).val()).toFixed(2));
          }
    });


    function myFunction()
    {

      // sell price to sell price with vat
        var sellPrice = document.getElementById("Sell_Price").value;
          //muda a casa decimal dos valores

        // document.getElementById("Sell_PriceVat").value = sellPrice;
        var takingVatPrice =   (sellPrice * 1.20).toFixed(2);

        if(isNaN(takingVatPrice)){
              price  = 0.00;
              document.getElementById("Sell_PriceVat").value = price.toFixed(2);
          }
          else{
            document.getElementById("Sell_PriceVat").value = takingVatPrice;
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
                  console.log(result);

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
                  <input id="Sell_PriceVat" name="Sell_PriceVat"
                          maxlength="191"
                          placeholder="Sell_PriceVat" class="form-control"
                          type="text"  value="{{ old('Sell_PriceVat') }}"
                          onchange="vatToNormalPrice()"
                            required>
              `);
            }
             });
          });
</script>


  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('admlyt/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <script src="{{ asset('ajaxfunctions/mainajax.js') }}"></script>


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
