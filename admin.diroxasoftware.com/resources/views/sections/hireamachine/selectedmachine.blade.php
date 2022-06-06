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
            <form action="/section/hireamachine/finalizingCustomerInfos/{{$allmachines->id}}" method="POST" id="registro" name="registro" enctype="multipart/form-data">
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

                            </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                      <label for="" style="text-align:center;color:black;"><b>Brand</b></label>
                                      
                                        <input id="brand" name="brand"
                                                maxlength="191"
                                                placeholder="brand" class="form-control" type="text"
                                                value="{{$allmachines->brand}}"
                                                disabled>
                                    </div>

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
                                </div>
                        <div class="row">

                                  <div class="form-group col-md-6">
                                        <label for="" style="color:black;"><b>MACHINE VALUE</b></label>
                                            <input id="valueMachine" name="valueMachine"
                                              maxlength="191" value="{{$allmachines->valueMachine}}"
                                              placeholder="0.00" class="form-control" type="text" disabled>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="" style="color:black;"><b>SUGGESTED DEPOSIT</b></label>
                                            <input id="depositSuggest" name="depositSuggest"
                                                  maxlength="191" value="{{$allmachines->depositSuggest}}"
                                                  placeholder="0.00" class="form-control" type="text" disabled>
                                    </div>
                        </div>

                          <div class="row">
                          
                                  <?php
                                      $twodaysprice = $allmachines->priceper2days;
                                      $threedaysprice = $allmachines->priceper3days;
                                      $oneweekprice = $allmachines->priceper1week;
                                      $twodaysprice = number_format($twodaysprice, 2, '.',',');
                                      $threedaysprice = number_format($threedaysprice, 2, '.',',');
                                      $oneweekprice = number_format($oneweekprice, 2, '.',',');
                                  ?>
                                
                                  <div class="form-group col-md-3">
                                        <label for="" style="text-align:center;color:black;"><b>Price per 1 Day (GBP)</b></label>
                                              <input id="machinePrice" name="machinePrice"
                                              maxlength="191"
                                              placeholder="machinePrice" class="form-control" type="text"
                                              value="{{$allmachines->price}}"
                                              disabled>
                                              
                                              <input id="machinePrice" name="machinePrice"
                                              maxlength="191"
                                              placeholder="machinePrice" class="form-control" type="text"
                                              value="{{$allmachines->price}}"
                                              hidden>

                                              <input id="machineId" name="machineId"
                                              maxlength="191"
                                              placeholder="machineId" class="form-control" type="text"
                                              value="{{$allmachines->id}}"
                                              hidden>
                                  </div>
                                  <div class="form-group col-md-3">
                                        <label for="" style="text-align:center;color:black;"><b>Price per 2 Days (GBP)</b></label>
                                              <input 
                                              maxlength="191"
                                              placeholder="machinePrice" class="form-control" type="text"
                                              value="{{$twodaysprice}}"
                                              disabled>
                                  </div>
                                  <div class="form-group col-md-3">
                                        <label for="" style="text-align:center;color:black;"><b>Price per 3 Days (GBP)</b></label>
                                              <input 
                                              maxlength="191"
                                              placeholder="machinePrice" class="form-control" type="text"
                                              value="{{$threedaysprice}}"
                                              disabled>
                                  </div>
                                  <div class="form-group col-md-3">
                                        <label for="" style="text-align:center;color:black;"><b>Price per 1 week (GBP)</b></label>
                                              <input 
                                              maxlength="191"
                                              placeholder="machinePrice" class="form-control" type="text"
                                              value="{{$oneweekprice}}"
                                              disabled>
                                  </div>
                            </div>


                        <hr>

                        <div class="form-row">
                                <div class="form-group col-md-12">
                                  <label for="" style="color:black;"><b>Machine Image </label><br>
                                    @if($allmachines->image !=null)
                                            <img src="/storage/{{$allmachines->image}}"
                                            alt="{{ $allmachines->image}}" style= "max-width: 250px;color:black;"><br>
                                    @endif
                                </div>                                 
                        </div>

                        <label for=""><b>Who will hire this machine?</b></label>
                          <div class="form-group col-md-6">
                                      <label for="" style="text-align:center;color:black;"><b>Customer</label>
                                      <select id="owner" name="owner" class="form-control" required>
                                            @foreach($allcustomers as $customer)
                                            <option value="{{$customer->id}}" >{{$customer->name}}</option>
                                            @endforeach
                                      </select>
                                      <a href="/section/customers/create"><b>Create a customer</b></a>
                                  </div>

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

                                <a  id="hiringMachineBtn" name="hiringMachineBtn" style="color:white;" type="button" class="btn btn-warning">
                                  <i class="fa fa-save fa-1x " aria-hidden="true"></i>
                                  <b>Confirm Customer and Take Proof of address</b>
                                </a>
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
                                  style="width: 120px; height:120px;" alt="/storage/`+ $resp.image + `"></td>
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


<script>
      $(document).ready(function(){
        
              // $('#ajaxSubmit').click(function(e){
                $(document).on("click", "#hiringMachineBtn", function(e){
                // var comboCidades = document.getElementById("option").value;
                var comboCidades = $('#mselect option:selected').val();
                var idOwner = $('#owner').val();
                var machineId = $('#machineId').val();
                alert("Redirecting....");
                // redirecionando para a rota de aluguel via customer
                window.location.href = "/section/hireamachine/viacustomer/choosingmachine/"+machineId+"/"+idOwner;
                e.preventDefault();
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
