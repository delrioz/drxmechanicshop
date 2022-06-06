

<!DOCTYPE html>
<html lang="en">
<head>
<title>Commenting Sounds - Cadastrando Músicas</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>



    <br><br><br>


 <style>
  
  img {width:100%;}

   #btnRoxo{
      background: #1497ff;
      color: #fff;
      border-color: #1497ff;
  }

     #maincolor{  
      background: #0066cc;
   }


</style>





  @if($errors->any())
     @foreach($errors->all() as $error)
     <br>
        <div class="alert alert-danger">

        {{ $error }}
        </div>

        @endforeach

 @elseif(session()->has('success'))
         <div class="alert alert-success">

       {{ session('success') }}
 @endif
        </div>






<!------ Include the above in your HEAD tag ---------->

<form action="/section/workOrder/update/{{$allworkOrders->id}}" method="POST" id="registro" name="registro" enctype="multipart/form-data">
                 @csrf
<section class="testimonial py-5" id="testimonial">
    <div class="container"  style="box-shadow: 0 4px 12px 0 rgba(0, 0, 2, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.19)">
        <div class="row ">
            <div class="col-md-4 py-5 bg-primary text-white text-center "
             id="btnRoxo">
                <div class=" ">
                    <div class="card-body">
                        <h2 class="py-3">Editing Work Order</h2>
                <br>
                      </div>
                  </div>
              </div>
              <div class="col-md-8 py-5 border">
                  <h4 class="pb-4">Please fill out all fields.</h4>

                    


                      <div class="form-row">
                          <div class="form-group col-md-6">
                          <input id="name" name="name" 
		                          maxlength="191" 
		                         placeholder="name" class="form-control" type="text"
                                 value ="{{$allworkOrders-> name}}"
                                 required>
                   
                          </div>

                          	<div class="form-group col-md-6">
		                        <input id="customer_report" name="customer_report" 
		                          maxlength="191" 
		                         placeholder="customer_report" class="form-control" type="text" 
                                 value ="{{$allworkOrders-> customer_report}}"
                                required>
	                        </div>
                       </div>


                      <div class="form-row">
                          <div class="form-group col-md-6">
                          <input id="first_observations" name="first_observations" 
		                          maxlength="191" 
		                         placeholder="first_observations " class="form-control" type="text" 
                                 value ="{{$allworkOrders-> first_observations}}"
                                 required>
                   
                          </div>

                          	<div class="form-group col-md-6">
		                        <input id="previous_observations" name="previous_observations" 
		                          maxlength="191" 
		                         placeholder="previous_observations" class="form-control" type="text" 
                                 value ="{{$allworkOrders-> previous_observations}}"
                                 required>
	                        </div>
                       </div>

                      <div class="form-row">
                          <div class="form-group col-md-6">
                          <input id="customer" name="customer" 
		                          maxlength="191" 
		                         placeholder="customer " class="form-control" type="text"
                                 value ="{{$allworkOrders-> customer}}"
                                 required>
                   
                          </div>

                          	<div class="form-group col-md-6">
		                        <input id="vehicle" name="vehicle" 
		                          maxlength="191" 
		                         placeholder="vehicle" class="form-control" type="text" 
                                 value ="{{$allworkOrders-> vehicle}}"
                                 required>
	                        </div>
                       </div>

                          	

                      <div class="form-row">
                          <div class="form-group col-md-6">
                          <input id="status" name="status" 
		                          maxlength="191" 
		                         placeholder="status " class="form-control" type="text"
                                 value ="{{$allworkOrders-> status}}"
                                 required>
                   
                          </div>

                          	<div class="form-group col-md-6">
		                        <input id="typeofpayment" name="typeofpayment" 
		                          maxlength="191" 
		                         placeholder="typeofpayment" class="form-control" type="text" 
                                 value ="{{$allworkOrders-> typeofpayment}}"
                                 required>
	                        </div>
                       </div>

                          	


                      <button type="submit" class="btn btn-warning">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</section>




<script>


    // verifica se o documento foi completamente carregado
    $(document).ready(function () {



      $("#cep").mask("99.999-999");

      
//id do form
      $("#registro").submit(function(){
          $("#cep").unmask();

    });


    
        // disparado quando o usuário alterar o cep
        $("#cep").change(function () {

            var cep = $(this).val().replace(/\D/g, '');

            $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/", function(dados) {

                if (!("erro" in dados)) {
                  $("#endereco").val(dados.logradouro); //endereco
                $("#bairro").val(dados.bairro); //bairro
                $("#municipio").val(dados.localidade); //cidade //estado
                $("#UF").val(dados.uf); //estado
                }
            });

        });


        $("#celular").change(function() {
            var celular = $(this).val().replace(/\D/g, '');
            $.getJSON("https://localhost/pelomundo/api.php?celular="+ celular, function(dados) {
            if (!("erro" in dados)){
                $("#cpf").val(dados.cpf);
                $("#nome").val(dados.nome);
            }
        });

    });
    
    });

</script>