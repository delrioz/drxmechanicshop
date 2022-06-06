const carro = new Carrito();
const carrito = document.getElementById('carrito');
const productos = document.getElementById('lista-productos');
const listaProductos = document.querySelector('#lista-carrito tbody');
const vaciarCarritoBtn = document.getElementById('vaciar-carrito');

// a que manda para outra pagina 
const procesarPedidoBtn = document.getElementById('procesar-pedido');

cargarEventos();

function cargarEventos(){

    //Se ejecuta cuando se presionar agregar carrito
    productos.addEventListener('click', (e)=>{carro.comprarProducto(e)});

    //Cuando se elimina productos del carrito
    carrito.addEventListener('click', (e)=>{carro.eliminarProducto(e)});

    //Al vaciar carrito
    vaciarCarritoBtn.addEventListener('click', (e)=>{carro.vaciarCarrito(e)});

    //Al cargar documento se muestra lo almacenado en LS
    document.addEventListener('DOMContentLoaded', carro.leerLocalStorage());

    // chama este metodo
    //Enviar pedido a otra pagina
    // chama a a função processar pedidio
    procesarPedidoBtn.addEventListener('click', (e)=>{carro.procesarPedido(e)});
}