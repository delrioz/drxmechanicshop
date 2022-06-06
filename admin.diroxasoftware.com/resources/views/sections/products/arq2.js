function purchaseClicked(e)
{
    
    alert('Thank you for your purchase')
    var params = (document.getElementsByClassName('cart-items')[0].getElementsByClassName('cart-row'))
    console.log
    var data = []
    let params2 = ''
    var cont = 0 

    
    for (var i = 0; i < params.length; i++) {
                 var results = params[i].getElementsByClassName("cart-quantity cart-colum")[0].getElementsByClassName("results")[0],
                 title = results.getElementsByClassName("title")[0].value,
                 price = results.getElementsByClassName("price")[0].value,
                 productID = results.getElementsByClassName("productID")[0].value
                 Object.entries(params).forEach(([chave, valor]) => {
                     params2 += `"produto" : "${valor[0]}",  "preco" :  "${valor[1]}" , "id" :  "${valor[2]}"`
                     params2 += cont <params.length - 1 ? ', ' : ''
                     cont++
                 })
                 return params2
                 
    }
    alert('fim da div')
}