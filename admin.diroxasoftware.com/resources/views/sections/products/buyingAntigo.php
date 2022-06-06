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

  <script src="{{ asset('js/store.js') }}" async></script>
  <script src="{{ asset('css/store.css') }}" async></script>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


  <script>
      
      
      
      // var dados = JSON.stringify(usuario);

      $(function(){
        $('form[name="obutaoenviar"]').submit(function(e){
          e.preventDefault();
          var retorno = purchaseClicked();

          // var imageSrc = $(this).find('input#imageSrc').val();
          
        $.ajax({
          url: 'http://localhost:8000/section/products/buyingProducts/ajaxCart' ,
          type: 'post',
          data: {data: retorno,  _token: '{{csrf_token()}}'},
          success: function(result){
            // alert('oioi');
            // $('#cliente').val(purchaseClicked());
            // var results = purchaseClicked();
            // alert(retorno);
            $("#button").append(`<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>` );

          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert(' n deu')
          }
        });
      });
    });
  </script>



  <style>
  
.cart-header {
    font-weight: bold;
    font-size: 1.25em;
    color: #333;
}


.cart-column {
    display: flex;
    align-items: center;
    border-bottom: 1px solid black;
    margin-right: 1.5em;
    padding-bottom: 10px;
    margin-top: 10px;
}

.cart-row {
    display: flex;
}

.cart-item {
    width: 45%;
}

.cart-price {
    width: 20%;
    font-size: 1.2em;
    color: #333;
}

.cart-quantity {
    width: 35%;
}

.cart-item-title {
    color: #333;
    margin-left: .5em;
    font-size: 1.2em;
}

.cart-item-image {
    width: 75px;
    height: auto;
    border-radius: 10px;
}

.btn-danger {
    color: white;
    background-color: #EB5757;
    border: none;
    border-radius: .3em;
    font-weight: bold;
}

.btn-danger:hover {
    background-color: #CC4C4C;
}

.cart-quantity-input {
    height: 34px;
    width: 50px;
    border-radius: 5px;
    border: 1px solid #56CCF2;
    background-color: #eee;
    color: #333;
    padding: 0;
    text-align: center;
    font-size: 1.2em;
    margin-right: 25px;
}

.cart-discount-input {
    height: 34px;
    width: 50px;
    border-radius: 5px;
    border: 1px solid #56CCF2;
    background-color: #eee;
    color: #333;
    padding: 0;
    text-align: center;
    font-size: 1.2em;
    margin-right: 25px;
}

.cart-row:last-child {
    border-bottom: 1px solid black;
}

.cart-row:last-child .cart-column {
    border: none;
}

.cart-total {
    text-align: end;
    margin-top: 10px;
    margin-right: 10px;
}

.cart-total-title {
    font-weight: bold;
    font-size: 1.5em;
    color: black;
    margin-right: 20px;
}


.cart-discount-title {
    font-weight: bold;
    font-size: 1.5em;
    color: black;
    margin-right: 20px;
}

.cart-total-price {
    color: #333;
    font-size: 1.1em;
}

.btn-purchase {
    display: block;
    margin: 40px auto 80px auto;
    font-size: 1.75em;
}
  </style>


</head>

      <span>
            @include('sections.components.topnavbar')
      </span>


        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">PRODUCTS</h1>
          <p class="mb-4">HERE YOU SEE ALL PRODUCTS ON YOUR DATABASE. IF YOU PREFERE YOU CAN </a><a href="/section/products/create">CREATE NEW ONE</a></p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Products</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <!-- 'name', 'serial_number', 'categorie', 'situation', 'year', 'brand', 'image', 'price', 'discount', 'about' -->

                      <th>Image</th>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Category</th>
                      <th>Seling Price</th>
                      <th>Cost Price</th>
                      <th>Quantity</th>
                     <th scope="col">Actions</th>

                    </tr>
                  </thead>

                  <tbody>
                    @foreach($allproducts as $product)

                    <tr>
                    <?php

                    $max = 10;
                    $str = " $product->name ";
                    $name=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                    $max = 10;
                    $str = " $product->about ";
                    $about=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                    ?>


                    <td>
                    <img src="/storage/{{$product->image}}" class="shop-item-image"
                    style="width: 100px; height:100px;"alt="Sheep">
                    </td>

                    <td class= "shop-item-productID">{{$product-> id}}</td>
                    <td class = "shop-item-title">{{$name}}</td>
                    <td>{{$product-> category}}</td>
                    <td class = "shop-item-price" >£{{$product-> Sell_Price}}</td>
                    <td>£{{$product-> Cost_Price}}</td>
                    <td class= "shop-item-qtdInStock">{{$product-> quantity}}</td>
                    <td>
                    <button class="btn btn-primary shop-item-button" type="button">ADD TO CART</button>

                    </td>
                    </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
  <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" >
  Launch demo modal
</button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" >
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            ...
          </div>
          
        </div>
      </div>
    </div>

    <!-- Large modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>

<form action="{{ route ('product.confirmPayment')}}" method="POST">
@csrf

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
  <div class="modal-content">
          <div class="modal-header" >
            <h5 class="modal-title" id="exampleModalLabel">Generate I</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="card ">
                  <div class="card-header">
                      <h3 class="text-xs-center"><strong>Order summary</strong></h3>
                  </div>
                  <div class="card-block">
                      <div class="table-responsive">
                          <table class="table table-sm">
                              <thead>
                                  <tr>
                                      <td><strong>Item Name</strong></td>
                                      <td class="text-xs-center"><strong>Item Price</strong></td>
                                      <td class="text-xs-center"><strong>Item Quantity</strong></td>
                                      <td class="text-xs-center"><strong>Discount</strong></td>
                                      <td class="text-xs-right"><strong>Total</strong></td>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td value="title">Screen protector</td>
                                      <td class="text-xs-center" name="price" value="price">$7</td>
                                      <td class="text-xs-center" name="quantity" value="quantity">4</td>
                                      <td class="text-xs-right"  name="discount" value="discount">$28</td>
                                      <td class="text-xs-right"  name="total" value="total"> $28</td>
                                      <input type="hidden" name="id[]" values="2">
                                      <input type="hidden" name="price[]" value="7">
                                      <input type="hidden" name="quantity[]" value="4">
                                      <input type="hidden" name="discount[]" value="0">
                                      <input type="hidden" name="total[]" value="28">
                                      <input type="hidden" name="total[]" value="28">
                                  </tr>
                                  <tr>
                                      <td class="highrow"></td>
                                      <td class="highrow"></td>
                                      <td class="highrow"></td>
                                      <td class="highrow text-xs-center"><strong>Subtotal</strong></td>
                                      <td class="highrow text-xs-right">$958.00</td>
                                  </tr>
                                  <tr>
                                      <td class="emptyrow"></td>
                                      <td class="emptyrow"></td>
                                      <td class="emptyrow text-xs-center"><strong>Shipping</strong></td>
                                      <td class="emptyrow text-xs-right">$20</td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
              </div>
          </div>
      </div>
  </div>

    <style>
    .height {
        min-height: 200px;
    }

    .icon {
        font-size: 47px;
        color: #5CB85C;
    }

    .iconbig {
        font-size: 77px;
        color: #5CB85C;
    }

    .table > tbody > tr > .emptyrow {
        border-top: none;
    }

    .table > thead > tr > .emptyrow {
        border-bottom: none;
    }

    .table > tbody > tr > .highrow {
        border-top: 3px solid;
    }
    </style>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
  </div>
  </form>
    </div>
  </div>
</div>
</div>

      <div class="">
      <section class="container content-section">
            <h2 class="section-header">CART</h2>
            <div class="cart-row">
                <span class="cart-item cart-header cart-column">ITEM</span>
                <span class="cart-price cart-header cart-column">PRICE</span>
                <span class="cart-quantity cart-header cart-column">IN STOCK</span>
                <span class="cart-quantity cart-header cart-column">QUANTITY</span>
            </div>
            
          <form  id="registro" name="obutaoenviar" id="obutaoenviar" enctype="multipart/form-data">
            @csrf
            
            <div class="cart-items">
           
            </div>
            <button class="btn btn-primary"  id="obutaoenviar" name="obutaoenviar">
                ENVIAR
            </button>
          </form>
          
            <div class="cart-total">
            <strong class="cart-discount-title">Discount</strong>
                <span class="cart-discount-price">
                  £<input class="cart-discount-input" type="number" value="0">
                </span>

                <strong class="cart-total-title">Total</strong>
                <span class="cart-total-price">£0</span>
            </div>
            
            
              <button type="button" class="btn btn-primary btn-purchase">PURCHASE</button>
              <!-- <button type="submit" class="btn btn-primary btn-vai" type="button">fui</button> -->

            </form>
        </section><br>

        <?php
          $variavelphp = "<script>document.write(results)</script>";
        ?>

    <form action="/section/products/buyingProducts/Post" method="POST" id="registro" name="registro" enctype="multipart/form-data">
      @csrf
        <button type="submit" class="btn btn-primary btn2" id ="btn2">btn2</button>
        <input type="text" name="cliente[]" id="cliente">
    </form>
      <br>

      <button type="submit" class="btn btn-primary btn-autoEnviar" id ="btn-autoEnviar">autoEnviar</button>


      </div>
      <!-- End of Main Content -->


      

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

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


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
     <form>
      <div class="form-group col-md-6">
          <input id="email" name="email" 
          maxlength="191" 
          placeholder="email" class="form-control" type="text" required>
      </div>
     </form>
    </div>
  </div>
</div>


  <p id="thisp"> 
    thisp
  </p>

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
