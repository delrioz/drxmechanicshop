<!DOCTYPE html>

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

      <span>
            @include('sections.components.topnavbar')
      </span>


        <!-- Begin Page Content -->
        <div class="container-fluid">

        @if($errors->any())
          <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                @endforeach
              </ul>
          </div>
        @endif

       <!-- Page Heading -->
          <!-- DataTales Example -->
         <!------ Include the above in your HEAD tag ---------->

            <form  id="myForm" enctype="multipart/form-data" action="/section/extrasales/store" method="POST">
                            @csrf
            <section class="testimonial py-3" id="testimonial">
                <div class="container"  style="box-shadow: 0 4px 12px 0 rgba(0, 0, 2, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.19)">
                    <div class="row ">
                        <div class="col-md-12 py-5 border">
                            <h4 class="pb-2" style="color:black;">Creating a Customer. Please, fill out the form.</h4>
                              <div class="invalidData" role="alert">
                              </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                    <label for="" style="color:black;"> description: </label>
                                        <input  class="form-control" type="text"
                                        value="{{ old('description') }}" required>
                                    </div>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                    </div>
                                    <!-- 'name', 'nationality', 'address', 'about', 'nameofbusiness', 'email' -->

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                    <label for="" style="color:black;"> sales_price: </label>
                                    <input 
                                            maxlength="191" 
                                            placeholder="sales_price" class="form-control" type="text" required>
                                    </div>


                                        <div class="form-group col-md-6">
                                            <label for="" style="color:black;"> sales_vat: </label>
                                            <input type="sales_vat" 
                                            maxlength="191" 
                                            placeholder="sales_vat" class="form-control" type="text" required>
                                        </div>
                                </div>


                                <div class="row">
                                

                                <div class="form-group col-md-6">
                                            <label for="" style="color:black;"> discount: </label>
                                            <input 
                                            maxlength="191" 
                                            placeholder="discount" class="form-control" type="text" required>
                                </div>
                                        
                                

                                <div class="form-group col-md-6">
                                    <label for="" style="color:black;"> methodPayment: </label>
                                    <input type="methodPayment" 
                                    maxlength="191" 
                                    placeholder="methodPayment" class="form-control" type="text" required>
                                </div>
                                </div>

                                <button type="submit"  class="btn btn-warning">Conclude Sales</button>
                                <a type="button" href="{{route('carrito.index') }}"  class="btn btn-info">Back</a>

                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Open modal for @mdo</button>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">Open modal for @fat</button>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Open modal for @getbootstrap</button>

  
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




  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</script>
<script>
    myFunction2();
      $(document).ready(function(){
            $('#ajaxSubmit').click(function(e){
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               $.ajax({
                  url: "{{ url('/section/costumers/createAjax') }}",
                  method: 'post',
                  data: {
                     name: $('#name').val(),
                     telephone: $('#telephone').val(),
                     email: $('#email').val(),
                     address:$('#address').val(),
                     _token: '{{csrf_token()}}'},
                  success: function(result){
                    alert('Customer Created!')
                    window.location.href = "{{ route('customer.index') }}";
                     console.log(result);
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

  function myFunction()
      {
        var Sales_Price = document.getElementById("Sales_Price").value;
        // document.getElementById("Sell_PriceVat").value = Sales_Price; 
        var takingVatPrice =   (Sales_Price * 0.20).toFixed(2);

        document.getElementById("Sales_PriceVat").value = Number(Sales_Price) + Number(takingVatPrice); 
        // document.getElementById("Sell_PriceVatView").value = Number(Sales_Price) + Number(takingVatPrice); 

      }

    function myFunction2()
        {
          var Sales_Price = document.getElementById("Sales_Price").value;
          // document.getElementById("Sell_PriceVat").value = Sales_Price; 
          var takingVatPrice =   (Sales_Price * 0.20).toFixed(2);

          document.getElementById("Sales_PriceVat").value = Number(Sales_Price) + Number(takingVatPrice); 
          // document.getElementById("Sell_PriceVatView").value = Number(Sales_Price) + Number(takingVatPrice); 

        }
</script>

  <!-- <script src="{{ asset('admlyt/js/customer/createandAddmachine.js') }}"></script> -->

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

</body>

</html>
