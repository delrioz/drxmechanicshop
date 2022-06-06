<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>DIROXA SOFTWARE</title>

  <!-- Custom fonts for this template -->
  <link href="{{ asset('admlyt/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{ asset('admlyt/css/sb-admin-2.min.css') }}" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="{{ asset('admlyt/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

  <link href="{{ asset('jquery/multiselect/chosen.min.css') }}" rel="stylesheet">
  <script type="text/javascript" src="{{ asset('jquery/multiselect/jquery-3.5.1.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('jquery/multiselect/chosen.jquery.min.js') }}"></script>

</head>
    <span>
            @include('sections.components.topnavbar')
      </span>

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->



          <!-- DataTales Example -->
         <!------ Include the above in your HEAD tag ---------->
            <form action="/section/internalMachines/update/{{$allmachines->id}}" method="POST" id="registro" name="registro" enctype="multipart/form-data">
                            @csrf
            <section class="testimonial py-3" id="testimonial">
                <div class="container"  style="box-shadow: 0 4px 12px 0 rgba(0, 0, 2, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.19)">
                    <div class="row ">
                        <div class="col-md-12 py-5 border">
                            <h4 class="pb-2" style="color:black;"><b>Editing a Motorcycle. Please, fill out the form.</b></h4>
                                @if($errors->any())
                                  <div class="alert alert-danger">
                                      <ul>
                                        @foreach ($errors->all() as $error)
                                              <li>{{ $error }}</li>
                                        @endforeach
                                      </ul>
                                  </div>
                                @endif
                                <div class="form-row">
                                                <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->

                                <div class="form-group col-md-6">
                                  <label for="" style="text-align:center; color:black;"><b>Serial Number</b></label>
                                    <input id="serial_number" name="serial_number"  id="serial_number"  placeholder="serial_number" class="form-control" type="text"
                                    value="{{$allmachines->serial_number}}"
                                    disabled>
                                    <input id="serial_number" name="serial_number"  id="serial_number"  placeholder="serial_number" class="form-control" type="text"
                                    value="{{$allmachines->serial_number}}"
                                    hidden>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="" style="text-align:center;color:black;"><b>Model</b></label>
                                    <input id="model" name="model"
                                    maxlength="191"
                                    placeholder="model" class="form-control" type="text"
                                    value="{{$allmachines->model}}"
                                    required>
                                </div>
                            </div>

                         <?php
                              if($thisMachineCondition == 0){
                                    $statusName = "AVAILABLE FOR HIRING";
                                  }

                                else if($thisMachineCondition == 1){
                                    $statusName = "UNAVAILABLE FOR HIRING";
                                }

                                else if($thisMachineCondition == 2){
                                    $statusName = "WAITING FOR COLLECTION";
                                }

                                $price = number_format($allmachines->price, 2, '.',',');
                                $priceper2days = number_format($allmachines->priceper2days, 2, '.',',');
                                $priceper3days = number_format($allmachines->priceper3days, 2, '.',',');
                                $priceper1week = number_format($allmachines->priceper1week, 2, '.',',');


                          ?>


                          <div class="row">

                            <div class="form-group col-md-6">
                                <label for="" style="text-align:center;color:black;"><b>Brand</b></label>
                                  <input id="brand" name="brand"
                                      maxlength="191"
                                      placeholder="brand" class="form-control" type="text"
                                      value="{{$allmachines->brand}}"
                                      required>
                                </div>

                                <div class="form-group col-md-6">
                                        <label for="" style="color:black;"><b>Quantity</b></label>
                                          <input id="quantity" name="quantity"
                                            maxlength="191" value="{{$allmachines->quantity}}"
                                            placeholder="0.00" class="form-control" type="number" required>
                                  </div>
                        </div>

                        <div class="row">
                              <div class="form-group col-md-6">
                                      <label for="" style="color:black;"><b>SELL PRICE</b></label>
                                        <input id="valueMachine" name="valueMachine"
                                          maxlength="191"   value="{{$allmachines->valueMachine}}"
                                          placeholder="0.00" class="form-control" type="text" required>
                                </div>

                                <div class="form-group col-md-6">
                                      <label for="" style="color:black;"><b>COST PRICE MOTORCYCLE</b></label>
                                        <input id="costMachine" name="costMachine"
                                              maxlength="191"  value="{{$allmachines->costMachine}}"
                                              placeholder="0.00" class="form-control" type="text" required>
                                </div>
                        </div>

                          <span class="crossHireMachineInfos" id="crossHireMachineInfos">
                          @if($thisTypeMachine == 1 )
                                <div class="row">
                                        <div class="form-group col-md-4">
                                                  <label for="" style="color:black;"><b>Cross Hire Machine (per Day)</b></label>
                                                    <input id="crossHireMachinePrice" name="crossHireMachinePrice"
                                                      maxlength="191" value="{{$crossHireMachinePrice}}"
                                                      placeholder="crossHireMachinePrice" class="form-control" type="text"
                                                      required>
                                          </div>
                              </div>
                          @endif
                          </span>





                          <div class="form-row">
                                    <div class="form-group col-md-12">
                                    <label for="" style="color:black;"><b>Choose a Machine Image: </label><br>
                                      @if($allmachines->image !=null)
                                              <img src="/storage/{{$allmachines->image}}"
                                              alt="{{ $allmachines->image}}" style= "max-width: 250px;color:black;"><br>
                                      @endif
                                      <div class="form-group col-md-6">
                                          <input type="file" class="form-control-file" id="machineImage"
                                          name="machineImage" >
                                      </div>
                                  </div>
                              </div>

                            <span id="tableTitle" class="d-none">
                               <div class="title "><h3 style="text:center;"><b>Preview Products</b></h3></div>
                                  <div class="row">
                                  <table class="table">
                                      <thead>
                                        <tr>
                                          <th  style="font-family:verdana; color:black;">Image</th>
                                          <th style="font-family:verdana; font-size:100%; color:#38393b;">Name</th>
                                          <th style="font-family:verdana; font-size:100%; color:#38393b;">SKU</th>
                                          <th style="font-family:verdana; font-size:100%; color:#38393b;">Sell Price</th>
                                          <th style="font-family:verdana; font-size:100%; color:#38393b;">Quantity</th>
                                          <th style="font-family:verdana; font-size:100%; color:#38393b;">Created At</th>
                                        </tr>
                                      </thead>
                                      <tbody class="prodstables" id="prodstables">

                                      </tbody>
                                    </table>
                                </div>
                              </span>

                                <button type="submit" class="btn btn-warning">
                                  <i class="fa fa-save fa-1x " aria-hidden="true"></i>
                                  <b>Update Motorcycle</b>
                                </button>
                                @if($from == 'welcomePage')
                                  <a type="button" href="{{route('welcome') }}"  class="btn btn-danger"><b>Back</b></a>
                                @elseif($from == 'generalSearchPage')
                                  <a type="button" href="{{route('general.search') }}"  class="btn btn-danger"><b>Back</b></a>
                                  @else
                                      <a type="button" href="{{route('internalmachines.index') }}"  class="btn btn-danger"><b>Back</b></a>
                                  @endif
                            </form>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

    
    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    $(document).ready(function(){
        $('#mselect').chosen();
    });
  </script>


<script>
      $(document).ready(function(){

            // $('#ajaxSubmit').click(function(e){
              $(document).on("change", "#mselect", function(e){
              // var comboCidades = document.getElementById("option").value;
              var comboCidades = $('#mselect option:selected').val();
              var data=[];
              // alert(comboCidades)
              // data.push(comboCidades);
              var valor = $('#mselect').val();
              // var texto = $('#mselect :selected').text();

              // alert('valor ' + valor);
              // alert('texto ' + texto);


               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               $.ajax({
                  url: "{{ url('/section/products/getProdsAjax') }}",
                  method: 'post',
                  data: {
                     data: valor,
                     _token: '{{csrf_token()}}'},

                  success: function(result){

                    console.log(result);
                    // alert('PEGOOOOOOOOOOOU!')
                    // $('.prodstables').empty();
                    $("#tableTitle").removeClass("d-none")
                    $resp = result;
                    $('.prodstables').empty();
                    $.each($resp, function (key, value){
                      $(".prodstables").append(`
                            <tr>
                                <td style="font-family:verdana; color:black;"> <img src="/storage/`+ value.image + `" class="media-photo"
                                  style="width: 70px; height:70px;" alt="/storage/`+ value.image + `"></td>
                                <td style="font-family:verdana; color:black;">` + value.name + `</td>
                                <td style="font-family:verdana; color:black;">` + value.SKU + `</td>
                                <td style="font-family:verdana; color:black;">`+ value.Sell_PriceVat + `</td>
                                <td style="font-family:verdana; color:black;">`+ value.quantity + `</td>
                                <td style="font-family:verdana; color:black;">`+ value.created_at + `</td>
                            </tr>
                    `);
                  });

                    // window.location.href = "{{ route('customer.index') }}";
                    //  console.log(result);
                  },
                  error: function(jqXHR, textStatus, errorThrown, result) {
                      // console.log(jqXHR.responseJSON.errors)
                      $msg = 'oi';
                      $resp = jqXHR.responseJSON.errors;
                      $('.prodstables').empty();
                      $('.invalidData').empty();
                      $.each($resp, function (key, value){
                      $(".invalidData").append(`
                          <div class="alert alert-danger">
                              <ul>
                                <li>`+ value +`</li>
                              </ul>
                          </div>
                    `);
                  });
                  }
                  });
               });
            });
</script>

<script>
      $(document).ready(function(){

            // $('#ajaxSubmit').click(function(e){
              $(document).on("change", "#mselect", function(e){
              // var comboCidades = document.getElementById("option").value;
              var comboCidades = $('#mselect option:selected').val();
              var data=[];
              // alert(comboCidades)
              // data.push(comboCidades);
              var valor = $('#mselect').val();
              // var texto = $('#mselect :selected').text();

              // alert('valor ' + valor);
              // alert('texto ' + texto);


               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               $.ajax({
                  url: "{{ url('/section/products/getProdsAjax') }}",
                  method: 'post',
                  data: {
                     data: valor,
                     _token: '{{csrf_token()}}'},

                  success: function(result){

                    console.log(result);
                    // alert('PEGOOOOOOOOOOOU!')
                    // $('.prodstables').empty();
                    $("#tableTitle").removeClass("d-none")
                    $resp = result;
                    $('.prodstables').empty();
                    $.each($resp, function (key, value){
                      $(".prodstables").append(`
                            <tr>
                                <td style="color:black;font-family:verdana;"> <img src="/storage/`+ value.image + `" class="media-photo"
                                  style="width: 70px; height:70px;" alt="/storage/`+ value.image + `"></td>
                                <td style="color:black;font-family:verdana;">` + value.name + `</td>
                                <td style="color:black;font-family:verdana;">` + value.SKU + `</td>
                                <td style="color:black;font-family:verdana;">`+ value.Sell_PriceVat + `</td>
                                <td style="color:black;font-family:verdana;">`+ value.quantity + `</td>
                                <td style="color:black;font-family:verdana;">`+ value.created_at + `</td>
                            </tr>
                    `);
                  });

                    // window.location.href = "{{ route('customer.index') }}";
                    //  console.log(result);
                  },
                  error: function(jqXHR, textStatus, errorThrown, result) {
                      // console.log(jqXHR.responseJSON.errors)
                      $msg = 'oi';
                      $resp = jqXHR.responseJSON.errors;
                      $('.prodstables').empty();
                      $('.invalidData').empty();
                      $.each($resp, function (key, value){
                      $(".invalidData").append(`
                          <div class="alert alert-danger">
                              <ul>
                                <li>`+ value +`</li>
                              </ul>
                          </div>
                    `);
                  });
                  }
                  });
               });
            });
</script>


<script>
      $(document).ready(function(){

            // $('#ajaxSubmit').click(function(e){
              $(document).on("change", "#typemachine", function(e){
                var typemachine = $('#typemachine option:selected').val();
                // alert(typemachine);

                if(typemachine == 1)
                {
                  $('.crossHireMachineInfos').empty();
                  $("#crossHireMachineInfos").append(`
                      <div class="row">
                                   <div class="form-group col-md-4">
                                            <label for="" style="color:black;"><b>Cross Hire Machine (per Day)</b></label>
                                              <input id="crossHireMachinePrice" name="crossHireMachinePrice"
                                                maxlength="191" value="{{ old('crossHireMachinePrice') }}"
                                                placeholder="crossHireMachinePrice" class="form-control" type="text"
                                                required>
                                    </div>
                        </div>
                    `);
                }

                else{
                  $('.crossHireMachineInfos').empty();
                }



               e.preventDefault();
               });
            });
</script>


<!-- <script>
    function myFunction()
    {
        var price = document.getElementById("price").value;
        // var price2days = document.getElementById("price2days").value;
        // var price3days = document.getElementById("price3days").value;
        // var price1week = document.getElementById("price1week").value;
          //muda a casa decimal dos valores

        // document.getElementById("Sell_PriceVat").value = sellPrice;
        var new2daysprice =  (price * 2).toFixed(2);
        var new3daysprice =  (price * 3).toFixed(2);
        var new1week =  (price * 7).toFixed(2);

        if(price == "NaN" || new2daysprice == "NaN" || new3daysprice == "NaN" || new1week == "NaN"){
            // document.getElementById("Sell_PriceVat").value = sellPrice;
            var price =  (0).toFixed(2);
            var new2daysprice =  (0).toFixed(2);
            var new3daysprice =  (0).toFixed(2);
            var new1week =  (0).toFixed(2);

            document.getElementById("price").value = price;
            document.getElementById("price2days").value = new2daysprice;
            document.getElementById("price3days").value = new3daysprice;
            document.getElementById("price1week").value = new1week;
        }
        else {
            document.getElementById("price2days").value = new2daysprice;
            document.getElementById("price3days").value = new3daysprice;
            document.getElementById("price1week").value = new1week;
        }
    }
</script>
 -->

 <script>
      $("#price").on("change",function(){
        $(this).val(parseFloat($(this).val()).toFixed(2));
      });

      $("#price2days").on("change",function(){
        $(this).val(parseFloat($(this).val()).toFixed(2));
        var price2days = document.getElementById("price2days").value;
        if(price2days == "NaN"){
              var new2daysprice =  (0).toFixed(2);
              document.getElementById("price2days").value = new2daysprice;
          }
      });

      $("#price3days").on("change",function(){
        $(this).val(parseFloat($(this).val()).toFixed(2));
        var price3days = document.getElementById("price3days").value;
        if(price3days == "NaN"){
              var new3daysprice =  (0).toFixed(2);
              document.getElementById("price3days").value = new3daysprice;
          }
      });

      $("#price1week").on("change",function(){
        $(this).val(parseFloat($(this).val()).toFixed(2));
        var price1week = document.getElementById("price1week").value;
        if(price1week == "NaN"){
              var new1week =  (0).toFixed(2);
              document.getElementById("price1week").value = new1week;
          }
      });

      $("#depositSuggest").on("change",function(){
        $(this).val(parseFloat($(this).val()).toFixed(2));
        var depositSuggest = document.getElementById("depositSuggest").value;
        if(depositSuggest == "NaN"){
              var new1week =  (0).toFixed(2);
              document.getElementById("depositSuggest").value = new1week;
          }
      });
      $("#valueMachine").on("change",function(){
        $(this).val(parseFloat($(this).val()).toFixed(2));
        var valueMachine = document.getElementById("valueMachine").value;
        if(valueMachine == "NaN"){
              var new1week =  (0).toFixed(2);
              document.getElementById("valueMachine").value = new1week;
          }
      });


      $("#costMachine").on("change",function(){
        $(this).val(parseFloat($(this).val()).toFixed(2));
        var costMachine = document.getElementById("costMachine").value;
        if(costMachine == "NaN"){
              var new1week =  (0).toFixed(2);
              document.getElementById("costMachine").value = new1week;
          }
      });


</script>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('admlyt/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


  <!-- Core plugin JavaScript-->
  <script src="{{ asset('admlyt/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('admlyt/js/sb-admin-2.min.js') }}"></script>

  <!-- Page level plugins -->

  <script src="{{ asset('admlyt/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('admlyt/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>


  <!-- Page level custom scripts -->
  <script src="{{ asset('admlyt/js/demo/datatables-demo.js') }}"></script>

</body>

</html>
