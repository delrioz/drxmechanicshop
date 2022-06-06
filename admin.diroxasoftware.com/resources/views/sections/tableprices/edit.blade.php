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

            <form action="/section/tableprices/update" method="POST" id="registro" name="registro" enctype="multipart/form-data">
                            @csrf
            <section class="testimonial py-3" id="testimonial">
                <div class="container"  style="box-shadow: 0 4px 12px 0 rgba(0, 0, 2, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.19)">
                    <div class="row ">
                        <div class="col-md-12 py-5 border">
                            <h4 class="pb-2" style="color:black;"><b>Adding a Service Price. Please, fill out the form.</b></h4>
                                <div class="form-row">
                                   <label for="" style="color:black;"><b> Name/ Title of servicing:</b></label>
                                    <div class="form-group col-md-12">
                                        <input id="name" name="name"  id="name"
                                        value="{{$findtableprices->name}}"
                                        placeholder="Name" class="form-control" type="text" required>
                                    </div>
                                    </div>
                                    <!-- 'name', 'nationality', 'address', 'about', 'nameofbusiness', 'email' -->

                                <div class="form-row">
                                    <div class="form-group col-md-12">

                                        <label for="" style="color:black;"><b> About:</b> <small style="color:red;"></small></label>
                                            <div class="form-group col-md-12">
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                                name="about"
                                                value="{{$findtableprices->about}}"
                                                    placeholder="about" id="about" required>Nothing to add</textarea>
                                            </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                      <div class="form-group col-md-6">
                                      <label for="" style="text-align:center;color:black;"><b>Service Price (GBP)</b></label>
                                      <input id="sell_price" name="sell_price"
                                              value="{{$findtableprices->sell_price}}"
                                              maxlength="191" onchange="myFunction()"
                                              placeholder="Sell_Price " class="form-control" type="text"
                                                required>
                                    </div>

                                    <div class="form-group col-md-6">
                                      <label for="" style="text-align:center;color:black;"><b>Service Price with 20% vat</b></label>

                                      <input id="sell_priceVat" name="sell_priceVat"
                                              maxlength="191"
                                              placeholder="sell_priceVat" class="form-control"
                                              type="text"
                                              value="{{$findtableprices->sell_priceVat}}"
                                               onchange="vatToNormalPrice()"
                                                required>
                                      </div>
                            </div>


                            <input type="text" name="tablepricesid" id="tablepricesid" value="{{$findtableprices->id}}" hidden>




                                <button type="submit" class="btn btn-warning">
                                <i class="fa fa-check fa-1x " aria-hidden="true"></i>
                                  <b>Update Service</b>
                                </button>
                                <a type="button" href="{{route('category.index') }}"  class="btn btn-danger"><b>Back</b></a>
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

  <script>

    $("#sell_price").on("change",function(){
      $(this).val(parseFloat($(this).val()).toFixed(2));
    });

    $("#sell_priceVat").on("change",function(){
      $(this).val(parseFloat($(this).val()).toFixed(2));
    });

  </script>

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
