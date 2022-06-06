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
              <h1 class="h3 mb-0 text-black-800"><strong style="color:black;">MACHINES HIRE REPORT</strong><br></h1>
              <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
              </div>

          <?php
            $hoje = date('d/m/Y');
          ?>
         

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
                        <a style="color:blue"> TOTAL INCOME MACHINES HIRED </a>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" ><strong style="color:green;" id="Nmachines" class="Nmachines">£{{$totalhiremachineincome}}</strong></div>
                        <b>Income earned with hiring machines </b>
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
                        <a style="color:blue"> TOTAL CROSS HIRE PRICE</a>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><strong style="color:green;" id="seeopenworks" class="seeopenworks">£{{$totalCrossHirePrice}}</strong></div>
                        <b>Amount spent with cross hiring machine</b>
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
                        <a style="color:blue">TOTAL EXTRA COSTS</a>
                        </div>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><strong style="color:green;" id="NumberClosedServices">£{{$totalextracost}}</strong></div> 
                              <b>Amount total with extra costs added in the hiring</b>
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
                        <div class="h5 mb-0 font-weight-bold"><strong style="color:green;" id="totaldiscountinwk">£{{$totaldiscount}}</strong></div>
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

            <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    <a style="color:blue">MACHINES READY FOR HIRE</a>
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold"><strong style="color:green;" id="totaldiscountinwk">{{$machinesready4hire}}</strong></div>
                                    <b>Total machines ready for hire</b>
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
                                    <a style="color:blue">OPEN  HIRINGS  </a>
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold"><strong style="color:green;" id="Nopenhiring">{{$Nopenhiring}}</strong></div>
                                    <b>Number of open hirings</b>
                                </div>
                                <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    <a style="color:blue">HIRINGS  FINISHED</a>
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold"><strong style="color:green;" id="Nclosedhiring">{{$Nclosedhiring}}</strong></div>
                                    <b>Number of closed hirings</b>
                                </div>
                                <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-xl-3 col-md-6 mb-4">
                    <?php
             

                    ?>
                            <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    <a style="color:blue">GENERAL BALANCE</a>
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold"><strong style="color:green;" id="generalBalance">£{{$generalbalance}}</strong></div>
                                    <b>SEE HOW MUCH YOU EARN HIRING - HOW MUCH YOU SPENT HIRING</b>
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
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">HIRED MACHINES</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
            <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->

                <th style="font-family:verdana; font-size:100%; color:#38393b;" >Id</th>
                <th style="font-family:verdana; font-size:100%; color:#38393b;" >Serial Number</th>
                <th style="font-family:verdana; font-size:100%; color:#38393b;" >Model</th>
                <th style="font-family:verdana; font-size:100%; color:#38393b;" >Brand</th>
                <th style="font-family:verdana; font-size:100%; color:#38393b;" >Hired by</th>
                <th style="font-family:verdana; font-size:100%; color:#38393b;" >Status</th>
                <th style="font-family:verdana; font-size:100%; color:#38393b;" >Started At</th>
                <th style="font-family:verdana; font-size:100%; color:#38393b;"  scope="col">Actions</th>

            </tr>
            </thead>

            <tbody>
            @foreach($hiredmachinebycustomer as $customerandmachine)

            <tr>

            <?php
                $max = 26;
                $str = " $customerandmachine->customerName";
                $owner=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                $max = 26;
                $str = " $customerandmachine->brand";
                $brand=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                $max = 26;
                $str = " $customerandmachine->internalmachinesSnumber";
                $serial_number=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                $max = 26;
                $str = " $customerandmachine->model";
                $model=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                $start = date('d/m/Y', strtotime($customerandmachine->created_at));

                $sttsNumer = $customerandmachine->hiringMachinesStatus;
                if($sttsNumer == 0){
                    $status = "ON HIRE";
                  }
                  else{
                    $status = "AVAILABLE";
                  }

                  if ($sttsNumer == 0)
                  {
                      $ShowStatus = "ON HIRE";
                      $statusHiringMachine = "OPEN";

                      $color = "color:orange";
                  }
                  else if ($sttsNumer == 1)
                  {
                      $ShowStatus = "HIRE FINISHED";
                      $statusHiringMachine = "CLOSED";
                      $color = "color:green";
                  }

                  $from = "machinehire";
                  

            ?>

            <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->

      



            <td style="font-family:verdana; font-size:100%; color:black;"><b>{{$customerandmachine->internalmachinesid}}</b></td>
            <td style="font-family:verdana; font-size:100%; color:black;"><b>{{$serial_number}}</b></td>
            <td style="font-family:verdana; font-size:100%; color:black;"><b>{{$model}}</b></td>
            <td style="font-family:verdana; font-size:100%; color:black;"><b>{{$brand}}</b></td>
            <td style="font-family:verdana; font-size:100%; color:black;"><b>{{$owner}}</b></td>
            <td>
                  @if($sttsNumer == 1 )
                        <h5><span class="badge badge-danger" style="font-family:verdana; color:white;"><b>{{$ShowStatus}}</b></span></h5>
                      @elseif($sttsNumer == 0)
                        <h5><span class="badge badge-warning" style="font-family:verdana; color:white;"><b>{{$ShowStatus}}</b></span></h5>
                      @elseif($sttsNumer == 2)
                      <h5><span class="badge badge-warning" style="font-family:verdana; color:white;"><b>{{$ShowStatus}}</b></span></h5>
                  @endif
            </td>
            <td style="font-family:verdana; font-size:100%; color:black;"><b>{{$start}}</b></td>
            
            <td>
                  <!-- <a href="/section/machines/viewPage/{{$customerandmachine}}" class="btn btn-success btn-group">View Page</a> -->
                  <a href="/section/allhiremachiness/viewPage/{{$customerandmachine->Hid}}/{{$customerandmachine->customerId}}/{{$statusHiringMachine}}/{{$from}}" class="btn btn-success btn-group"><b>View Page</b></a>

            </td>
            </tr>
        @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Page Heading -->
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Overview Hire's Machines</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
      <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
            <thead>
            <tr>
            <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->

                <th style="font-family:verdana; font-size:100%; color:#38393b;" >Serial Number</th>
                <th style="font-family:verdana; font-size:100%; color:#38393b;" >Model</th>
                <th style="font-family:verdana; font-size:100%; color:#38393b;" >Brand</th>
                <th style="font-family:verdana; font-size:100%; color:#38393b;" >Price per day</th>
                <th style="font-family:verdana; font-size:100%; color:#38393b;" >Nº hiring times</th>
                <th style="font-family:verdana; font-size:100%; color:#38393b;" >Total Income</th>
                <th style="font-family:verdana; font-size:100%; color:#38393b;" >Total Discount</th>
                <th style="font-family:verdana; font-size:100%; color:#38393b;" >Total Extra cost</th>
                <!-- <th style="font-family:verdana; font-size:100%; color:#38393b;" >Created At</th> -->
                <th style="font-family:verdana; font-size:100%; color:#38393b;"  scope="col">Actions</th>

            </tr>
            </thead>

            <tbody>
            @foreach($overviewpricesinfoshiremachines as $machine)

              <tr>

              <?php
                  $max = 26;
                  $str = " $machine->internalmachineModel";
                  $model=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                  $max = 26;
                  $str = " $machine->internalmachineBrand";
                  $brand=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                  $max = 26;
                  $str = " $machine->internalmachineSnumber";
                  $serial_number=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                  $priceperday = number_format($machine->priceperday, 2, '.',',');
                  $totalHireMachineIncome = number_format($machine->totalHireMachineIncome, 2, '.',',');
                  $totaldiscount = number_format($machine->totaldiscount, 2, '.',',');
                  $totalextracost = number_format($machine->totalextracost, 2, '.',',');


                  $start = date('d/m/Y', strtotime($machine->internalMachineDateCreatedAt));


                  if($machine->hiringMachinesStatus == 0){
                      $status = "AVAILABLE";
                    }
                    else{
                      $status = "ON HIRE";
                    }
              ?>

              <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->


                <td style="font-family:verdana; font-size:100%; color:black;"><b>{{$serial_number}}</b></td>
                <td style="font-family:verdana; font-size:100%; color:black;"><b>{{$model}}</b></td>
                <td style="font-family:verdana; font-size:100%; color:black;"><b>{{$brand}}</b></td>
                <td style="font-family:verdana; font-size:100%; color:black;"><b>£{{$priceperday}}</b></td>
                <td style="font-family:verdana; font-size:100%; color:black;"><b>{{$machine->NhiringTimes}}</b></td>
                <td style="font-family:verdana; font-size:100%; color:black;"><b>£{{$totalHireMachineIncome}}</b></td>
                <td style="font-family:verdana; font-size:100%; color:black;"><b>£{{$totaldiscount}}</b></td>
                <td style="font-family:verdana; font-size:100%; color:black;"><b>£{{$totalextracost}}</b></td>
                <!-- <td style="font-family:verdana; font-size:100%; color:black;"><b>{{$start}}</b></td> -->
                
                <td>
                      <a href="/section/hiringMachine/reportsMachineHireviewPage/{{$machine->hiringMachineId}}/{{$machine->machineId}}" class="btn btn-success btn-group">View Page</a>
                </td>
            </tr>
        @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>


  <!-- Page Heading -->
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Payments Hire's Machines</h6>
      <h5 class="m-0 font-weight-bold text-dark">All  Hire payments and the history about the latest hirings</h5>
    </div>
    <div class="card-body">
      <div class="table-responsive">
      <table class="table table-bordered" id="dataTable3" width="100%" cellspacing="0">
            <thead>
            <tr>
            <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->

                <th style="font-family:verdana; font-size:100%; color:#38393b;" >Serial Number</th>
                <th style="font-family:verdana; font-size:100%; color:#38393b;" >Model</th>
                <th style="font-family:verdana; font-size:100%; color:#38393b;" >Brand</th>
                <th style="font-family:verdana; font-size:100%; color:#38393b;" >Duration</th>
                <th style="font-family:verdana; font-size:100%; color:#38393b;" >Price per day</th>
                <th style="font-family:verdana; font-size:100%; color:#38393b;" >Total Income</th>
                <th style="font-family:verdana; font-size:100%; color:#38393b;" >Total Discount</th>
                <th style="font-family:verdana; font-size:100%; color:#38393b;" >Total Extra cost</th>
                <th style="font-family:verdana; font-size:100%; color:#38393b;" >Finished At</th>
                <th style="font-family:verdana; font-size:100%; color:#38393b;"  scope="col">Actions</th>

            </tr>
            </thead>

            <tbody>
            @foreach($latestsHiring as $lasthiring)

              <tr>

              <?php
                  $max = 26;
                  $str = " $lasthiring->internalmachinesModel";
                  $model=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                  $max = 26;
                  $str = " $lasthiring->internalmachinesBrand";
                  $brand=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                  $max = 26;
                  $str = " $lasthiring->internalmachinesSerialNumber";
                  $serial_number=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                  $priceperday = number_format($lasthiring->priceperday, 2, '.',',');
                  $totalHireMachineIncome = number_format($lasthiring->hiringPrice, 2, '.',',');
                  $totaldiscount = number_format($lasthiring->discount, 2, '.',',');
                  $totalextracost = number_format($lasthiring->extracost, 2, '.',',');


                  $start = date('d/m/Y', strtotime($lasthiring->finishHiringDate));


                  if($lasthiring->hiringMachinesStatus == 0){
                      $status = "AVAILABLE";
                    }
                    else{
                      $status = "ON HIRE";
                    }

                    $statusHiringMachine = "CLOSED";
              ?>

              <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->


                <td style="font-family:verdana; font-size:100%; color:black;"><b>{{$serial_number}}</b></td>
                <td style="font-family:verdana; font-size:100%; color:black;"><b>{{$model}}</b></td>
                <td style="font-family:verdana; font-size:100%; color:black;"><b>{{$brand}}</b></td>
                <td style="font-family:verdana; font-size:100%; color:black;"><b>{{$lasthiring->totalDaysNumber}}</b></td>
                <td style="font-family:verdana; font-size:100%; color:black;"><b>£{{$priceperday}}</b></td>
                <td style="font-family:verdana; font-size:100%; color:black;"><b>£{{$totalHireMachineIncome}}</b></td>
                <td style="font-family:verdana; font-size:100%; color:black;"><b>£{{$totaldiscount}}</b></td>
                <td style="font-family:verdana; font-size:100%; color:black;"><b>£{{$totalextracost}}</b></td>
                <td style="font-family:verdana; font-size:100%; color:black;"><b>{{$start}}</b></td>
                
                <td>
                <a type="button" class="btn btn-info" href="/section/hiremachine/checkfirstinvoice/{{$lasthiring->hiringMachineId}}">
                                <i class="fa fa-eye fa-1x " aria-hidden="true"></i>
                                <b>First Invoice</b>
                </a>
                <a type="button" class="btn btn-success" href="/section/hiremachine/checklastinvoice/{{$lasthiring->hiringMachineId}}">
                                <i class="fa fa-eye fa-1x " aria-hidden="true"></i>
                                <b>Last invoice</b>
                </a>
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



    <!-- Bootstrap core JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
    

    <script>
            $(document).ready(function(){
          
          // $('#ajaxSubmit').click(function(e){
            $(document).on("click", "#ajaxSubmit", function(e){
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
                url: "{{ route('machinesrepairreport.searchajax') }}",
                method: 'get',
                data: {
                  dataComecoPadraoDateTime: dataComecoPadraoDateTime,
                  dataFimPadraoDateTime: dataFimPadraoDateTime,
                  _token: '{{csrf_token()}}'},

                success: function(result){  

                  $('.show-range').empty();
                  $(".show-range").append(`
                      <div class="alert alert-warning">
                        <h4>Searchig for machines repairs reports `+ result.start +` and `+ result.end +`</h4>
                      </div>
                  `);

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

                  $("#Nmachines").append(result.Nmachines);
                  $("#seeopenworks").append(result.seeopenworks);
                  $("#NumberClosedServices").append(result.NumberClosedServices);
                  $("#totalamountproducts").append(`£` + result.totalamountproducts);
                  $("#totalamoutwkwithoutprods").append(`£` + result.totalamoutwkwithoutprods);
                  $("#totaldiscountinwk").append(`£` + result.totaldiscountinwk);
                  $("#totalvat").append(`£` + result.totalvat);
                  $("#totalwkvalue").append(`£` + result.totalwkvalue);
                  $("#WkTotalWithVat").append(`£` + result.WorkOrderTotalAmount);
                  

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
