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

          <!-- Page Heading -->

          <!-- DataTales Example -->

         <!------ Include the above in your HEAD tag ---------->
            <form  id="myForm" enctype="multipart/form-data" action="/section/customers/store" method="POST">
                            @csrf
            <section class="testimonial py-3" id="testimonial">
                <div class="container"  style="box-shadow: 0 4px 12px 0 rgba(0, 0, 2, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.19)">
                    <div class="row ">
                        <div class="col-md-12 py-5 border">
                            <h4 class="pb-2" style="color:black;">This Customer's Data</h4>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                    <label for="" style="color:black;"> Name: </label>
                                        <input id="name" name="name"  id="name"
                                          value="{{$thisCustomer->name}}" disabled
                                          placeholder="Name" class="form-control" type="text" >
                                    </div>
                                    </div>
                                    <!-- 'name', 'nationality', 'address', 'about', 'nameofbusiness', 'email' -->

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                    <label for="" style="color:black;"> Contact Number: </label>
                                    <input id="telephone" name="telephone"
                                            maxlength="191"
                                            value="{{$thisCustomer->telephone}}" disabled
                                            placeholder="telephone" class="form-control" type="text" >
                                    </div>


                                        <div class="form-group col-md-6">
                                            <label for="" style="color:black;"> Email: </label>
                                            <input id="email" name="email"
                                            value="{{$thisCustomer->email}}" disabled
                                            maxlength="191"
                                            placeholder="email" class="form-control" type="text" >
                                        </div>
                                        <!-- <a href="/section/hireamachine/viacustomer/choosingngmachine/{{$thisCustomer->id}}" type="button" class="btn btn-success"><b>Go to Hire Machine</b></a> -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->


         <!-- Begin Page Content -->
    <div class="container-fluid">
              @if(session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                    </button>
              </div>
          @endif

          @if(session('error'))
            <div class="alert alert-danger">
              {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                </button>
            </div>
          @endif

      <form action="/section/machines/store" method="POST" id="registro" name="registro" enctype="multipart/form-data">
                      @csrf
      <section class="testimonial py-3" id="testimonial">
          <div class="container"  style="box-shadow: 0 4px 12px 0 rgba(0, 0, 2, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.19)"
          id="creatingMachineContainer">
              <div class="row ">
                  <div class="col-md-12 py-5 border">

                  <div class="alert  alert-success d-none messageBox" role="alert">
                      </div>

                      <h4 class="pb-2" style="color:black;"><b>Creating a Motorcycle. Please, fill out the form.</b></h4>
                      <div class="invalidData" role="alert">

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

                          <div class="form-row">
                          <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->
                          @if($latestMachine != "")
                                                  <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->
                                  <div class="form-group col-md-6">
                                    <label for="" style="text-align:center;color:black;"><b>Serial Number</b></label>
                                      <input id="serial_number" name="serial_number"  id="serial_number"
                                      value="{{ old('serial_number') }}"
                                      placeholder="The last Serial Number was: {{$latestMachine->serial_number}}" class="form-control" type="text">
                                      The last Serial Number: <b>{{$latestMachine->serial_number}}</b>
                                  </div>
                          @else

                                  <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->
                                  <div class="form-group col-md-6">
                                    <label for="" style="text-align:center;color:black;"><b>Serial Number</b></label>
                                      <input id="serial_number" name="serial_number"  id="serial_number"
                                      value="{{ old('serial_number') }}"  placeholder="serial_number" class="form-control" type="text">
                                  </div>
                          @endif


                          <div class="form-group col-md-6">
                            <label for="" style="text-align:center;color:black;"><b>Model</b></label>

                              <input id="model" name="model"
                              maxlength="191" value=""
                              placeholder="model" class="form-control" type="text" >
                          </div>

                      </div>
                          <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="" style="text-align:center;color:black;"><b>Brand</b></label>

                              <input id="brand" name="brand"
                                      maxlength="191" value=""
                                      placeholder="brand" class="form-control" type="text" >
                              </div>

                              <div class="form-group col-md-6">
                                <label for="" style="text-align:center;color:black;"><b>Customer</b></label>
                                <select id="owner" name="owner" class="form-control">
                                      <option value="{{$thisCustomer->id}}">{{$thisCustomer->name}}</option>
                                </select>
                                <!-- <a href="/section/customers/create">Create a customer</a> -->
                            </div>
                          </div>

                            <div class="row">
                                      <div class="col-md-3">
                                          <label>Optional</label><br>
                                          <label style="color:black;">Bike Mileage</label>
                                        <input id="mileage" name="mileage"
                                                maxlength="191" value="{{ old('mileage') }}"
                                                placeholder="mileage" class="form-control" type="text" required>
                                      </div>
                            </div>
                                  <br>
                            <div class="row">
                                  <div class="col-md-12">
                                    <label for="" style="color:black;"><b> Observations: </b></label>
                                          <div class="form-group col-md-12">
                                          <textarea id="observations" name="observations"
                                              maxlength="191" value="{{ old('observations') }}"
                                              placeholder="observations" class="form-control" type="text" required>dasdasdasdasdas</textarea>
                                  </div>
                              </div>
                            </div>
                    
                          <button type="submit" id="ajaxSubmit" class="btn btn-warning"><b>
                            <i class="fa fa-plus fa-1x " aria-hidden="true"></i>
                            Create and Add More</b></button>
                          <button type="submit" class="btn btn-info">
                            <i class="fa fa-plus fa-1x " aria-hidden="true"></i>
                            <b>Create Motorcycle and Go</b>
                          </button>

                          <a type="submit" href="/section/customers/viewPage/{{$thisCustomer->id}}" class="btn btn-primary">
                            <i class="fa fa-plus fa-1x " aria-hidden="true"></i>
                            <b>View All about {{$thisCustomer->name}}</b>
                          </a>
                      </form>

                      <a type="button" href="/section/customers" class="btn btn-success">
                            <i class="fa fa-plus fa-1x " aria-hidden="true"></i>
                            <b>View All Customers</b>
                    </a>

                  </div>
              </div>
          </div>
    </section>

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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</script>
<script>
      $(document).ready(function(){

            // $('#ajaxSubmit').click(function(e){
              $(document).on("click", "#ajaxSubmit", function(e){
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               $.ajax({
                  url: "{{ url('/section/costumers/createMachineAjax') }}",
                  method: 'post',
                  data: {
                     serial_number: $('#serial_number').val(),
                     model: $('#model').val(),
                     brand: $('#brand').val(),
                     owner: $('#owner').val(),
                     customer_report: $('#customer_report').val(),
                     mileage: $('#mileage').val(),
                     observations: $('#observations').val(),
                     _token: '{{csrf_token()}}'},

                  success: function(result){
                    // console.log('dasdasdasdsadas');
                    // alert('Customer Created!')
                    $('.invalidData').empty();
                    $msg = '<h4><strong>Motorcycle successfull created</h4>';
                    $('.messageBox').removeClass('d-none').html($msg);
                      // $("#serial_number").empty();
                      document.getElementById('serial_number').value = '';
                      document.getElementById('model').value = '';
                      document.getElementById('brand').value = '';
                      document.getElementById('mileage').value = '';
                      document.getElementById('observations').value = '';

                    // window.location.href = "{{ route('customer.index') }}";
                    //  console.log(result);
                  },
                  error: function(jqXHR, textStatus, errorThrown, result) {
                      // console.log(jqXHR.responseJSON.errors)
                      $msg = 'oi';
                      $resp = jqXHR.responseJSON.errors;
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
