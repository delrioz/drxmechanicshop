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
              </div>
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
             <h1 class="h3 mb-2 text-black-800" style="color:black;"><strong>Appointments</strong></h1>
              <a href="/section/appointments/create/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                      class="fas fa-plus fa-sm text-white-50"></i> <b>BOOK Appointments</b></a>
          </div>

          <?php
            $hoje = date('d/m/Y');

            $start = date('d/m/Y', strtotime($start));
            $end = date('d/m/Y', strtotime($end));

          ?>

        @if($searchingAlertSection !=null)
          <div class="alert alert-warning">
            <p>Searching data between {{$start}} to {{$end}}</p>
          </div>
        @endif
      @if(isset($foundCustomer ))
          @if($foundCustomer == null)
            <div class="form-group">
              <form action="{{route('appointments.appointmentsajax')}}" method="POST" name="formSearch">
              @csrf
                  <label for="start" style="color:black!important;">Start date:</label>
                      <input type="date" id="start" name="dataComecoPadraoDateTime"
                      value="{{$hoje}}"
                      min="{{$hoje}}" max="{{$hoje}}">

                    <label for="start" style="color:black!important;">Final date:</label>
                      <input type="date" id="end" name="dataFimPadraoDateTime"
                      value="{{$hoje}}"
                      min="{{$hoje}}" max="{{$hoje}}">
                    <!-- <input type="submit" value="search"> -->
                    <button type="submit" class="btn btn-info" id="ajaxSubmit" value="Search">Search</button>
              </form>
              <br>
            </div>
          @else
            <div class="alert alert-warning">
              <p>Searching all Appointments from {{$foundCustomer->name}}</p>
              <a href="/section/customers/viewPage/{{$foundCustomer->id}}">Go to his Profile's page</a>
            </div>
          @endif
        @endif



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
                      <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>About</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Appointment Date</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Customer</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;" scope="col"><b>Actions</b></th>

                    </tr>
                  </thead>

                  <tbody>
                    @foreach($allAppointment as $appointment)

                    <tr>

                    <?php
                        $max = 100;
                        $str = " $appointment->name ";
                        $name=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);
                        $max = 10;
                        $str = " $appointment->about ";
                        $about=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                        $max = 10;
                        $str3 = " $appointment->nameInCustomer ";
                        $nameInCustomer =  substr_replace($str3, (strlen($str3) > $max ? '...' : ''), $max);


                        // $appointmentDate = date('d/m/Y', strtotime($appointment->appointmentDate));
                        $appointmentDate = date('d/m/Y H:i', strtotime($appointment->appointmentHoursDate));
                    ?>



                    <td style="font-family:verdana; color:black;"><b>{{$name}}</b>

                    <td style="font-family:verdana; color:black;"><b>{{$about}}</b>
                    </td>

                    <td style="font-family:verdana; color:black;"><b>{{$appointmentDate}}</b>

                    <td style="font-family:verdana; color:black;">
                            <a href="/section/customers/viewPage/{{$appointment->idInCustomer}}">
                                <b>{{$nameInCustomer}}</b>
                            </a>

                        </td>
                    <td>
                        <div class="row">
                          <div class="col-md-12">

                                  <a href="/section/appointments/edit/{{$appointment->id}}/{{$from}}" class="btn btn-block btn-primary btn-circle">
                                            <i class="fas fa-eye"></i>
                                  <a href="/section/appointments/destroy/{{$appointment->id}}" class="btn btn-block btn-danger btn-circle"
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
