
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
     <h3>Jobs oppen:</h3>
  </div><br>



<div class="container">
  <div class="row">
    <div class="col-12">
		<table class="table table-image">
		  <thead>
		    <tr>
		      <th scope="col"></th>
            <th scope="col">Name</th>
            <th scope="col">Type</th>
            <th scope="col">About</th>
            <th scope="col">Client</th>
            <th scope="col">Product/Machine</th>
            <th scope="col">Actions</th>
		    </tr>
		  </thead>
		  <tbody>

      @foreach($jobs as $jb)

          <td></td>
          <td>{{$jb-> name}}</td>
          <td>{{$jb-> type}}</td>
          <td>{{$jb-> about}}</td>
          <td>{{$jb-> client}}</td>
          <td>{{$jb-> machineName}}</td>
            <td>

            <a href="/newjob/edit/{{$jb->id}}" class="btn btn-primary btn-group">Edit</a>


            <a href="/newjob/delete/{{$jb->id}}"  class="btn btn-danger btn-group"
              onclick="return confirm('Deseja realmente excluir a ordem de serviço?');">
                      Remove</a>
        </td>
		    <tr>
    </tr>

    @endforeach



    <div class="container">

        <div class="alert alert-danger" role="alert">
        Você ainda não publicou nenhuma música!
        </div>
        <a href="/home" class="btn btn-danger">Voltar</a>
        <a href="/newjob" class="btn btn-warning" >Publicar</a>
    </div>




		  </tbody>
		</table>
    </div>
  </div>
</div>


</body>

</html>
