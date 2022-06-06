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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

    
    <!-- Custom styles for this page -->
    <link href="{{ asset('admlyt/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

  <script type="text/javascript" src="{{ asset('jquery/multiselect/jquery-3.5.1.min.js') }}"></script> 
  <script type="text/javascript" src="{{ asset('jquery/multiselect/chosen.jquery.min.js') }}"></script>



  </head>

        <span>
              @include('sections.components.topnavbar')
        </span>
        

        <?php

            $from = "ProductsReports";
        ?>

          <!-- Begin Page Content -->
          <div class="container-fluid">
          <!-- Begin Page Content -->
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


              <!-- Page Heading -->
              <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-black-800"><strong style="color:black;">PRODUCTS REPORTS</strong></h1>
                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                <a href="/section/products/create/{{$from}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-plus fa-sm text-white-50"></i> <b>ADD PRODUCT</b></a>

              </div>

                  <a href="/products/export/" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                            class="fas fa-download fa-sm text-white-50"></i> <b>EXPORT PRODUCTS</b></a>     

                  <a href="/section/buysection/index/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                  class="fas fa-plus  fa-sm text-white-50"></i> <b>GO THE CART</b></a>         
              <hr>

        <!-- Content Row -->
            <div class="row">
                          <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        <a  style="color:green;"> <b>STOCK COST</b></a>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><strong style="color:blue;">£{{$stockCost}}</strong></div>
                        <b>total money spent in products</b>
                      </div>
                      <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            <!-- Earnings (Monthly) Card Example -->
                  <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        <a style="color:green;"> <b>STOCK WITHOUT VAT</b></a>
                        </div>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><strong style="color:blue;">£{{$stockPriceWithoutVat}}</strong>
                                </div><b>TOTAL STOCK SELLING PRICE</b>
                          </div>
                          <div class="col">
                          </div>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        <a style="color:green;"> <b>STOCK WITH VAT</b> </a>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><strong style="color:blue;">£{{$stockPrice}}</strong></div>
                        <b>TOTAL STOCK SELLING PRICE</b>
                      </div>
                      <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <!-- Pending Requests Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        <a style="color:green;"> <b>GENERAL BALANCE</b></a>
                        </div>
                        @if($productsgeneralbalance < 0)
                        <div class="h5 mb-0 font-weight-bold"><strong style="color:red;">£{{$productsgeneralbalance}}</strong>  </div><b>AMOUNT IN STOCK WITH VAT  - AMOUNT SPENT</b>

                        @else
                        <div class="h5 mb-0 font-weight-bold"><strong style="color:blue;">£{{$productsgeneralbalance}}</strong>  </div><b>AMOUNT IN STOCK WITH VAT - AMOUNT SPENT</b>
                        @endif
                      </div>
                      <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
              </div>
              </div>
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
                                   
                                        <div class="col-lg-3 col-md-3 col-sm-12 p-2">
                                            <select class="form-control search-slt" id="exampleFormControlSelect1" name="orderByInput">
                                                <option value="orderByAll">Order By All</option>
                                                <option value="orderByName">Order By Name</option>
                                                <option value="orderBySKU">Order By SKU</option>
                                                <option value="categoryName">Order By Category</option>
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
                                              <a href="/section/reports/products" class="btn btn-primary" 
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
                <table class="table table-bordered"   width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <!-- 'name', 'serial_number', 'categorie', 'situation', 'year', 'brand', 'image', 'price', 'discount', 'about' -->

                      <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Image</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Name</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>SKU</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Category</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Seling Price</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Cost Price</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;"><b>Quantity</b></th>
                      <th style="font-family:verdana; font-size:100%; color:#38393b;" scope="col"><b>Actions</b></th>

                    </tr>
                  </thead>

                  <tbody class="infoTable" id="infoTable">
                    @foreach($allproducts as $product)

                    <tr>
                    <?php

                    $max = 500;
                    $str = " $product->name ";
                    $name=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                    $max = 500;
                    $str = " $product->about ";
                    $about=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                    $max = 350;
                    $str = " $product->categoryName ";
                    $categoryName=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                    $start = date('d/m/Y', strtotime($product->created_at));

                    $Sell_Price = number_format($product->Sell_Price, 2, '.',',');
                    $Sell_PriceVat = number_format($product->Sell_PriceVat, 2, '.',',');
                    $Cost_Price = number_format($product->Cost_Price, 2, '.',',');



                    if($product->quantity <= 3){
                      $statusQuantity = "low quantity";
                    }
                    else{
                      $statusQuantity = "";
                    }

                    ?>



                    <td><img src="/storage/{{$product->image}}" class="card-img-top" style="width: 140px; height: 140px;!important"></td>


                    <td style="font-family:verdana; color:black;"><b>{{$name}}</b><br><b style="color:#eb4634;"> Created at: {{$start}}</b>
                    <br>
                    
                    <span class="badge badge-success" style="font-family:verdana; color:white;"><b> Condition : {{$product->condition}}</b></span>
                    </td>
                    <td style="font-family:verdana; color:black;"><b>{{$product-> SKU}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$categoryName}}</b></td>

                    @if($product->isTheVatFree == "yes")
                      <td style="font-family:verdana; color:black;"><b>£{{$Sell_Price}}</b></td>

                    @else
                    <td style="font-family:verdana; color:black;"><b>£{{$Sell_PriceVat}}</b></td>

                    @endif

                    <td style="font-family:verdana; color:black;"><b>£{{$Cost_Price}}</b></td>
                    <td style="font-family:verdana; color:orange;"><strong>{{$product->quantity}}</strong><br><h7 style="color:red;"><b>{{$statusQuantity}}</b></h7></td>
                    <td>
                        <div class="row">
                          <div class="col-md-4">
                              <!-- <a href="/section/products/view/{{ $product->id }}" class="btn btn-block btn-primary fa fa-eye" style="background-color:#050d80"></a> -->
                              <a href="/section/products/view/{{$product->id }}/{{$from}}" style="background-color:#050d80" class="btn btn-block text-white btn-circle" >
                                        <i class="fas fa-eye" ></i>
                              </a>
                              <!-- <a href="/section/products/edit/{{$product->id}}" class="btn btn-block btn-primary btn-group fa fa-edit"></a> -->
                              <a href="/section/products/edit/{{$product->id}}/{{$from}}" class="btn btn-block btn-primary btn-circle">
                                        <i class="fas fa-edit"></i>
                              <a href="/section/products/destroy/{{$product->id}}" class="btn btn-block btn-danger btn-circle" 
                               onclick="return confirm('Are you sure that you want delete this Product?');"> 
                                        <i class="fas fa-trash"></i>
                                    </a>
                              </a>
                          </div>
                        </div>  
                    </td>
                    </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
            </div>
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

  <!-- // forma de fazer uma petição ajax-->

    <!-- <form action="POST" action="/section/reports/products/all" id="form1">
        @csrf
          <input type="hidden" name="id" value="1">
          <input type="hidden" name="">
    </form> -->

    <!-- end of container fluid  -->
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>

  </script>
  <script>
      var idEliminar=0;
      var productos=[];
      var valores=[];

      $(document).ready(function(){
        $.ajax({
          url: '/section/reports/products/all',
          method: 'POST',
          data:{ 
            id:1,
            _token: $('input[name="_token"]').val()
          }
      }).done(function(res){
          // alert(res);
          // string to JSON
          var arreglo = JSON.parse(res);
          // alert('here');
          for(var x=0; x<arreglo.length; x++){
            // alert(10);
              console.log(arreglo);
              console.log(arreglo[x].id)
              console.log(arreglo[x].name)
              console.log(arreglo[x].SKU)
              console.log(arreglo[x].category) 
              productos.push(arreglo[x].name);
              valores.push(arreglo[x].totalNproducts);
          }
            chartGenerate();
        });
        });

        function chartGenerate(){
              // alert('olá, mundo!');
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: productos,
                datasets: [{
                    label: 'Best Seller Product',
                    data: valores,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
      }


  </script>




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
                  url: "{{ url('/section/products/getProductsAjaxOnReportsPage') }}",
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

                      
                      if(value.quantity <= 3){
                          var statusQuantity = "low quantity";
                        }
                        else{
                          var statusQuantity = "";
                        }


                        $("#infoTable").append(`
                              <tr>
                                  <td style="font-family:verdana; color:black;"> <img src="/storage/`+ value.image + `" class="media-photo"
                                    style="width: 140px; height:140px;" alt="/storage/`+ value.image + `"></td>


                                  <td style="font-family:verdana; color:black;"><b>` + value.name + `</b><br><b style="color:#eb4634;"> Created at: ` + dateFormated + `</b>
                                    <br>
                                    <span class="badge badge-success" style="font-family:verdana; color:white;"><b> Condition : ` + value.condition + `</b></span>
                                  </td>
                                  
                                  <td style="font-family:verdana; color:black;"><b>` + value.SKU + `</b></td>
                                  <td style="font-family:verdana; color:black;"><b>` + value.categoryName + `</b></td>
                                  <td style="font-family:verdana; color:black;"><b>£`+ value.Sell_Price + `</b></td>
                                  <td style="font-family:verdana; color:black;"><b>£`+ value.Cost_Price + `</b></td>
                                  <td style="font-family:verdana; color:orange;"><strong><b>`+ value.quantity + `</b></strong><br>
                                   <h7 style="color:red;"><b>`+ statusQuantity + `</b></h7>
                                  </td>
                                  <td style="font-family:verdana; color:black;" hidden>
                                    <b>`+ dateFormated + `</b>
                                  </td>
                                  
                                  <td>
                                  <div class="row">
                                      <div class="col-md-4">
                                          <a href="/section/products/view/`+ value.id + `/{{$from}}" style="background-color:#050d80" class="btn btn-block text-white btn-circle" >
                                                    <i class="fas fa-eye" ></i>
                                          </a>
                                          <!-- <a href="/section/products/edit/`+ value.id + `" class="btn btn-block btn-primary btn-group fa fa-edit"></a> -->
                                          <a href="/section/products/edit/`+ value.id + `/{{$from}}" class="btn btn-block btn-primary btn-circle">
                                                    <i class="fas fa-edit"></i>
                                          <a href="/section/products/destroy/`+ value.id + `" class="btn btn-block btn-danger btn-circle" 
                                          onclick="return confirm('Are you sure that you want delete this Product?');"> 
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                          </a>
                                      </div>
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
      <script src="{{ asset('admlyt/js/demo/chart-pie-demo.js') }}"></script>

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
