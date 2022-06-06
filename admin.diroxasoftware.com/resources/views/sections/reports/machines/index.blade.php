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

            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-black-800"><strong style="color:black;">MOTORCYCLES REPAIRS REPORT</strong><br></h1>
              <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
              </div>

          <?php
            $hoje = date('d/m/Y');
          ?>
          
          <div class="form-group">
            <form action="{{route('machinesrepairreport.searchajax')}}" method="POST" name="formSearch">
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

        <div class="show-range">
        </div>

            <!-- Content Row -->
            <div class="row">
              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        <a> REGISTERED MOTORCYCLES </a>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" ><strong style="color:green;" id="Nmachines" class="Nmachines">{{$Nmachines}}</strong></div>
                        <!-- <div class="h5 mb-0 font-weight-bold text-gray-800" id="CardPrincipalAVGtotalEarnings">£{{$Nmachines}}</div> -->

                        <b>number of motorcycles on our database</b>
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
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        <a style="color:blue"> OPEN SERVICES</a>
                        </div>
                        @foreach($seeopenworks as $NopenWorks)
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><strong style="color:green;" id="seeopenworks" class="seeopenworks">{{$NopenWorks->TOTAL}}</strong></div>
                        <b>number of services still open</b>
                        @endforeach
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
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        <a style="color:blue"> CLOSED SERVICES</a>
                        </div>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                          @foreach($NumberClosedServices as $NclosedServices)
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><strong style="color:green;" id="NumberClosedServices">{{$NclosedServices->TOTAL}}</strong></div> 
                              <b>Number of jobs already done</b>
                          @endforeach
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

              <!-- Pending Requests Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        <a style="color:blue"> TOTAL DISCOUNT </a>
                        </div>
                        <div class="h5 mb-0 font-weight-bold"><strong style="color:green;" id="totaldiscountinwk">£{{$totaldiscountinwk}}</strong></div>
                          <b>Total amount from discounts</b>
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
            <div class="row">
                <!-- Earnings (Monthly) Card Example -->
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                          <a style="color:blue"> TOTAL AMOUNT VAT </a>
                          </div>
                          <div class="h5 mb-0 font-weight-bold"><strong style="color:green;" id="totalvat">£{{$totalvat}}</strong></div>
                            <b>Total amount VAT in work orders</b>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                </div>
              </div>


              <!-- Pending Requests Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        <a style="color:blue"> TOTAL AMOUNT PRODUCTS IN WORK ORDER MOTORCYCLES</a>
                        
                        </div>
                        <div class="h5 mb-0 font-weight-bold"><strong style="color:green;" id="totalamountproducts">£{{$totalamountproducts}}</strong></div>
                          <b>Total amount products</b>
                          
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
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        <a style="color:blue">TOTAL WORK LABOUR AMOUNT </a>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><strong style="color:green;" id="totalwkvalue" >£{{$totalwkvalue}}</strong></div>
                        <b>total income from Labour/service</b>
                      </div>
                      <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Earnings (Monthly) Card Example -->
              <!-- <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        <a style="color:blue"> GENERAL BALANCE (excl Products)</a>
                        </div>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                              <div class="h5 mb-0 font-weight-bold"><strong style="color:green;">£{{$totalamoutwkwithoutprods}}</strong></div>
                              <b>Machine's services income (no Prods)</b>
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
              </div> -->

              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        <a style="color:blue"> GENERAL BALANCE (inc products)</a>
                        </div>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                              @if($WorkOrderTotalAmount2  != null)
                                  <div class="h5 mb-0 font-weight-bold"><strong style="color:green;" id="WkTotalWithVat">£{{$WkTotalWithVat}}</strong></div>
                                  <b>Motorcycle's services income (with Prods)</b>
                              @elseif($WorkOrderTotalAmount2  == null)
                                  <div class="h5 mb-0 font-weight-bold"><strong style="color:green;" id="WkTotalWithVat">£0.00</strong></div>
                                  <b>Motorcycle's services income (with Prods)</b>
                              @endif
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
              <!-- Pending Requests Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
              </div>
            </div>



  <!-- Page Heading -->
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Work Order's Registered Motorcycles</h6>
    </div>
    
    <div class="card-body">
      <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
            <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->

                <th style="font-family:verdana; font-size:100%; color:#38393b;" >Title</th>
                <th style="font-family:verdana; font-size:100%; color:#38393b;" >Customer</th>
                <th style="font-family:verdana; font-size:100%; color:#38393b;" >Motorcycle</th>
                <th style="font-family:verdana; font-size:100%; color:#38393b;" >Status</th>
                <th style="font-family:verdana; font-size:100%; color:#38393b;" >Created At</th>
                <th style="font-family:verdana; font-size:100%; color:#38393b;"  scope="col">Actions</th>

            </tr>
            </thead>

            <tbody class="prodstables" id="prodstables">
            @foreach($allmachines as $workOrder)

            <tr>
                    <?php

                        $max = 13;
                        $str = " $workOrder->title ";
                        $title=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                        $max = 13;
                        $str = " $workOrder->customer_report ";
                        $customer_report=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                        $max = 13;
                        $str = " $workOrder->first_observations ";
                        $first_observations=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                        $max = 13;
                        $str = " $workOrder->last_observations ";
                        $last_observations=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                        $max = 13;
                        $str = " $workOrder->customerName ";
                        $customer=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                        $max = 13;
                        $str = " $workOrder->machineModel ";
                        $machine=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                        $max = 13;
                        $str = " $workOrder->status ";
                        $status=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                        $max = 2;
                        $str = " $workOrder->typeofpayment ";
                        $typeofpayment=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                        $start = date('d/m/Y', strtotime($workOrder->created_at));

                        $WhichStatus  = " $workOrder->status ";
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
                        else if ($WhichStatus == 2)
                        {
                            $ShowStatus = "READY FOR COLLECTION";
                            $color = "color:orange";
                        }
                        

                        $from = "MachineSearchPage";


                    ?>

                    <!-- 'name', 'customer_report', 'first_observations', 'previous_observations', 'customer', 'vehicle', 'status', 'typeofpayment' -->

                    <td style="font-family:verdana; color:black;"><b>{{$title}}</b></td>
                    <td style="font-family:verdana; color:black;" hidden><b>{{$customer_report}}</b></td>
                    <td style="font-family:verdana; color:black;" hidden><b>{{$last_observations}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$customer}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$machine}}</b></td>
                    <td>
                            @if($workOrder->status == 1 )
                                  <h5><span class="badge badge-danger" style="font-family:verdana; color:white;"><b>{{$ShowStatus}}</b></span></h5>
                                @elseif($workOrder->status == 0)
                                  <h5><span class="badge badge-success" style="font-family:verdana; color:white;"><b>{{$ShowStatus}}</b></span></h5>
                                @elseif($workOrder->status == 2)
                                <h5><span class="badge badge-warning" style="font-family:verdana; color:white;"><b>{{$ShowStatus}}</b></span></h5>
                            @endif
                    </td>
                    <td style="font-family:verdana; color:black;">
                     <b hidden>{{$workOrder->created_at}}</b>
                     <b>{{$start}}</b>
                    </td>

                    <td>
                      
                            <a href="/section/workOrder/destroy/{{$workOrder->id}}"  class="btn btn-danger btn-group"
                            onclick="return confirm('Are you sure that you want delete this Vehicle?');">
                                    Remove</a>
                        @if($workOrder->status != 1 )
                            <a href="/section/py/processing/{{$workOrder->id}}"  class="btn btn-success btn-group">
                            More Options</a>
                        @endif

                        @if($workOrder->status == 1 )
                          <a href="/section/machines/viewpage/viewinvoice/{{$workOrder->id}}" class="btn btn-primary btn-group"><b>View Invoice</b></a>
                        @endif

                    </td>
                    </tr>
          </div>
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



    <!-- Bootstrap core JavaScript-->
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

                url: "{{ route('machinesrepairreport.searchajax') }}",
                method: 'get',
                data: {
                  dataComecoPadraoDateTime: dataComecoPadraoDateTime,
                  dataFimPadraoDateTime: dataFimPadraoDateTime,
                  _token: '{{csrf_token()}}'},

                success: function(result){  


                  // console.log(result);

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

                  else 
                  {
                    $(".show-range").append(`
                    <div class="alert alert-warning">
                        <h4>Searchig for motorcycles repairs reports `+ result.start +` and `+ result.end +`</h4>
                    </div>
                   `);
                
                  }

                  // alert(3);
                  // console.log(result);
                  $('#Nmachines').empty();
                  $('#seeopenworks').empty();
                  $('#NumberClosedServices').empty();
                  $('#WorkOrderTotalAmount').empty();
                  $('#totalamountproducts').empty();
                  $('#totalamoutwkwithoutprods').empty();
                  $('#totaldiscountinwk').empty();
                  $('#totalvat').empty();
                  $('#totalwkvalue').empty();
                  $('#WkTotalWithVat').empty();

                  $("#Nmachines").append(result.WorkOrderPerRangeDate);
                  $("#seeopenworks").append(result.OpenedWorkOrderPerRangeDate);
                  $("#NumberClosedServices").append(result.ClosedWorkOrderPerRangeDate);
                  $("#totalamountproducts").append(`£` + result.totalamountproducts);
                  $("#totalamoutwkwithoutprods").append(`£` + result.totalamoutwkwithoutprods);
                  $("#totaldiscountinwk").append(`£` + result.totaldiscountinwk);
                  $("#totalvat").append(`£` + result.totalvat);
                  $("#totalwkvalue").append(`£` + result.totalwkvalue);
                  $("#WkTotalWithVat").append(`£` + result.WorkOrderTotalAmount);


                  // Changin the table
                  $resp = result.VarFilterCustomersMachines;

                  // Changin the table
                      $('.prodstables').empty();
                      $.each($resp, function (key, value){

                        //montando a data começo
                        var outraData = new Date(value.created_at);
                        var newDay = outraData.getDate();
                        var newMonth = outraData.getMonth() + 1; // pois a contagem dos meses começa do 0
                        var newYear = outraData.getFullYear();
                        var status = value.status;


                        if(status == 1){
                          var statusName = "CLOSED";
                          var statusClass = "badge badge-danger";
                          var buttons = `   
                              <td>
                                  <a href="/section/workOrder/destroy/`+ value.id +`"  class="btn btn-danger btn-group"
                                  onclick="return confirm('Are you sure that you want delete this Work Order?');">
                                      <b>Remove</b></a>
                                  <a href="/section/machines/viewpage/viewinvoice/`+ value.id +`" class="btn btn-primary btn-group"><b>View Invoice</b></a>
                              </td>
                          `;
                        }
                        
                        else{
                          var statusName = "OPEN";
                          var statusClass = "badge badge-success";
                          var buttons = `   
                              <td>
                                  <a href="/section/py/processing/`+ value.id +`"  class="btn btn-success btn-group"><b>More Options</b></a>
                              </td>
                          `;
                        }
                  


                        if(newDay < 10){
                                newDay = `0${newDay}`;
                        }

                        if(newMonth < 10){
                          newMonth = `0${newMonth}`;
                        }

                        var dateJustCreated = `${newDay}/${newMonth}/${newYear}`;


                        $(".prodstables").append(`
                              <tr>
                                  <td style="font-family:verdana; color:black;"><b>`+ value.title +`</b><br></td>
                                  <td style="font-family:verdana; color:black;"><b>`+ value.customerName +`</b><br></td>
                                  <td style="font-family:verdana; color:black;"><b>`+ value.machineModel +`</b></td>
                                  <td><h5><span class="`+ statusClass +`">`+ statusName +`</span></h5></td>
                                  <td style="font-family:verdana; color:black;"><b>`+ dateJustCreated +`</b></td>
                                  `+ buttons +`
                              </tr>
                      `);
                    });

              
                    // $("#Nmachines").append(result.Nmachines);
                    // $("#seeopenworks").append(result.seeopenworks);
                    // $("#NumberClosedServices").append(result.NumberClosedServices);
                    // $("#WorkOrderTotalAmount").append(`£` + result.WorkOrderTotalAmount);
                    // $("#totalamountproducts").append(`£` + result.totalamountproducts.totalProdAmount);
                    // $("#totalamoutwkwithoutprods").append(`£` + result.totalamoutwkwithoutprods.totalamoutwkwithoutprods);
                    // $("#totaldiscountinwk").append(`£` + result.totaldiscountinwk.totaldiscount);
                    // $("#totalvat").append(`£` + result.totalvat.totalvat);
                    // $("#totalwkvalue").append(`£` + result.totalwkvalue.totalWk);
                    // $("#WkTotalWithVat").append(result.WorkOrderTotalAmount.totalWithVAT);

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
