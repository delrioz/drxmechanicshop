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

        <?php
          $from = "allinvoices";
        ?>



        <!-- Begin Page Content -->
        <div class="container-fluid">
              <div class="d-sm-flex align-items-center justify-content-between mb-4">
                  <h1 class="h3 mb-0 text-black-800" style="color:black!important;"><strong> All Invoices</strong></h1>
              </div>

          <?php
            $hoje = date('d/m/Y');
          ?>

          <p>
             All invoices showed here is <b>Today Invoices.</b>
             <br>
             If you want to search an especific date range feel free to use the search section
          </p>

     
          <?php
            $hoje = date('d/m/Y');
          ?>
          
          <div class="form-group">
            <form action="{{route('allinvoices.search')}}" method="POST" name="formSearch">
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
                  <button type="button" class="btn btn-info" id="searchAjaxSubmit" value="Search">Search</button>
                  <a href="{{route('allinvoices.index')}}" method="GET" type="button" class="btn btn-warning">Reset Search</a>
            </form>
            <br>
          </div>


          <div class="show-range">
          </div>


          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="alert alert-success">
                    <p>All Work Order's or Quote's and Sales Invoices finished.</p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="alert alert-warning">
                    <p>All Sales Invoices that haven't finished yet.</p>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="alert alert-danger">
                    <p>This Won't Show any Invoices waiting for approvation.</p>
                  </div>
                </div>
              </div>
           

              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->
                        <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Reference</b></th>
                        <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Customer</b></th>
                        <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Status</b></th>
                        <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Created At</b></th>
                        <th style="font-family:verdana; font-size:100%; color:#38393b;" scope="col"><b>Actions</b></th>
                    </tr>
                  </thead>

                  <tbody class="prodstables" id="prodstables">
                    @foreach($allworkOrders as $allworkOrders)
                    <?php
                      $start = date('d/m/Y', strtotime($allworkOrders->created_at));
                    ?>


                    <tr>
                    <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->
                    <td style="font-family:verdana; color:black;"><b>Work Order</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$allworkOrders->customerName}}</b></td>
                    @if($allworkOrders->status == 0)
                      <td style="font-family:verdana; color:black;">
                      <h5><span class="badge badge-warning" style="font-family:verdana; color:white;"><b>OPEN</b></span></h5>
                      </td>
                    @else
                      <td style="font-family:verdana; color:black;">
                      <h5><span class="badge badge-success" style="font-family:verdana; color:white;"><b>PROCESSED</b></span></h5>
                      </td>
                    @endif

                    <td style="font-family:verdana; color:black;">
                        <b >{{$start}}</b>
                    
                    </td>

                    <td>
                        @if($allworkOrders->status == 1 )
                          <a href="/section/machines/viewpage/viewinvoice/{{$allworkOrders->id}}" class="btn btn-primary btn-group"><b>View Invoice</b></b></a>
                        @endif
                    </td>
                    
                    </tr>
                @endforeach

                
              @foreach($allquotes as $allquotes)

                <?php
                  $start = date('d/m/Y', strtotime($allquotes->created_at));
                ?>

                <tr  >
                <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->

                <td style="font-family:verdana; color:black;"><b>Quote</b></td>
                <td style="font-family:verdana; color:black;"><b>{{$allquotes->customerName}}</b></td>

                @if($allquotes->status == 0)
                  <td style="font-family:verdana; color:black;">
                   <h5><span class="badge badge-warning" style="font-family:verdana; color:white;"><b>OPEN</b></span></h5>
                  </td>
                @else
                  <td style="font-family:verdana; color:black;">
                   <h5><span class="badge badge-success" style="font-family:verdana; color:white;"><b>PROCESSED</b></span></h5>
                  </td>
                @endif
                <td style="font-family:verdana; color:black;">
                    <b >{{$start}}</b>
                </td>

                  <td>
                   <a href="/section/quotesAlreadyDone/viewpage/viewinvoice/{{$allquotes->id}}" class="btn btn-primary btn-group"><b>View Invoice</b></a>
                  </td>

                </tr>
            @endforeach

            @foreach($allsales as $allsales)
               <?php
                  $start = date('d/m/Y', strtotime($allsales->created_at));
                ?>

                <tr>
                
                <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->

                <td style="font-family:verdana; color:black;"><b>Product Sale</b></td>
                <td style="font-family:verdana; color:black;"><b>{{$allsales->name}}</b></td>
                <td style="font-family:verdana; color:black;">
                    @if($allsales->status == 0)
                      <h5><span class="badge badge-success" style="font-family:verdana; color:white;"><b>PROCESSED</b></span></h5>
                    @else
                      <h5><span class="badge badge-warning" style="font-family:verdana; color:white;"><b>BEING PROCESSED</b></span></h5>
                    @endif
                </td>

                <td style="font-family:verdana; color:black;">
                    <b >{{$start}}</b>
                </td>

                <td>
                    <a href="/section/sales/allsales/invoice/{{$allsales->id}}/{{$from}}" class="btn btn-primary btn-group"><b>View Invoice</b></a>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
    

  
  <script>
            $(document).ready(function(){
          // $('#ajaxSubmit').click(function(e){
            $(document).on("click", "#searchAjaxSubmit", function(e){
          //  alert(11111)
            e.preventDefault();
              // var dataComecoPadraoDateTime = $(this).find('input#dataComecoPadraoDateTime').val();
              // var dataFimPadraoDateTime = $(this).find('input#dataFimPadraoDateTime').val();

              var dataComecoPadraoDateTime  = $("#start").val();
              var dataFimPadraoDateTime  = $("#end").val();
              
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });


            $.ajax({
                url: "{{ route('allinvoices.search') }}",
                method: 'get',
                data: {
                  dataComecoPadraoDateTime: dataComecoPadraoDateTime,
                  dataFimPadraoDateTime: dataFimPadraoDateTime,
                  _token: '{{csrf_token()}}'},


                success: function(result){  

                  console.log(result);

                  $('.show-range').empty();

                  if(result.start == "01/01/1970" || result.end == "01/01/1970")
                  {
                    $(".show-range").append(`
                      <div class="alert alert-warning">
                        <h4>
                            Choose any available date range to Search </h4>
                      </div>
                   `);
                  }

                  else if(result.start == "undefined" || result.end == "undefined")
                  {
                    $(".show-range").append(`
                      <div class="alert alert-danger">
                        <h4>
                            Please Choose any available date range to Search </h4>
                      </div>
                   `);
                  }

                  


                  else 
                  {
                    $(".show-range").append(`
                    <div class="alert alert-warning">
                        <h4>Searchig for All invoices on `+ result.start +` and `+ result.end +`</h4>
                    </div>
                   `);
                
                  }


                  // Changin the table
                  $respAllWorkOrders = result.allworkOrders;
                  // console.log($respAllWorkOrders);

                  // Changin the table
                      $('.prodstables').empty();

                      $.each($respAllWorkOrders, function (key, value){

                      
                        //montando a data começo
                        var outraData = new Date(value.created_at);
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



                        if($respAllWorkOrders.status == 0)
                          {
                              $statusClass = "badge badge-warning";
                              $statusPhrase = "OPEN";
                              
                              // $status = "<h5><span class="badge badge-success" style="font-family:verdana; color:white;"><b>PROCESSED</b></span></h5>";
                          }
                          else
                          {
                              $statusClass = "badge badge-success";
                              $statusPhrase = "PROCESSED";
                              // $status = "<h5><span class="badge badge-warning" style="font-family:verdana; color:white;"><b>BEING PROCESSED</b></span></h5>";
                          }



                        $(".prodstables").append(`
                              <tr>
                                  <td style="font-family:verdana; color:black;"><b>Work Order</b><br></td>
                                  <td style="font-family:verdana; color:black;"><b>`+ value.customerName +`</b><br></td>
                                  <td style="font-family:verdana; color:black;"><h5><span class="`+ $statusClass +`" style="font-family:verdana; color:white;"><b>`+ $statusPhrase +`</b></span></h5></td>
                                  <td style="font-family:verdana; color:black;"><b>`+ dateJustCreated +`</b></td>
                                  <td>
                                      <a href="/section/machines/viewpage/viewinvoice/`+ value.id +`" class="btn btn-primary btn-group"><b>View Invoice</b></a>
                                  </td>
                              </tr>
                      `);
                    });


                  // Changin the table
                  $respAllQuotes = result.allquotes;

                  // console.log($respAllQuotes);

                  // Changin the table

                      $.each($respAllQuotes, function (key, value){

                      
                        //montando a data começo
                        var outraData = new Date(value.created_at);
                        var newDay = outraData.getDate();
                        var newMonth = outraData.getMonth() + 1; // pois a contagem dos meses começa do 0
                        var newYear = outraData.getFullYear();
                        if(newDay < 10){
                                newDay = `0${newDay}`;
                        }

                        if(newMonth < 10){
                          newMonth = `0${newMonth}`;
                        }


                        if($respAllQuotes.status == 0)
                          {
                              $statusClass = "badge badge-warning";
                              $statusPhrase = "OPEN";
                              
                              // $status = "<h5><span class="badge badge-success" style="font-family:verdana; color:white;"><b>PROCESSED</b></span></h5>";
                          }
                          else
                          {
                              $statusClass = "badge badge-success";
                              $statusPhrase = "PROCESSED";
                              // $status = "<h5><span class="badge badge-warning" style="font-family:verdana; color:white;"><b>BEING PROCESSED</b></span></h5>";
                          }


                        var dateJustCreated = `${newDay}/${newMonth}/${newYear}`;


                        $(".prodstables").append(`
                              <tr>
                                  <td style="font-family:verdana; color:black;"><b>Quote</b><br></td>
                                  <td style="font-family:verdana; color:black;"><b>`+ value.customerName +`</b><br></td>
                                  <td style="font-family:verdana; color:black;"><h5><span class="`+ $statusClass +`" style="font-family:verdana; color:white;"><b>`+ $statusPhrase +`</b></span></h5></td>
                                  <td style="font-family:verdana; color:black;"><b>`+ dateJustCreated +`</b></td>
                                  <td>
                                      <a href="/section/quotesAlreadyDone/viewpage/viewinvoice/`+ value.id +`" class="btn btn-primary btn-group"><b>View Invoice</b></a>
                                  </td>
                              </tr>
                      `);
                    });



                  // Changin the table
                  $respAllSales = result.allsales;

                    console.log($respAllSales);

                    // Changin the table

                        $.each($respAllSales, function (key, value){

                        
                          //montando a data começo
                          var outraData = new Date(value.created_at);
                          var newDay = outraData.getDate();
                          var newMonth = outraData.getMonth() + 1; // pois a contagem dos meses começa do 0
                          var newYear = outraData.getFullYear();
                          if(newDay < 10){
                                  newDay = `0${newDay}`;
                          }

                          if(newMonth < 10){
                            newMonth = `0${newMonth}`;
                          }



                          if($respAllSales.status == 0)
                          {
                              $statusClass2 = "badge badge-success";
                              $statusPhrase2 = "PROCESSED";
                              
                              // $status = "<h5><span class="badge badge-success" style="font-family:verdana; color:white;"><b>PROCESSED</b></span></h5>";
                          }
                          else
                          {
                              $statusClass2 = "badge badge-warning";
                              $statusPhrase2 = "BEING PROCESSED";
                              // $status = "<h5><span class="badge badge-warning" style="font-family:verdana; color:white;"><b>BEING PROCESSED</b></span></h5>";
                          }




                          var dateJustCreated = `${newDay}/${newMonth}/${newYear}`;


                          $(".prodstables").append(`
                                <tr>
                                    <td style="font-family:verdana; color:black;"><b>Product Sale</b><br></td>
                                    <td style="font-family:verdana; color:black;"><b>`+ value.name +`</b><br></td>
                                    <td style="font-family:verdana; color:black;"><h5><span class="`+ $statusClass2 +`" style="font-family:verdana; color:white;"><b>`+ $statusPhrase2 +`</b></span></h5></td>

                                    <td style="font-family:verdana; color:black;"><b>`+ dateJustCreated +`</b></td>
                                    <td>
                                        <a href="/section/sales/allsales/invoice/`+ value.id +`/allinvoices §"class="btn btn-primary btn-group"><b>View Invoice</b></a>
                                    </td>
                                </tr>
                        `);
                      });
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