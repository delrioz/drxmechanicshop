
<!DOCTYPE html>
<!-- # "current" => "anuncio"]) -->
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="css/app.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <title>Diroxa Software</title>
</head>

<style>

    #footer{
        color: white;

        background: purple;


    }

    #links{
        background: orange;
    }



    #btnRoxo {
    background: rgb(87, 13, 119);
    color: #fff;
    border-color: purple;
}



</style>
<body>

<header>



</header>


<div class="container-fluid" >
    <div class="container search-table">
           <div class="meusposts">
    <br />
    <br />
    <br />
<br>

     <div class="search-list" id="servicosanunciados">
     <h3>Existing Products:</h3>
  </div>
  <a href="/section/products/create"  class="btn btn-primary btn-group">Add new Product</a><br>
  <br>
  



<div class="container">
  <div class="row">
    <div class="col-12">
		<table class="table table-image">
		  <thead>
		    <tr>
		      <th scope="col"></th>
            <th scope="col">Name</th>
            <th scope="col">serial_number</th>
            <th scope="col">categorie</th>
            <th scope="col">situation</th>
            <th scope="col">year</th>
            <th scope="col">brand</th>
            <th scope="col">image</th>
            <th scope="col">price</th>
            <th scope="col">discount</th>

            <th scope="col">Actions</th>
		    </tr>
		  </thead>
		  <tbody>

      @foreach($allproducts as $product)

      <?php

        $max = 15;
        $str = " $product->name ";
        $name=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);



        ?>
          <td></td>
          <td>{{$name}}</td>
          <td>{{$product-> serial_number}}</td>
          <td>{{$product-> categorie}}</td>
          <td>{{$product-> situation}}</td>
          <td>{{$product-> year}}</td>
          <td>{{$product-> brand}}</td>
          <td>{{$product-> image}}</td>
          <td>{{$product-> price}}</td>
          <td>{{$product-> discount}}</td>
            <td>

            <a href="/section/products/edit/{{$product->id}}" class="btn btn-primary btn-group">Edit</a>


            <a href="/section/products/destroy/{{$product->id}}"  class="btn btn-danger btn-group"
              onclick="return confirm('Are you sure that you want delete this Product?');">
                      Remove</a>
        </td>
		    <tr>
    </tr>

    @endforeach






		  </tbody>
		</table>
    </div>
  </div>
</div>


</body>

</html>
