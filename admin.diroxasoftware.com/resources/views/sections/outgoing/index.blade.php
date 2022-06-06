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

          <?php
                $from = "indexOutGoing";
          ?>


      <!-- Content Row -->
      <div class="row">
                          <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 ">

              </div>

                          <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        <a  style="color:green;"> <b>Number of Expenses</b></a>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><strong style="color:blue;">{{$nTotalOutgoing}}</strong></div>
                        <b>total number of expenses</b>
                      </div>
                      <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>




            <!-- Earnings (Monthly) Card Example -->
                  <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        <a style="color:green;"> <b>AMOUNT EXPENSES</b></a>
                        </div>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><strong style="color:blue;">£{{$amountExpenses}}</strong>
                                </div><b>TOTAL AMOUNT OF EXPENSES</b>
                          </div>
                          <div class="col">
                          </div>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              </div>




          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
             <h1 class="h3 mb-2 text-black-800" style="color:black;"><strong>Expenses</strong></h1>
              <a href="/section/outgoing/create/{{$from}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                      class="fas fa-plus fa-sm text-white-50"></i> <b>ADD EXPENSES</b></a>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <!-- <h6 class="m-0 font-weight-bold text-primary"> <p class="mb-4"><b>HERE YOU SEE ALL PRODUCTS ON YOUR DATABASE</a></p></b></h6> -->
              <!-- <h6 class="m-0 font-weight-bold text-primary"> <p class="mb-4"><b>Can't find a poduct?</a><a href="/section/searches/products" style="color:grey;"><b> Go to Product's Search Page</b></a></p></b></h6> -->

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <!-- 'name', 'serial_number', 'categorie', 'situation', 'year', 'brand', 'image', 'price', 'discount', 'about' -->

                      <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Title</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Code</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Category</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Quantity</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Total Expenses</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;" scope="col"><b>Actions</b></th>

                    </tr>
                  </thead>

                  <tbody>
                    @foreach($alloutgoing as $outgoing)

                    <tr>

                    <?php
                        $max = 100;
                        $str = " $outgoing->name ";
                        $name=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                        $max = 10;
                        $str = " $outgoing->about ";
                        $about=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                        $max = 35;
                        $str = " $outgoing->title ";
                        $title=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                        $max = 10;
                        $str = " $outgoing->code ";
                        $code=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                        $max = 40;
                        $str = " $outgoing->outgoingCategoryName ";
                        $categoryName=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                        $start = date('d/m/Y', strtotime($outgoing->created_at));

                        $Cost_Price = number_format($outgoing->Cost_Price, 2, '.',',');




                        if($outgoing->quantity <= 2){
                          $statusQuantity = "low quantity";
                        }
                        else{
                          $statusQuantity = "";
                        }
                    ?>


                    <!-- <img src="/storage/{{$outgoing->image}}" class="media-photo"
                    style="width: 70px; height:70px;"alt="Sheep"> -->
                    <!-- <img src="/storage/{{$outgoing->image}}" alt="Imagem" />  -->



                    <td style="font-family:verdana; color:black;"><b>{{$title}}</b>

                    <td style="font-family:verdana; color:black;"><b>{{$code}}</b>
                    </td>


                    <td style="font-family:verdana; color:black;"><b>{{$categoryName}}</b>
                    </td>

                    <td style="font-family:verdana; color:black;"><b>{{$outgoing->quantity}}</b></td>

                    <td style="font-family:verdana; color:red;"><b>£{{$Cost_Price}}</b>
                    </td>
                    <td>
                        <div class="row">
                          <div class="col-md-12">
                              <a href="/section/outgoing/view/{{$outgoing->outgoingId}}/{{$from}}" style="background-color:#050d80" class="btn btn-block text-white btn-circle" >
                                        <i class="fas fa-eye" ></i>
                              </a>
                              <a href="/section/outgoing/edit/{{$outgoing->outgoingId}}/{{$from}}" class="btn btn-block btn-primary btn-circle">
                                        <i class="fas fa-edit"></i>
                              <a href="/section/outgoing/destroy/{{$outgoing->outgoingId}}" class="btn btn-block btn-danger btn-circle"
                               onclick="return confirm('Are you sure that you want delete this Outgoing report?');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                              </a>
                          </div>
                        </div>
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
