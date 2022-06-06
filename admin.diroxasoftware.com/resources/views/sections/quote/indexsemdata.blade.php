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

  <script type="text/javascript" src="{{ asset('jquery/multiselect/jquery-3.5.1.min.js') }}"></script> 
  <script type="text/javascript" src="{{ asset('jquery/multiselect/chosen.jquery.min.js') }}"></script>

</head>



<body id="page-top">

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
              @if(session('warning'))
              <div class="alert alert-warning">
                  {{ session('warning') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                  </button>
              </div>
          @endif


          @if(session('error'))
            <div class="alert alert-danger">
              {{ session('error') }}
            </div>
          @endif

          @if(session('NoProdsQuotes'))
            <div class="alert alert-warning">
              {{ session('NoProdsQuotes') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-black-800" style="color:black;" ><strong>QUOTE</strong></h1><br>

          <a href="/section/quote/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-plus fa-sm text-white-50"></i> <b>CREATE QUOTE</b></a>
          </div>

          


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
            <!-- <p class="mb-4 font-weight-bold" style="color:black;">HERE YOU SEE ALL QUOTES. IF YOU PREFERE YOU CAN </a><a href="/section/quote/create">MAKE A NEW ONE</a></p> -->
              <strong> <p class="mb-4 font-weight-bold" style="color:black;">PLEASE, NOTICE THAT HERE WILL SHOW ONLY THE OPPEN QUOTES AT MOMENT. TO SEE ALL QUOTES ALREADY DONE CLICK  </a><a href="/section/quotesAlreadyDone">HERE</a></p></strong>
            </div>


            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered"  id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <!-- 'name', 'customer_report', 'first_observations', 'previous_observations', 'customer', 'vehicle', 'status', 'typeofpayment' -->

                      <th style="font-family:verdana; font-size:100%; color:#38393b;" ><b>Title</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;" ><b>Customer</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;" ><b>Motorcycle</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;" ><b>Customer Report</b></th>
                      <!-- <th style="font-family:verdana; font-size:100%; color:#38393b;" ><b>First Observations</b></th> -->
                      <th style="font-family:verdana; font-size:100%; color:#38393b;" ><b>Status</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;" ><b>Created At</b></th>
                     <th  style="font-family:verdana; font-size:100%; color:#38393b;" scope="col"><b>Actions</b></th>

                    </tr>
                  </thead>

                  <tbody class="infoTable" id="infoTable">
                    @foreach($allQuotes as $quote)

                    <tr>
                    <?php

                        $max = 10;
                        $str = " $quote->title ";
                        $title=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                        $max = 13;
                        $str = " $quote->customer_report ";
                        $customer_report=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                        $max = 13;
                        $str = " $quote->first_observations ";
                        $first_observations=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                        $max = 13;
                        $str = " $quote->last_observations ";
                        $last_observations=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                        $max = 13;
                        $str = " $quote->customerName";
                        $customer=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                        $max = 13;
                        $str = " $quote->machineModel";
                        $machine=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                        $max = 13;
                        $str = " $quote->status ";
                        $status=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                        $TypeOfStatus = $quote->status;

                        $start = date('d/m/Y', strtotime($quote->created_at));


                        if ($TypeOfStatus == 0)
                        {
                          $TypeOfStatus = "OPEN";
                        }
                        else
                        {
                          $TypeOfStatus = "CLOSED";
                        }



                        $WhichStatus  = " $quote->status ";
                        $ShowStatus = 0;
                        $color = "color:red";

                        if ($WhichStatus == 0)
                        {
                            $ShowStatus = "OPEN";
                            $color = "color:green";
                        }
                        else if ($WhichStatus == 1)
                        {
                            $ShowStatus = "CLOSED";
                            $color = "color:red";
                        }
                        else if ($WhichStatus == 3)
                        {
                            $ShowStatus = "QUOTE REFUSED";
                            $color = "color:orange";
                        }



                        $max = 2;
                        $str = " $quote->typeofpayment ";
                        $typeofpayment=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                        $start = date('d/m/Y', strtotime($quote->created_at));


                    ?>

                    <!-- 'name', 'customer_report', 'first_observations', 'previous_observations', 'customer', 'vehicle', 'status', 'typeofpayment' -->


                    <td style="font-family:verdana; color:black;"><b>{{$title}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$customer}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$machine}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$customer_report}}</b></td>
                    <!-- <td style="font-family:verdana; color:black;"><b>{{$first_observations}}</b></td> -->
                    <td>
                        @if($quote->status == 1 )
                          <h5><span class="badge badge-danger">{{$ShowStatus}}</span></h5>
                        @elseif($quote->status == 0)
                          <h5><span class="badge badge-success">{{$ShowStatus}}</span></h5>
                        @elseif($quote->status == 3)
                         <h5><span class="badge badge-warning">{{$ShowStatus}}</span></h5>
                        @endif
                    </td>
                    <td style="font-family:verdana; color:black;">
                        <b hidden>{{$quote->created_at}}</b>
                        <b>{{$start}}</b>
                    </td>

                    <td>
                        <a href="/section/quote/edit/{{$quote->id}}" class="btn btn-primary btn-group">Edit</a>
                        <a href="/section/quote/destroy/{{$quote->id}}"  class="btn btn-danger btn-group"
                        onclick="return confirm('Are you sure that you want DELETE this Quote?');">
                                Remove</a>

                        <a href="/section/quote/previewInvoice/{{$quote->id}}"  class="btn btn-success btn-group">
                                More Options</a>
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


  <script>
  function formatingDate(dataComecoPadraoDateTime){

      //montando a data começo
      var outraData = new Date(dataComecoPadraoDateTime);
      var newDay = outraData.getDate();
      var newMonth = outraData.getMonth() + 1; // pois a contagem dos meses começa do 0
      var newYear = outraData.getFullYear();
      if(newDay < 10){
              newDay = `0${newDay}`;
      }

      if(newMonth < 10){
        newMonth = `0${newMonth}`;
      }
      
      var dateJustCreated = `${newDay}/${newMonth}/${newYear}`;

      return dateJustCreated;
  }
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
