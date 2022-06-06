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
    // procesarCompraBtn.addEventListener('click', procesarCompra);

    carrito.addEventListener('change', (e) => { compra.obtenerEvento(e) });
    carrito.addEventListener('keyup', (e) => { compra.obtenerEvento(e) });


}


function procesarCompra() {

    // e.preventDefault(); 

    alert('Purchase Completed!');
    data = compra.obtenerProductosLocalStorage(); 
    localStorage.clear();
    

            dataPurchases = []
            // var sellPrice = document.getElementById("Sell_Price").value;
            // // document.getElementById("Sell_PriceVat").value = sellPrice; 
            // var takingVatPrice =   (sellPrice * 0.20).toFixed(2);
          
            // document.getElementById("Sell_PriceVat").value = Number(sellPrice) + Number(takingVatPrice); 
            // document.getElementById("Sell_PriceVatView").value = Number(sellPrice) + Number(takingVatPrice); 

            // tirando os sinais das libras na frente dos nomes
            var subtotalvalue = document.getElementById('subtotal').innerHTML;
            var newsubtotalvalue = document.title = subtotalvalue.replace('£/. ', ''); // vai mudar o titulo removendo "STACK"

            var totalvalue = document.getElementById('total').value;
            var newtotalvalue = document.title = totalvalue.replace('£/. ', ''); // vai mudar o titulo removendo "STACK"

            var vat = document.getElementById('igv').innerHTML;
            var newvatvalue = document.title = vat.replace('£/. ', ''); // vai mudar o titulo removendo "STACK"


            var paymentMethod = document.getElementById('paymentMethod').value;

            var sales_discount = document.getElementById('discount').value;
            var newtotalvalue = document.title = totalvalue.replace('£/. ', ''); // vai mudar o titulo removendo "STACK"

            for(var i=0; i<data.length; i++) {
               var dataPurchase = {
            
                imagen : data[i].imagen,
                titulo: data[i].titulo,
                precio: data[i].precio,
                id: data[i].id,
                cantidad:data[i].cantidad,
                precioconVAT:data[i].precio,
                SKU:data[i].SKU,
                subtotalvalue: newsubtotalvalue,
                totalvalue: newtotalvalue,
                vat: newvatvalue,
                paymentMethod:paymentMethod,
                sales_discount: sales_discount,

            }
            
            
            dataPurchases.push(dataPurchase);

            }

            // data = JSON.stringify(dataPurchases)
            data = dataPurchases;
            return (data);

        }

