const compra = new Carrito();
const listaCompra = document.querySelector("#lista-compra tbody");
const carrito = document.getElementById('carrito');
// botao de realizar compra
const procesarCompraBtn = document.getElementById('procesar-compra');
const cliente = document.getElementById('cliente');
const correo = document.getElementById('correo');


cargarEventos();

function cargarEventos() {
    document.addEventListener('DOMContentLoaded', compra.leerLocalStorageCompra());

    //Eliminar productos del carrito
    carrito.addEventListener('click', (e) => { compra.eliminarProducto(e) });

    compra.calcularTotal();

    //cuando se selecciona procesar Compra
    procesarCompraBtn.addEventListener('click', procesarCompra);

    carrito.addEventListener('change', (e) => { compra.obtenerEvento(e) });
    carrito.addEventListener('keyup', (e) => { compra.obtenerEvento(e) });


}


function procesarCompra() {
    // e.preventDefault();
    
    alert('compra realizada!');
    console.log(compra.obtenerProductosLocalStorage()); 

    if (compra.obtenerProductosLocalStorage().length === 0) {
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'There is no product, select some',
            showConfirmButton: false,
            timer: 2000
        }).then(function () {
            // window.location = "/section/carrito/index";
        })
    }
    else if (cliente.value === '' || correo.value === '') {
        Swal.fire({
            type: 'success',
            title: 'Redirecionando...',
            text: 'Ingrese todos los campos requeridos',
            showConfirmButton: false,
            timer: 2000
        }).then(function () {
           alert('oioi');
        })    
    }
}

