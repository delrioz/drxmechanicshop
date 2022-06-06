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

    <?php
        $max = 80;
        $str = " $allproducts->name ";
        $name=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);
    ?>

<!-- Portfolio Item Heading -->
<h1 class="my-4" id="titleLetter">Infos About
  <small>{{$name}}</small>

<!-- Portfolio Item Row -->
<div class="row">

  <div class="col-md-6">
    <img class="img-fluid"  src="/storage/{{$img}}"
     style="width: 400px; height: 300px;">
  </div>

  <div class="col-md-6">
@if(count($machinesByProducts) > 0)

    <h3 class="my-"><strong>Machines using this product</strong></h3>
    <ul>
    @foreach($machinesByProducts as $machines)
    <li id="BlackTypeStyle"> <a href="/section/internalMachines/view/{{$machines->MachineId}}"> {{$machines->model}}</a></li>
@endforeach


@else
    <div class="alert alert-danger">
        <h5>This product cannot be find in any machine </h5>
    </div>
@endif

    </ul>
  </div>

</div>
<!-- /.row -->

<!-- Related Projects Row -->

<div class="card card-outline-secondary my-4">
          <div class="card-header">
            <strong>Informations</strong>
          </div>
          <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                <h3 class="my-3" id="titleLetter"><strong>SKU</strong></h3>
                    <p id="paragsStyle">{{$allproducts->SKU}}</p>
                </div>

                <div class="col-md-6">
                <h3 class="my-3" id="titleLetter"><strong>Id in our System</strong></h3>
                    <p id="paragsStyle">{{$allproducts->id}}</p>
                </div>
            </div>
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="my-3" id="titleLetter"><strong>Brand</strong></h3>
                        <p id="paragsStyle">{{$allproducts->brand}}</p>
                    </div>
                    <div class="col-md-6">
                        <h3 class="my-3" id="titleLetter"><strong>Category</strong></h3>
                        <p id="paragsStyle">{{$allproducts->categoryName}}</p>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="my-3" id="titleLetter"><strong>Sell Price</strong></h3>
                        <p id="paragsStyle">£{{$allproducts->Sell_PriceVat}}</p>
                    </div>

                    <div class="col-md-6">
                      <a type="a" href="/section/carrito/index" class="btn btn-danger" type="submit">Back</a>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="my-3" id="titleLetter"><strong>About</strong></h3>
                        <p id="paragsStyle">{{$allproducts->about}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="my-3" style="color:black">For more management options access:</h3><br>
                        <strong  id="titleLetter"><h5><a href="/section/reports/products"> Product Reports Area</a></strong></h5>
                    </div>
                </div>
            <hr>
          </div>
        </div>


        
<script>
      $(document).ready(function(){
        

             //    inicio de abrir o olho

              $(document).on("click", "#costPriceviwer", function(e){

             $("#spanCostPrice").removeClass("d-none")
       

              $('.spanCostPrice').empty();
 

                $(".spanCostPrice").append(`
                            <h3 class="my-3" id="titleLetter"><strong>Cost Price </strong><a href="#costPriceOpenviwer" onclick="funcao2()" class="costPriceOpenviwer" id="costPriceOpenviwer"><i class="fas fa-eye-slash"></i></a></h3>
                    `);
                
               });


               //    INICIO DE ABRIR O OLHO
               $(document).on("click", "#costPriceOpenviwer", function(e){

                $('.spanCostPrice').empty();
        
                $(".spanCostPrice").append(`
                    <h3 class="my-3" id="titleLetter"><strong>Cost Price </strong><a href="#costPriceviwer" class="costPriceviwer" id="costPriceviwer"><i class="fas fa-eye"></i></a></h3>
                            <p id="paragsStyle">£{{$allproducts->Cost_Price}}</p>
                `);
                
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
