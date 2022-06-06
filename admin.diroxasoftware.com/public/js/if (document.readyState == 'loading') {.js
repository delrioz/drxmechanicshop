if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', ready)
} else {
    ready()
    
}

function ready() {
    var removeCartItemButtons = document.getElementsByClassName('btn-danger')
    for (var i = 0; i < removeCartItemButtons.length; i++) {
        var button = removeCartItemButtons[i]
        button.addEventListener('click', removeCartItem)
    }

    var quantityInputs = document.getElementsByClassName('cart-quantity-input')
    for (var i = 0; i < quantityInputs.length; i++) {
        var input = quantityInputs[i]
        input.addEventListener('change', quantityChanged)
    }

    var addToCartButtons = document.getElementsByClassName('shop-item-button')
    for (var i = 0; i < addToCartButtons.length; i++) {
        var button = addToCartButtons[i]
        button.addEventListener('click', addToCartClicked)
    }

    document.getElementsByClassName('btn-purchase')[0].addEventListener('click', purchaseClicked)
}

function purchaseClicked(e)
{
    
    alert('Thank you for your purchase')
    var params = (document.getElementsByClassName('cart-items')[0].getElementsByClassName('cart-row'))
    var data = []

    for (var i = 0; i < params.length; i++) {
                var results = params[i].getElementsByClassName("cart-quantity cart-column")[0].getElementsByClassName("results")[0],
                 title = results.getElementsByClassName("title")[0].value,
                 price = results.getElementsByClassName("price")[0].value, 
                 productID = results.getElementsByClassName("productID")[0].value
                 attArr();                 
    }
                     
    function attArr() {
        data.push([title, price, productID])
        return data;
    }

    // console.log(data)
    document.getElementsById('myInput').value = 3;
    

}


function removeCartItem(event) {
    var buttonClicked = event.target
    buttonClicked.parentElement.parentElement.remove()
    updateCartTotal()
    
}

function quantityChanged(event) {

    var input = event.target
    if (isNaN(input.value) || input.value <=0 ) {
        input.value = 1     
    }
    updateCartTotal()

}

function readDatas(title, prices, quantity)
{
    console.log(title.value, prices.value, quantity.value)
}

function addToCartClicked(event) {
    var button = event.target
    var shopItem = button.parentElement.parentElement
    var title = shopItem.getElementsByClassName('shop-item-title')[0].innerText
    var price = shopItem.getElementsByClassName('shop-item-price')[0].innerText
    var imageSrc = shopItem.getElementsByClassName('shop-item-image')[0].src
    // inner text pega o que esta escrito DENTRO 
    var qtdInStock = shopItem.getElementsByClassName('shop-item-qtdInStock')[0].innerText
    var productID = shopItem.getElementsByClassName('shop-item-productID')[0].innerText

    // var datas = purchaseClicked()
    addItemToCart(title, price, imageSrc, qtdInStock, productID)
    updateCartTotal()
}

function addItemToCart(title, price, imageSrc, qtdInStock, productID, datas) {
    var cartRow = document.createElement('div')
    cartRow.classList.add('cart-row')
    var cartItems = document.getElementsByClassName('cart-items')[0]
    var cartItemNames = cartItems.getElementsByClassName('cart-item-title')
    for (var i = 0; i < cartItemNames.length; i++) {
        if (cartItemNames[i].innerText == title) {
            alert('This item is already added to the cart')
            return
        }
    }
    var cartRowContents = `
        <div class="cart-item cart-column">
            <img class="cart-item-image" name="image"  src="${imageSrc}" width="100" height="100">
            <span class="cart-item-title" name = "${title}" >${title}</span>
        </div>
        <span class="cart-price cart-column" name = "${price}" >${price}</span>
        <span class="cart-price cart-column"  id="shop-item-qtdInStock" >${qtdInStock}</span>
        <div class="cart-quantity cart-column">
            <input class="cart-quantity-input" type="number" value="1">
            <button class="btn btn-danger" type="button">REMOVE</button>
        <span id="results" class="results">
            <input type="hidden" name="imageSrc" value="${imageSrc}">
            <input type="hidden" class="title" name="title" value="${title}">
            <input type="hidden" class="price" name="price" value="${price}">
            <input type="hidden" class="qtdInStock" name="qtdInStock" value="${qtdInStock}">
            <input type="hidden" class="productID" name="productID" value="${productID}">
            <input type="hidden" id="myInput" class="myInput" name="myInput" value="2"/>

        </span>
        </div><br>`

    cartRow.innerHTML = cartRowContents
    cartItems.append(cartRow)
    cartRow.getElementsByClassName('btn-danger')[0].addEventListener('click', removeCartItem)
    cartRow.getElementsByClassName('cart-quantity-input')[0].addEventListener('change', quantityChanged)
}

function updateCartTotal() {
    var cartItemContainer = document.getElementsByClassName('cart-items')[0]
    var cartRows = cartItemContainer.getElementsByClassName('cart-row')
    var total = 0
    for (var i = 0; i < cartRows.length; i++) {
        var cartRow = cartRows[i]
        var priceElement = cartRow.getElementsByClassName('cart-price')[0]
        var quantityElement = cartRow.getElementsByClassName('cart-quantity-input')[0]
        var price = parseFloat(priceElement.innerText.replace('£', ''))
        var quantity = quantityElement.value
        total = total + (price * quantity)
        readDatas(priceElement, quantityElement, price)

    }


    total = Math.round(total * 100) / 100
    document.getElementsByClassName('cart-total-price')[0].innerText = '£' + total
}