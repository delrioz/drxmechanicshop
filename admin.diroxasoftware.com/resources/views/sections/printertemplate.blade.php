
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style.css">
        <title>Receipt example</title>
    </head>

    <style>
        
        * {
            font-size: 12px;
            font-family: 'Times New Roman';
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
        }

        td.description,
        th.description {
            width: 75px;
            max-width: 75px;
        }

        td.quantity,
        th.quantity {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        td.price,
        th.price {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: 300px;
            max-width: 155px;
        }

        img {
            max-width: inherit;
            width: inherit;
        }

        @media print {
            .hidden-print,
            .hidden-print * {
                display: none !important;
            }
        }

        @page {
            margin: 0.95mm;
            }

    
    </style>
    <body>
        <div class="ticket" >
            <img src="{{ asset('admlyt/imgs/gwlogo.png') }}" alt="Logo">
            <p class="centered">GOLDWORKS RECEIPT
                <br>1 Cromwell Ct, Ealing Rd
                <br>Alperton, Wembley HA0 1JU</p>
            <table>
                <thead>
                    <tr>
                        <th class="quantity">Qt.</th>
                        <th class="description">Description</th>
                        <th class="price">£</th>
                    </tr>
                </thead>
                <tbody>
            @if($typesales == 0 )
                @foreach($ProductsInfos2 as $product)
                    <tr>
                        <td class="quantity">{{$product->quantity}}</td>
                        <td class="description">{{$product->name}}</td>
                        <td class="price">£{{$product->totalSalesWithoutVat}}</td>
                    </tr>
                @endforeach
                    <tr>
                        <td class="quantity"></td>
                        <td class="description">SUBTOTAL</td>
                        <td class="price">£{{$sales_price}}</td>
                    </tr>
                    <tr>
                        <td class="quantity"></td>
                        <td class="description"><h3>VAT(20%)</h3></td>
                        <td class="price">£{{$sales_price}}</td>
                    </tr>
                    <tr>
                        <td class="quantity"></td>
                        <td class="description"><h3>DISCOUNT</h3></td>
                        <td class="price">£{{$sales_price}}</td>
                    </tr>
                    <tr>
                        <td class="quantity"></td>
                        <td class="description"><h3>GRAND TOTAL</h3></td>
                        <td class="price">£{{$sales_price}}</td>
                    </tr>
                    <tr>
                        <td class="quantity"></td>
                        <td class="description"><h3>PAYMENT METHOD</h3></td>
                        <td class="price">£{{$sales_price}}</td>
                    </tr>
            @else

                    <tr>
                        <td class="quantity"></td>
                        <td class="description">SUBTOTAL</td>
                        <td class="price">£{{$sales_subtotal}}</td>
                    </tr>
                    <tr>
                        <td class="quantity"></td>
                        <td class="description"><h3>VAT(20%)</h3></td>
                        <td class="price">£{{$sales_vat}}</td>
                    </tr>
                    <tr>
                        <td class="quantity"></td>
                        <td class="description"><h3>DISCOUNT</h3></td>
                        <td class="price">£{{$sales_discount}}</td>
                    </tr>
                    <tr>
                        <td class="quantity"></td>
                        <td class="description"><h3>GRAND TOTAL</h3></td>
                        <td class="price">£{{$sales_price}}</td>
                    </tr>
                    <tr>
                        <td class="quantity"></td>
                        <td class="description"><h3>PAYMENT METHOD</h3></td>
                        <td class="price">{{$methodPayment}}</td>
                    </tr>
            @endif
            
                </tbody>
            </table>
            <p class="centered">Thanks for choose us!
                <br>GOLDWORKS SERVICES</p>
        </div>
        <button id="btnPrint" class="hidden-print">Print</button>
        <script src="script.js"></script>
        <script>
                const $btnPrint = document.querySelector("#btnPrint");
                $btnPrint.addEventListener("click", () => {
                    window.print();
                });
        </script>
    </body>
</html>