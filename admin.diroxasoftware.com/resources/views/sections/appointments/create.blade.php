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



    <form action="/section/appointments/store" method="POST" id="registro" name="registro" enctype="multipart/form-data">
        @csrf
        <section class="testimonial py-3" id="testimonial">
                <div class="container"  style="box-shadow: 0 4px 12px 0 rgba(0, 0, 2, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.19)">
                    <div class="row ">
                        <div class="col-md-12 py-5 border">
                            <h4 class="pb-2" style="color:black;"><b>Book Appointment</b></h4>
                            <div class="alert alert-warning">
                              <p><a href="/section/appointments/index">See all Appointments</a></p>
                            </div>

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
                                    <div class="form-group col-md-6">
                                    <label for="" style="text-align:center;color:black;"><b>Title</b></label>
                                        <input id="name" name="name"  id="name" 
                                         value="{{ old('name') }}"
                                         placeholder="Keep it empty for no title" class="form-control" type="text"
                                         >
                                    </div>
                              

                                    <div class="form-group col-md-6">
                                    <label for="" style="text-align:center;color:black;"><b>Choose Date</b></label>
                                          <input id="appointmentDate" name="appointmentDate"  id="appointmentDate" 
                                          value="{{ old('appointmentDate') }}"
                                          placeholder="Keep it empty for no appointmentDate" class="form-control"
                                          type="datetime-local">
                                    </div>

                                </div>
                     
                            <div class="form-row">
                                  <label for="" style="color:black;"><b> Observation: </b></label>
                                        <div class="form-group col-md-12"> 
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                            name="about" placeholder="Observation" 
                                          value="{{ old('about') }}" id="about" ></textarea>
                                        </div>
                            </div>  
                            
                            <div class="row">
                                  <div class="form-group col-md-6">
                                            <label for="" style="text-align:center;color:black;"><b>Customer</label>
                                            <select id="customerId" name="customerId" class="form-control" required>
                                                  @foreach($allcustomers as $customer)
                                                  <option value="{{$customer->id}}" >{{$customer->name}}</option>
                                                  @endforeach
                                            </select>
                                            <a href="/section/customers/create"><b>Create a customer</b></a>
                                  </div>            
                            </div>
                
                              <button type="submit" class="btn btn-success">
                              <i class="fa fa-check fa-1x " aria-hidden="true"></i>
                              <b>Save Outgoing</b></button>

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




  
      <!-- minha modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add new Category</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form  id="myForm" enctype="multipart/form-data" >
                            @csrf
              <div class="row">
                  <div class="col-md-12">
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Category name:</label>
                          <input id="categoryName" categoryName="categoryName"  id="categoryName"  placeholder="categoryName" class="form-control" type="text" required>
                        </div>
                  </div>
              </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">About / Description: *(NOT REQUIRED)*</label>
                  <textarea class="form-control" id="categoryAbout" rows="3"
                  name="categoryAbout" 
                  placeholder="categoryAbout" id="categoryAbout" required>Nothing to add</textarea>
                </div>
         
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button type="submit" id="ajaxSubmit" class="btn btn-success ajaxSubmit ">Add Category</button>

            </div>
          </form>
          </div>

          <!-- end of modal -->


          <script>

function EnableVatPrice(checkbox1)
{
   var sellpricevat = document.getElementById("Sell_PriceVatView");



   sellpricevat.disabled=checkbox1.checked ? false: true;
   
   if(!sellpricevat.disabled)
   {
    document.getElementById("Sell_PriceVatView").disabled = false;
   }

   else {
     document.getElementById("Sell_PriceVatView").disabled = true;
   }
}

function vatToNormalPrice(){
      var sellPriceVat = document.getElementById("Sell_PriceVat").value;
      var sellPrice = document.getElementById("Sell_Price").value;

      var sellpricelessvat = (sellPriceVat / 1.20).toFixed(2);

      

      // alert(sellPrice)
      // adicionando valor no campo sellprice TIRANDO OS 20 % DO VAT INCLUSO
      document.getElementById("Sell_Price").value = 0; 
      document.getElementById("Sell_Price").value = sellpricelessvat; 
  }
</script>

<script type="text/javascript">
  $(document).ready(function(){
      $('#mselect').chosen();
  });
</script>



<script>

$("#Sell_Price").on("change",function(){
  $(this).val(parseFloat($(this).val()).toFixed(2));
});

$("#Sell_PriceVat").on("change",function(){
  $(this).val(parseFloat($(this).val()).toFixed(2));
});

$("#Cost_Price").on("change",function(){
  $(this).val(parseFloat($(this).val()).toFixed(2));
});


function myFunction()
{
    var sellPrice = document.getElementById("Sell_Price").value;
      //muda a casa decimal dos valores


    // document.getElementById("Sell_PriceVat").value = sellPrice; 
    var takingVatPrice =   (sellPrice * 1.20).toFixed(2);

    document.getElementById("Sell_PriceVat").value = takingVatPrice; 
}

</script>


<script>
    $(document).ready(function(){

          $('#ajaxSubmit').click(function(e){
             e.preventDefault();
             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
             $.ajax({
                url: "{{ url('/section/categories/storeAjax') }}",
                method: 'post',
                data: {
                   name: $('#categoryName').val(),
                   about: $('#categoryAbout').val(),
                   _token: '{{csrf_token()}}'},
                  success: function(result){
                  alert('Category Add!')
                  // window.location.href = "{{ route('customer.index') }}";
                    console.log(result);
                    document.getElementById('categoryName').value = '';
                    document.getElementById('categoryAbout').value = '';
                    document.getElementById('categoryAbout').value = 'Nothing to add';
                    $('.categoriesOptions').empty();
                    $resp = result;
                    $.each($resp, function (key, value){
                    $(".categoriesOptions").append(`
                       <option value="`+ value.id + `">`+ value.name + `</option>
                  `);
                });

                    
                },
                error: function(jqXHR, textStatus, errorThrown, result) {
                  $msg = 'oi';
                    $resp = jqXHR.responseJSON.errors;
                    console.log(jqXHR, textStatus, errorThrown, result);

                    $('.messageBox').empty();
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

  <script src="{{ asset('ajaxfunctions/mainajax.js') }}"></script>


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