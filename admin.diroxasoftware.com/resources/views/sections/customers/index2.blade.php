
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
     <h3>Existing Customers:</h3>
  </div>
  <a href="/section/customers/create"  class="btn btn-primary btn-group">Add new Customer</a><br>
  <br>
  



<div class="container">
  <div class="row">
    <div class="col-12">
		<table class="table table-image">
		  <thead>
		    <tr>
		      <th scope="col"></th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Address</th>
            <th scope="col">About</th>
            <th scope="col">Name of Business</th>
            <th scope="col">Nationality</th>
            <th scope="col">Actions</th>
		    </tr>
		  </thead>
		  <tbody>

      @foreach($allcustomers as $customer)

      <?php

        $max = 10;
        $str = " $customer->about ";
        $about=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

        $max = 18;
        $str = " $customer->nameofbusiness";
        $nameofbusiness =  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


        $max = 15;
        $str = " $customer->address";
        $address =  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);
        
        $max = 15;
        $str = " $customer->name";
        $name =  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);
        
        
        ?>
          <td></td>
          <td>{{$name}}</td>
          <td>{{$customer-> email}}</td>
          <td>{{$address}}</td>
          <td>{{$about}}</td>
          <td>{{$nameofbusiness}}</td>
          <td>{{$customer-> nationality}}</td>
            <td>

            <a href="/section/customers/edit/{{$customer->id}}" class="btn btn-primary btn-group">Edit</a>


            <a href="/section/customers/destroy/{{$customer->id}}"  class="btn btn-danger btn-group"
              onclick="return confirm('Are you sure that you want delete this Customer?');">
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
