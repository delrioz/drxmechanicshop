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
    <div class="container">

<div class="row">
    <div class="col-md-12">

<div class="card mt-4">
  <div class="card-body">
    <h3 class="card-title"><p>Model: <strong style="color:#060b30;">{{$allmachines->model}}</strong></p></h3>
    <h4>Serial Number: <strong style="color:#060b30;">{{$allmachines->serial_number}}</strong></h4>
    <p class="card-text">Owner: <strong style="color:#060b30;">{{$nameOwner}}</strong></p>
  </div>
</div>
<!-- /.card -->

<div class="card card-outline-secondary my-4" style="color:black;">
  <div class="card-header" style="background-color:#060b30; color:white;">
    Customer Report
  </div>
  <div class="card-body">
    <p>{{$allmachines->customer_report}}</p>
    <hr>
  </div>
<div class="card card-outline-secondary my-4">
  <div class="card-header" style="background-color:#060b30; color:white;">
  First Observations
  </div>
  <div class="card-body">
  <p>{{$allmachines->first_observations}}</p>
    <hr>
  </div>
  <div class="card-header" style="background-color:#060b30; color:white;">
  Products in this Machine
  </div>
  <div class="card-body">
  @foreach($ProductsByMachines as $machines)
  <ul>
    <li><a href="/section/products/view/{{$machines->productId}}">{{$machines->productName}}</a></li>
  </ul>
  @endforeach
    <hr>
    <a href="/section/reports/machines" class="btn btn-success" style="background-color:#060b30;">Go To Reports Page</a>
  </div>
  <hr>
</div>
<!-- /.card -->

</div>
<!-- /.col-lg-9 -->
</div>
</div>
</div>
<!-- /.container -->

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
