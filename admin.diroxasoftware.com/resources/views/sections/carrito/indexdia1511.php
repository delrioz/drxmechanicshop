<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <link href="{{ asset('carrito/css/bootstrap.min.css') }}" rel="stylesheet">


    <script src="{{ asset('carrito/js/popper.min.js') }}"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    
    <link href="{{ asset('carrito/css/sweetalert2.min.css') }}" rel="stylesheet">
    <script src="{{ asset('carrito/js/store.js') }}" async></script>

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

<main>
   
        <!-- Begin Page Content -->
        <div class="container-fluid" id="lista-productos">
        <header>
  
          <!-- Page Heading -->
        <div class="container">
            <div class="row align-items-stretch justify-content-between">
                <nav class=" navbar-expand-md navbar-dark  ">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item dropdown">
                                <img src = "{{ asset('carrito/img/cart.jpeg') }}" class="nav-link dropdown-toggle img-fluid" height="70px"
                                    width="70px" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"></img>
                                <div id="carrito" class="dropdown-menu" aria-labelledby="navbarCollapse">
                                    <table id="lista-carrito" class="table">
                                        <thead>
                                            <tr>
                                                <th>Imagen</th>
                                                <th>Nombre</th>
                                                <th>Precio</th>
                                                <th>Cantidad</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>

                                    <a href="#" id="vaciar-carrito" class="btn btn-primary btn-block">empty basket</a>
                                    <a href="#" id="procesar-pedido" class="btn btn-danger btn-block">Buy</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
        </div>
        <h1 class="h3 mb-2 text-gray-800"> BUYING PRODUCTS</h1>
          <p class="mb-4">HERE YOU SEE ALL PRODUCTS ON YOUR DATABASE. CLICK ON 'BUY' TO ADD INTO THE CART</p>
          
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Products</h6>
          <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Extra Sales</button>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                            <!-- 'name', 'serial_number', 'categorie', 'situation', 'year', 'brand', 'image', 'price', 'discount', 'about' -->

                            <th>Image</th>
                            <th> Product Name</th>
                            <th hidden>SKU</th>
                            <th>Quantity</th>
                            <th>Seling Price</th>
                            <th hidden>Cost Price</th>
                            <th hidden>Quantity</th>
                            <th hidden>ID</th>
                            <th hidden>Sell</th>
                            <th scope="col">Actions</th>

                      </tr>
                        </thead>

                        <tbody>
                        <div class="card-body">

                        @foreach($allproducts as $prod)

                        <?php
                            if($prod->quantity <= 2){
                              $statusQuantity = "low quantity";
                            }
                            else{
                              $statusQuantity = "";
                            }
                          ?>

                        <tr>
                                <td><img src="/storage/{{$prod->image}}" class="card-img-top" style="width: 150px; height: 100px;!important"></td>
                                <td class="my-0 font-weight-bold prodName"> {{$prod->name}}</h5></td>                    
                                <td hidden><h6 class="prodSKU">{{$prod->SKU}}</h6></td>
                                <td style="color:orange;"><strong>{{$prod->quantity}}</strong><br><h7 style="color:red;">{{$statusQuantity}}</h7></td>
                                <td> <h5 class="card-title pricing-card-title precio">£<span class="">{{$prod->Sell_Price}}</span></h5></td>                    
                                <td hidden> <h5 class="card-title pricing-card-title Costprecio">£<span class="">{{$prod->Cost_Price}}</span></h5></td>                    
                                    <td class="card-title pricing-card-title qtd" hidden><span class="">1</span></td>
                                    <td hidden>Id {{$prod->id}}</td>
                                    <td class="card-title pricing-card-title preciovat" hidden><span class="">{{$prod->Sell_PriceVat}}</span></td>                                
                                    <td> <a  href="" class="btn btn-block btn-primary agregar-carrito" data-id="{{$prod->id}}"><i class="fa fa-plus" aria-hidden="true"></i></a></td>
                    @endforeach               
            </tr>
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

      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Extra Sales</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form  id="myForm" enctype="multipart/form-data" action="/section/extrasales/store" method="POST">
                            @csrf
              <div class="row">
                  <div class="col-md-6">
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Quantity (GBP):</label>
                          <input type="text" class="form-control"  id="Sales_Price" name="Sales_Price"  
                          onchange="myFunction()"
                          value="{{ old('Sales_Price') }}">
                        </div>
                  </div>
                  <div class="col-md-6">
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Discount (GBP):</label>
                          <input type="text" class="form-control"  type="discount" id="discount" name="discount" value="{{ old('discount') }}">
                        </div>
                  </div>
              </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Description:</label>
                  <textarea class="form-control" id="description" description="description" name="description" id="description"  placeholder="description"></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="recipient-name" class="col-form-label">VAT PRICE (GBP) (20%):</label>
                        <input type="text" class="form-control" id="Sales_PriceVat" name="Sales_PriceVat" value="{{ old('Sales_PriceVat') }}"  disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="recipient-name" class="col-form-label">Payment Method:</label>
                        <select class="custom-select my-1 mr-sm-2" id="methodPayment" name="methodPayment" value="{{ old('methodPayment') }}">
                                  <option value="card">Card</option>
                                  <option value="cash">Cash</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-warning">Conclude Sale</button>
            </div>
          </form>
          </div>
        </div>
      </div>



    </main>


    <script>

  function myFunction()
      {
        var Sales_Price = document.getElementById("Sales_Price").value;
        // document.getElementById("Sell_PriceVat").value = Sales_Price; 
        var takingVatPrice =   (Sales_Price * 0.20).toFixed(2);

        document.getElementById("Sales_PriceVat").value = Number(Sales_Price) + Number(takingVatPrice); 
        // document.getElementById("Sell_PriceVatView").value = Number(Sales_Price) + Number(takingVatPrice); 

      }

    function myFunction2()
        {
          var Sales_Price = document.getElementById("Sales_Price").value;
          // document.getElementById("Sell_PriceVat").value = Sales_Price; 
          var takingVatPrice =   (Sales_Price * 0.20).toFixed(2);

          document.getElementById("Sales_PriceVat").value = Number(Sales_Price) + Number(takingVatPrice); 
          // document.getElementById("Sell_PriceVatView").value = Number(Sales_Price) + Number(takingVatPrice); 

        }
</script>



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{ asset('carrito/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('carrito/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('carrito/js/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('carrito/js/carrito.js') }}"></script>
    <script src="{{ asset('carrito/js/pedido.js') }}"></script>



  
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
