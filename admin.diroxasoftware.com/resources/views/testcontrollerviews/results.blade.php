<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

@if( session('status'))
    <h3> {{ session('status') }} </h3>
    OLÁ, VC PAGOU <h3> {{ session('total') }} </h3>
@endif
    
</body>
</html>