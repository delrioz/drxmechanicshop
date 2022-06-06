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
            <form action="/section/machines/update/{{$allmachines->id}}" method="POST" id="registro" name="registro" enctype="multipart/form-data">
                            @csrf
            <section class="testimonial py-3" id="testimonial">
                <div class="container"  style="box-shadow: 0 4px 12px 0 rgba(0, 0, 2, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.19)">
                    <div class="row ">
                        <div class="col-md-12 py-5 border">
                            <h4 class="pb-2" style="color:black;"><b>Editing a Motorcycle. Please, fill out the form.</b></h4>
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

                                <div class="form-group col-md-6">
                                  <label for="" style="text-align:center;color:black;"><b>Serial Number</b></label>
                                    <input id="serial_number" name="serial_number"  id="serial_number"  placeholder="serial_number" class="form-control" type="text"
                                    value="{{$allmachines->serial_number}}" required>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="" style="text-align:center;color:black;"><b>Model</b></label>
                                    <input id="model" name="model"
                                    maxlength="191"
                                    placeholder="model" class="form-control" type="text"
                                    value="{{$allmachines->model}}"
                                    required>
                                </div>

                            </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                      <label for="" style="text-align:center;color:black;"><b>Brand</b></label>
                                    <input id="brand" name="brand"
                                            maxlength="191"
                                            placeholder="brand" class="form-control" type="text"
                                            value="{{$allmachines->brand}}"
                                            required>

                                    </div>

                                    <input type="text" name="StatusbackRoute" id="StatusbackRoute" value="{{$backRoute}}" hidden>
                                    <input type="text" name="machineId" id="machineId" value="{{$allmachines->id}}" hidden>


                                        <div class="form-group col-md-6">
                                          <label for="" style="text-align:center;color:black;"><b>Customer</b></label>
                                            <select id="owner" name="owner" class="form-control">
                                                  <option selected value="{{$IdOwnerMachine}}">{{$nameOwnerMachine}}</option>
                                                  <!-- @foreach($allcustomers as $allcustomer)
                                                  <option value="{{$allcustomer->id}}" >{{$allcustomer->name}}</option>
                                                  @endforeach -->
                                              </select>
                                        </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-3">
                                      <label>Optional</label><br>
                                      <label style="color:black;">Bike Mileage</label>
                                    <input id="mileage" name="mileage"
                                            maxlength="191" value="{{$allmachines->mileage}}"
                                            placeholder="mileage" class="form-control" type="text" required>
                                  </div>
                                </div><br>  

                                
                                <div class="row">
                                      <div class="col-md-12">
                                        <label for="" style="color:black;"><b> Observations: </b></label>
                                              <div class="form-group col-md-12">
                                              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                                  name="observations" placeholder="observations"
                                                  value="{{$allmachines->observations}}" id="observations" required>{{$allmachines->observations}}</textarea>
                                      </div>
                                  </div>

                        
                                <button type="submit" class="btn btn-warning">
                                  <i class="fas fa-save"></i>
                                  <b>Update Motorcycle</b>
                                </button>
                                @if($backRoute == 'welcomePage')
                                  <a type="button" href="{{route('welcome') }}"  class="btn btn-danger"><b>Back</b></a>
                                  @elseif($backRoute == 'customerMachineIndex')
                                      <a type="button" href="{{route('machine.index') }}"  class="btn btn-danger"><b>Back</b></a>
                                  @elseif($backRoute == 'generalSearchPage')
                                      <a type="button" href="{{route('general.search') }}"  class="btn btn-danger"><b>Back</b></a>
                                  @elseif($backRoute == 'machineOverviewPage')
                                      <a type="button" href="/section/machines/{{$IdOwnerMachine}}"  class="btn btn-danger"><b>Back</b></a>
                                  @elseif($backRoute == 'customerIndexViewPage')
                                      <a type="button" href="/section/customers/viewPage/{{$IdOwnerMachine}}"  class="btn btn-danger"><b>Back</b></a>
                                  @elseif($backRoute == 'indexMachine')
                                      <a type="button" href="/section/machines"  class="btn btn-danger"><b>Back</b></a>
                                  @elseif($backRoute == 'customerindexMachine')
                                      <a type="button" href="{{$from}}"  class="btn btn-danger"><b>Back</b></a>
                                  @else 
                                      <a type="button" href="{{route('machine.index') }}"  class="btn btn-danger"><b>Back</b></a>
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
