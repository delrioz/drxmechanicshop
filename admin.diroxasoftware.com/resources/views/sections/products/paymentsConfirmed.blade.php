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

  <style>
  * {
    margin: 0;
    padding: 0;
    -webkit-font-smoothing: antialiased;
    -webkit-text-shadow: rgba(0, 0, 0, .01) 0 0 1px;
    text-shadow: rgba(0, 0, 0, .01) 0 0 1px
}

body {
    font-family: 'Rubik', sans-serif;
    font-size: 14px;
    font-weight: 400;
    background: #E0E0E0;
    color: #000000
}

ul {
    list-style: none;
    margin-bottom: 0px
}

.button {
    display: inline-block;
    background: #0e8ce4;
    border-radius: 5px;
    height: 48px;
    -webkit-transition: all 200ms ease;
    -moz-transition: all 200ms ease;
    -ms-transition: all 200ms ease;
    -o-transition: all 200ms ease;
    transition: all 200ms ease
}

.button a {
    display: block;
    font-size: 18px;
    font-weight: 400;
    line-height: 48px;
    color: #FFFFFF;
    padding-left: 35px;
    padding-right: 35px
}

.button:hover {
    opacity: 0.8
}

.cart_section {
    width: 100%;
    padding-top: 93px;
    padding-bottom: 111px
}

.cart_title {
    font-size: 30px;
    font-weight: 500
}

.cart_items {
    margin-top: 8px
}

.cart_list {
    border: solid 1px #e8e8e8;
    box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.1);
    background-color: #fff
}

.cart_item {
    width: 100%;
    padding: 15px;
    padding-right: 46px
}

.cart_item_image {
    width: 133px;
    height: 133px;
    float: left
}

.cart_item_image img {
    max-width: 100%
}

.cart_item_info {
    width: calc(100% - 133px);
    float: left;
    padding-top: 18px
}

.cart_item_name {
    margin-left: 7.53%
}

.cart_item_title {
    font-size: 14px;
    font-weight: 400;
    color: rgba(0, 0, 0, 0.5)
}

.cart_item_text {
    font-size: 18px;
    margin-top: 35px
}

.cart_item_text span {
    display: inline-block;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    margin-right: 11px;
    -webkit-transform: translateY(4px);
    -moz-transform: translateY(4px);
    -ms-transform: translateY(4px);
    -o-transform: translateY(4px);
    transform: translateY(4px)
}

.cart_item_price {
    text-align: right
}

.cart_item_total {
    text-align: right
}

.order_total {
    width: 100%;
    height: 60px;
    margin-top: 30px;
    border: solid 1px #e8e8e8;
    box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.1);
    padding-right: 46px;
    padding-left: 15px;
    background-color: #fff
}

.order_total_title {
    display: inline-block;
    font-size: 14px;
    color: rgba(0, 0, 0, 0.5);
    line-height: 60px
}

.order_total_amount {
    display: inline-block;
    font-size: 18px;
    font-weight: 500;
    margin-left: 26px;
    line-height: 60px
}

.cart_buttons {
    margin-top: 60px;
    text-align: right
}

.cart_button_clear {
    display: inline-block;
    border: none;
    font-size: 18px;
    font-weight: 400;
    line-height: 48px;
    color: rgba(0, 0, 0, 0.5);
    background: #FFFFFF;
    border: solid 1px #b2b2b2;
    padding-left: 35px;
    padding-right: 35px;
    outline: none;
    cursor: pointer;
    margin-right: 26px
}

.cart_button_clear:hover {
    border-color: #0e8ce4;
    color: #0e8ce4
}

.cart_button_checkout {
    display: inline-block;
    border: none;
    font-size: 18px;
    font-weight: 400;
    line-height: 48px;
    color: #FFFFFF;
    padding-left: 35px;
    padding-right: 35px;
    outline: none;
    cursor: pointer;
    vertical-align: top
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
  </style>

</head>

      <span>
            @include('sections.components.topnavbar')
      </span>
<form action="" method="post">
@csrf
      <div class="cart_section">
     <div class="container-fluid">
         <div class="row">
             <div class="col-lg-10 offset-lg-1">
                 <div class="cart_container">
                     <div class="cart_title">Shopping Cart<small> (1 item in your cart) </small></div>
                     @foreach ($Products as $prod)
                     <div class="cart_items">
                         <ul class="cart_list">
                             <li class="cart_item clearfix">
                                 <div class="cart_item_image"><img src="/storage/{{$prod->image}}" alt=""></div>
                                 <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                     <div class="cart_item_name cart_info_col">
                                         <div class="cart_item_title">Name</div>
                                         <div class="cart_item_text">{{$prod->name}}</div>
                                     </div>
                                     <div class="cart_item_color cart_info_col">
                                         <div class="cart_item_title">IN STOCK</div>
                                         <div class="cart_item_text">{{$prod->quantity}}</div>
                                     </div>
                                     <div class="cart_item_quantity cart_info_col">
                                         <div class="cart_item_title">Quantity</div>
                                         <div class="cart_item_text">
                                            <input class="cart-quantity-input" type="number" value="1">
                                         </div>
                                     </div>
                                     <div class="cart_item_price cart_info_col">
                                         <div class="cart_item_title">Price</div>
                                         <div class="cart_item_text">₹22000</div>
                                     </div>
                                     <div class="cart_item_total cart_info_col">
                                         <div class="cart_item_title">Discount</div>
                                         <div class="cart_item_text">
                                          <input class="cart-quantity-input" type="number" value="0">
                                         </div>
                                     </div>
                                 </div>
                             </li>
                         </ul>
                     </div>
                    @endforeach
                     <div class="order_total">
                         <div class="order_total_content text-md-right">
                             <div class="order_total_title">Discount:</div>
                             <div class="order_total_amount">0</div>
                             <div class="order_total_title"></div>
                             <div class="order_total_title">VAT:</div>
                             <div class="order_total_amount">20%</div>
                             <div class="order_total_title">Order Total:</div>
                             <div class="order_total_amount">₹22000</div>
                         </div>
                     </div>
                     <button type="submit">dsad</button>
                 </div>
</form>
             </div>
         </div>
     </div>
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
