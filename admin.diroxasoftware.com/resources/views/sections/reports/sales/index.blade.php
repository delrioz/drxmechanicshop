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

        @if (session('status'))
          <div class="alert alert-danger">
              {{ session('status') }}
          </div>
        @endif

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-black-800" style="color:black!important;"><strong>Products Sales Reports</strong></h1>

            <div class="dropdown mb-4">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Data Range
                    </button>

                    <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">

                    <form action="{{route('sales.reports.index')}}" method="GET">
                    @csrf
                      <button class="dropdown-item" name="QuicklyOption" value="sevenDays">General Overview</button>
                    </form>

                    <form action="{{route('sales.reports.searchIt')}}" method="POST">
                        @csrf
                      <button class="dropdown-item" name="QuicklyOption" value="sevenDays">Last week</button>
                    </form>

                    <form action="{{route('sales.reports.searchIt')}}" method="POST">
                        @csrf
                      <button class="dropdown-item" name="QuicklyOption" value="lastmonth">Last Month</button>
                    </form>

                    <form action="{{route('sales.reports.searchIt')}}" method="POST">
                        @csrf
                      <button class="dropdown-item" name="QuicklyOption" value="lastday">Last Day</button>
                    </form>


                    <form action="{{route('sales.reports.searchIt')}}" method="POST">
                        @csrf
                      <button class="dropdown-item" name="QuicklyOption" value="today">Today</button>
                    </form>

                      <!-- <a class="dropdown-item" name="QuicklyOption" value="sevenDays">Another action</a>
                      <a class="dropdown-item" name="QuicklyOption" value="1month">Something else here</a> -->
                    </div>
                  </form>
                  </div>
          </div>

      <?php
        $hoje = date('d/m/Y');
      ?>

      <div class="form-group">
        <form action="{{route('sales.searchajax')}}" method="POST" name="formSearch">
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


          <!-- Content Row -->
          <div class="row">

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Earnings Today</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="CardPrincipalEarningsToday">£{{$totearningstoday}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Amount sold</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="CardPrincipalEarningsSofar">£{{$totalEarnings}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Number of Sales</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="CardPrincipalNumberofSales">{{$NumberOfSales}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-pound-sign fa-2x text-gray-300"></i>
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
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Avarage sale amount</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="CardPrincipalAVGtotalEarnings">£{{$AVGtotalEarnings}}</div>

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

          <!-- Content Row -->
          <span class="data-rangeAlert">
              @if(isset($start))
                  <?php
                    $start = date('d-m-Y', strtotime($start));
                    $end = date('d-m-Y', strtotime($end));

                  ?>


                  <div class="alert alert-warning">
                    <h4>Searchig for sales reports between {{$start}} - {{$end}}</h4>
                  </div>
              @endif
          </span>

        <div class="show-range">
        </div>


        <div class="alert alert-warning">
          <p>Check all the invoices <a href="/section/sales/allsales"> clicking here</a></p>
        </div>

          <div class="row">

            <!-- Area Chart -->
              @if(($productsFound) != 0)
            <div class="col-xl-5 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Best Seller Product</h6>
                  <div class="dropdown no-arrow">
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                <!-- <img class="img-fluid"  src="/storage/images/{{$ProductbestSeller->image}}"
                  style="width: 300px; height: 200px;"> -->
                  <div class="row">
                    <div class="col-md-6">
                      <img src="/storage/{{$ProductbestSeller->image}}" class="card-img-top" style="width: 180px; height: 200px;!important">
                    </div>
                    <div class="col-md-6">
                      <ul>
                      <li><h4>Quantities Sold: <b>{{$ProductbestSeller->totalQuantitySales}}</b></h4></li>
                      <li><h4>Product Id: <b>{{$ProductbestSeller->id}}</b></h4></li>
                      <li><h4>Product Name: <b>{{$ProductbestSeller->name}}</b></h4></li>
                      </ul>
                    </div>
                  </div>
                </div>
                </div>
              </div>
                @endif



            <!-- Pie Chart -->
            <div class="col-xl-6 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Payments Overview</h6>
                  <div class="dropdown no-arrow">
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col" class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;"><strong><b>Method Payment</b></strong></th>
                  <th scope="col" class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;"><strong><b>Number of Payments</b></strong></th>
                  <th scope="col" class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;"><strong><b>Amount Payment</b></strong></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row"></th>
                  <td style="font-family:verdana; color:black;"><b>CARD</b></td>
                  <td id="PyOverViewqtdSellByCard" style="font-family:verdana; color:black;"><b>{{$qtdSellByCard}}</b></td>
                  <td id="PyOverViewAmountSalesWithVAT" style="font-family:verdana; color:black;"><b>£{{$AmountSalesWithVAT}}</b></td>
                </tr>
                <tr>
                  <th scope="row"></th>
                  <td style="font-family:verdana; color:black;"><b>CASH</b></td>
                  <td id="PyOverViewqtdSellByCash" style="font-family:verdana; color:black;"><b>{{$qtdSellByCash}}</b></td>
                  <td id="PyOverViewAmountSalesCashWithVAT" style="font-family:verdana; color:black;"><b>£{{$AmountSalesCashWithVAT}}</b></td>
                </tr>
              </tbody>
            </table>
            <hr>
            <div class="row">
            <div class="col-md-5">
            <h3 style="color:black!important;">Total inc VAT: </h3>
            </div>
            <div class="col-md-7">
              <h3 style="text-aling:center; color:black;" id="PyOverViewtotalEarnings"><b>£{{$totalEarnings}}</b></h3>
            </div>
            </div>
                  </div>
                </div>
              </div>
            </div>

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-6 col-lg-6">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary"><b>CARDS PAYMENTS OVERVIEW</b></h6>
          <div class="dropdown no-arrow">
          </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
        <div class="row">
        <div class="col-md-12">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col" class="mb-0 text-grey-800" style="font-family:verdana; font-size:100%; color:#38393b;"><b>Number Sales</b></th>
              <th scope="col" class="mb-0 text-grey-800" style="font-family:verdana; font-size:100%; color:#38393b;"><b>Amount With VAT</b></th>
              <th scope="col" class="mb-0 text-grey-800" style="font-family:verdana; font-size:100%; color:#38393b;"><b>Amount Without VAT</b></th>
              <th scope="col" class="mb-0 text-grey-800" style="font-family:verdana; font-size:100%; color:#38393b;"><b>VAT Amount</b></th>
              <th scope="col" class="mb-0 text-grey-800" style="font-family:verdana; font-size:100%; color:#38393b;"><b>Discount Amount</b></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row"></th>
              <td style="font-family:verdana; color:black;" id="CardqtdSellByCard"><b>{{$qtdSellByCard}}</b></td>
              <td style="font-family:verdana; color:black;" id="CardAmountSalesWithVAT"><b>£{{$AmountSalesWithVAT}}</b></td>
              <td style="font-family:verdana; color:black;" id="CardAmountSalesWithoutVAT"><b>£{{$AmountSalesWithoutVAT}}</b></td>
              <td style="font-family:verdana; color:black;" id="CardAmountSalesCardVAT"><b>£{{$AmountSalesCardVAT}}</b></td>
              <td style="font-family:verdana; color:black;" id="CardAmountSalesCardDiscount"><b>£{{$AmountSalesCardDiscount}}</b></td>
            </tr>
          </tbody>
        </table>
        </div>
        <!-- <div class="col-lg-3">
          <h2>{{$qtdSellByCard}}</h2>
          <hr>
          <h2>£{{$AmountSalesWithVAT}}</h2>
        </div> -->

        </div>
        </div>
      </div>
    </div>


    <!-- discount amount  -->
    <!-- Area Chart -->
    <div class="col-xl-6 col-lg-6">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary"><b>CASH PAYMENTS OVERVIEW</b></h6>
          <div class="dropdown no-arrow">

          </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
        <div class="row">
        <div class="col-md-12">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col" class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;">Number Sales</th>
              <th scope="col" class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;">Amount With VAT</th>
              <th scope="col" class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;">Amount Without VAT</th>
              <th scope="col" class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;">VAT Amount</th>
              <th scope="col" class="mb-0 text-black-800" style="font-family:verdana; font-size:100%; color:#38393b;">Discount Amount</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row"></th>
              <td id="CashqtdSellByCash" style="font-family:verdana; color:black;"><b>{{$qtdSellByCash}}</b></td>
              <td id="CashAmountSalesCashWithVAT" style="font-family:verdana; color:black;"><b>£{{$AmountSalesCashWithVAT}}</b></td>
              <td id="CashAmountSalesCashWithoutVAT" style="font-family:verdana; color:black;"><b>£{{$AmountSalesCashWithoutVAT}}</b></td>
              <td id="CashAmountSalesCashVAT" style="font-family:verdana; color:black;"><b>£{{$AmountSalesCashVAT}}</b></td>
              <td id="CashAmountSalesCashDiscount" style="font-family:verdana; color:black;"><b>£{{$AmountSalesCashDiscount}}</b></td>

            </tr>
          </tbody>
        </table>
        </div>
        </div>
        </div>
    </div>
    <!-- <div class="col-lg-3">
      <h2>{{$qtdSellByCard}}</h2>
      <hr>
      <h2>£{{$AmountSalesWithVAT}}</h2>
    </div> -->

            </div>
          </div>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>



    <script>
      
          $(document).ready(function(){
        // $('#ajaxSubmit').click(function(e){
          $(document).on("click", "#ajaxSubmit", function(e){
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
              url: "{{ url('/section/reports/SalesReports/searchajax') }}",
              method: 'post',
              data: {
                dataComecoPadraoDateTime: dataComecoPadraoDateTime,
                 dataFimPadraoDateTime: dataFimPadraoDateTime,
                 _token: '{{csrf_token()}}'},

              success: function(result){

                console.log(result);
                
                if(result == 'NDA' || result == null || result == "NDA"){
                  alert('Nothing was found matching this datas');
                }
                else{
                  // console.log(result);
                  // // console.log('dasdasdasdsadas');
                  // // alert('Customer Created!')
                  // $msg = '<h4><strong>Machine successfull created</h4>';
                  // $('.messageBox').removeClass('d-none').html($msg);
                    // $("#serial_number").empty();

                  $('.data-rangeAlert').empty();
                  $('.show-range').empty();
                  $(".show-range").append(`
                      <div class="alert alert-warning">
                        <h4>Searchig for sales reports between `+ result.start +` and `+ result.end +`</h4>
                      </div>
                    `);


                  $('#CardPrincipalEarningsSofar').empty();
                  $('#CardPrincipalNumberofSales').empty();
                  $('#CardPrincipalAVGtotalEarnings').empty();


                  $('#PyOverViewqtdSellByCard').empty();
                  $('#PyOverViewAmountSalesWithVAT').empty();
                  $('#PyOverViewtotalEarnings').empty();

                  $('#PyOverViewqtdSellByCash').empty();
                  $('#PyOverViewAmountSalesCashWithVAT').empty();



                  //card
                  $('#CardAmountSalesWithVAT').empty();
                  $('#CardAmountSalesWithoutVAT').empty();
                  $('#CardqtdSellByCard').empty();
                  $('#CardAmountSalesCardVAT').empty();
                  $('#CardAmountSalesCardDiscount').empty();

                  //cash
                  $('#CashqtdSellByCash').empty();
                  $('#CashAmountSalesCashWithVAT').empty();
                  $('#CashAmountSalesCashWithoutVAT').empty();
                  $('#CashAmountSalesCashVAT').empty();
                  $('#CashAmountSalesCashDiscount').empty();

                  // VAT SECTION
                  $('#VATSectionAmountSalesCardVAT').empty();
                  $('#VATSectionAmountSalesCashVAT').empty();
                  $('#VATSectiontotalamountfromVAT').empty();

                  // DISCOUNT SECTION
                  $('#DiscountSectionAmountSalesCardDiscount').empty();
                  $('#DiscountSectionAmountSalesCashDiscount').empty();
                  $('#DiscountSectiontotalamountDiscount').empty();



                  // $('#reports_sales_cash').empty();
                  // $('#AmountSalesCashWithVAT').empty();
                  // $('#AmountSalesCashWithoutVAT').empty();
                  // $('#AmountSalesCashVAT').empty();
                  // $('#AmountSalesCashDiscount').empty();
                  // $('#qtdSellByCash').empty();
                  // $('#AmountSalesCardVAT').empty();
                  // $('#totalamountDiscount').empty();

                    // document.getElementById('CardPrincipalEarningsSofar').value = '1';
                    // $("#CardPrincipalEarningsSofar").html(`+result.totalEarnings`);
                    // $("#CardPrincipalEarningsToday").append(`£` + result.totalearningstoday);
                    $("#CardPrincipalEarningsSofar").append(`£` + result.totalEarnings);
                    $("#CardPrincipalNumberofSales").append(result.NumberOfSales);
                    $("#CardPrincipalAVGtotalEarnings").append(`£` + result.AVGtotalEarnings);

                    // Payments Overview
                    $("#PyOverViewqtdSellByCard").append(result.qtdSellByCard);
                    $("#PyOverViewAmountSalesWithVAT").append(`£` +result.AmountSalesWithVAT);
                    $("#PyOverViewqtdSellByCash").append(result.qtdSellByCash);
                    $("#PyOverViewAmountSalesCashWithVAT").append(`£` +result.AmountSalesCashWithVAT);
                    $("#PyOverViewtotalEarnings").append(`£` +result.totalEarnings);


                    // card
                    $("#CardqtdSellByCard").append(result.qtdSellByCard);
                    $("#CardAmountSalesWithVAT").append(`£` +result.AmountSalesWithVAT);
                    $("#CardAmountSalesWithoutVAT").append(`£` +result.AmountSalesWithoutVAT);
                    $("#CardAmountSalesCardVAT").append(`£` + result.AmountSalesCardVAT);
                    $("#CardAmountSalesCardDiscount").append(`£` +result.AmountSalesCardDiscount);


                    // Cash
                    $("#CashqtdSellByCash").append(result.qtdSellByCash);
                    $("#CashAmountSalesCashWithVAT").append(`£` +result.AmountSalesCashWithVAT);
                    $("#CashAmountSalesCashWithoutVAT").append(`£` +result.AmountSalesCashWithoutVAT);
                    $("#CashAmountSalesCashVAT").append(`£` + result.AmountSalesCashVAT);
                    $("#CashAmountSalesCashDiscount").append(`£` +result.AmountSalesCashDiscount);

                    //VAT SECTION
                    $("#VATSectionAmountSalesCardVAT").append(`£` +result.AmountSalesCardVAT);//aqui
                    $("#VATSectionAmountSalesCashVAT").append(`£` +result.AmountSalesCashVAT);
                    $("#VATSectiontotalamountfromVAT").append(`Total: £` +result.totalVAT);


                    //DISCOUNT SECTION
                    $("#DiscountSectionAmountSalesCardDiscount").append(`£` + result.AmountSalesCardDiscount);
                    $("#DiscountSectionAmountSalesCashDiscount").append(`£` + result.AmountSalesCashDiscount);
                    $("#DiscountSectiontotalamountDiscount").append(`Total: £` +result.totalDiscount);


                  // window.location.href = "{{ route('customer.index') }}";
                  //  console.log(result);
                }

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>


    <script src="{{ asset('admlyt/js/demo/chart-pie-demo.js') }}"></script>
    <script src="{{ asset('admlyt/js/demo/chart-earnings-demo.js') }}"></script>


    <script src="{{ asset('admlyt/js/demo/chart-bar-demo.js') }}"></script>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

  </body>

  </html>
