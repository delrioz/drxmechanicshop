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
  <link href="{{ asset('carrito/css/sweetalert2.min.css') }}" rel="stylesheet">

</head>

      <span>
            @include('sections.components.topnavbar')
      </span>

        <!-- Begin Page Content -->
        <div class="container-fluid">

        <!-- Page Heading -->

        <!-- DataTales Example -->
         <!------ Include the above in your HEAD tag ---------->

            <form action="/section/buysection/finishingbuy" method="POST" id="registro" name="registro" enctype="multipart/form-data">
              @csrf

            <section class="testimonial py-3" id="testimonial">
            <div class="container"  style="box-shadow: 0 4px 12px 0 rgba(0, 0, 2, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.19)">
                    <div class="row ">
                        <div class="col-md-12 py-5 border">
                            <h4 class="pb-2" style="color:black;"><b>Selecting Products. Please, choose them all to finish the buy.</b></h4>
                            <!-- <div class="alert alert-warning">
                                <p><b>If you are trying create a order without products, please select the "only services" on Products input</b></p>
                            </div> -->
                            @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                        @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                        @endforeach
                                        </ul>
                                    </div>
                                @endif
                                
                                @if(session('warning'))
                                <div class="alert alert-info">
                                    {{ session('warning') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="row">
                                    <div class="form-group col-md-12">
                                        <label style="color:black;"><b>Search for a product</b></label>
                                            <input id="searchBox" name="searchBox"  id="searchBox"  placeholder="Search for a product" 
                                                class="form-control" type="text" >
                                    </div>
                            </div>
                            <hr>
                            <tbody class="dataTable" id="dataTable">

                            </tbody>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label style="color:black;"><b>Product</b></label>
                                        <select id="chooseProduct" name="chooseProduct" class="form-control categoriesOptions">
                                            <option value="0">Choose the product</option>
                                        </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                <label style="color:black;"><b>Quantity</b></label>
                                    <input id="quantity" name="quantity"  id="quantity"  placeholder="Search for a product" 
                                        value ="1" type="text" >
                                </div>
                            </div>

                        <!-- <span id="tableTitle" class="d-none">
                                <div class="title ">
                                    <div class="alert alert-warning">
                                        <h5>Customers Found</h5>
                                    </div>
                                </div>

                                    <div class="row">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Contact Number:</th>
                                            <th>Email</th>
                                            <th scope="col">Actions</th>

                                        </tr>
                                        </thead>
                                        <tbody class="dataTable" id="dataTable">

                                        </tbody>
                                    </table>
                                </div>
                        </span> -->

                               <button type="button" class="btn btn-success" id="addToTheCart">Add to the cart</button>
                            </form>
                        </div>
                    </div>

                   <main>
                      <div class="container">
                          <div class="row mt-3">
                              <div class="col">
                                  <h2 class="d-flex justify-content-center mb-3">Finalizing Purchase</h2>
                                  <form id="procesar-pago" action="#" method="post">
                                  @csrf
                                    

                                      <div id="carrito" class="form-group table-responsive" >
                                          <table class="table" id="lista-compra" >
                                              <thead>
                                                  <tr>
                                                      <th scope="col">Image</th>
                                                      <th scope="col">Name</th>
                                                      <th scope="col">Unit Price (GBP)<br>(excl Vat )</th>
                                                      <th scope="col">Quantity</th>
                                                      <th scope="col">Total Vat (20%)</th>
                                                      <th scope="col">Sub Total (GBP)<br>(incl Vat)</th>
                                                      <th scope="col">Clean</th>
                                                  </tr>

                                              </thead>
                                              <tbody >

                                              </tbody>
                                              <tr>
                                                  <th colspan="4" scope="col" class="text-right"><b>Sub Total :</b></th>
                                                  <th scope="col">
                                                      <p id="subtotal"></p>
                                                  </th>
                                                  <!-- <th scope="col"></th> -->
                                              </tr>
                                              <tr>
                                                  <th colspan="4" scope="col" class="text-right"><b>Tax :</b></th>
                                                  <th scope="col">
                                                      <p id="igv"></p>
                                                  </th>
                                                  <!-- <th scope="col"></th> -->
                                              </tr>
                                              <tr>
                                                  <th colspan="4" scope="col" class="text-right"><b>Discount (GBP):</b></th>
                                                  <th scope="col">
                                                      <input type="number"  id="discount" class="form-control cantidad" min="0"  value="0">
                                                  </th>
                                                  <!-- <th scope="col"></th> -->
                                              </tr>



                                              <tr>
                                                  <th colspan="4" scope="col" class="text-right">Total :</th>
                                                  <th scope="col">
                                                      <input id="total" name="monto" class="font-weight-bold border-0" readonly style="background-color: white;"></input>
                                                  </th>
                                                  <!-- <th scope="col"></th> -->
                                              </tr>

                                              <tr>
                                                  <th colspan="4" scope="col" class="text-right">Payment Method :</th>
                                                          <th scope="col">
                                                                      <div class="row">
                                                                              <form class="form-inline">
                                                                                  <select class="custom-select my-1 mr-sm-2" id="paymentMethod">
                                                                                      <option value="card">Card</option>
                                                                                      <option value="cash">Cash</option>
                                                                                  </select>
                                                                              </form>
                                                                      </div>
                                                          </th>
                                                  <!-- <th scope="col"></th> -->
                                              </tr>

                                          </table>
                                      </div>

                                      <div class="row justify-content-center" id="loaders">
                                          <img id="cargando" src="img/cargando.gif" width="220">
                                      </div>

                                    
                                      <div class="row justify-content-between">
                                          <div class="col-md-4 mb-2">
                                              <a href="#" ></a>
                                              <a name="atipobutton"  href="/section/carrito/index" type="button" class="btn btn-danger btn-block redirectKeepBuying" id="redirectKeepBuying">
                                                  Back
                                              </a>
                                          </div>
                                          <div class="col-xs-12 col-md-4">
                                              <button href="#" class="btn btn-success btn-block" id="procesar-compra">Buy</button>
                                          </div>
                                      </div>
                                  </form>
                                  <div class="row text-center" id="h5" >
                              </div>
                              </div>
                          </div>
                      </div>
                  </main>
            </section>
        </div>
        <!-- /.container-fluid -->
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
  




<script>
      $(document).ready(function(){
        // alert(1);
        
            // $('#ajaxSubmit').click(function(e){
              $(document).on("change", "#searchBox", function(e){
                
                var inputSearch = searchBox.value;
                // alert(inputSearch);
                // var comboCidades = $('#mselect option:selected').val();
              
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               $.ajax({
                  url: "{{ url('/home/searchingProductsAjax') }}",
                  method: 'post',
                  data: {
                     data: inputSearch,
                     _token: '{{csrf_token()}}'},

                  success: function(result){
                    
                    $resp = result;
                    // console.log($resp);

                    if($resp == 0){
                        alert('Nothing was found matching this datas');
                        $('#dataTable').empty();
                        $("#tableTitle").addClass("d-none")
                        document.getElementById('searchBox').value = '';
                    }

                    else{
                      
                    //   $("#tableTitle").removeClass("d-none")
                    //   $('#dataTable').empty();

                    $('.categoriesOptions').empty();
                        $resp = result;
                        $.each($resp, function (key, value){
                        $(".categoriesOptions").append(`
                        <option value="`+ value.id + `">`+value.name + `</option>
                    `);
                  });
                  } // fim do else 
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


<script>
   //Almacenar en el LS
   function guardarProductosLocalStorage(producto){
        // console.log(producto);
        let productos;
        //Toma valor de un arreglo con datos del LS
        productos = this.obtenerProductosLocalStorage();
        //Agregar el producto al carrito
        productos.push(producto);
        //Agregamos al LS
        localStorage.setItem('productos', JSON.stringify(productos));
        calcularTotal();
   }



  //Comprobar que hay elementos en el LS
    function obtenerProductosLocalStorage(){
        let productoLS;

        //Comprobar si hay algo en LS
        if(localStorage.getItem('productos') === null){
            productoLS = [];
        }
        else {
            productoLS = JSON.parse(localStorage.getItem('productos'));
        }
        return productoLS;
    }


    //muestra producto seleccionado en carrito
    // O CARRINHO É AQUI


    function eliminarProducto(prodId){
        // e.preventDefault();
        // alert(prodId);
        let productoID;
        productoID = prodId;
        this.eliminarProductoLocalStorage(productoID);

    }


        //Eliminar producto por ID del LS
    function eliminarProductoLocalStorage(productoID){
        let productosLS;
        //Obtenemos el arreglo de productos
        productosLS = this.obtenerProductosLocalStorage();
        //Comparar el id del producto borrado con LS
        productosLS.forEach(function(productoLS, index){
            if(productoLS.id === productoID){
                productosLS.splice(index, 1);
            }
        });

        //Añadimos el arreglo actual al LS
        localStorage.setItem('productos', JSON.stringify(productosLS));
        calcularTotal();

    }


    function calcularTotal(){
          let productosLS;
          let total = 0, igv = 0, subtotal = 0, vat = 0, discount = 0 ;
          productosLS = this.obtenerProductosLocalStorage();
          discount = document.getElementById("discount").value;
      
          for(let i = 0; i < productosLS.length; i++)
          {
              // Total dos discontos
              // let elementDiscount = NumSber(productosLS[i].discount);
              // discount = discount + elementDiscount;
        
              // subtotal, SEM O VAT 
              let element = Number(productosLS[i].precio * productosLS[i].cantidad);
                subtotal = subtotal + element;
                
              // total com vat   
              let elementVAT = Number(productosLS[i].precioConVAT) *  Number(productosLS[i].cantidad);
                total = total + elementVAT;
        
              // total DO vat   
              let elementTotalVAT = Number((productosLS[i].precioConVAT - productosLS[i].precio) *  Number(productosLS[i].cantidad));
                vat = vat + elementTotalVAT;
        
              //   // total DO vat   
              //     let elementTotalDiscount = 2;
              //     // <td id='subtotales'>${(producto.precio * producto.cantidad) + producto.precio * 0.20}</td>
              //     discount = discount + elementTotalDiscount;
          }
      
          
          var totalWithDiscount = total  - discount;
          igv = parseFloat(total * 0.20).toFixed(2);
          // subtotal = parseFloat(total-igv).toFixed(2);

          document.getElementById('subtotal').innerHTML = "£/. " + subtotal.toFixed(2);
          document.getElementById('igv').innerHTML = "£/. " + vat.toFixed(2);
          // document.getElementById('discount').value = "£/. " + discount.toFixed(2);
          document.getElementById('total').value = "£/. " + totalWithDiscount.toFixed(2);
    }

</script>





<!-- <script>
      $(document).ready(function(){
        // alert(1);
        
            // $('#ajaxSubmit').click(function(e){
              $(document).on("click", "#addToTheCart", function(e){
                e.preventDefault();
                alert(123);

                // // alert(inputSearch);
                var chooseProduct = $('#chooseProduct option:selected').val();
                var quantity = $('#quantity').val();
                var inputSearch = chooseProduct;

            });
        });
</script> -->


<script>
      $(document).ready(function(){
        // alert(1);
        
            // $('#ajaxSubmit').click(function(e){
              $(document).on("click", "#addToTheCart", function(e){
                
                // alert(123);
                // alert(inputSearch);
                var chooseProduct = $('#chooseProduct option:selected').val();
                var quantity = $('#quantity').val();
                var inputSearch = chooseProduct;
              
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               $.ajax({
                  url: "{{ url('/home/searchingProductsAjaxById') }}",
                  method: 'post',
                  data: {
                     data: inputSearch,
                     _token: '{{csrf_token()}}'},

                  success: function(result){
                    
                    $resp = result;
                    console.log($resp);

                    if($resp == 0){
                        alert('Nothing was found matching this datas');
                        $('#dataTable').empty();
                        $("#tableTitle").addClass("d-none")
                        document.getElementById('searchBox').value = '';
                    }

                    else{
                      
                        $("#tableTitle").removeClass("d-none")
                        $resp = result;
                        let productos;
                        console.log(result.id);
                  
                        const infoProducto = {
                            imagen : result.image,
                            titulo: result.name,
                            precio: result.Sell_Price,
                            id: result.id,
                            //pega  quantidade
                            cantidad: quantity,
                            SKU: result.SKU,
                            // discount: 0,
                            precioConVAT: result.Sell_PriceVat,
                            // cantidad: producto.getElementById('cantidadContent').textContent,
                        }

                        comprarProducto(infoProducto); // EBDCAQUI
                        // alert(sellpricetot);
                     } // fim do else 
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





<script>
        $(document).ready(function(){
          
              // $('#ajaxSubmit').click(function(e){
                $(document).on("click", "#finishCartButton", function(e){
                // $(this).parent().parent().remove();
                // alert(123);

                var lastname = localStorage.getItem("lastname");
                alert(lastname);
        
                
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/section/products/getProdsAjax') }}",
                    method: 'post',
                    data: {
                      data: valor,
                      _token: '{{csrf_token()}}'},

                    success: function(result){

                    },
                    error: function(jqXHR, textStatus, errorThrown, result) {
                        // console.log(jqXHR.responseJSON.errors)
                        $msg = 'oi';
                        $resp = jqXHR.responseJSON.errors;
                        $('.prodstables').empty();
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


  
<script>

    function comprarProducto(infoProducto){
            // alert(infoProducto);
            var a = this.leerDatosProducto(infoProducto);
            loadDatas();

    }

    function insertarCarrito(producto){
        this.guardarProductosLocalStorage(producto);
    }

     //Leer datos del producto
     function leerDatosProducto(infoProducto){
        
        let productosLS;

        productosLS = this.obtenerProductosLocalStorage();
        productosLS.forEach(function (productoLS){
            if(productoLS.id === infoProducto.id){
                console.log(productoLS);
                productosLS = productoLS.id;
            }
        });

        if(productosLS === infoProducto.id){
            // alert('olá, mundo');
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'This product is already added in your basket, try another one',
                showConfirmButton: false,
                timer: 2000
            })
        }
        else {
            this.insertarCarrito(infoProducto);
        }

    }




    function leerLocalStorageCompra(){
        let productosLS;
        productosLS = this.obtenerProductosLocalStorage();
        productosLS.forEach(function (producto){
            const row = document.createElement('tr');
            var vatsubtotales =  producto.precio * 0.20;
            var vatsubtotalesArredondado = parseFloat(vatsubtotales.toFixed(2));

            // var subtotales = (producto.precio * producto.cantidad) + producto.precio * 0.20; 
            var subtotales = (producto.precio * producto.cantidad);

            var subtotalesArredondado = parseFloat(subtotales.toFixed(2));

            row.innerHTML = `
                <td>
                    <img src="${producto.imagen}" width=100>
                </td>
                <td>${producto.titulo}</td>
                <td>${producto.precio}</td>
                <td>
                    <input type="number" class="form-control cantidad" min="1" value=${producto.cantidad}>
                </td>
            
                <td id='vatsubtotales'>${vatsubtotalesArredondado}</td>
                <td id='subtotales'>${subtotalesArredondado}</td>
                <td>
                
                    <a href="#" class="borrar-producto fas fa-times-circle" style="font-size:30px" data-id="${producto.id}"></a>
                </td>
            `;
            const listaCompra = document.querySelector("#lista-compra tbody");
            listaCompra.appendChild(row);
        });
    }
   
</script>
 
  <script>

   function loadDatas()
   {
          calcularTotal();
          leerLocalStorageCompra();
  }

  loadDatas();
  </script>



    <!-- Bootstrap core JavaScript-->
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

    <script src="{{ asset('carrito/js/sweetalert2.min.js') }}"></script>



  </body>

  </html>

