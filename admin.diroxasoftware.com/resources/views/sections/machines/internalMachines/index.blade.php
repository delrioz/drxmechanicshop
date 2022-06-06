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
                    <!-- Begin Page Content -->
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

          <?php
                $from = "indexInternalMachines";
          ?>

          <!-- Page Heading -->
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-black-800" style="color:black!important;"><strong>GARAGE'S MOTORCYCLES</strong></h1>
              <a href="/section/internalMachines/create/{{$from}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                      class="fas fa-plus fa-sm text-white-50"></i> <b>ADD MOTORCYCLE</b></a>
          </div>

          <!-- <a href="/section/machines/create">CREATE NEW ONE</a></p> -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"> <p class="mb-4">HERE YOU SEE ALL INTERNAL MOTORCYCLES ON YOUR DATABASE.  </a></p></h6>
              <h6 class="m-0 font-weight-bold text-primary"> <p class="mb-4">Can't find a Motorcycle?</a><a href="/section/searches/machines" style="color:grey;"> Go to Motorcycle's Search Page</a></p></h6>


            </div>
            <div class="card-body" id="card-bodytable">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->

                      <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Id</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Serial Number</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Model</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Brand</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Created At</b></th>
                     <th style="font-family:verdana; font-size:100%; color:#38393b;" scope="col"><b>Actions</b></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($allmachines as $machine)

                    <tr>
                    <?php

                    $max = 26;
                    $str = " $machine->id";
                    $id=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                    $max = 26;
                    $str = " $machine->customerName";
                    $owner=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                    $max = 26;
                    $str = " $machine->brand";
                    $brand=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                    $max = 26;
                    $str = " $machine->serial_number";
                    $serial_number=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                    $max = 26;
                    $str = " $machine->model";
                    $model=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                    $start = date('d/m/Y', strtotime($machine->created_at))

                    ?>

                    <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->

                    <td style="font-family:verdana; color:black;"><b>{{$id}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$serial_number}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$model}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$brand}}</b></td>
                    <td style="font-family:verdana; color:black;">
                      <b hidden>{{$machine->created_at}}}</b>
                      <b>{{$start}}</b>
                    </td>

                    <td>
                        <!-- <a href="/section/internalMachines/view/{{ $machine->id }}/{{$from}}" class="btn btn-primary btn-circle" style="background-color:#050d80"><i class="fas fa-eye"></i></a> -->
                        <a href="/section/internalMachines/edit/{{$machine->id}}/{{$from}}" class="btn btn-primary btn-group btn-circle"><i class="fas fa-edit"></i></a>
                        <a href="/section/internalMachines/destroy/{{$machine->id}}"  class="btn btn-danger btn-group btn-circle"
                        onclick="return confirm('Are you sure that you want delete this Machine?');">
                        <i class="fas fa-trash"></i></a>

                    </td>
                    </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

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


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <form action="/section/machines/store" method="POST" id="registro" name="registro" enctype="multipart/form-data">
                            @csrf
            <section class="testimonial py-3" id="testimonial">
                <div class="container">
                    <div class="row ">
                        <div class="col-md-12 py-5 border">

                        <div class="alert  alert-success d-none messageBox" role="alert">
                        </div>

                            <h4 class="pb-2" style="color:black;">Creating a Machine. Please, fill out the form.</h4>
                                <div class="form-row">
                                                    <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->
                                    <div class="form-group col-md-6">
                                      <label for="" style="text-align:center;">Serial Number</label>

                                        <input id="serial_number" name="serial_number"  id="serial_number"  placeholder="Serial Number" class="form-control" type="text" required>
                                    </div>

                                <div class="form-group col-md-6">
                                  <label for="" style="text-align:center;">Model</label>

                                    <input id="model" name="model"
                                    maxlength="191"
                                    placeholder="model" class="form-control" type="text" required>
                                </div>

                            </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                      <label for="" style="text-align:center;">Brand</label>

                                    <input id="brand" name="brand"
                                            maxlength="191"
                                            placeholder="brand" class="form-control" type="text" required>
                                    </div>

                                </div>
                                <button type="submit" id="ajaxSubmit" class="btn btn-warning">Create Machine</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

          </div>
          <!-- /.container-fluid -->
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
                    url: "{{ url('/section/internalMachines/createMachineAjax') }}",
                    method: 'post',
                    data: {
                      serial_number: $('#serial_number').val(),
                      model: $('#model').val(),
                      brand: $('#brand').val(),
                      _token: '{{csrf_token()}}'},

                    success: function(result){
                      // alert('Customer Created!')
                      // alert(result)
                      $msg = '<h4><strong>Machine successfull created</h4>';
                      $('.messageBox').removeClass('d-none').html($msg);
                        // $("#serial_number").empty();
                        document.getElementById('serial_number').value = '';
                        document.getElementById('model').value = '';
                        document.getElementById('brand').value = '';
                      // console.log(result);
                      // add mais uma coluna na tabela
                      window.location.href = "{{ route('internalmachines.index') }}";

                      }}
                    );
                });
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
