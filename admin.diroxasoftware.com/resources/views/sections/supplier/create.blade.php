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

            <form  id="myForm" enctype="multipart/form-data" action="/section/suppliers/store" method="POST">
                            @csrf
            <section class="testimonial py-3" id="testimonial">
                <div class="container"  style="box-shadow: 0 4px 12px 0 rgba(0, 0, 2, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.19)">
                    <div class="row ">
                        <div class="col-md-12 py-5 border">
                            <h4 class="pb-2" style="color:black;"><b>Adding a Supplier. Please, fill out the form</b></h4>
                              <div class="invalidData" role="alert">
                              </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                    <label for="" style="color:black;"> <b>Name:</b> </label>
                                        <input id="name" name="name"  id="name"  placeholder="Name" class="form-control" type="text"
                                        value="{{ old('name') }}" required>
                                    </div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                    </div>
                                    <!-- 'name', 'nationality', 'address', 'about', 'nameofbusiness', 'email' -->

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                    <label for="" style="color:black;"> <b>Contact Number:</b> </label>
                                    <input id="contactNumber" name="contactNumber"  value="{{ old('contactNumber') }}"
                                            maxlength="191" 
                                            placeholder="Contact Number" class="form-control" type="text" >
                                    </div>

                                        <div class="form-group col-md-6">
                                            <label for="" style="color:black;"> <b>Email:</b> </label>
                                            <input type="contactEmail" id="contactEmail" name="contactEmail" value="{{ old('contactEmail') }}"
                                            maxlength="191" 
                                            placeholder="Contact Email" class="form-control" type="text" >
                                        </div>
                                        
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                    <label for="" style="color:black;"> <b>Location:</b> </label>
                                    <input id="location" name="location" value="{{ old('location') }}"
                                            maxlength="191" 
                                            placeholder="location" class="form-control" type="text" >
                                    </div>
                                </div>

                                <label for="" style="color:black;"><b> Note: </b></label>
                                      <div class="form-group col-md-12">
                                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                          name="note" placeholder="note"
                                          value="{{ old('note') }}" id="note" ></textarea>
                              </div>


                                <button type="submit"  class="btn btn-warning">
                                  <i class="fa fa-check fa-1x " aria-hidden="true"></i>
                                  <b>Add Supplier</b>
                                </button>


                                @if($backRoute == 'welcomePage')
                                  <a type="button" href="{{route('welcome') }}"  class="btn btn-danger"><b>Back</b></a>
                                  @else
                                      <a type="button" href="{{route('supplier.index') }}"  class="btn btn-danger"><b>Back</b></a>
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


</script>
 
<script>
      $(document).ready(function(){
            // $('#ajaxSubmit').click(function(e){
              $(document).on("click", "#addmorephone", function(e){
              // var comboCidades = document.getElementById("option").value;
              var comboCidades = $('#mselect option:selected').val();
              var data=[];  
              // alert(comboCidades)
              // data.push(comboCidades);
              var valor = $('#mselect').val();
              // var texto = $('#mselect :selected').text();
              
              // alert('valor ' + valor);
              // alert('texto ' + texto);

              $('.addmorephone').empty();
              $(".newtelephones").append(`<br>
                      <div class="row">
                            <div class="col-md-6">
                                  <input id="newtelephones" name="newtelephones[]"  
                                  maxlength="191" 
                                  placeholder="New Number" class="form-control" type="text" required>
                            </div>
                            <div class="col-md-6">
                                <a href="" id="removeRow" name="removeRow" class="btn btn-danger">Remove</a>
                            </div>
                      </div>

                      <a href="#addmorephone" id="addmorephone" class="addmorephone">add more</a>
                  
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

                    console.log(result);
                    // alert('PEGOOOOOOOOOOOU!')
                    // $('.prodstables').empty();
                    $("#tableTitle").removeClass("d-none")
                    $resp = result;
                    $('.prodstables').empty();
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
            e.preventDefault();
            $(this).parent().parent().remove();
       
            });
          });
</script>


<!-- 

<script>
      $(document).ready(function(){
            // $('#ajaxSubmit').click(function(e){
              $(document).on("click", "#createAndHireMachine", function(e){
              // var comboCidades = document.getElementById("option").value;
              alert('ooi');
              // var name = $('#name').val();
              // var contactNumber = $('#telephone').val();
              // var extraNumber = $('#newtelephones').val();
              // var email = $('#email').val();
              // var address = $('#address').val();
              // var profileImage = $('#image').val();
              // var idImage = $('#idimage').val();
              // var proofofAddress = $('#proofOfAddress').val();
              

        
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
</script> -->

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
