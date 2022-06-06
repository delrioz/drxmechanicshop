

class Carrito {

    //Añadir producto al carrito
    comprarProducto(e){
        e.preventDefault();
        //Delegado para agregar al carrito
        if(e.target.classList.contains('agregar-carrito')){

            const producto = e.target.parentElement.parentElement;
            //Enviamos el producto seleccionado para tomar sus datos
            var a = this.leerDatosProducto(producto);
        }
    }

    //Leer datos del producto
    leerDatosProducto(producto){
        const infoProducto = {
            imagen : producto.querySelector('img').src,
            titulo: producto.querySelector('.prodName').textContent,
            precio: producto.querySelector('.precio span').textContent,
            id: producto.querySelector('a').getAttribute('data-id'),
            //pega  quantidade
            cantidad: producto.querySelector('.qtd span').textContent,

            SKU: producto.querySelector('.prodSKU').textContent,


            // discount: 0,

            precioConVAT: producto.querySelector('.preciovat span').textContent,
            // cantidad: 1,

            
            // cantidad: producto.getElementById('cantidadContent').textContent,

        }
        
        console.log(producto);
        
        let productosLS;
        productosLS = this.obtenerProductosLocalStorage();
        productosLS.forEach(function (productoLS){
            if(productoLS.id === infoProducto.id){
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

    //muestra producto seleccionado en carrito
    // O CARRINHO É AQUI
    insertarCarrito(producto){
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <img src="${producto.imagen}" width=100>
            </td>
            <td>${producto.titulo}</td>
            <td>${producto.precio}</td>
            <td>${producto.cantidad}</td>
            <td>
                <a href="#" class="borrar-producto fas fa-times-circle" data-id="${producto.id}"></a>
            </td>
        `;
        listaProductos.appendChild(row);
        this.guardarProductosLocalStorage(producto);

    }

    //Eliminar el producto del carrito en el DOM
    eliminarProducto(e){
        e.preventDefault();
        let producto, productoID;
        if(e.target.classList.contains('borrar-producto')){
            e.target.parentElement.parentElement.remove();
            producto = e.target.parentElement.parentElement;
            productoID = producto.querySelector('a').getAttribute('data-id');
        }
        this.eliminarProductoLocalStorage(productoID);
        // automaticamente atualiza
        this.calcularTotal();

    }

    //Elimina todos los productos
    vaciarCarrito(e){
        e.preventDefault();
        while(listaProductos.firstChild){
            listaProductos.removeChild(listaProductos.firstChild);
        }
        this.vaciarLocalStorage();

        return false;
    }

    //Almacenar en el LS
    guardarProductosLocalStorage(producto){
        let productos;
        //Toma valor de un arreglo con datos del LS
        productos = this.obtenerProductosLocalStorage();
        //Agregar el producto al carrito
        productos.push(producto);
        //Agregamos al LS
        localStorage.setItem('productos', JSON.stringify(productos));
    }

    //Comprobar que hay elementos en el LS
    obtenerProductosLocalStorage(){
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

    //Mostrar los productos guardados en el LS
    leerLocalStorage(){
        let productosLS;
        productosLS = this.obtenerProductosLocalStorage();
        productosLS.forEach(function (producto){
            //Construir plantilla
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>
                    <img src="${producto.imagen}" width=100>
                </td>
                <td>${producto.titulo}</td>
                <td>${producto.precio}</td>
                <td>
                    <a href="#" class="borrar-producto fas fa-times-circle" data-id="${producto.id}"></a>
                </td>
            `;
            listaProductos.appendChild(row);
        });
    }

    //Mostrar los productos guardados en el LS en compra.html
    // finalizing buy 

    leerLocalStorageCompra(){
        let productosLS;
        productosLS = this.obtenerProductosLocalStorage();
        productosLS.forEach(function (producto){
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>
                    <img src="${producto.imagen}" width=100>
                </td>
                <td>${producto.titulo}</td>
                <td>${producto.precio}</td>
                <td>
                    <input type="number" class="form-control cantidad" min="1" value=${producto.cantidad}>
                </td>
            
                <td id='vatsubtotales'>${producto.precioConVAT - producto.precio}</td>
                <td id='subtotales'>${(producto.precio * producto.cantidad) + producto.precio * 0.20}</td>
                <td>
                
                    <a href="#" class="borrar-producto fas fa-times-circle" style="font-size:30px" data-id="${producto.id}"></a>
                </td>
            `;
            listaCompra.appendChild(row);
        });
    }

    //Eliminar producto por ID del LS
    eliminarProductoLocalStorage(productoID){
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
    }

    //Eliminar todos los datos del LS
    vaciarLocalStorage(){
        localStorage.clear();
    }

    //Procesar pedido
    procesarPedido(e){
        e.preventDefault();

        if(this.obtenerProductosLocalStorage().length === 0){
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'The basket is empty, please select some products',
                showConfirmButton: false,
                timer: 2000
            })
        }
        else {
            location.href = "/section/carrito/processarcompra";
        }
    }

    calcularTotal(){
        let productosLS;
        let total = 0, igv = 0, subtotal = 0, vat = 0, discount = 0 ;
        productosLS = this.obtenerProductosLocalStorage();
        discount = document.getElementById("discount").value;
    
        for(let i = 0; i < productosLS.length; i++){
         // Total dos discontos
            // let elementDiscount = Number(productosLS[i].discount);
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

    obtenerEvento(e) {
        e.preventDefault();
        let id, cantidad, producto, productosLS;
        if (e.target.classList.contains('cantidad')) {
            producto = e.target.parentElement.parentElement;
            id = producto.querySelector('a').getAttribute('data-id');
            cantidad = producto.querySelector('input').value;
            let actualizarMontos = document.querySelectorAll('#subtotales');
            let actualizarVatMontos = document.querySelectorAll('#vatsubtotales');
            // let actualizarDiscountMontos = document.querySelectorAll('#discountsubtotales');
            productosLS = this.obtenerProductosLocalStorage();
            productosLS.forEach(function (productoLS, index) {
                if (productoLS.id === id) {

                    // aparece o vat e o preço na tela
                    productoLS.cantidad = cantidad;                    
                    actualizarMontos[index].innerHTML = Number(cantidad * productosLS[index].precio);

                    // productoLS.discount = discount;                    
                    // actualizarMontos[index].innerHTML = Number(discount * productosLS[index].precio);

                    // LOGICA PARA O SUBTOTAL INCLUINDO VAT 
                    var vatInprods= Number(cantidad * productosLS[index].precio * 0.20);
                    actualizarVatMontos[index].innerHTML = vatInprods;
                    actualizarMontos[index].innerHTML = Number(cantidad * productosLS[index].precio + vatInprods);

                }    
            });
            localStorage.setItem('productos', JSON.stringify(productosLS));
            
        }
        else {
            console.log("click afuera");
        }
    }
}