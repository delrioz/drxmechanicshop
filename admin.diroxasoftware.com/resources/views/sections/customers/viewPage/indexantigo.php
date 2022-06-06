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

  <style>
  #titleLetter{
      color:#050d80;
  }
  #paragsStyle{
      color:black;
      font-size:17px;
  }
  #BlackTypeStyle{
      color:black;
      font-size:22px;
  }

  </style>
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
    <?php

      $from = 'viewPage';

    ?>

     <!-- Begin Page Content -->
     <div class="container-fluid">

         <!-- Page Heading -->
         <div class="d-sm-flex align-items-center justify-content-between">
           <h3 class="h3 mb-0 text-black-800" style="color:black;"><strong><b>{{$thisCustomer->name}}'s</b> Page</strong></h3>
           <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
           <ul class="nav justify-content-center">
              <li class="nav-item">
                <a  class="btn btn-block btn-info btn-group nav-link" href="/section/customers/edit/{{$thisCustomer->id}}/{{$from}}"><b>Edit Profile </b></a>
              </li>
              <li class="nav-item">
                <a  class="btn btn-block btn-primary btn-group nav-link" href="/section/customers/"> All Customer's</a>
              </li>
           </ul>
         </div>
   <br>

   <!-- Begin Page Content -->
   <div class="container-fluid">
     <!-- Begin Page Content -->

     @if(isset($thisCustomer) )
      <!-- Heading Row -->
            <div class="row align-items-center my-3" style="text-align:center;">
              <div class="col-lg-6">
                          <img class="img-fluid"  src="/storage/{{$thisCustomer->image}}"
                          style="width: 150; height: 200px;">
              </div>
              <!-- /.col-lg-8 -->
              <div class="col-lg-3">
                  <h4 style="color:black;" ><small><b>This Customer Data:</b></small></h4>
                  <h4 style="color:black;" ><b>Name:</b>  <small>{{$thisCustomer->name}}</small></h4>
                  @if($thisCustomer->telephone != '77777777777')
                    <h4 style="color:black;"><b>Contact Number:</b> <small>{{$thisCustomer->telephone}}</small> </h4>
                  @endif
                  @if(count($findNewTelephones) > 0)
                    @foreach($findNewTelephones as $nt)
                      <h4 style="color:black;"><b>Extra  Number:</b> <small>{{$nt->telephoneNumber}}</small></h4>
                    @endforeach
                  @endif
                  @if($thisCustomer->email != 'email@mail.com')
                    <h4 style="color:black;"><b>Email:</b>  <small>{{$thisCustomer->email}}</small></h4>
                  @endif
                  @if($thisCustomer->address != 'Customer Address')
                  <h4 style="color:black;"><b>Address:</b>  <small>{{$thisCustomer->address}}</small></h4>  
                  @endif
                  <a href="/section/customers/edit/{{$thisCustomer->id}}/{{$from}}"><i class="fas fa-edit"></i><b> Edit Profile </b></a>
                  <a href="/section/customers/destroy/{{$thisCustomer->id}}" onclick="return confirm('Are you sure that you want delete this Customer?');" style="color:#eb2a1c; text-color:white;">
                  <i class="fas fa-trash"></i><b> Remove Profile</b></a>
              </div>
              <!-- /.col-md-4 -->
            </div>
       <!-- /.row -->
      @endif



<!-- Begin Page Content -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"><b>ALL MACHINES FROM {{$thisCustomer->name}}</b>
    <!-- @if(($allworkOrders) != "[]"  )
                    <div class="alert alert-warning">
                        <b>These Follow Machines are waiting for a <b>COLLECTION IN STORE</b>. When the cliente comes, please go to More Options page and conclude the order to get the payment.</b>
                          <ul>
              @foreach($allworkOrders as $wk)
                            <li><a href="/section/machines/viewPage/{{$wk->machineId}}"><b>{{$wk->machineModel}}</b></a></li>
              @endforeach
                          </ul>
                    </div>
      @endif -->


     <a  class="m-0 font-weight-bold text-success"href="/section/customers/createmachineonviewpage/{{$thisCustomer->id}}">ADD NEW MACHINE</a></h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
          <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->

            <th style="font-family:verdana; font-size:100%; color:#38393b;">Status</th>
            <th style="font-family:verdana; font-size:100%; color:#38393b;">Id</th>
            <th style="font-family:verdana; font-size:100%; color:#38393b;">Serial Number</th>
            <th style="font-family:verdana; font-size:100%; color:#38393b;">Model</th>
            <th style="font-family:verdana; font-size:100%; color:#38393b;">Brand</th>
            <th style="font-family:verdana; font-size:100%; color:#38393b;">Status</th>
            <th style="font-family:verdana; font-size:100%; color:#38393b;">Created At</th>
           <th  style="font-family:verdana; font-size:100%; color:#38393b;" scope="col">Actions</th>

          </tr>

          <?php
            $from = "customerIndexViewPage";
          ?>


        </thead>
@if(($showFilteredMachinesStatus) == true)
        <tbody>
          @foreach($showFilteredMachines as $machine)

          <tr>
          <?php


          $max = 26;
          $str = " $machine->id";
          $machineId=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

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

          <td style="font-family:verdana; color:black;"><b>{{$machineId}}</b></td>
          <td style="font-family:verdana; color:black;"><b>{{$serial_number}}</b></td>
          <td style="font-family:verdana; color:black;"><b>{{$owner}}</b></td>
          <td style="font-family:verdana; color:black;"><b>{{$model}}</b></td>
          <td style="font-family:verdana; color:black;"><b>{{$brand}}</b></td>
          <!-- <td style="font-family:verdana; color:black;"><b>WAITING FOR WORK ORDERS</b></td> -->
          <td style="font-family:verdana; color:black;"><h5><span class="badge badge-info" style="font-family:verdana; color:white;"><b>WAITING FOR WORK ORDERS</b></span></h5></td>

          <td style="font-family:verdana; color:black;"><b>{{$start}}</b></td>

          <td>


              <a href="/section/machines/edit/{{$machine->id}}/{{$from}}" class="btn btn-primary btn-group"><b>Edit<b></a>
              <a href="/section/machines/destroy/{{$machine->id}}/{{$from}}"  class="btn btn-danger btn-group"
                 onclick="return confirm('Are you sure that you want delete this Machine?');">
                <b>Remove<b></a>
              <a href="/section/machines/viewPage/{{$machine->id}}" class="btn btn-success btn-group"><b>View Page</b></a>
          </td>
          </tr>
      @endforeach
    </tbody>
@endif 



@if(count($allworkOrders) > 0)
<tbody>
      @foreach($allworkOrders as $allwk)
          <tr>
          <?php
              $max = 26;
              $str = " $allwk->machineId";
              $machineId=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

              $max = 26;
              $str = " $allwk->customerName";
              $owner=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


              $max = 26;
              $str = " $allwk->machineBrand";
              $brand=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

              $max = 26;
              $str = " $allwk->serial_number";
              $serial_number=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

              $max = 26;
              $str = " $allwk->machineModel";
              $model=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

              $date = date('d/m/Y', strtotime($allwk->created_at));

              $ShowStatus = 0;
              $WhichStatus  = " $allwk->status ";

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

      
          ?>

          <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->

           <td style="font-family:verdana; color:black;"><b>{{$machineId}}</b></td>
           <td style="font-family:verdana; color:black;"><b>{{$serial_number}}</b></td>
           <td style="font-family:verdana; color:black;"><b>{{$owner}}</b></td>
           <td style="font-family:verdana; color:black;"><b>{{$model}}</b></td>
           <td style="font-family:verdana; color:black;"><b>{{$allwk->brand}}</b></td>
           <td>
                  @if($allwk->status == 1 )
                        <h5><span class="badge badge-danger" style="font-family:verdana; color:white;"><b>{{$ShowStatus}}</b></span></h5>
                      @elseif($allwk->status == 0)
                        <h5><span class="badge badge-success" style="font-family:verdana; color:white;"><b>{{$ShowStatus}}</b></span></h5>
                      @elseif($allwk->status == 2)
                      <h5><span class="badge badge-warning" style="font-family:verdana; color:white;"><b>{{$ShowStatus}}</b></span></h5>
                  @endif
            </td>
           <td style="font-family:verdana; color:black;"><b>{{$date}}</b></td>

          <td>
          <a href="/section/machines/edit/{{$allwk->machineId}}/{{$from}}" class="btn btn-primary btn-group"><b>Edit<b></a>
              <a href="/section/machines/destroy/{{$allwk->machineId}}/{{$from}}"  class="btn btn-danger btn-group"
                 onclick="return confirm('Are you sure that you want delete this Machine?');">
                <b>Remove<b></a>
              <a href="/section/machines/viewPage/{{$allwk->machineId}}" class="btn btn-success btn-group"><b>View Page</b></a>
          </td>
          </tr>
      @endforeach
    </tbody>
@endif


@if(count($allmachineswithowner) <= 0)
    <div class="alert alert-danger">
        <h5>{{$thisCustomer->name}} has no machines created his name</h5>
    </div>
@endif
      </table>
    </div>
  </div>
</div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
            <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><b>PAYMENTS ALREADY DONE</b></h6>

            </div>
            <div class="card-body">
              <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <!-- 'name', 'customer_report', 'first_observations', 'previous_observations', 'customer', 'vehicle', 'status', 'typeofpayment' -->

                      <th style="font-family:verdana; font-size:100%; color:#38393b;">Model</th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;">Brand</th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;">Type of Payment</th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;">Total</th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;">Vat</th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;">Discount</th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;">Status</th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;">Created At</th>
                      <th  style="font-family:verdana; font-size:100%; color:#38393b;" scope="col">Actions</th>

                    </tr>
                  </thead>

                  <tbody>
                    @foreach($workorder_payments as $workorder_payments)

                    <tr>
                    <?php

                        $max = 13;
                        $str = " $workorder_payments->title ";
                        $title=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                        $max = 13;
                        $str = " $workorder_payments->customer_report ";
                        $customer_report=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                        $max = 13;
                        $str = " $workorder_payments->first_observations ";
                        $first_observations=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                        $max = 13;
                        $str = " $workorder_payments->last_observations ";
                        $last_observations=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                        $max = 13;
                        $str = " $workorder_payments->customerName ";
                        $customer=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                        $max = 13;
                        $str = " $workorder_payments->machineModel ";
                        $machine=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                        $max = 13;
                        $str = " $workorder_payments->status ";
                        $status=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                        $max = 2;
                        $str = " $workorder_payments->typeofpayment ";
                        $typeofpayment=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                        $start2 = date('d/m/Y', strtotime($workorder_payments->created_at));

                        $discount = number_format($workorder_payments->discount, 2, '.',',');
                        $totalWithVAT = number_format($workorder_payments->totalWithVAT, 2, '.',',');
                        $vat = number_format($workorder_payments->vat, 2, '.',',');

                    ?>

                    <!-- 'name', 'customer_report', 'first_observations', 'previous_observations', 'customer', 'vehicle', 'status', 'typeofpayment' -->


                    <td style="font-family:verdana; color:black;"><b>{{$workorder_payments->model}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$workorder_payments->brand}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$workorder_payments->typeofpayment}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$totalWithVAT}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$vat}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$discount}}</b></td>
                    <td style="font-family:verdana; color:red;">
                            <h5><span class="badge badge-danger" style="font-family:verdana; color:white;"><b>CLOSED</b></span></h5>
                    </td>
                    <td style="font-family:verdana; color:black;"><b>{{$start2}}</b></td>
                    
                    <td>
                        <a href="/section/machines/viewpage/viewinvoice/{{$workorder_payments->workOrderReference}}" class="btn btn-info btn-group">
                          <i class="fas fa-eye" ></i>
                        </a>
                        
                        <a href="/section/py/destroy/{{$workorder_payments->id}}" onclick="return confirm('Are you sure that you want delete this payment?');"  class="btn btn-danger btn-group">
                          <i class="fas fa-trash" ></i>
                        </a>
                    </td>
                    </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>




        <!-- Begin Page Content -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><b>Machines Hired by {{$thisCustomer->name}}</b>
            <!-- @if(($allworkOrders) != "[]"  )
                            <div class="alert alert-warning">
                                <b>These Follow Machines are waiting for a <b>COLLECTION IN STORE</b>. When the cliente comes, please go to More Options page and conclude the order to get the payment.</b>
                                  <ul>
                      @foreach($allworkOrders as $wk)
                                    <li><a href="/section/machines/viewPage/{{$wk->machineId}}"><b>{{$wk->machineModel}}</b></a></li>
                      @endforeach
                                  </ul>
                            </div>
              @endif -->




          <a  class="m-0 font-weight-bold text-success"href="/section/hireamachine/allmachines/{{$thisCustomer->id}}">Go to Hire Machine</a></h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                  <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->

                    <th style="font-family:verdana; font-size:100%; color:#38393b;">Model</th>
                    <th style="font-family:verdana; font-size:100%; color:#38393b;">Brand</th>
                    <th style="font-family:verdana; font-size:100%; color:#38393b;">Serial Number</th>
                    <!-- <th style="font-family:verdana; font-size:100%; color:#38393b;">Daily</th> -->
                    <th style="font-family:verdana; font-size:100%; color:#38393b;">Hiring Price</th>
                    <th style="font-family:verdana; font-size:100%; color:#38393b;">Starts on</th>
                    <th style="font-family:verdana; font-size:100%; color:#38393b;">Finish on</th>
                    <th style="font-family:verdana; font-size:100%; color:#38393b;">Status</th>
                  <th  style="font-family:verdana; font-size:100%; color:#38393b;" scope="col">Actions</th>

                  </tr>
                </thead>
        @if(count($allhiremachines) > 0)
                <tbody>
                  @foreach($allhiremachines as $hiredmachine)

                  <tr>
                  <?php



                  if($hiredmachine->hiringMachinesStatus == 0){
                    $statusHiringMachine = "OPEN";
                  }
                  else{
                    $statusHiringMachine = "CLOSED";
                  }


                  $max = 26;
                  $str = " $hiredmachine->id";
                  $hiredmachineId=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                  $max = 26;
                  $str = " $hiredmachine->customerName";
                  $owner=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                  $max = 15;
                  $str = " $hiredmachine->brand";
                  $brand=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                  $max = 26;
                  $str = " $hiredmachine->serial_number";
                  $serial_number=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                  $max = 26;
                  $str = " $hiredmachine->model";
                  $model=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                  $start = date('d/m/Y', strtotime($hiredmachine->startHiringDate));
                  $end = date('d/m/Y', strtotime($hiredmachine->finishHiringDate));

                  $hiringPrice = number_format($hiredmachine->hiringPrice, 2, '.',',');

                  ?>

                  <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->

                  <td style="font-family:verdana; color:black;"><b>{{$model}}</b></td>
                  <td style="font-family:verdana; color:black;"><b>{{$brand}}</b></td>
                  <td style="font-family:verdana; color:black;"><b>{{$serial_number}}</b></td>
                  <!-- <td style="font-family:verdana; color:black;"><b>{{$hiredmachine->price}}</b></td> -->
                  <td style="font-family:verdana; color:black;"><b>£{{$hiringPrice}}</b></td>
                  <td style="font-family:verdana; color:black;"><b>{{$start}}</b></td>
                  <td style="font-family:verdana; color:black;"><b>{{$end}}</b></td>
                  @if($statusHiringMachine == "OPEN")
                  <td style="font-family:verdana; color:green;"><b>
                    <h5><span class="badge badge-success" style="font-family:verdana; color:white;"><b>{{$statusHiringMachine}}</b></span></h5>
                  </td>
                  
                  @else
                  <td style="font-family:verdana; color:red!important;"><b>
                    <h5><span class="badge badge-danger" style="font-family:verdana; color:white;"><b>{{$statusHiringMachine}}</b></span></h5>
                  </td>
                  @endif

                  <td>
                  <?php
                    $from = "customerIndexViewPage";
                  ?>
                    @if($statusHiringMachine == "OPEN")
                      <a href="/section/allhiremachiness/edit/{{$hiredmachine->hiringMachineId}}/{{$thisCustomer->id}}/{{$statusHiringMachine}}" class="btn btn-primary btn-group"><b>Edit</b></a>
                    @endif
                    <a href="/section/allhiremachiness/destroy/{{$hiredmachine->hiringMachineId}}/{{$thisCustomer->id}}"  class="btn btn-danger btn-group"
                          onclick="return confirm('Are you sure that you want delete this hire?');">
                    <b>Remove<b></a>

                    <a href="/section/allhiremachiness/viewPage/{{$hiredmachine->hiringMachineId}}/{{$thisCustomer->id}}/{{$statusHiringMachine}}" class="btn btn-success btn-group"><b>View Page</b></a>
                  </td>
                  </tr>
              @endforeach
            </tbody>
        @endif 

        @if(count($allhiremachines) <= 0)
            <div class="alert alert-danger">
                <h5>{{$thisCustomer->name}} has no machines hired</h5>
            </div>
        @endif
              </table>
            </div>
          </div>
        </div>


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
