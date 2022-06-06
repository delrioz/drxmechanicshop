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

    <!-- Page Content -->
<div class="container">


<!-- Related Projects Row -->

<div class="card card-outline-secondary my-4">
          <div class="card-header">
         <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <strong>Service Table Price</strong>
                      <a href="/section/tableprices/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-plus fa-sm text-white-50"></i> <b>ADD SERVICE PRICE</b></a>
          </div>


          </div>
          <div class="card-body">
          @foreach($alltableprices as $alltablep)
          <?php
              $max = 350;
              $str = " $alltablep->about ";
              $about=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

           ?>

            <div class="row">
                <div class="col-md-6">
                <h4 class="my-3" id="titleLetter"><strong>{{$alltablep->name}}</strong></h3>
                    <p id="paragsStyle"><b>{{$about}}</b></p>
                    <p><b>Price with vat: £{{$alltablep->sell_priceVat}}</b></p>
                    <p><b>Price without vat: £{{$alltablep->sell_price}}</b></p>
                </div>
              </div>
                <div class="row">
                    <div class="col-md-3">
                        <a type="button" href="/section/tableprices/edit/{{$alltablep->id}}" class="btn btn-block btn-primary btn">Edit</a>
                    </div>
                    <div class="col-md-3">
                      <a type="button" href="/section/tableprices/remove/{{$alltablep->id}}" class="btn btn-block btn-danger btn">Remove</a>
                    </div>
                </div>
          </div>
          @endforeach
        </div>







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
