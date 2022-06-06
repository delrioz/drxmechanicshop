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

<!-- Portfolio Item Heading -->
<h1 class="my-4" id="titleLetter">Infos About
    <?php 
        $max = 40;
        $str = " $allproducts->name ";
        $prodsName=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

        $Sell_PriceVat = number_format($allproducts->Sell_PriceVat, 2, '.',',');
        $Sell_Price = number_format($allproducts->Sell_Price, 2, '.',',');
        $Cost_Price = number_format($allproducts->Cost_Price, 2, '.',',');

    ?>
  <small>{{$prodsName}}</small>
</h1>

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
         <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <strong>Informations</strong>
                      <a href="/section/products" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                      <i class="fas fa-eye fa-sm text-white-50"></i> <b>ALL PRODUCTS</b></a>
            
          </div>


          </div>
          <div class="card-body">
            <div class="row">

                <div class="col-md-6">
                <h3 class="my-3" id="titleLetter"><strong>SKU</strong></h3>
                    <p id="paragsStyle"><b>{{$allproducts->SKU}}</b></p>
                </div>

                <div class="col-md-6">
                <h3 class="my-3" id="titleLetter"><strong>Id in our System</strong></h3>
                    <p id="paragsStyle"><b>{{$allproducts->id}}</b></p>
                </div>
            </div>
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="my-3" id="titleLetter"><strong>Brand</strong></h3>
                        <p id="paragsStyle"><b>{{$allproducts->brand}}</b></p>
                    </div>
                    <div class="col-md-6">
                        <h3 class="my-3" id="titleLetter"><strong>Category</strong></h3>
                        <p id="paragsStyle"><b>{{$allproducts->categoryName}}</b></p>
                    </div>
                </div>
                <div class="row">
                    @if($allproducts->isTheVatFree == "yes")
                        <div class="col-md-6">
                            <h3 class="my-3" id="titleLetter"><strong>Sell Price</strong></h3>
                            <p id="paragsStyle"><b>£{{$Sell_Price}}</b></p>
                        </div>
                    @else
                        <div class="col-md-6">
                            <h3 class="my-3" id="titleLetter"><strong>Sell Price</strong></h3>
                            <p id="paragsStyle"><b>£{{$Sell_PriceVat}}</b></p>
                        </div>
                    @endif

                    <div class="col-md-6 spanCostPrice" id="spanCostPrice">
                        <h3 class="my-3" id="titleLetter"><strong>Cost Price</strong><a href="#costPriceviwer" class="costPriceviwer" id="costPriceviwer"><i class="fas fa-eye"></i></a></h3>
                        <p id="paragsStyle"><b>£{{$Cost_Price}}</b></p>
                    </div>
                </div>

                
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="my-3" id="titleLetter"><strong>About</strong></h3>
                        <p id="paragsStyle"><b>{{$allproducts->about}}</b></p>
                    </div>
                    <div class="col-md-6">
                        <h3 class="my-3" id="titleLetter"><strong>Quantity</strong></h3>
                        <p id="paragsStyle"><b>{{$allproducts->quantity}}</b></p>
                        <?php
                            if($allproducts->quantity <=5){
                                $msg="yes";
                                $alert = "Low in stock";
                            }


                        ?>
                        @if($allproducts->quantity <= 5)
                            <p id="paragsStyle" style="color:red"><b>{{$alert}}</b><a href="/section/products/edit/{{$allproducts->id}}"> add more</a></p>
                        @endif
                    </div>
                </div>
            @if($allproducts->isTheVatFree == "yes")
                <h5 style="color:red;"><b>This Product Is VAT free</b></h5>
            @endif
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="my-3" style="color:black">For more management options access:</h3><br>
                        <strong  id="titleLetter"><h5><a href="/section/reports/products"><b>Product Reports Area</a></strong></b></h5>
                    </div>
                </div>
            <hr>

        
          </div>
        </div>


        <div class="card-body">
              <div class="table-responsive">
                  <h2 style="color:black;"><b>Sale History</b></h2><br>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->
                      <th style="font-family:verdana; font-size:95%; color:#38393b;"><b>Date</b></th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;"><b>Sales References</b></th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;"><b>Description</b></th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;"><b>Qty</b></th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;"><b>Sales Price (GBP)</b></th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;"><b>Total</b></th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;"><b>Status</b></th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;"><b>Actions</b></th>

                    </tr>
                  </thead>

                  <tbody>
                    @foreach($allsales as $sales)

                    <tr>
                    <?php

                      $max = 26;
                      $str = " $sales->customerName";
                      $owner=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                      $max = 26;
                      $str = " $sales->brand";
                      $brand=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                      $max = 26;
                      $str = " $sales->serial_number";
                      $serial_number=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                      $max = 26;
                      $str = " $sales->model";
                      $model=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                      $max = 26;
                      $str = " $sales->name";
                      $name=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                      $start = date('d/m/Y', strtotime($sales->created_at));

                      $sales_price = number_format($sales->sales_price, 2, '.',',');
                      $sales_subtotal = number_format($sales->sales_subtotal, 2, '.',',');
                      $sales_discount = number_format($sales->sales_discount, 2, '.',',');
                      $sales_vat = number_format($sales->sales_vat, 2, '.',',');
                      $totalSalesWithVat = number_format($sales->totalSalesWithVat, 2, '.',',');
                      

                      
                      $from = "allsalespage";

                      if($sales->status == 0){
                        $statusResult = "PAID";
                      }
                      else if($sales->status == 1){
                         $statusResult = "AWAITING PAYMENT";
                      }

                    ?>

                    <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->


                    <td style="font-family:verdana; color:black;"><b>{{$start}}</b></b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$sales->salesId}}</b></b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$sales->about}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$sales->quantity}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>£{{$sales_price}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>£{{$totalSalesWithVat}}</b></td>
                    
                    @if($sales->status == 0)
                      <td style="font-family:verdana; color:black;"><h5><span class="badge badge-success" style="font-family:verdana; color:white;"><b>{{$statusResult}}</b></span></h5></td>
                    @elseif($sales->status == 1)
                      <td style="font-family:verdana; color:black;"><h5><span class="badge badge-danger" style="font-family:verdana; color:white;"><b>{{$statusResult}}</b></span></h5></td>
                    @endif

                    <td>
                        <a href="/section/sales/allsales/invoice/{{$sales->salesId}}/{{$from}}" style="background-color:#050d80" class="btn btn-block text-white btn-circle">
                            <i class="fas fa-eye"></i>
                        </a>

                        </a>


                    </td>
                    </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
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
