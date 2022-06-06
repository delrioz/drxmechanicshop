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

      @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">
            {{ session('error') }}
            </div>
        @endif

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-black-800" style="color:black!important;"><strong>SUPPLIERS</strong></h1>
              <a href="/section/SUPPLIERS/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                      class="fas fa-plus fa-sm text-white-50"></i> <b>ADD SUPPLIERS</b></a>
          </div>
          

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">

              <p class="m-0 font-weight-bold text-primary" style="color:black;">HERE YOU SEE ALL SUPPLIERS ON YOUR DATABASE</a></p>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <!-- 'name', 'serial_number', 'categorie', 'situation', 'year', 'brand', 'image', 'price', 'discount', 'about' -->

                      <th style="font-family:verdana; font-size:95%; color:#38393b;"><b>Id</b></b></th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;"><b>Name</b></th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;"><b>Created At</b></th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;"><b>View</b></th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;"><b>Edit</b></th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;"><b>Remove</b></th>

                    </tr>
                  </thead>

                  <tbody>
                    @foreach($allcategories as $category)

                    <tr>
                    <?php

                    $max = 10;
                    $str = " $category->name ";
                    $name=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                    $max = 25;
                    $str = " $category->about ";
                    $about=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);
                    $start = date('d-m-Y', strtotime($category->created_at));

                    $max2 = 150;
                    $str = " $category->name ";
                    $categoryName=  substr_replace($str, (strlen($str) > $max2 ? '...' : ''), $max2);


                    ?>

                    <td style="font-family:verdana; color:black;"><b>{{$category-> id}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$categoryName}}</b></td>
                    <td style="font-family:verdana; color:black;"><b><b>{{$start}}</b></td>
                    <td>
                        <a href="/section/categories/view/{{ $category->id }}" class="btn btn-block btn-primary btn-circle" style="background-color:#050d80"><i class="fas fa-eye"></i></a>
                    </td>
                    <td>
                        <a href="/section/categories/edit/{{$category->id}}" class="btn btn-block btn-primary btn-group btn-circle"><i class="fas fa-edit"></i></a>
                    </td>
                    <td>
                        <a href="/section/categories/destroy/{{$category->id}}"  class="btn btn-block btn-danger btn-group btn-circle"
                        onclick="return confirm('Are you sure that you want delete this Product?');">
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

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; DiroxaSoftware 2020</span>
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
