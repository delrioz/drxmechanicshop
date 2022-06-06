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
                            
            <h3>Searching Products</h3>
            <p>Choose which data you would like to find !</p>
          @if(isset($name))
                <h6>Searching for :  <strong>{{$name}} </h6></strong>
          @endif

          </div>
          <form  name="formSearch" >
              @csrf

              <input type="text" name="nameText" id="nameText" class = "form-control" 
                placeholder = "Name or text">
              <!-- <input type="text" name="sobre" id="" class = "form-control" placeholder = "Sobre"> -->

                <select name="searchOption" id="searchOption" class = "form-control ml-2" >
                      <option   value="products">Products</option>
                      <option   value="machines">Machines</option>
                      <option   value="general">General</option>
                </select>

               <button type="submit" class="btn btn-primary ml-2"  style="background-color:#050d80">Search</button>
            </form>
        </div>
</header>

<div class="alert  alert-danger d-none messageBox" role="alert">
</div>


<!-- Page Features -->
<div class="row text-center" id="h5" >
@if(count($productsSearch) > 0)

@foreach($productsSearch as $pS)
<?php

$max = 34;
$str = " $pS->first_observations ";
$first_observations=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


$max = 20;
$str = " $pS->titulo ";
$result2=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);
?>

<div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="/storage/{{$pS->image}}"  width="200" height="200">
          <div class="card-body">
        <h4 class="card-title" style="color:black;"><strong>{{ $pS->name }}</strong></h4>
        <p class="card-text"><strong>{{ $first_observations }}</strong></p>
      </div>
      <div class="card-footer">
        <a href="/section/searches/products/edit/{{ $pS->id }}" class="btn btn-primary" style="background-color:#050d80">More details</a>
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
   {!! $productsSearch->appends($dataForm)->links() !!}

@elseif(isset($a))
    @elseif(isset($normal))
   {!! $productsSearch->links()  !!}
    @else
   {!! $productsSearch->links()  !!}
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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>

</script>
<script>
      $(function(){
        $('form[name="formSearch"]').submit(function(e){
          e.preventDefault();
          var text = $(this).find('input#nameText').val();
          alert('passou do preventdefault' + text );
          $.ajax({
            url: "{{ route('products.search') }}",
            type: "post",
            data: $(this).serialize(),
            dataType: 'json',

            success:function(response){
              var searchDatas = (response.data);
              console.log(searchDatas);
              if(searchDatas){
              $.each(searchDatas, function(key, value ){
                  $("#h5").empty();
                  $("#h5").append(`
                    <?php

                    echo $searchDatas = "<script>document.write(searchDatas)</script>";
                    $max = 34;
                    $str = " $pS->first_observations ";
                    $first_observations=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                    $max = 20;
                    $str = " $pS->titulo ";
                    $result2=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);
                    ?>
                    <!-- Page Features -->
                    <div class="row text-center" id="h5" >

                    @foreach($searchDatas as $pS2)

                    <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card h-100">
                              <img class="card-img-top" src="/storage/{{$pS->image}}"  width="200" height="200">
                              <div class="card-body">
                            <h4 class="card-title" style="color:black;"><strong>{{ $pS->name }}</strong></h4>
                            <p class="card-text"><strong>{{ $first_observations }}</strong></p>
                          </div>
                          <div class="card-footer">
                            <a href="/section/searches/products/edit/{{ $pS->id }}" class="btn btn-primary" style="background-color:#050d80">More details</a>
                          </div>
                        </div>
                      </div>
                    @endforeach
                    </div>

                    <!-- /.row -->


                    <div class="card-body">
                    @if (isset($dataForm))
                      {!! $searchDatas->appends($dataForm)->links() !!}

                    @elseif(isset($a))
                        @elseif(isset($normal))
                      {!! $searchDatas->links()  !!}
                        @else
                      {!! $searchDatas->links()  !!}
                        @endif
                    </div>

                  `);

                });
              }
              if(response.success === true){
              }
              else{ //msgs
                   $('.messageBox').removeClass('d-none').html(response.data[0]);
              }
            }
          });
        });
      });
</script>

</body>

</html>
Y6