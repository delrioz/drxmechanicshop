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

          <!-- Page Heading -->

          <!-- DataTales Example -->
         <!------ Include the above in your HEAD tag ---------->

                            <div class="container">
                              <h2>Form control: checkbox</h2>
                              <p>The form below contains three checkboxes. The last option is disabled:</p>
                              
                        <form action="/section/products/store" method="POST" id="registro" name="registro" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input id="name" name="name"  id="name"  placeholder="Name" class="form-control" type="text"
                                         required>
                                    </div>

                                <div class="form-group col-md-6">
                                    <input id="SKU" name="SKU" 
                                            maxlength="191" 
                                            placeholder="SKU" class="form-control" type="text"
                                             required>
                                    </div>
                                </div>
                                <div class="form-row">
                                <div class="form-group col-md-6">
                                        <select id="category" name="category" class="form-control">
                                          @foreach($allcategories as $allcategory)
                                          <option>{{$allcategory->name}}</option>
                                          @endforeach
                                      </select>
                              </div>
                              <div class="form-group col-md-6">
                                      <select id="situation" name="situation" class="form-control">
                                            <option>NEW</option>
                                            <option>USED</option>
                                        </select>
                              </div>
                          </div>
                                <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input id="brand" name="brand" 
                                            maxlength="191" 
                                            placeholder="brand" class="form-control" type="text"
                                             required>
                                  </div>


                                        <div class="form-group col-md-6">
                                            <input id="year" name="year" 
                                            maxlength="191" 
                                            placeholder="Year" class="form-control" type="text" 
                                            required>
                                        </div>
                                </div>

                                <div class="form-row">
                                  <div class="form-group col-md-6">
                                    <input id="Cost_Price" name="Cost_Price" 
                                            maxlength="191" 
                                            placeholder="Cost_Price" class="form-control" type="text"
                                             required>
                                  </div>

                                  <div class="form-group col-md-6">
                                    <input id="Sell_Price" name="Sell_Price" 
                                            maxlength="191" 
                                            placeholder="Sell_Price " class="form-control" type="text"
                                             required>
                                 </div>
                                 
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                    <input id="VAT" name="VAT" 
                                            maxlength="191" 
                                            placeholder="VAT " class="form-control" type="text"
                                             required>
                                    </div>
                                    
                                        <div class="form-group col-md-6">
                                            <input id="discount" name="discount" 
                                            maxlength="191" 
                                            placeholder="discount" class="form-control" type="text" 
                                            required>
                                        </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                    <label for="">Quantity</label>
                                    <input id="quantity" name="quantity" 
                                            maxlength="191" 
                                            placeholder="quantity " class="form-control" 
                                            type="number"
                                             required>
                                    </div>
                                    <div class="form-group col-md-6">
                                    <label for="">Machines</label>
                                    @foreach($allmachines as $machines)
                                <div class="checkbox">
                              <label><input type="checkbox" name="Machinesoptions[]"  id="option" value="{{$machines->id}}">{{$machines->model}}</label>
                                </div>
                              @endforeach
                            </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                        <label for="" style="color:black;"> About: </label>
                                            <div class="form-group col-md-12">
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                                name="about" 
                                                    placeholder="about" id="about">
                                            </textarea>
                                </div>



                                <div class="form-group col-md-6">
                          
                                <div class="form-group col-md-6">
                                    <input type="file" class="form-control-file" id="exampleFormControlFile1"
                                    name="image" >
                                </div>
                            </div>
                        </div>
           
                        <button type="submit" class="btn btn-success">Create Product</button>

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
