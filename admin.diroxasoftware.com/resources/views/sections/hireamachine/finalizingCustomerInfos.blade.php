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
            <form action="{{route('hiremachine.storehiring')}}" method="POST" id="registro" name="registro" enctype="multipart/form-data">
                @csrf

            <section class="testimonial py-3" id="testimonial">
                <div class="container"  style="box-shadow: 0 4px 12px 0 rgba(0, 0, 2, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.19)">
                    <div class="row ">
                        <div class="col-md-12 py-5 border">
                            <h4 class="pb-2" style="color:black;"><b>Machine Hiring section/Machine's infos.</b></h4>
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
                                        disabled>
                                </div>

                            </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                      <label for="" style="text-align:center;color:black;"><b>Brand</b></label>
                                      
                                        <input id="brand" name="brand"
                                                maxlength="191"
                                                placeholder="brand" class="form-control" type="text"
                                                value="{{$allmachines->brand}}"
                                                disabled>
                                    </div>
                                </div>

                            <div class="row">
                                    @if(count($allproducts)  > 0)
                                        <div class="form-group">
                                            <div class="form-group col-md-12">
                                              <label for="" style='color:black;'><b>Products in this machine</b></label><br>
                                              <select id="mselect" multiple style="width:300px;"  name="Productsoptions[]" disabled>
                                            @if($statusNulo == false)
                                              @foreach($respostaProducts as $products)
                                                <option id="option" value="{{$products->id}}">{{$products->name}}</option>
                                              @endforeach

                                              @foreach($outrasop as $op)
                                              <option id="option" value="{{$op->product_id}}" selected>{{$op->productName}}</option>
                                              @endforeach
                                            @endif

                                            @if($statusNulo == true)
                                              @foreach($outrasop as $op)
                                              <option id="option" value="{{$op->product_id}}" selected>{{$op->productName}}</option>
                                              @endforeach
                                            @endif

                                              </select>
                                          </div>
                                        </div>
                                      @endif
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

                        ?>

                         <div class="row">
                                    <div class="form-group col-md-6">
                                          <label for="" style="color:black;"><b>STATUS</b></label>
                                                      <!-- <select id="condition" name="condition" class="form-control categoriesOptions" >
                                                          <option value="0">AVAILABLE FOR HIRING</option>
                                                          <option value="1">UNAVAILABLE FOR HIRING</option>
                                                      </select> -->

                                                      <select id="condition" name="condition" class="form-control" disabled>
                                                          @if($thisMachineCondition == 0 )
                                                          <option value="{{$thisMachineCondition}}" selected>{{$statusName}}</option>
                                                          <option value="1">UNAVAILABLE FOR HIRING</option>
                                                          @elseif($thisMachineCondition == 1)
                                                          <option value="{{$thisMachineCondition}}" selected>{{$statusName}}</option>
                                                          <option value="0">AVAILABLE FOR HIRING</option>
                                                          @else
                                                            <option value="0">AVAILABLE FOR HIRING</option>
                                                            <option value="1">UNAVAILABLE FOR HIRING</option>
                                                          @endif
                                                  </select>
                                        </div>
                                    <div class="form-group col-md-6">
                                          <label for="" style="color:black;"><b>Price per hour</b></label>
                                            <input id="machinePrice" name="machinePrice"
                                                    maxlength="191"
                                                    placeholder="machinePrice" class="form-control" type="text"
                                                    value="£50.00"
                                                    disabled>
                                        </div>
                          </div>
                        <hr>
                      
                        <input id="machineId" name="machineId"
                                    maxlength="191"
                                    placeholder="machineId" class="form-control" type="text"
                                    value="{{$allmachines->id}}"
                                    hidden>

                            <span id="tableTitle" class="d-none">
                               <div class="title "><h3 style="text:center;"><b>Customer's data</b></h3></div>
                                  <div class="row">
                                  <table class="table">
                                      <thead>
                                        <tr>
                                          <th  style="font-family:verdana; color:black;">Image</th>
                                          <th style="font-family:verdana; font-size:100%; color:#38393b;">Name</th>
                                          <th style="font-family:verdana; font-size:100%; color:#38393b;">Telephone</th>
                                          <th style="font-family:verdana; font-size:100%; color:#38393b;">Email</th>
                                        </tr>
                                      </thead>
                                      <tbody class="prodstables" id="prodstables">

                                      </tbody>
                                    </table>
                                </div>
                              </span>

                              <div class="col-md-12 py-5 border">
                            <h4 class="pb-2" style="color:black;"><b>Selected Customer data </b></h4>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                    <label for="" style="color:black;"> Name: </label>
                                        <input id="name" name="name"  id="name"
                                          value="{{$thisCustomer->name}}" disabled
                                          placeholder="Name" class="form-control" type="text" >
                                    </div>
                                    </div>
                                    <!-- 'name', 'nationality', 'address', 'about', 'nameofbusiness', 'email' -->

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                    <label for="" style="color:black;"> Contact Number: </label>
                                    <input id="telephone" name="telephone" 
                                            maxlength="191" 
                                            value="{{$thisCustomer->telephone}}" disabled
                                            placeholder="telephone" class="form-control" type="text" >
                                    </div>


                                        <div class="form-group col-md-6">
                                            <label for="" style="color:black;"> Email: </label>
                                            <input id="email" name="email" 
                                            value="{{$thisCustomer->email}}" disabled
                                            maxlength="191" 
                                            placeholder="email" class="form-control" type="text" >
                                        </div>

                                        <input id="customerId" name="customerId" hidden
                                            value="{{$thisCustomer->id}}" 
                                            maxlength="191" 
                                            placeholder="customerId" class="form-control" type="text" >

                                        <div class="row">
                                            <div class="form">
                                                <label for="" style="color:black;"><b>Id</b></label><br>
                                                <div class="form-group col-md-12">

                                                @if($thisCustomer->idimage !="default.png")
                                                  <img src="/storage/{{$thisCustomer->idimage}}""
                                                  alt="{{ $thisCustomer->idimage}}" style= "max-width: 250px;color:black;">

                                                  <input type="file" class="form-control-file" id="exampleFormControlFile1"
                                                name="idimage">
                                                @else
                                                  <input type="file" class="form-control-file" id="exampleFormControlFile1"
                                                  name="idimage"required >
                                                @endif

                                            </div>
                                            </div>
                                        </div>  
                                        <div class="row">
                                                <div class="form">
                                                    <label for="" style="color:black;"><b>Proof of address</b></label><br>
                                                        <div class="form-group col-md-12">
                                                    @if($thisCustomer->proofOfAddress !="default.png")
                                                      <img src="/storage/{{$thisCustomer->proofOfAddress}}""
                                                      alt="{{ $thisCustomer->proofOfAddress}}" style= "max-width: 250px;color:black;">
                                                      <input type="file" class="form-control-file" id="exampleFormControlFile1"
                                                      name="proofOfAddress">
                                                    @else
                                                    <input type="file" class="form-control-file" id="exampleFormControlFile1"
                                                    name="proofOfAddress" required>
                                                    @endif

                                                </div>
                                              </div>
                                      </div>
                                </div>
                        </div>

                                <button type="submit" class="btn btn-warning">
                                  <i class="fa fa-save fa-1x " aria-hidden="true"></i>
                                  <b>Save customer data's and proceed</b>
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

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Diroxa Software 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

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
              $(document).on("change", "#owner", function(e){
              // var comboCidades = document.getElementById("option").value;
              var comboCidades = $('#mselect option:selected').val();
              var data=[];  
              // alert(comboCidades)
              // data.push(comboCidades);
              var valor = $('#owner').val();
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
                  url: "{{ url('/section/hireamachine/findCustomer') }}",
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
                    // alert($resp);
                    
                    $('.prodstables').empty();
                      $(".prodstables").append(`
                            <tr>
                                <td style="color:black;font-family:verdana;"> <img src="/storage/`+ $resp.image + `" class="media-photo"
                                  style="width: 70px; height:70px;" alt="/storage/`+ $resp.image + `"></td>
                                <td style="color:black;font-family:verdana;">` + $resp.name + `</td>
                                <td style="color:black;font-family:verdana;">` + $resp.telephone + `</td>
                                <td style="color:black;font-family:verdana;">`+ $resp.email + `</td>
                            </tr>
                    `);
                    // window.location.href = "{{ route('customer.index') }}";
                    //  console.log(result);
                  },
                  error: function(jqXHR, textStatus, errorThrown, result) {
                      // console.log(jqXHR.responseJSON.errors)
                      alert(2);
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
