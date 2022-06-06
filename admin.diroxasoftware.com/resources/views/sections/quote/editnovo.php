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

         <form action="/section/quote/update/{{$allQuotes->id}}" method="POST" id="registro" name="registro" enctype="multipart/form-data">
                            @csrf
            <section class="testimonial py-3" id="testimonial">
                <div class="container"  style="box-shadow: 0 4px 12px 0 rgba(0, 0, 2, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.19)">
                    <div class="row ">
                        <div class="col-md-12 py-5 border">
                            <h4 class="pb-2" style="color:black;">Editing a Quote. Please, fill out the form.</h4>
                            @if($errors->any())
                                      <div class="alert alert-danger">
                                          <ul>
                                            @foreach ($errors->all() as $error)
                                                  <li>{{ $error }}</li>
                                            @endforeach
                                          </ul>
                                      </div>
                              @endif
                            <div class="form-row">
                            <label for="" style="color:black;"> Title: </label>
                                <div class="form-group col-md-12">
                                    <input id="title" name="title"  id="title"  placeholder="title" class="form-control" type="text"
                                           value = "{{$allQuotes->title}}" required>
                                </div>

                            </div>
                            <div class="form-row">
                                    <label for="" style="color:black;"> Customer Report: </label>
                                        <div class="form-group col-md-12">
                                        <input type="text" value="{{$allQuotes->customer_report}}" name ="customer_report" hidden>  
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                                name="customer_report"
                                                placeholder="Customer Report" id="customer_report" disabled>{{$allQuotes->customer_report}}</textarea>
                                  </div>
                            </div>

                            <div class="form-row">
                                    <label for="" style="color:black;"> First Observations: </label>
                                        <div class="form-group col-md-12">
                                        <input type="text" value="{{$allQuotes->first_observations}}" name ="first_observations" hidden>  
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                              name="first_observations" 
                                              placeholder="First Observations" id="first_observations" disabled>{{$allQuotes->first_observations}}</textarea>

                                  </div>
                            </div>

                            <div class="form-row">
                                      <label for="" style="color:black;"> Last Observations: </label>
                                          <div class="form-group col-md-12">
                                          <textarea class="form-control"  rows="3"
                                                name="last_observations" class="last_observations" value="{{$allQuotes->last_observations}}"
                                                placeholder="Last Observations" id="last_observations">{{$allQuotes->last_observations}}</textarea>

                              </div>


                                
                            <div class="form-group col-md-6">
                                       <label for="" style="color:black;"> Customer: </label>
                                        <input type="text" value="{{$name}}" name ="customer" hidden>  
                                        <select id="customer" name="customer" class="form-control" disabled>
                                          <option selected>{{$allQuotes->customerName}}</option>
                                      </select>
                              </div>


                            <div class="form-group col-md-6">
                                       <label for="" style="color:black;"> Machine: </label>
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
                                              <label for="">Products</label><br>
                                              <select id="mselect" multiple style="width:300px;"  name="Productsoptions[]">
                                            @if($statusNulo == false)
                                              @foreach($respostaProducts as $products)
                                                <option id="option" value="{{$products->id}}">{{$products->name}}</option>
                                              @endforeach

                                              @foreach($outrasop as $op)
                                              <option id="option" value="{{$op->product_id}}" selected>{{$op->productName}}</option>
                                              @endforeach
                                            @endif

                                            @if($statusNulo == true)
                                              @foreach($outrasop as $op)
                                              <option id="option" value="{{$op->product_id}}" selected>{{$op->productName}}</option>
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
                                  <div class="col-md-6">
                                      <label for="productName">Product Name</label>
                                      <input type="text"  class="form-control mb-2 mr-sm-2" value="{{$product->name}}" placeholder="Product Name">
                                      <input type="hidden"  class="form-control mb-2 mr-sm-2"  name="productName[]" id="productName" value="{{$product->id}}" placeholder="Product ID">
                                      </div>
                                  <div class="col-md-6">
                                      <label  for="quantity">Quantity</label>
                                      <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                        </div>
                                        <input type="number"  class="form-control" name="quantity[]" id="quantity"  value="{{$product->quantity}}" placeholder="Quantity">

                                      </div>
                                    </div>
                                </div>
                               @endforeach
                               @endif

                            <span id="tableTitle" class="d-none">
                               <div class="title "><h3 style="text:center;">Preview Products</h3></div>
                                  <div class="row">
                                  <table class="table">
                                      <thead>
                                        <tr>
                                          <th>Image</th>
                                          <th>Name</th>
                                          <th>SKU</th>
                                          <th>Sell Price</th>
                                          <th>Quantity</th>
                                          <th>Created At</th>
                                        </tr>
                                      </thead>
                                      <tbody class="prodstables" id="prodstables">

                                      </tbody>
                                    </table>
                                </div>
                              </span>


                               <div class="title"><h3 style="text:center;">Products on this order</h3></div>
                                @foreach($ProductsSelected as $product)
                                  <div class="row newProdutos" id ="newProdutos" >
                                  <div class="col-md-6" > 
                                      <label for="productName">Product Name</label>
                                      <input type="text"  class="form-control mb-2 mr-sm-2" value="{{$product->productName}}" placeholder="Product Name">
                                      <input type="hidden"  class="form-control mb-2 mr-sm-2"  name="productName[]" id="productName" value="{{$product->product_id}}" placeholder="Product ID">
                                      </div>
                                  <div class="col-md-6 newProdutosQts"  name = "newProdutosQts">
                                      <label  for="quantity">Quantity</label>
                                      <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                        </div>
                                        <input type="number"  class="form-control" name="quantity[]" id="quantity"  value="{{$product->pmqProductQuantity}}" placeholder="Quantity">
                                      </div>
                                    </div>
                                </div>
                               @endforeach
                               <input type="number"  class="form-control" name="id" id="id"  value="{{$allQuotes->id}}" placeholder="id" hidden >
                                <button type="submit" class="btn btn-warning">Save and Go</button>
                                <button type="submit" class="btn btn-warning">Save and</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->


      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
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
  


</script>


<script>
      $(document).ready(function(){
        // produtos que ja estavam nessa pag ao carregar

        var prodsIniciais = $('#mselect').val();
        alert(prodsIniciais);

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
                    $('.newProdutos').empty();
                    $.each($resp, function (key, value){
                      $(".prodstables").append(`
                            <tr>
                                <td> <img src="/storage/`+ value.image + `" class="media-photo"
                                  style="width: 70px; height:70px;" alt="/storage/`+ value.image + `"></td>
                                <td>` + value.name + `</td>
                                <td>` + value.SKU + `</td>
                                <td>`+ value.Sell_PriceVat + `</td>
                                <td>`+ value.quantity + `</td>
                                <td>`+ value.created_at + `</td>
                            </tr>
                    `);
                    
                  });
                  getAjax2(prodsIniciais, valor);
          
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
    function getAjax2(prodsIniciais, valor){
                  alert('prodsIniciais');
                  alert(prodsIniciais);
                  alert('selecionados');
                  alert(valor);
                  
                  var produtosaocarregar = [];
                  var valoresselecionados = [];

                  produtosaocarregar.push(prodsIniciais);
                  valoresselecionados.push(valor);

                  $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               $.ajax({
                  url: "{{ url('/section/products/getProdsAjax2') }}",
                  method: 'post',
                  data: {
                     data: produtosaocarregar, valoresselecionados,
                     _token: '{{csrf_token()}}'},

                  success: function(result){
                    console.log(result);

                  },
                  error: function(jqXHR, textStatus, errorThrown, result) {
                   
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
