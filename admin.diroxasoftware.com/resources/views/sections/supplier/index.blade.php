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
          <!-- Page Headi

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-black-800" style="color:black!important;"><strong>SUPPLIERS</strong></h1>
                <a href="/section/suppliers/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-plus fa-sm text-white-50"></i> <b>ADD SUPPLIER</b></a>
          </div>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> <p class="mb-4">HERE YOU SEE ALL SUPPLIERS ON YOUR DATABASE</p></h6>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <!-- 'name', 'nationality', 'address', 'about', 'nameofbusiness', 'email' -->
                      <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Id</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Name</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Contact Number</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Email</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Created At</b></th>

                     <th style="font-family:verdana; font-size:95%; color:#38393b;" scope="col"><b>Actions</b></th>

                    </tr>
                  </thead>

                  <tbody>
                @foreach($allSuppliers as $supplier)

                    <tr>
                    <?php

                        $max = 30;
                        $str = " $supplier->name ";
                        $name=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                        $max = 30;
                        $str = " $supplier->email ";
                        $email=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                        $start = date('d/m/Y', strtotime($supplier->created_at));
                        $supllierTelephone = $supplier-> telephone;
                        $supplier-> contactNumber == "77777777777" ? $supllierTelephone =  'no telephone' : $supllierTelephone = $supplier->contactNumber;
                        $supplier-> contactEmail == "email@mail.com" ? $supplierEmail =  'no email' : $supplierEmail = $supplier->contactEmail;

                    ?>

                    <!-- 'name', 'nationality', 'address', 'about', 'nameofbusiness', 'email' -->
                    <td style="font-family:verdana; color:black;"><b>{{$supplier->id}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$name}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$supllierTelephone}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$supplierEmail}}</b></td>
                    <td style="font-family:verdana; color:black;">
                      <b hidden>{{$supplier->created_at}}</b>
                      <b>{{$start}}</b>
                    </td>

                    <td>
                        <a href="/section/suppliers/edit/{{$supplier->id}}" class="btn btn-primary btn-group">Edit</a>
                        <a href="/section/suppliers/destroy/{{$supplier->id}}"  class="btn btn-danger btn-group"
                        onclick="return confirm('Are you sure that you want delete this supplier?');">
                                Remove</a>
                        <a href="/section/suppliers/view/{{$supplier->id}}" class="btn btn-success btn-group">View Page</a>
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
