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

  <style>
    .inputSearchArea{
      padding:5px;
      border-radius:5px;
      width:100%;


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

          @if(session('error'))
            <div class="alert alert-danger">
              {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                </button>
            </div>
          @endif
          <!-- Page Headi

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-black-800" style="color:black!important;"><strong>CUSTOMERS</strong></h1>
                <a href="/section/customers/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-plus fa-sm text-white-50"></i> <b>ADD CUSTOMER</b></a>
          </div>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> <p class="mb-4">HERE YOU SEE ALL CUSTOMERS ON YOUR DATABASE</p></h6>
            </div>

            <section class="search-sec">
                    <div class="container">
                        <form action="/section/costumers/searchCustomerAjax" method="post" novalidate="novalidate">
                        @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-12 p-2">
                                            <input type="text" name="searchInput" id="searchInput" class="form-control search-slt"
                                             placeholder="Search Everything">
                                        </div>
                                        <!-- <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                            <input type="text" class="form-control search-slt" placeholder="Enter Drop City">
                                        </div> -->
                                        <div class="col-lg-3 col-md-3 col-sm-12 p-2">
                                            <select class="form-control search-slt" id="exampleFormControlSelect1" name="orderByInput">
                                                <option value="orderByAll">Order By All</option>
                                                <option value="orderByName">Order By Name</option>
                                                <option value="orderById">Order By Id</option>
                                                <option value="orberByCreatedAt">Order By Created At</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 p-2">
                                            <select class="form-control search-slt" id="ascOrDesc" name="ascOrDesc">
                                                <option value="asc">ASC</option>
                                                <option value="desc">DESC</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-sm-12 p-2">
                                              <button type="submit" class="btn btn-danger searchButton" id="searchButton" name="searchButton">Search</button>
                                              <a href="/section/customers" class="btn btn-primary"
                                              onclick="return confirm('Are you sure that you want Reset Search and Refresh the Page?');">
                                            Reset Search
                                          </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered"  width="100%" cellspacing="0">
                  <thead id="mainThead" name="mainThead">
                    <tr>
                    <!-- 'name', 'nationality', 'address', 'about', 'nameofbusiness', 'email' -->
                      <th style="font-family:verdana; font-size:100%; color:#38393b;">
                        <a href="" id="thId" class="thId" name="thId">
                          <b>Id</b>
                        </a>
                      </th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;">
                        <a href="" id="thName" class="thName" name="thName">
                         <b>Name</b>
                        </a>
                      </th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;">
                        <a href="" id="thContactNumber" class="thContactNumber" name="thContactNumber">
                          <b>Contact Number</b>
                        </a>
                      </th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;">
                        <a href="" id="thEmail" class="thEmail" name="thEmail">
                          <b>Email</b>
                        </a> 
                      </th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;">
                        <a href="" id="thCreatedAt" class="thCreatedAt" name="thCreatedAt">
                         <b>Created At</b>
                        </a>
                      </th>
                     <th style="font-family:verdana; font-size:95%; color:#38393b;" scope="col"><b>Actions</b></th>
                    </tr>
                  </thead>
                  <hr>

                  <tbody class="infoTable" id="infoTable">
                    @foreach($allcustomers as $customer)

                    <tr>
                    <?php

                    $max = 30;
                    $str = " $customer->name ";
                    $name=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                    $max = 30;
                    $str = " $customer->email ";
                    $email=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                    $start = date('d/m/Y', strtotime($customer->created_at));
                    $customerTelephone = $customer-> telephone;
                    $customer-> telephone == "77777777777" ? $customerTelephone =  'no telephone' : $customerTelephone = $customer->telephone;
                    $customer-> email == "email@mail.com" ? $customerEmail =  'no email' : $customerEmail = $customer->email;

                    ?>

                    <!-- 'name', 'nationality', 'address', 'about', 'nameofbusiness', 'email' -->
                    <td style="font-family:verdana; color:black;"><b>{{$customer->id}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$name}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$customerTelephone}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$customerEmail}}</b></td>
                    <td style="font-family:verdana; color:black;">
                      <b hidden>{{$customer->created_at}}</b>
                      <b>{{$start}}</b>
                    </td>

                    <td>
                        <a href="/section/customers/edit/{{$customer->id}}" class="btn btn-primary btn-group">Edit</a>
                        <a href="/section/customers/destroy/{{$customer->id}}"  class="btn btn-danger btn-group"
                        onclick="return confirm('Are you sure that you want delete this Customer?');">
                                Remove</a>
                        <a href="/section/customers/viewPage/{{$customer->id}}" class="btn btn-success btn-group">View Page</a>
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

            // $('#ajaxSubmit').click(function(e){
              $(document).on("click", "#searchButton", function(e){

                var searchInput = $('#searchInput').val();
                var ascOrDesc = $('#ascOrDesc').val();
                var orderByInput = $('#exampleFormControlSelect1 option:selected').val();



               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               $.ajax({
                  url: "{{ url('/section/costumers/searchCustomerAjax') }}",
                  data: {
                    searchInput: searchInput,
                    orderByInput: orderByInput,
                    ascOrDesc: ascOrDesc,
                     _token: '{{csrf_token()}}'},

                  success: function(result){
                    $resp = result;
                    console.log($resp);
                    $('#infoTable').empty();

                    $.each($resp, function (key, value){

                      var  dateFormated =  formatingDate(value.created_at);

                        $("#infoTable").append(`
                              <tr>

                                  <td style="font-family:verdana; color:black;"><b>` + value.id + `</b></td>
                                  <td style="font-family:verdana; color:black;"><b>` + value.name + `</b></td>
                                  <td style="font-family:verdana; color:black;"><b>` + value.telephone + `</b></td>
                                  <td style="font-family:verdana; color:black;"><b>`+ value.email + `</b></td>
                                  <td style="font-family:verdana; color:black;"><b>`+ dateFormated + `</b></td>
                                  <td>
                                      <a href="/section/customers/edit/`+ value.id + `" class="btn btn-primary btn-group">Edit</a>
                                      <a href="/section/customers/destroy/`+ value.id + `"  class="btn btn-danger btn-group"
                                      onclick="return confirm('Are you sure that you want delete this Customer?');">
                                              Remove</a>
                                      <a href="/section/customers/viewPage/`+ value.id + `" class="btn btn-success btn-group">View Page</a>
                                  </td>
                              </tr>
                      `);
                    });



                  },
                  error: function(jqXHR, textStatus, errorThrown, result) {
                      // console.log(jqXHR.responseJSON.errors)
                      Alert('Some ERROR try again');
                      $msg = 'oi';
                      $resp = jqXHR.responseJSON.errors;
                      $('.dataTable').empty();
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

<script>
      $(document).ready(function(){

            // $('#ajaxSubmit').click(function(e){
              $(document).on("click", "#thCreatedAt", function(e){
                
                alert("primeiro");
                var searchInput = $('#searchInput').val();
                var filteredBy = "id";
                var ascOrDesc = "ASC";
                // var orderByInput = $('#exampleFormControlSelect1 option:selected').val();

               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               $.ajax({
                  url: "{{ url('/section/costumers/searchCustomerAjaxByFilters') }}",
                  data: {
                    searchInput: searchInput,
                    filteredBy: filteredBy,
                    ascOrDesc: ascOrDesc,
                     _token: '{{csrf_token()}}'},

                  success: function(result){
                    $resp = result;
                    console.log($resp);
                    $('#infoTable').empty();
                    $('#mainThead').empty();

                    $("#mainThead").append(`
                        <tr>
                              <th style="font-family:verdana; font-size:100%; color:#38393b;">
                                <a href="" id="thId" class="thId" name="thId">
                                  <b>Id</b>
                                </a>
                              </th>
                              <th style="font-family:verdana; font-size:100%; color:#38393b;">
                                <a href="" id="thName" class="thName" name="thName">
                                <b>Name</b>
                                </a>
                              </th>
                              <th style="font-family:verdana; font-size:100%; color:#38393b;">
                                <a href="" id="thContactNumber" class="thContactNumber" name="thContactNumber">
                                  <b>Contact Number</b>
                                </a>
                              </th>
                              <th style="font-family:verdana; font-size:100%; color:#38393b;">
                                <a href="" id="thEmail" class="thEmail" name="thEmail">
                                  <b>Email</b>
                                </a> 
                              </th>

                              <th style="font-family:verdana; font-size:100%; color:#38393b;">
                                <a href="" id="thCreatedAt2" class="thCreatedAt2" name="thCreatedAt2">
                                <b>Created At DESC</b>
                                </a>
                              </th>
                              <th style="font-family:verdana; font-size:95%; color:#38393b;" scope="col"><b>Actions</b></th>
                      </tr>
                      `);

                    $.each($resp, function (key, value){

                      var  dateFormated =  formatingDate(value.created_at);

                        $("#infoTable").append(`
                            <tr>
                                  <td style="font-family:verdana; color:black;"><b>` + value.id + `</b></td>
                                  <td style="font-family:verdana; color:black;"><b>` + value.name + `</b></td>
                                  <td style="font-family:verdana; color:black;"><b>` + value.telephone + `</b></td>
                                  <td style="font-family:verdana; color:black;"><b>`+ value.email + `</b></td>
                                  <td style="font-family:verdana; color:black;"><b>`+ dateFormated + `</b></td>
                                  <td>
                                      <a href="/section/customers/edit/`+ value.id + `" class="btn btn-primary btn-group">Edit</a>
                                      <a href="/section/customers/destroy/`+ value.id + `"  class="btn btn-danger btn-group"
                                      onclick="return confirm('Are you sure that you want delete this Customer?');">
                                              Remove</a>
                                      <a href="/section/customers/viewPage/`+ value.id + `" class="btn btn-success btn-group">View Page</a>
                                  </td>
                              </tr>
                      `);
                    });



                  },
                  error: function(jqXHR, textStatus, errorThrown, result) {
                      // console.log(jqXHR.responseJSON.errors)
                      Alert('Some ERROR try again');
                      $msg = 'oi';
                      $resp = jqXHR.responseJSON.errors;
                      $('.dataTable').empty();
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


<script>
      $(document).ready(function(){

            // $('#ajaxSubmit').click(function(e){
              $(document).on("click", "#thCreatedAt2", function(e){
                alert("segundo");
                

                var searchInput = $('#searchInput').val();
                var filteredBy = "id";
                var ascOrDesc = "DESC";
                // var orderByInput = $('#exampleFormControlSelect1 option:selected').val();

               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               $.ajax({
                  url: "{{ url('/section/costumers/searchCustomerAjaxByFilters') }}",
                  data: {
                    searchInput: searchInput,
                    filteredBy: filteredBy,
                    ascOrDesc: ascOrDesc,
                     _token: '{{csrf_token()}}'},

                  success: function(result){
                    $resp = result;
                    console.log($resp);
                    $('#infoTable').empty();
                    $('#mainThead').empty();

                    $("#mainThead").append(`
                        <tr>
                              <th style="font-family:verdana; font-size:100%; color:#38393b;">
                                <a href="" id="thId" class="thId" name="thId">
                                  <b>Id 4444</b>
                                </a>
                              </th>
                              <th style="font-family:verdana; font-size:100%; color:#38393b;">
                                <a href="" id="thName" class="thName" name="thName">
                                <b>Name</b>
                                </a>
                              </th>
                              <th style="font-family:verdana; font-size:100%; color:#38393b;">
                                <a href="" id="thContactNumber" class="thContactNumber" name="thContactNumber">
                                  <b>Contact Number</b>
                                </a>
                              </th>
                              <th style="font-family:verdana; font-size:100%; color:#38393b;">
                                <a href="" id="thEmail" class="thEmail" name="thEmail">
                                  <b>Email</b>
                                </a> 
                              </th>

                              <th style="font-family:verdana; font-size:100%; color:#38393b;">
                                <a href="" id="thCreatedAt2" class="thCreatedAt2" name="thCreatedAt2">
                                <b>Created At DESC</b>
                                </a>
                              </th>
                              <th style="font-family:verdana; font-size:95%; color:#38393b;" scope="col"><b>Actions</b></th>
                      </tr>
                      `);


                    $.each($resp, function (key, value){

                      var  dateFormated =  formatingDate(value.created_at);

                        $("#infoTable").append(`
                            <tr>
                                  <td style="font-family:verdana; color:black;"><b>` + value.id + `</b></td>
                                  <td style="font-family:verdana; color:black;"><b>` + value.name + `</b></td>
                                  <td style="font-family:verdana; color:black;"><b>` + value.telephone + `</b></td>
                                  <td style="font-family:verdana; color:black;"><b>`+ value.email + `</b></td>
                                  <td style="font-family:verdana; color:black;"><b>`+ dateFormated + `</b></td>
                                  <td>
                                      <a href="/section/customers/edit/`+ value.id + `" class="btn btn-primary btn-group">Edit</a>
                                      <a href="/section/customers/destroy/`+ value.id + `"  class="btn btn-danger btn-group"
                                      onclick="return confirm('Are you sure that you want delete this Customer?');">
                                              Remove</a>
                                      <a href="/section/customers/viewPage/`+ value.id + `" class="btn btn-success btn-group">View Page</a>
                                  </td>
                              </tr>
                      `);
                    });



                  },
                  error: function(jqXHR, textStatus, errorThrown, result) {
                      // console.log(jqXHR.responseJSON.errors)
                      Alert('Some ERROR try again');
                      $msg = 'oi';
                      $resp = jqXHR.responseJSON.errors;
                      $('.dataTable').empty();
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
TESSS




<script>
      $(document).ready(function(){

            // $('#ajaxSubmit').click(function(e){
              $(document).on("click", "#thEmail", function(e){
                
                var searchInput = $('#searchInput').val();
                var filteredBy = "email";
                var ascOrDesc = "ASC";
                // var orderByInput = $('#exampleFormControlSelect1 option:selected').val();

               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               $.ajax({
                  url: "{{ url('/section/costumers/searchCustomerAjaxByFilters') }}",
                  data: {
                    searchInput: searchInput,
                    filteredBy: filteredBy,
                    ascOrDesc: ascOrDesc,
                     _token: '{{csrf_token()}}'},

                  success: function(result){
                    $resp = result;
                    console.log($resp);
                    $('#infoTable').empty();
                    $('#mainThead').empty();

                    $("#mainThead").append(`
                        <tr>
                              <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Id</b></th>
                              <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Name</b></th>
                              <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Contact Number</b></th>
                              <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Email</b></th>
                                <th style="font-family:verdana; font-size:100%; color:#38393b;">
                                  <a href="" id="thCreatedAt2" class="thCreatedAt2" name="thCreatedAt2">
                                  <b>Created At DESC</b>
                                  </a>
                                </th>
                              <th style="font-family:verdana; font-size:95%; color:#38393b;" scope="col"><b>Actions</b></th>
                        </tr>
                      `);

                 

                    $.each($resp, function (key, value){

                      var  dateFormated =  formatingDate(value.created_at);

                        $("#infoTable").append(`
                            <tr>
                                  <td style="font-family:verdana; color:black;"><b>` + value.id + `</b></td>
                                  <td style="font-family:verdana; color:black;"><b>` + value.name + `</b></td>
                                  <td style="font-family:verdana; color:black;"><b>` + value.telephone + `</b></td>
                                  <td style="font-family:verdana; color:black;"><b>`+ value.email + `</b></td>
                                  <td style="font-family:verdana; color:black;"><b>`+ dateFormated + `</b></td>
                                  <td>
                                      <a href="/section/customers/edit/`+ value.id + `" class="btn btn-primary btn-group">Edit</a>
                                      <a href="/section/customers/destroy/`+ value.id + `"  class="btn btn-danger btn-group"
                                      onclick="return confirm('Are you sure that you want delete this Customer?');">
                                              Remove</a>
                                      <a href="/section/customers/viewPage/`+ value.id + `" class="btn btn-success btn-group">View Page</a>
                                  </td>
                              </tr>
                      `);
                    });



                  },
                  error: function(jqXHR, textStatus, errorThrown, result) {
                      // console.log(jqXHR.responseJSON.errors)
                      Alert('Some ERROR try again');
                      $msg = 'oi';
                      $resp = jqXHR.responseJSON.errors;
                      $('.dataTable').empty();
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


<script>
      $(document).ready(function(){

            // $('#ajaxSubmit').click(function(e){
              $(document).on("click", "#thCreatedAt2", function(e){
                
                var searchInput = $('#searchInput').val();
                var filteredBy = "id";
                var ascOrDesc = "DESC";
                // var orderByInput = $('#exampleFormControlSelect1 option:selected').val();

               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               $.ajax({
                  url: "{{ url('/section/costumers/searchCustomerAjaxByFilters') }}",
                  data: {
                    searchInput: searchInput,
                    filteredBy: filteredBy,
                    ascOrDesc: ascOrDesc,
                     _token: '{{csrf_token()}}'},

                  success: function(result){
                    $resp = result;
                    console.log($resp);
                    $('#infoTable').empty();
                    $('#mainThead').empty();

                    $("#mainThead").append(`
                        <tr>
                              <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Id</b></th>
                              <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Name</b></th>
                              <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Contact Number</b></th>
                              <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Email</b></th>
                              <th style="font-family:verdana; font-size:100%; color:#38393b;">
                                <a href="" id="thCreatedAt" class="thCreatedAt" name="thCreatedAt">
                                <b>Created At ASC</b>
                                </a>
                              </th>
                            <th style="font-family:verdana; font-size:95%; color:#38393b;" scope="col"><b>Actions</b></th>
                        </tr>
                      `);

                    $.each($resp, function (key, value){

                      var  dateFormated =  formatingDate(value.created_at);

                        $("#infoTable").append(`
                            <tr>
                                  <td style="font-family:verdana; color:black;"><b>` + value.id + `</b></td>
                                  <td style="font-family:verdana; color:black;"><b>` + value.name + `</b></td>
                                  <td style="font-family:verdana; color:black;"><b>` + value.telephone + `</b></td>
                                  <td style="font-family:verdana; color:black;"><b>`+ value.email + `</b></td>
                                  <td style="font-family:verdana; color:black;"><b>`+ dateFormated + `</b></td>
                                  <td>
                                      <a href="/section/customers/edit/`+ value.id + `" class="btn btn-primary btn-group">Edit</a>
                                      <a href="/section/customers/destroy/`+ value.id + `"  class="btn btn-danger btn-group"
                                      onclick="return confirm('Are you sure that you want delete this Customer?');">
                                              Remove</a>
                                      <a href="/section/customers/viewPage/`+ value.id + `" class="btn btn-success btn-group">View Page</a>
                                  </td>
                              </tr>
                      `);
                    });



                  },
                  error: function(jqXHR, textStatus, errorThrown, result) {
                      // console.log(jqXHR.responseJSON.errors)
                      Alert('Some ERROR try again');
                      $msg = 'oi';
                      $resp = jqXHR.responseJSON.errors;
                      $('.dataTable').empty();
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
