<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

COMPROU,  REDIRECIONADO
<br>

The product was:
{{$dataConfirmBuy->product}}
<br>
The price was:
{{$dataConfirmBuy->price}}

<br>
The discount was:
{{$dataConfirmBuy->discount}}

<br>
PAGAR COM:
<br>
<a href="/paypal/pay/{{$dataConfirmBuy->price}}" class="btn btn-primary btn-group">CARTAO / PAYPAL</a>
<a href="/paypal/pay">CARTAO / PAYPAL</a>
<a href="/DINHEIRO">DINHEIRO</a>
</body>
</html>