function ajxFunction(){

  var idEliminar=0;
  var productosCategories=[];
  var valoresCategories=[];
  var id = $("#id").val();
  var title = $('#title').val();
  var customer = $('#customer').val();
  var machine = $('#machine').val();
  var customer_report = $('.customer_report').val();
  var first_observations = $('.first_observations').val();
  var last_observations = $('.last_observations').val();
  var Productsoptions = $('select#mselect').val();

  alert('ooooooo' + id);

  $(document).ready(function(){
    alert('oi');
  $.ajax({
    url: '/section/workOrder/getQuantities',
    method: 'POST',
    data:{ 
      id:id,
      title:title,
      customer_report:customer_report,
      first_observations:first_observations,
      last_observations:last_observations,
      Productsoptions:Productsoptions,
      customer:customer,
      machine:machine,
      _token: $('input[name="_token"]').val()
    }
}).done(function(res){
  //   alert(res);
  //   alert('chegou aqui');
    // string to JSON
    alert('oi2');
    console.log(res);
    // var arreglo = JSON.parse(res);
    $resp = res;

    alert($resp);

    $("#h5").empty();
    $("span").removeClass("d-none");
    $.each($resp, function (key, value){
    $("#h5").append(`
        <div class="col-md-6">
            <label for="productName">Product Name</label>
            <input type="text"  class="form-control mb-2 mr-sm-2" value="`+value.name+`" placeholder="Product Name">
            <input type="hidden"  class="form-control mb-2 mr-sm-2"  name="productName[]" id="productName" value="`+ value.id+`" placeholder="Product ID">
            <input type="hidden"  class="form-control mb-2 mr-sm-2" value="`+id+`" name="id" id="workOrderId" class="workOrderId" >

            </div>
        <div class="col-md-6">
            <label  for="quantity">Quantity</label>
            <div class="input-group mb-2 mr-sm-2">
              <div class="input-group-prepend">
              </div>
              <input type="number"  class="form-control" name="quantity[]" id="quantity"  value="`+value.quantity +`" placeholder="Quantity">

            </div>
          </div>
      </div>
    `);
    })

    // FAZER A  BUSCA SOBRE OS PRODUTOS DESSE ID QUE E A QUANTIDADE DE PRODUTOS NEELES
    
    for(var x=0; x<arreglo.length; x++){
      // alert(10);
        console.log(arreglo);
        console.log(arreglo[x].id)
        console.log(arreglo[x].name)
        console.log(arreglo[x].SKU)
        console.log(arreglo[x].categoryName) 
        productosCategories.push(arreglo[x].categoryName);
        valoresCategories.push(arreglo[x].totalNproducts);
     }

   });

  });

}
 