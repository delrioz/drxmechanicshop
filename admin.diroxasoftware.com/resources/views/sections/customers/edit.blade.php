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

            <form action="/section/customers/update/{{$allcustomers->id}}" method="POST" id="registro" name="registro" enctype="multipart/form-data">
                            @csrf
            <section class="testimonial py-3" id="testimonial">
                <div class="container"  style="box-shadow: 0 4px 12px 0 rgba(0, 0, 2, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.19)">
                    <div class="row ">
                        <div class="col-md-12 py-5 border">
                            <h4 class="pb-2" style="color:black;"><b>Editing a Customer. Please, fill out the form</b></h4>
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
                                    <div class="form-group col-md-12">
                                    <label for="" style="color:black;"> <b>Name:</b> </label>
                                        <input id="name" name="name"  id="name"  placeholder="Name" class="form-control" type="text" 
                                        value="{{$allcustomers->name}}"
                                        required>
                                    </div>
                                    </div>
                                    <!-- 'name', 'nationality', 'address', 'about', 'nameofbusiness', 'email' -->

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                    <label for="" style="color:black;"> <b>Main Contact Number:</b> </label>
                                    <input id="telephone" name="telephone" 
                                            maxlength="191" 
                                            placeholder="Contact Number" class="form-control" type="text" 
                                            value="{{$allcustomers->telephone}}"
                                            required>
                                            <a href="#addmorephone" id="addmorephone" class="addmorephone">add more</a>

                                            @if($findNewNumbers != null)
                                            <br> <label for="" style="color:black;"> 
                                                <b> More Contact Number:</b> </label>
                                             @foreach($findNewNumbers as $NewNumber)
                                              <span id="newtelephones" class="newtelephones">
                                              <br> 
                                            <div class="row">
                                                <div class="col-md-6">
                                                  <input id="newtelephones" name="newtelephones[]" 
                                                  maxlength="191" 
                                                  placeholder="Contact Number" class="form-control" type="text" 
                                                  value="{{$NewNumber->telephoneNumber}}"
                                                  required>
                                              </div>

                                                <div class="col-md-6">
                                                            <a href="" id="removeRow" name="removeRow" class="btn btn-danger">Remove</a>
                                                </div>
                                            </div>
                                              @endforeach
                                            @endif
                                            <span id="newtelephones2" class="newtelephones2">
                                            </span>
                            
                                    </div>

                                        <div class="form-group col-md-6">
                                        <label for="" style="color:black;"> <b>Email:</b> </label>
                                            <input id="email" name="email" 
                                            maxlength="191" 
                                            placeholder="email" class="form-control" type="text"
                                            value="{{$allcustomers->email}}"
                                             required>
                                        </div>
                                </div>

                                <input type="text" name="StatusbackRoute" id="StatusbackRoute" value="{{$backRoute}}" hidden>
                                <input type="text" name="customerId" id="customerId" value="{{$allcustomers->id}}" hidden>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                    <label for="" style="color:black;"> <b>Address: </label>

                                    <input id="address" name="address" 
                                            maxlength="191" value="{{$allcustomers->address}}"
                                            placeholder="address" class="form-control" type="text" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                    <label for="" style="color:black;"> <b>Profile Image: </label><br>
                                      @if($allcustomers->image !=null)
                                              <img src="/storage/{{$allcustomers->image}}""
                                              alt="{{ $allcustomers->image}}" style= "max-width: 250px;color:black;">
                                      @endif
                                      <div class="form-group col-md-6">
                                          <input type="file" class="form-control-file" id="exampleFormControlFile1"
                                          name="image" >
                                      </div>
                                  </div>                                 
                              </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                    <label for="" style="color:black;"> <b>Id Image: </label><br>
                                      @if($allcustomers->idimage !=null)
                                       <img src="/storage/{{$allcustomers->idimage}}""
                                        alt="{{ $allcustomers->idimage}}" style= "max-width: 250px;color:black;">
                                      @endif
                                      <div class="form-group col-md-6">
                                          <input type="file" class="form-control-file" id="exampleFormControlFile1"
                                          name="idimage" >
                                      </div>
                                  </div>                                 
                              </div>
                              
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                    <label for="" style="color:black;"> <b>Proof of address: </label><br>
                                      @if($allcustomers->proofOfAddress !=null)
                                        <img src="/storage/{{$allcustomers->proofOfAddress}}""
                                          alt="{{ $allcustomers->proofOfAddress}}" style= "max-width: 250px;color:black;">
                                      @endif
                                      <div class="form-group col-md-6">
                                        <input type="file" class="form-control-file" id="proofOfAddress"
                                        name="proofOfAddress">
                                      </div>
                                  </div>                                 
                              </div>

                                <button type="submit" class="btn btn-success">
                                  <i class="fa fa-save fa-1x " aria-hidden="true"></i>
                                    <b>Edit Customer</b>
                                </button>
                                @if($backRoute == 'customerViewPage')
                                <a type="button" class="btn btn-danger" href="/section/customers/viewPage/{{$allcustomers->id}}">
                                  <i class="fa fa-save fa-1x " aria-hidden="true"></i>
                                    <b>Back</b>
                                </a>
                                @elseif($backRoute == 'customerIndex')
                                  <a type="button" class="btn btn-danger" href="/section/customers/">
                                    <i class="fa fa-save fa-1x " aria-hidden="true"></i>
                                      <b>Back</b>
                                  </a>
                                @elseif($backRoute == 'choosingmachine')
                                  <a type="button" class="btn btn-danger" href="/section/hireamachine/viacustomer/choosingmachine/{{$idMachineFrom}}/{{$allcustomers->id}}">
                                    <i class="fa fa-save fa-1x " aria-hidden="true"></i>
                                      <b>Back</b>
                                  </a>
                                @elseif($backRoute == 'hiresmachinesviewpage')
                                  <a type="button" class="btn btn-danger" href="/section/customers/viewPage/{{$allcustomers->id}}">
                                    <i class="fa fa-save fa-1x " aria-hidden="true"></i>
                                      <b>Back</b>
                                  </a>
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

  <script>
   $(document).ready(function(){
          // $('#ajaxSubmit').click(function(e){
            $(document).on("click", "#removeRow", function(e){
            e.preventDefault();
            $(this).parent().parent().remove();
       
            });
          });
</script>


<script>
      $(document).ready(function(){
            // $('#ajaxSubmit').click(function(e){
              $(document).on("click", "#addmorephone", function(e){
              // var comboCidades = document.getElementById("option").value;
              var comboCidades = $('#mselect option:selected').val();
              var data=[];  
              // alert(comboCidades)
              // data.push(comboCidades);
              var valor = $('#mselect').val();
              // var texto = $('#mselect :selected').text();
              
              // alert('valor ' + valor);
              // alert('texto ' + texto);

              $('.addmorephone').empty();
              $(".newtelephones2").append(`<br>
                      <div class="row">
                            <div class="col-md-6">
                                  <input id="newtelephones" name="newtelephones[]"  
                                  maxlength="191" 
                                  placeholder="New Number" class="form-control" type="text" required>
                            </div>
                            <div class="col-md-6">
                                <a href="" id="removeRow" name="removeRow" class="btn btn-danger">Remove</a>
                            </div>
                      </div>

                      <a href="#addmorephone" id="addmorephone" class="addmorephone">add more</a>
                  
                  `);

              
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
                                <td> <img src="/storage/`+ value.image + `" class="media-photo"
                                  style="width: 70px; height:70px;" alt="/storage/`+ value.image + `"></td>
                                <td>` + value.name + `</td>
                                <td>` + value.SKU + `</td>
                                <td>`+ value.Sell_PriceVat + `</td>
                                <td>`+ value.quantity + `</td>
                                <td>`+ value.created_at + `</td>
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

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('admlyt/vendor/jquery/jquery.min.js') }}"></script>
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
