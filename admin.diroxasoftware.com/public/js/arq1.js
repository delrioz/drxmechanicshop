function purchaseClicked(e)
{
    
    alert('Thank you for your purchase')
    var params = (document.getElementsByClassName('cart-items')[0].getElementsByClassName('cart-row'))
    var data = []
    let params2 = ''
    var cont = 0 

    for (var i = 0; i < params.length; i++) {
                 var results = params[i].getElementsByClassName("cart-quantity cart-column")[0].getElementsByClassName("results")[0],
                 title = results.getElementsByClassName("title")[0].value,
                 price = results.getElementsByClassName("price")[0].value,
                 productID = results.getElementsByClassName("productID")[0]
                 data.push([title, price, productID])
    }

    // document.getElementsByClassName('cart-all-data')[0].value =  data +'[]'
    console.log (data)
     //continue submitting
}