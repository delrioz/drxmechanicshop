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
  #BlackTypeStyle{
      color:black;
      font-size:22px;
  }

  #btnStyles{
    background-color:#060b30;
  }

  #PurpleButton{
    background-color:#060b30; color:white;
    /* style="background-color:#050d80" */
  }
</style>
</head>

      <span>
            @include('sections.components.topnavbar')
      </span>

  <!-- Page Content -->
  <div class="container">

<!-- Jumbotron Header -->
<header class="jumbotron my-4" style="background-color:#346beb; color:white">
<div class="row">
    <div class="col-md-6">
          @if(isset($nameText))
            <span>Seacrhing for <strong>{{$nameText}}</strong></span>
          @endif
                            
            <h3>Searching Machines</h3>
            <p>Choose which data you would like to find !</p>
          @if(isset($name))
                <h6>Pesquisando por :  <strong>{{$name}} </h6></strong>
          @endif

          </div>
          <form action="{{ route('machines.search') }}" method="POST" class="form form-inline">
              @csrf

              <input type="text" name="nameText" id="" class = "form-control" 
                placeholder = "Name or text">
              <!-- <input type="text" name="sobre" id="" class = "form-control" placeholder = "Sobre"> -->

                <select name="searchOption" id="" class = "form-control ml-2" >
                      <option   value="machines">Machines</option>
                      <option   value="products">Products</option>
                      <option   value="general">General</option>
                </select>

               <button type="submit" class="btn btn-primary ml-2"  style="background-color:#050d80">Search</button>
            </form>
        </div>
</header>

<!-- Page Features -->
<div class="row text-center">
@if(count($machinesSearch) > 0)

@foreach($machinesSearch as $mS)
<?php

$max = 34;
$str = " $mS->first_observations ";
$first_observations=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


$max = 20;
$str = " $mS->titulo ";
$result2=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

?>

  <div class="col-lg-3 col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <h4 class="card-title" style="color:black;"><strong>{{ $mS->model }}</strong></h4>
        <p class="card-text"><strong>{{ $first_observations }}</strong></p>
      </div>
      <div class="card-footer">
        <a href="/section/searches/machines/edit/{{ $mS->id }}" class="btn btn-primary" style="background-color:#050d80">More details</a>
      </div>
    </div>
  </div>
@endforeach
</div>
@else

<div class="alert alert-danger center">
  <h4>No datas with this specification was found.</h4>
</div>
@endif

<!-- /.row -->


<div class="card-body">
@if (isset($dataForm))
   {!! $machinesSearch->appends($dataForm)->links() !!}

@elseif(isset($a))
    @elseif(isset($normal))
   {!! $machinesSearch->links()  !!}
    @else
   {!! $machinesSearch->links()  !!}
    @endif
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
