(function () {
    var addButton = document.getElementById("add-extra-cost-btn")
    var tableContainer = document.getElementById("extra-cost-container");
    
    var productCount = 0;
    addButton.addEventListener("click", function () {
        ++productCount;
        var table = document.createElement("table");
        table.innerHTML = 
            "<tr>" + 
                "<th>Extra Cost Name</th>" + 
                "<th>Price</th>" + 
                "<th>Price incl Vat</th>" + 
                "<th>Options</th>" + 
            "</tr>" + 
            "<tr>" + 
                "<td><input type='text' class='product-name' name='DescriptionName[]' placeholder='prod'" + productCount + "' required></td>" + 
                "<td><input  class='price' name='Sell_Price[]' placeholder='Price' required></td>" + 
                "<td><input  class='price-vat' name='Sell_PriceVat[]' placeholder='Price with' required></td>" + 
                "<td><input type='button' class='remove-btn' value='Remove'></td>" + 
            "</tr>";
        tableContainer.append(table);
    });

    tableContainer.addEventListener("click", function (e) {
        var el = e.target;
        if (el.classList.contains("remove-btn")) {
            while (el.tagName !== "TABLE") {
                el = el.parentElement;
            }
            el.remove();
        }
    });

    tableContainer.addEventListener("input", function (e) {
        var el = e.target;

        if (el.classList.contains("price")) {
            var tr = el.parentElement.parentElement;
            var priceVatInput = tr.querySelector(".price-vat");
            var priceInput = tr.querySelector(".price");
            var price = Number(el.value);
            var priceVat = price * 1.2;
            if(isNaN(price)){
                price  = 0.00;
                priceVat = 0.00;
                priceInput.value = price.toFixed(2);
                priceVatInput.value = priceVat.toFixed(2);
          }
          else{
            priceVatInput.value = priceVat.toFixed(2);
          }
        } else if (el.classList.contains("price-vat")) {
            var tr = el.parentElement.parentElement;
            var priceInput = tr.querySelector(".price");
            var priceVatInput = tr.querySelector(".price-vat");
            var priceVat = Number(el.value);
            var price = priceVat * (10/12);
          if(isNaN(price)){
                price  = 0.00;
                priceVat = 0.00;
                priceInput.value = price.toFixed(2);
                priceVatInput.value = priceVat.toFixed(2);
          }
          else{
                priceInput.value = price.toFixed(2);
          }
        }
    });
})();
