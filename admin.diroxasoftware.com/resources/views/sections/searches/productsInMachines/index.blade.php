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


<style>


body,html{
    height: 100%;
    width: 100%;
    margin: 0;
    padding: 0;
    background: #e74c3c !important;
    }

    .searchbar{
    margin-bottom: auto;
    margin-top: auto;
    height: 60px;
    background-color: #353b48;
    border-radius: 30px;
    padding: 10px;
    }

    .search_input{
    color: white;
    border: 0;
    outline: 0;
    background: none;
    width: 0;
    caret-color:transparent;
    line-height: 40px;
    transition: width 0.4s linear;
    }

    .searchbar:hover > .search_input{
    padding: 0 10px;
    width: 450px;
    caret-color:red;
    transition: width 0.4s linear;
    }

    .searchbar:hover > .search_icon{
    background: white;
    color: #e74c3c;
    }

    .search_icon{
    height: 40px;
    width: 40px;
    float: right;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    color:white;
    text-decoration:none;
    }

</style>

      <span>
            @include('sections.components.topnavbar')
      </span>

      <!-- Begin Page Content -->
      <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><b>Searching Products in Machines</b></h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <div class="alert alert-info">
            <h4><p><b>Type the Machine mode/name and we we'll show you all products in this Machine</b></p></h4>


          </div>
          <!-- Content Row -->

        <div class="row">
      <div class="container h-100">
      <div class="d-flex justify-content-center h-100">
          <form  name="formSearch" method="POST" action="{{route('productsinmachines.search')}}" class="form form-inline">
              @csrf
                      <input type="text" name="name" id="name" class = "form-control" 
                        placeholder = "Search by a machine's name">
                      <!-- <input type="text" name="sobre" id="" class = "form-control" placeholder = "Sobre"> -->
                      <button type="submit" class="btn btn-primary ml-2"  style="background-color:#050d80">Search</button>
            </form>
        </div>
      </div>
    </div>
    </div>
    <br>
    
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-black-800" style="color:black;"><b>MACHINES</b></h1>

<!-- <a href="/section/machines/create">CREATE NEW ONE</a></p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <p class="h5 mb-4 text-gray-800"><b>HERE YOU SEE ALL MACHINES ON YOUR DATABASE. IF YOU PREFERE YOU CAN </a>
    <a href="/section/internalMachines">View All Machines</b></a>
  </div>
  <div class="card-body" id="card-bodytable">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
          <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->

            <th style="font-family:verdana; font-size:95%; color:#38393b;" >Id</th>
            <th style="font-family:verdana; font-size:95%; color:#38393b;" >Serial Number</th>
            <th style="font-family:verdana; font-size:95%; color:#38393b;" >Model</th>
            <th style="font-family:verdana; font-size:95%; color:#38393b;" >Brand</th>
            <th style="font-family:verdana; font-size:95%; color:#38393b;" >Created At</th>
           <th  style="font-family:verdana; font-size:95%; color:#38393b;" scope="col">Actions</th>
          </tr>
        </thead>

        <tbody>
          @foreach($allmachines as $machine)

          <tr>
          <?php

          $max = 26;
          $str = " $machine->id";
          $id=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

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

          $formateddate = date('d-m-Y', strtotime($machine->created_at));

          ?>

          <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->

          <td style="font-family:verdana; color:black;"><b>{{$id}}</b></td>
          <td style="font-family:verdana; color:black;"><b>{{$serial_number}}</b></td>
          <td style="font-family:verdana; color:black;"><b>{{$model}}</b></td>
          <td style="font-family:verdana; color:black;"><b>{{$brand}}</b></td>
          <td style="font-family:verdana; color:black;"><b>{{$formateddate}}</b></td>

          <td>
              <a href="/section/searches/productsinmachines/searchIndex/{{$id}}" class="btn btn-success" >View Page</a>
    
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

    <!-- tabela machines -->

    
    

  <script type="text/javascript">


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
