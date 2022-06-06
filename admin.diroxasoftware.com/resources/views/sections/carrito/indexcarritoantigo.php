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


    <title>Carrito Compras en JavaScript</title>
</head>

<body>

    <header>
        <div class="container">
            <div class="row align-items-stretch justify-content-between">
                <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                    <a class="navbar-brand" href="#">Buy Section</a>
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
        </div>
    </header>

    <main>
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 my-4 mx-auto text-center">
            <h1 class="display-4 mt-4">Products List</h1>
        </div>

    <div class="container" id="lista-productos">
        <div class="card-deck mb-3 text-center">

            @foreach($allproducts as $prod)
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-bold">{{$prod->name}}</h4>
                    </div>
                    <div class="card-body">
                        <img src="/storage/{{$prod->image}}" class="card-img-top" style="width: 200px; height: 110px;">
                        <h1 class="card-title pricing-card-title precio">£<span class="">{{$prod->Sell_Price}}</span></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li></li>
                            <li>{{$prod->SKU}}</li>
                            <li class="card-title pricing-card-title qtd"><span class="">1</span></li>

                            <li>Id {{$prod->id}}</li>
                        </ul>
                        <a  href="" class="btn btn-block btn-primary agregar-carrito" data-id="{{$prod->id}}">Comprar</a>
                    </div>
                </div>
            @endforeach                
            </div>
        </div>
    </main>

    <script src="{{ asset('carrito/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('carrito/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('carrito/js/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('carrito/js/carrito.js') }}"></script>
    <script src="{{ asset('carrito/js/pedido.js') }}"></script>









</body>

</html>