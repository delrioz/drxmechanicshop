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

    <link href="{{ asset('jquery/multiselect/chosen.min.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('jquery/multiselect/jquery-3.5.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('jquery/multiselect/chosen.jquery.min.js') }}"></script>

</head>

<style>
            /* Style the buttons */
        .btnChooseOne {
        border: none;
        outline: none;
        padding: 10px 16px;
        background-color: #f1f1f1;
        cursor: pointer;
        }

        /* Style the active class (and buttons on mouse-over) */
        .activeOne, .btn:hover {
        background-color: #666;
        color: white;
    }
</style>

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
  $max = 27;
  $str = " $allmachines->model ";
  $model=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

  $max2 = 27;
  $str = " $allmachines->serial_number ";
  $serial_number=  substr_replace($str, (strlen($str) > $max2 ? '...' : ''), $max2);

  $from = 'MachineViewPage';
?>

<!-- Page Content -->
    <div class="container">
        <!-- Heading Row -->
        <div class="row align-items-center my-5">
            <div class="col-lg-7">
                <div class="card-body">
                    <p><b>This motorcycle data's</b></p>
                    <h3 class="card-title" style="color:black;"><p>Model: <strong style="color:black;">{{$model}}</strong></p></h3>
                    <h4 style="color:black;">Serial Number: <strong style="color:black;">{{$serial_number}}</strong></h4>
                    <a href="/section/machines/edit/{{$machineId}}/{{$from}}" style="color:#1da100;"><i class="fas fa-edit"></i><b> Edit this Motorcycle </b></a>
                    <a href="/section/machines/destroy/{{$machineId}}" onclick="return confirm('Are you sure that you want delete this Customer?');" style="color:#d90226; text-color:white;">
                        <i class="fas fa-trash" style="color:#f00014;"></i><b style="color:#f00014;"> Delete Motorcycle</b></a>
                <!-- <p class="card-text">Owner: <strong style="color:#060b30;">{{$allmachines->nameOwner}}</strong></p> -->
                    @if($NwkMade == 0)
                        <p>New Bike! This bike never had completed Work Order Before </p>
                    @else
                        <p>This bike has {{$NwkMade}} jobs already done!</p>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <a href="/section/workOrder/create/{{$machineId}}">Start New Job</a>
                    </div>

                    <div class="col-md-6">
                        <a href="/section/quote/create/{{$machineId}}">Make a Quote</a>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-8 -->
            <div class="col-lg-5">
                <h1 class="font-weight-light" style="color:black;"><b>View Motorcycle Page</b></h1>
                <p style="color:black;">
                    <b>This motorcycle belongs to:<br> {{$allmachineswithowner->customerName}}</b>
                </p>
                <a class="btn btn-primary" href="/section/customers/viewPage/{{$allmachineswithowner->customerId}}"> View All Customers Motorcycles</a>
            </div>
            <!-- /.col-md-4 -->
        </div>
        <!-- /.row -->
        </div>


                <input type="text" id="machineId" name="machineId" value="{{$machineId}}" hidden>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-4 text-gray-800">Buttons</h1> -->

                    <div class="row">

                        <div class="col-lg-6">

                            <!-- Circle Buttons -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">

                                <div class="buttonOptions" id="buttonOptions">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- <h6 class="m-0 font-weight-bold text-primary">Work Orders</h6> -->
                                            <button class="btnChooseOne activeOne">Work Orders</button><br><br>
                                            <!-- <a href="" name="btnChooseClosedWorkOrders" id="btnChooseClosedWorkOrders" style="color:red;">See all closed Work Orders</a>\ -->
                                            <!-- Example split danger button -->

                                            <div class="btn-group dropDownMenu" id="dropDownMenu" name="dropDownMenu">
                                                <button type="button" class="btn btn-success">Actives</button>
                                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"  name="btnChooseClosedWorkOrders" id="btnChooseClosedWorkOrders" href="#">See closed work orders</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <!-- <h6 class="m-0 font-weight-bold text-primary">Quotes</h6> -->
                                            <button class="btnChooseOne" id="btnChooseQuote" name="btnChooseQuote">Quotes</button>
                                        </div>
                                    </div>
                                </div>


                                </div>
                            <div class="card-body">
                                <!-- On rows -->
                                 <table class="table table-striped">
                                    <thead>
                                        <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                <tbody id="fadeInTable" name="fadeInTable">
                                    @foreach($allworkOrders as $workOrder)
                                    <?php
                                        $start = date('d/m/Y', strtotime($workOrder->created_at));

                                        $max = 13;
                                        $str = " $workOrder->title ";
                                        $title=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

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


                                    ?>
                                        <tr>
                                            <th scope="row">{{$workOrder->id}}</th>
                                            <td>{{$start}}</td>
                                            <td>{{$title}}</td>
                                            <td>
                                                @if($workOrder->status == 1 )
                                                    <h5><span class="badge badge-danger"><b>{{$ShowStatus}}</b></span></h5>
                                                @elseif($workOrder->status == 0)
                                                    <h5><span class="badge badge-success"><b>{{$ShowStatus}}</b></span></h5>
                                                @elseif($workOrder->status == 2)
                                                    <h5><span class="badge badge-warning"><b>{{$ShowStatus}}</b></span></h5>
                                                @endif
                                            </td>
                                            <!-- <td><a href="">Preview</a></td> -->
                                            <td>
                                                <ul class="navbar-nav ml-auto">
                                                    <li class="nav-item dropdown">
                                                        <a class="dropdown-toggle" href="#" id="navbarDropdown"
                                                            role="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            Options
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right animated--grow-in"
                                                            aria-labelledby="navbarDropdown">
                                                            <a class="dropdown-item" href="/section/py/processing/{{$workOrder->id}}/{{$from}}">Preview</a>
                                                            @if ($WhichStatus == 0)
                                                                <a class="dropdown-item" href="/section/workOrder/edit/{{$workOrder->id}}/{{$from}}" class="btn btn-primary btn-group">Edit</a>
                                                            @endif
                                                            <a class="dropdown-item" href="/section/workOrder/destroy/{{$workOrder->id}}"  class="btn btn-danger btn-group"
                                                                 onclick="return confirm('Are you sure that you want delete this Work Order?');">
                                                                <b>Remove</b>
                                                            </a>

                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="/section/workorder/jobCart/{{$workOrder->id}}/{{$from}}">Job Sheet</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                        <!-- <tbody id="fadeInTable" name="fadeInTable">
                                        </tbody>
                                        <div class="alert alert-warning" id="loadingAlert" name="loadingAlert">
                                            <p> No Work Orders was found </p>
                                        </div> -->
                                </table>
                                <!-- <a href="/section/workOrder/create/">Create Work Order</a> -->
                        </div>
                    </div>




                            <!-- Brand Buttons -->
                            <!-- <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                </div>
                                <div class="card-body">
                                </div>
                            </div> -->

                        </div>

                        <div class="col-lg-6">

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Payments</h6>
                                </div>
                                <div class="card-body">
                                <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Payment Method</th>
                                        <th scope="col">Amount</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($workorder_payments as $workorder_payments)
                                    <?php
                                        $start2 = date('d/m/Y', strtotime($workorder_payments->created_at));
                                        $totalWithVAT = number_format($workorder_payments->totalWithVAT, 2, '.',',');
                                    ?>
                                        <tr>
                                            <th scope="row">{{$workorder_payments->id}}</th>
                                            <td>{{$start2}}</td>
                                            <td>{{$workorder_payments->typeofpayment}}</td>
                                            <td>{{$totalWithVAT}}</td>
                                            <td>
                                                <a href="/section/machines/viewpage/viewinvoice/{{$workorder_payments->workOrderReference}}" class="btn btn-info btn-group">
                                                    <i class="fas fa-eye" ></i>
                                                </a>
                                                <a href="/section/py/destroy/{{$workorder_payments->id}}" onclick="return confirm('Are you sure that you want delete this payment?');" class="btn btn-danger btn-group">
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

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->




        <!-- btnChooseOne -->
<!--
<script>
        $(document).ready(function(){
            $('#btnChooseQuote').click(function(e){

                // // showing the Quotes
                // $("#fadeInTable").append(`
                //         <table class="table table-striped">
                //             <thead>
                //                 <tr>
                //                 <th scope="col">Id</th>
                //                 <th scope="col">Date</th>
                //                 <th scope="col">Title</th>
                //                 <th scope="col">Status</th>
                //                 </tr>
                //             </thead>
                //     `);


                });
            });
</script> -->

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


<script>

    $(document).ready(function(){

       $(document).on("click", "#btnChooseQuote", function(e){
            // alert(1);
                // $('.buttonOptions').empty();
                var machineId = $('#machineId').val();

                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ url('/section/quote/getQuoteAjaxByMachine') }}",
                    method: 'post',
                    data: {
                        machineId: machineId,
                    _token: '{{csrf_token()}}'},

                    success: function(result){
                        $('#fadeInTable').empty();
                        $('#loadingAlert').empty();

                        //  console.log(result);
                    $resp = result;

                        $('#buttonOptions').empty();
                        $('#loadingAlert').empty();

                        $("#buttonOptions").append(`

                            <div class="buttonOptions" id="buttonOptions">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btnChooseOne" id="btnChooseWk"  name="btnChooseWk" >Work Orders</button><br><br>

                                            <div class="btn-group dropDownMenu" id="dropDownMenu" name="dropDownMenu">
                                                <button type="button" class="btn btn-success">Actives</button>
                                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"  name="btnChooseClosedQuotes" id="btnChooseClosedQuotes" href="#">See closed Quotes</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <!-- <h6 class="m-0 font-weight-bold text-primary">Quotes</h6> -->
                                            <button class="btnChooseOne activeOne">Quotes</button>
                                        </div>
                                    </div>
                            </div>

                        `);


                    if($resp == "[]" || $resp == null || $resp == 0)
                    {
                        $("#loadingAlert").append(`
                                <p> No Quotes was found </p>
                        `);
                    }
                    else
                    {
                        $.each($resp, function (key, value){

                            var WhichStatus  = value.status;

                            if (WhichStatus == 0)
                            {
                                var ShowStatus = "OPEN";
                                var className = "badge badge-success";
                            }
                            else if (WhichStatus == 1)
                            {
                                var ShowStatus = "CLOSED";
                                var className = "badge badge-danger";
                            }
                            else if (WhichStatus == 2)
                            {
                                var ShowStatus = "READY FOR COLLECTION";
                                var className = "badge badge-warning";
                            }

                            else if (WhichStatus == 3)
                            {
                                var ShowStatus = "QUOTE REFUSED";
                                var className = "badge badge-danger";
                            }

                            var  dateFormated =  formatingDate(value.created_at);


                            $("#fadeInTable").append(`

                                    <tr>
                                            <th scope="row">`+ value.id +`</th>
                                            <td>`+ dateFormated +`</td>
                                            <td>`+ value.title +`</td>
                                            <td>
                                                <h5><span class="`+ className +`">`+ ShowStatus +`</span></h5>
                                            </td>
                                            <td>
                                                <ul class="navbar-nav ml-auto">
                                                    <li class="nav-item dropdown">
                                                        <a class="dropdown-toggle" href="#" id="navbarDropdown"
                                                            role="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            Options
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right animated--grow-in"
                                                            aria-labelledby="navbarDropdown">
                                                            <a class="dropdown-item" href="/section/quote/previewInvoice/`+ value.id +`/{{$from}}">Preview</a>
                                                            <a class="dropdown-item" href="/section/quote/edit/`+ value.id +`/{{$from}}" class="btn btn-primary btn-group">Edit</a>
                                                            <a class="dropdown-item" href="/section/quote/destroy/`+ value.id +`"  class="btn btn-danger btn-group"
                                                                onclick="return confirm('Are you sure that you want DELETE this Quote?');">
                                                                <b>Remove</b>
                                                            </a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                    </tr>
                            `);
                        });
                     }
                    },

                    error: function(jqXHR, textStatus, errorThrown, result) {
                    $msg = 'oi';
                        $resp = jqXHR.responseJSON.errors;
                        console.log(jqXHR, textStatus, errorThrown, result);

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


          $(document).on("click", "#btnChooseWk", function(e){
            // $('.buttonOptions').empty();
            $('#btnChooseWk').click(function(e){

            var machineId = $('#machineId').val();

             e.preventDefault();
             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

             $.ajax({
                url: "{{ url('/section/workOrder/getWKAjaxByMachine')}}",
                method: 'post',
                data: {
                    machineId: machineId,
                   _token: '{{csrf_token()}}'},

                  success: function(result){
                     $('#fadeInTable').empty();
                    //  console.log(result);
                     $resp = result;

                        $('#buttonOptions').empty();
                        $('#loadingAlert').empty();

                        $("#buttonOptions").append(`

                            <div class="buttonOptions" id="buttonOptions">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <!-- <h6 class="m-0 font-weight-bold text-primary">Work Orders</h6> -->
                                                <button class="btnChooseOne activeOne">Work Orders</button><br><br>
                                                <!-- <a href="" name="btnChooseClosedWorkOrders" id="btnChooseClosedWorkOrders" style="color:red;">See all closed Work Orders</a>\ -->
                                                <!-- Example split danger button -->
                                                <div class="btn-group dropDownMenu" id="dropDownMenu" name="dropDownMenu">
                                                    <button type="button" class="btn btn-success">Actives</button>
                                                    <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"  name="btnChooseClosedWorkOrders" id="btnChooseClosedWorkOrders" href="#">See closed work orders</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- <h6 class="m-0 font-weight-bold text-primary">Quotes</h6> -->
                                                <button class="btnChooseOne" id="btnChooseQuote" name="btnChooseQuote">Quotes</button>
                                            </div>
                                        </div>
                            </div>

                        `);







                    if($resp == "[]" || $resp == null || $resp == 0)
                    {
                        $("#loadingAlert").append(`
                                <p> No Work Orders was found </p>
                        `);
                    }

                    else

                    {

                        $.each($resp, function (key, value){

                            var WhichStatus  = value.status;

                            if (WhichStatus == 0)
                            {
                                var ShowStatus = "OPEN";
                                var className = "badge badge-success";
                            }
                            else if (WhichStatus == 1)
                            {
                                var ShowStatus = "CLOSED";
                                var className = "badge badge-danger";
                            }
                            else if (WhichStatus == 2)
                            {
                                var ShowStatus = "READY FOR COLLECTION";
                                var className = "badge badge-warning";
                            }



                            var  dateFormated =  formatingDate(value.created_at);

                            // document.querySelector('#btnChooseWk').classList.remove("activeOne");
                            // document.querySelector('#btnChooseQuote').classList.remove("activeOne");

                            // document.querySelector('#btnChooseWk').classList.toggle("activeOne");



                            $("#fadeInTable").append(`

                                    <tr>
                                            <th scope="row">`+ value.id +`</th>
                                            <td>`+ dateFormated +`</td>
                                            <td>`+ value.title +`</td>
                                            <td>
                                                <h5><span class="`+ className +`">`+ ShowStatus +`</span></h5>
                                            </td>
                                            <td>
                                                <ul class="navbar-nav ml-auto">
                                                    <li class="nav-item dropdown">
                                                        <a class="dropdown-toggle" href="#" id="navbarDropdown"
                                                            role="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            Options
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right animated--grow-in"
                                                            aria-labelledby="navbarDropdown">
                                                            <a class="dropdown-item" href="/section/py/processing/`+ value.id +`/{{$from}}">Preview</a>
                                                            <a class="dropdown-item" href="/section/workOrder/edit/`+ value.id +`/{{$from}}" class="btn btn-primary btn-group">Edit</a>
                                                            <a class="dropdown-item" href="/section/workOrder/destroy/`+ value.id +`"  class="btn btn-danger btn-group"
                                                                onclick="return confirm('Are you sure that you want delete this Work Order?');">
                                                                <b>Remove</b>
                                                            </a>

                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="/section/workorder/jobCart/`+ value.id +`/{{$from}}">Job Sheet</a>
                                                        </div>

                                                    </li>
                                                </ul>
                                            </td>
                                    </tr>
                            `);
                        });
                    }
                },

                error: function(jqXHR, textStatus, errorThrown, result) {
                  $msg = 'oi';
                    $resp = jqXHR.responseJSON.errors;
                    console.log(jqXHR, textStatus, errorThrown, result);

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
        });


/// SE ALL CLOSED WORK ORDERS AND QUOTES btnChooseClosedWorkOrders



$(document).on("click", "#btnChooseClosedWorkOrders", function(e){
    // alert(1);
        // $('.buttonOptions').empty();
        var machineId = $('#machineId').val();

        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{ url('/section/workOrder/allworkorderAjaxByMachine') }}",
            method: 'post',
            data: {
                machineId: machineId,
            _token: '{{csrf_token()}}'},

            success: function(result){

                $('#fadeInTable').empty();
                $('#loadingAlert').empty();

            $resp = result;



            $('#buttonOptions').empty();
                $("#buttonOptions").append(`

                <div class="buttonOptions" id="buttonOptions">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- <h6 class="m-0 font-weight-bold text-primary">Work Orders</h6> -->
                                <button class="btnChooseOne activeOne">Work Orders</button><br><br>
                                <!-- <a href="" name="btnChooseClosedWorkOrders" id="btnChooseClosedWorkOrders" style="color:red;">See all closed Work Orders</a>\ -->
                                <!-- Example split danger button -->

                                <div class="btn-group dropDownMenu" id="dropDownMenu" name="dropDownMenu">
                                    <button type="button" class="btn btn-danger">Closed</button>
                                    <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"  class="btnChooseOne" id="btnChooseWk"  name="btnChooseWk" href="#">See openned work orders</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- <h6 class="m-0 font-weight-bold text-primary">Quotes</h6> -->
                                <button class="btnChooseOne" id="btnChooseQuote" name="btnChooseQuote">Quotes</button>
                            </div>
                        </div>
                    </div>
                `);


            if($resp == "[]" || $resp == null || $resp == 0)
            {
                $("#loadingAlert").append(`
                        <p> No Closed Work Order was found </p>
                `);
            }
            else
            {
                
                $.each($resp, function (key, value){

                    var WhichStatus  = value.status;

                    if (WhichStatus == 0)
                    {
                        var ShowStatus = "OPEN";
                        var className = "badge badge-success";
                    }
                    else if (WhichStatus == 1)
                    {
                        var ShowStatus = "CLOSED";
                        var className = "badge badge-danger";
                    }
                    else if (WhichStatus == 2)
                    {
                        var ShowStatus = "READY FOR COLLECTION";
                        var className = "badge badge-warning";
                    }

                    


                    var  dateFormated =  formatingDate(value.created_at);



                    $("#fadeInTable").append(`

                            <tr>
                            ddd
                                    <th scope="row">`+ value.id +`</th>
                                    <td>`+ dateFormated +`</td>
                                    <td>`+ value.title +`</td>
                                    <td>
                                        <h5><span class="`+ className +`">`+ ShowStatus +`</span></h5>
                                    </td>
                                    <td>
                                        <ul class="navbar-nav ml-auto">
                                            <li class="nav-item dropdown">
                                                <a class="dropdown-toggle" href="#" id="navbarDropdown"
                                                    role="button" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Options
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right animated--grow-in"
                                                    aria-labelledby="navbarDropdown">
                                                    <a class="dropdown-item" href="/section/py/processing/`+ value.id +`/{{$from}}">Preview</a>
                                                    <a class="dropdown-item" href="/section/workOrder/destroy/`+ value.id +`"  class="btn btn-danger btn-group"
                                                        onclick="return confirm('Are you sure that you want delete this Work Order?');">
                                                        <b>Remove</b>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </td>
                            </tr>
                    `);
                });
             }
            },

            error: function(jqXHR, textStatus, errorThrown, result) {
            $msg = 'oi';
                $resp = jqXHR.responseJSON.errors;
                console.log(jqXHR, textStatus, errorThrown, result);

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



/// SE ALL CLOSED AND QUOTES and btnChooseClosedQuotes



$(document).on("click", "#btnChooseClosedQuotes", function(e){

        // $('.buttonOptions').empty();
        var machineId = $('#machineId').val();

        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{ url('/section/quote/getClosedQuoteByMachine') }}",
            method: 'post',
            data: {
                machineId: machineId,
            _token: '{{csrf_token()}}'},

            success: function(result){
                $('#fadeInTable').empty();
                $('#loadingAlert').empty();

            $resp = result;
            console.log($resp);

            $('#buttonOptions').empty();
                $("#buttonOptions").append(`

                    <div class="buttonOptions" id="buttonOptions">
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- <h6 class="m-0 font-weight-bold text-primary">Work Orders</h6> -->
                                    <button class="btnChooseOne" id="btnChooseWk"  name="btnChooseWk">Work Orders</button><br><br>
                                    <!-- <a href="" name="btnChooseClosedWorkOrders" id="btnChooseClosedWorkOrders" style="color:red;">See all closed Work Orders</a>\ -->
                                    <!-- Example split danger button -->

                                    <div class="btn-group dropDownMenu" id="dropDownMenu" name="dropDownMenu">
                                        <button type="button" class="btn btn-danger">Closed</button>
                                        <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" id="btnChooseQuote" name="btnChooseQuote"  href="#">See Quotes Actives</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- <h6 class="m-0 font-weight-bold text-primary">Quotes</h6> -->
                                    <button class="btnChooseOne activeOne" >Quotes</button>
                                </div>
                            </div>
                    </div>
                `);


            if($resp == "[]" || $resp == null || $resp == 0)
            {
                $("#loadingAlert").append(`
                        <p> No Quotes was found </p>
                `);
            }
            else
            {
                $.each($resp, function (key, value){

                    var WhichStatus  = value.status;

                    if (WhichStatus == 0)
                    {
                        var ShowStatus = "OPEN";
                        var className = "badge badge-success";
                    }
                    else if (WhichStatus == 1)
                    {
                        var ShowStatus = "CLOSED";
                        var className = "badge badge-danger";
                    }
                    else if (WhichStatus == 2)
                    {
                        var ShowStatus = "READY FOR COLLECTION";
                        var className = "badge badge-warning";
                    }     

                    else if (WhichStatus == 3)
                    {
                        var ShowStatus = "QUOTE REFUSED";
                        var className = "badge badge-danger";
                    }


                    var  dateFormated =  formatingDate(value.created_at);


                    $("#fadeInTable").append(`

                            <tr>
                            ddd
                                    <th scope="row">`+ value.id +`</th>
                                    <td>`+ dateFormated +`</td>
                                    <td>`+ value.title +`</td>
                                    <td>
                                        <h5><span class="`+ className +`">`+ ShowStatus +`</span></h5>
                                    </td>
                                    <td>
                                        <ul class="navbar-nav ml-auto">
                                            <li class="nav-item dropdown">
                                                <a class="dropdown-toggle" href="#" id="navbarDropdown"
                                                    role="button" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Options
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right animated--grow-in"
                                                    aria-labelledby="navbarDropdown">
                                                    <a class="dropdown-item" href="/section/quotesAlreadyDone/viewpage/viewinvoice/`+ value.id +`">Preview</a>
                                                    <a class="dropdown-item" href="/section/quote/destroy/`+ value.id +`"  class="btn btn-danger btn-group"
                                                        onclick="return confirm('Are you sure that you want delete this Quote?');">
                                                        <b>Remove</b>
                                                    </a>
                                                </div>
                                <td>

                                            </li>
                                        </ul>
                                    </td>
                            </tr>
                    `);
                });
             }
            },

            error: function(jqXHR, textStatus, errorThrown, result) {
            $msg = 'oi';
                $resp = jqXHR.responseJSON.errors;
                console.log(jqXHR, textStatus, errorThrown, result);

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





</script>




<!-- Bootstrap core JavaScript-->
<script src="{{ asset('admlyt/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admlyt/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('ajaxfunctions/mainajax.js') }}"></script>


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
