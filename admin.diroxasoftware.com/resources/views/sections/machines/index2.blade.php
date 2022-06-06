
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
     <h3>Existing Vehicles:</h3>
  </div>
  <a href="/section/vehicles/create"  class="btn btn-primary btn-group">Add new Vehicle</a><br>
  <br>
  



<div class="container">
  <div class="row">
    <div class="col-12">
		<table class="table table-image">
		  <thead>
		    <tr>        

		      <th scope="col"></th>
            <th scope="col">Plate</th>
            <th scope="col">brand</th>
            <th scope="col">model</th>
            <th scope="col">colour</th>
            <th scope="col">year</th>
            <th scope="col">owner</th>

            <th scope="col">Actions</th>
		    </tr>
		  </thead>
		  <tbody>

      @foreach($allvehicles as $vehicle)

      <?php

        $max = 15;
        $str = " $vehicle->owner ";
        $owner=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


        ?>
          <td></td>
          <td>{{$vehicle-> plate}}</td>
          <td>{{$vehicle-> brand}}</td>
          <td>{{$vehicle-> model}}</td>
          <td>{{$vehicle-> colour}}</td>
          <td>{{$vehicle-> year}}</td>
          <td>{{$owner}}</td>
            <td>

            <a href="/section/vehicles/edit/{{$vehicle->id}}" class="btn btn-primary btn-group">Edit</a>


            <a href="/section/vehicles/destroy/{{$vehicle->id}}"  class="btn btn-danger btn-group"
              onclick="return confirm('Are you sure that you want delete this vehicle?');">
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
