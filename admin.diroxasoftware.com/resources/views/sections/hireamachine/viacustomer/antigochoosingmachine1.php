<!DOCTYPE html>


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

         <form action="{{route('hiremachine.openthehiring')}}" method="POST" id="registro" name="registro" enctype="multipart/form-data">
            @csrf
            <section class="testimonial py-3" id="testimonial">
                <div class="container"  style="box-shadow: 0 4px 12px 0 rgba(0, 0, 2, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.19)">
                    <div class="row ">
                        <div class="col-md-12 py-5 border">
                            <h4 class="pb-2" style="color:black;"><b>This Customer's Data</b></h4>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                    <label for="" style="color:black;"> Name: </label>
                                        <input id="name" name="name"  id="name"
                                          value="{{$thisCustomer->name}}" disabled
                                          placeholder="Name" class="form-control" type="text" >


                                        <input id="customerId" name="customerId"  id="customerId"
                                          value="{{$thisCustomer->id}}" hidden
                                          placeholder="customerId" class="form-control" type="text" >
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

                                        <?php
                                            $routeBack = "choosingmachine";
                                        ?>  

                                        
                                        <a href="/section/customers/edit/{{$thisCustomer->id}}/{{$routeBack}}/{{$thisMachine->id}}" type="button" class="btn btn-success"><b>Se all this Customer Data</b></a>

                                </div>
                            
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->


         <!-- Begin Page Content -->
    <div class="container-fluid">
              @if(session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                    </button>
              </div>
          @endif

     
   
      <section class="testimonial py-3" id="testimonial">
          <div class="container"  style="box-shadow: 0 4px 12px 0 rgba(0, 0, 2, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.19)" 
          id="creatingMachineContainer">
              <div class="row ">
                  <div class="col-md-12 py-5 border">

                  <div class="alert  alert-success d-none messageBox" role="alert">
                      </div>


                      <h4 class="pb-2" style="color:black;"><b>Choosed Hire Machine.</b></h4>
                      <div class="invalidData" role="alert">

                      </div>
               
                      @if(session('error'))
                        <div class="alert alert-danger">
                          {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                      @endif
                      
                          <div class="form-row">
                     
                          <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->
                              <div class="form-group col-md-6">
                                   
                         
                                <label for="" style="text-align:center;color:black;"><b>Serial Number</b></label>

                                  <input id="serial_number" name="serial_number"  id="serial_number"  placeholder="Serial Number"
                                  value="{{$thisMachine->serial_number}}" class="form-control" type="text" disabled>
                              </div>

                          <div class="form-group col-md-6">
                            <label for="" style="text-align:center;color:black;"><b>Model</b></label>

                              <input id="model" name="model"
                              maxlength="191" value="{{$thisMachine->model}}"
                              placeholder="model" class="form-control" type="text" disabled>
                          </div>

                      </div>
                          <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="" style="text-align:center;color:black;"><b>Brand</b></label>

                              <input id="brand" name="brand"
                                      maxlength="191" value="{{$thisMachine->brand}}"
                                      placeholder="brand" class="form-control" type="text" disabled>
                              </div>

                          </div>

                          <div class="row">
                          <?php
                              $twodaysprice = $thisMachine->priceper2days;
                              $threedaysprice = $thisMachine->priceper3days;
                              $oneweekprice = $thisMachine->priceper1week;
                              $twodaysprice = number_format($twodaysprice, 2, '.',',');
                              $threedaysprice = number_format($threedaysprice, 2, '.',',');
                              $oneweekprice = number_format($oneweekprice, 2, '.',',');
                            
                          ?>
                                
                                      <div class="form-group col-md-3">
                                            <label for="" style="text-align:center;color:black;"><b>Price per 1 Day (GBP)</b></label>
                                                  <input id="machinePrice" name="machinePrice"
                                                  maxlength="191"
                                                  placeholder="machinePrice" class="form-control" type="text"
                                                  value="{{$thisMachine->price}}"
                                                  disabled>
                                                  
                                                  <input id="machinePrice" name="machinePrice"
                                                  maxlength="191"
                                                  placeholder="machinePrice" class="form-control" type="text"
                                                  value="{{$thisMachine->price}}"
                                                  hidden>

                                                  <input id="machineId" name="machineId"
                                                  maxlength="191"
                                                  placeholder="machineId" class="form-control" type="text"
                                                  value="{{$thisMachine->id}}"
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

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                  <label for="" style="color:black;"><b>Machine Image </label><br>
                                    @if($thisMachine->image !=null)
                                            <img src="/storage/{{$thisMachine->image}}"
                                            alt="{{ $thisMachine->image}}" style= "max-width: 250px;color:black;"><br>
                                    @endif
                                </div>                                 
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                        <?php
                                            $hoje = date('d/m/Y');
                                            $hojeNoFormated = date('m-d-Y');
                                        ?>

                                                <h3 style="color:black;"><b>Hiring Informations</b></h3>
                                                <h5><b>Price per day: £{{ $thisMachine->price}}</b></h5>

                                                <div class="row">
                                                      <div class="form-group col-md-4">
                                                            <label for="" style="color:black;"><b>SELECT TYPE HIRING</b></label>
                                                                        <select id="typehiring" name="typehiring" class="form-control categoriesOptions" >
                                                                            <option value="0">1 DAY HIRING</option>
                                                                            <option value="1">2 DAYS HIRING</option>
                                                                            <option value="2">3 DAYS HIRING</option>
                                                                            <option value="3">1 WEEK HIRING</option>
                                                                        </select>
                                                        </div>
                                                </div>

                                                <label for="start" style="color:black!important;">Start date:</label>
                                                    <input type="date" id="start" name="dataComecoPadraoDateTime"
                                                    value="{{$hoje}}"
                                                    min="{{$hoje}}" max="{{$hoje}}">

                                               
                                                <label for="start" style="color:black!important;">Final date:</label>
                                                    <input type="date" id="end" name="dataFimPadraoDateTime"
                                                    value="{{$hoje}}"
                                                    min="{{$hoje}}" max="{{$hoje}}">
                                                <!-- <input type="submit" value="search"> -->


                                                <input type="text" id="todayDateNoFormated" name="todayDateNoFormated"
                                                 value="{{$hojeNoFormated}}" hidden>
                                                 
                                                <input type="text" id="todayDateFormated" name="todayDateFormated"
                                                 value="{{$hoje}}" >

                                                <button type="submit" class="btn btn-info" id="chooseDateBtn" value="Search">Choose date</button><br><hr>
                                                <p><b>Choosed Machine: {{$thisMachine->model}}</b></p>
                                                <p style="color:black;"><b id="startHiring">Hiring starts on :</b></p>
                                                <p style="color:black;"><b id="finishHiring">Finishing starts on :</b></p>
                                                <p style="color:black;"><b id="totalDays">Total days :</b></p>
                                                <p style="color:black;"><b id="hiringPrice">Hiring Price :</b></p>
                                                <label for="discount" style="color:black!important;"><b>Discount:</b></label>
                                                <input type="input" id="discount" name="discount"
                                                    value="0" required>
                                                <p style="color:black;"><b>First deposit Price:</b>
                                                    <input type="input" id="inputFirstDeposit" name="inputFirstDeposit"
                                                        value="0" required>
                                                </p>

                                              <div class="form-row">
                                                      <label for="" style="color:black;"> <b>Observations /Extra infos about this hiring</b> </label>
                                                  <div class="form-group col-md-12">
                                                      <textarea class="form-control" id="about" rows="3" name="about" placeholder="about" id="about">{{$thisMachine-> about}}</textarea>
                                                  </div>
                                              </div>

                                                <input type="text" id="inputStartHiring"  name="inputStartHiring"hidden>
                                                <input type="text" id="inputfinishHiring" name="inputfinishHiring" hidden>
                                                <input type="text" id="inputTotalDays"    name="inputTotalDays" hidden>
                                                <input type="text" id="inputHiringPrice"  name="inputHiringPrice" hidden>
                                    </div>
                            </div>

                            <button type="submit" class="btn btn-warning">
                                  <i class="fa fa-save fa-1x " aria-hidden="true"></i>
                                  <b>Confirm datas and Start the Hiring</b>
                            </button>

                      </form>
                  </div>
              </div>
          </div>
    </section>

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
              $(document).on("change", "#typehiring", function(e){
               e.preventDefault();
                var typehiring = $('#typehiring option:selected').val();
                // alert(typehiring);
                
                if(typehiring == 0)
                {

                  var dataComecoPadraoDateTime  = $("#todayDateNoFormated").val();
                  var dataComecoPadraoDateTime2  = $("#todayDateFormated").val();
                  
                  var machinePrice  = $("#machinePrice").val();
                  var discount  = $("#discount").val();
                  alert(dataComecoPadraoDateTime2);
                  
                  var outraData = new Date(dataComecoPadraoDateTime);
                  outraData.setDate(outraData.getDate() + 3); // Adiciona 3 dias
                  // alert(outraData.getDate());
                  var newDay = outraData.getDate();
                  var newMonth = outraData.getMonth() + 1;
                  var newYear = outraData.getFullYear();
                  
                  if(newDay < 10){
                      newDay = `0${newDay}`;
                    }

                    if(newMonth < 10){
                      newMonth = `0${newMonth}`;
                    }


                   alert(newDay);
                    var dateJustCreated = `${newDay}-${newMonth}-${newYear}`;
                    var dateJustCreated2 = `${newDay}/${newMonth}/${newYear}`;

                    var dataFimPadraoDateTime  = outraData;

                  // var total_days = (dataFimPadraoDateTime - dataComecoPadraoDateTime) / (1000 * 60 * 60 * 24);

                  document.getElementById("totalDays").innerHTML = " ";
                  document.getElementById("startHiring").innerHTML = " ";
                  document.getElementById("finishHiring").innerHTML = " ";
                  document.getElementById("totalDays").innerHTML = " ";

                  var day_start = new Date(dataComecoPadraoDateTime);
                  var day_end = new Date(dataFimPadraoDateTime);
                  var total_days = (day_end - day_start) / (1000 * 60 * 60 * 24);
                  var findHiringPrice = (Math.round(total_days) * machinePrice) - discount;
                  // var firstDepositPercentage = findHiringPrice * 0.20;
                  var hiringPrice2 = findHiringPrice.toFixed(2);
                  // var firstDepositPercentage2 = firstDepositPercentage.toFixed(2);

                  document.getElementById("totalDays").innerHTML = "Total days : "+   Math.round(total_days);
                  document.getElementById("startHiring").innerHTML = "Hiring starts on :"+ dataComecoPadraoDateTime;
                  document.getElementById("finishHiring").innerHTML = "Finishing starts on :"+ dateJustCreated;
                  document.getElementById("totalDays").innerHTML = "Total days : "+   Math.round(total_days);
                  document.getElementById("hiringPrice").innerHTML = "Hiring Price : £"+   hiringPrice2;
                  // document.getElementById("firstDeposit").innerHTML = "First deposit Price (20%) :  £"+  firstDepositPercentage2;

                  document.getElementById("inputStartHiring").value = "";
                  document.getElementById("inputfinishHiring").value = "";
                  document.getElementById("inputTotalDays").value = "";
                  document.getElementById("inputHiringPrice").value = "";
                  // document.getElementById("inputFirstDeposit").value = "";

                  document.getElementById("todayDateNoFormated").value = dataComecoPadraoDateTime2;
                  document.getElementById("end").value = dateJustCreated;
                  document.getElementById("inputStartHiring").value = dataComecoPadraoDateTime;
                  document.getElementById("inputfinishHiring").value = dataFimPadraoDateTime;
                  document.getElementById("inputTotalDays").value = total_days;
                  document.getElementById("inputHiringPrice").value = findHiringPrice;

                }
                else if(typehiring == 1)
                {
                  alert('2 days');
                }
                else if(typehiring == 2)
                {
                  alert('3 days');
                }
                else if(typehiring == 3)
                {
                  alert('1 week');
                }

               });
            });
</script>

  <script type="text/javascript">
      function datediff(first, second) {
        // Take the difference between the dates and divide by milliseconds per day.
        // Round to nearest whole number to deal with DST.
        return Math.round((second-first)/(1000*60*60*24));
    }

      function parseDate(str) {
          var mdy = str.split('/');
          return new Date(mdy[2], mdy[0]-1, mdy[1]);
    }
  </script>


<script>
      $(document).ready(function(){
        
            // $('#ajaxSubmit').click(function(e){
              $(document).on("click", "#chooseDateBtn", function(e){
               e.preventDefault();
               // alert(1);
              
              var dataComecoPadraoDateTime  = $("#todayDate").val();
              var dataFimPadraoDateTime  = $("#end").val();
              var machinePrice  = $("#machinePrice").val();
              var discount  = $("#discount").val();
              
              alert(dataComecoPadraoDateTime);


              // var total_days = (dataFimPadraoDateTime - dataComecoPadraoDateTime) / (1000 * 60 * 60 * 24);
              // alert('dsadadasdasda', total_days);

              document.getElementById("totalDays").innerHTML = " ";
              document.getElementById("startHiring").innerHTML = " ";
              document.getElementById("finishHiring").innerHTML = " ";
              document.getElementById("totalDays").innerHTML = " ";
              

              var day_start = new Date(dataComecoPadraoDateTime);
              var day_end = new Date(dataFimPadraoDateTime);
              var total_days = (day_end - day_start) / (1000 * 60 * 60 * 24);
              var findHiringPrice = (Math.round(total_days) * machinePrice) - discount;
              // var firstDepositPercentage = findHiringPrice * 0.20;
              var hiringPrice2 = findHiringPrice.toFixed(2);
              // var firstDepositPercentage2 = firstDepositPercentage.toFixed(2);

              document.getElementById("totalDays").innerHTML = "Total days : "+   Math.round(total_days);
              document.getElementById("startHiring").innerHTML = "Hiring starts on :"+ dataComecoPadraoDateTime;
              document.getElementById("finishHiring").innerHTML = "Finishing starts on :"+ dataFimPadraoDateTime;
              document.getElementById("totalDays").innerHTML = "Total days : "+   Math.round(total_days);
              document.getElementById("hiringPrice").innerHTML = "Hiring Price : £"+   hiringPrice2;
              // document.getElementById("firstDeposit").innerHTML = "First deposit Price (20%) :  £"+  firstDepositPercentage2;


              // <input type="text" id="inputStartHiring">
              // <input type="text" id="inputfinishHiring">
              // <input type="text" id="inputTotalDays">
              // <input type="text" id="inputHiringPrice">
              // <input type="text" id="inputFirstDeposit">

              document.getElementById("inputStartHiring").value = "";
              document.getElementById("inputfinishHiring").value = "";
              document.getElementById("inputTotalDays").value = "";
              document.getElementById("inputHiringPrice").value = "";
              // document.getElementById("inputFirstDeposit").value = "";

              document.getElementById("inputStartHiring").value = dataComecoPadraoDateTime;
              document.getElementById("inputfinishHiring").value = dataFimPadraoDateTime;
              document.getElementById("inputTotalDays").value = total_days;
              document.getElementById("inputHiringPrice").value = findHiringPrice;
              // document.getElementById("inputFirstDeposit").value = firstDepositPercentage;

              

              // <p><b id="startHiring">Hiring starts on :</b></p>
              // <p><b id="finishHiring">Finishing starts on :</b></p>
              // <p><b id="totalDays">Total days :</b></p>
              // <p><b id="hiringPrice">Hiring Price :</b></p>
              // <p><b id="firstDeposit">First deposit Price (20%) :</b></p>

              

              // alert(dataComecoPadraoDateTime);
              // alert(dataFimPadraoDateTime);
              // alert(datediff("day", dataComecoPadraoDateTime, dataFimPadraoDateTime)); // what goes here?
              // alert(datediff(parseDate(dataComecoPadraoDateTime), parseDate(dataFimPadraoDateTime)));

              // alert(2);

              var data=[];  
              // alert(comboCidades)
              // data.push(comboCidades);
              var valor = $('#owner').val();
              // var texto = $('#mselect :selected').text();
              
              // alert('valor ' + valor);
              // alert('texto ' + texto);

              
      
               });
            });
</script>

<script>
      $(document).ready(function(){
        
            // $('#ajaxSubmit').click(function(e){
              $(document).on("change", "#discount", function(e){
               e.preventDefault();

              var dataComecoPadraoDateTime  = $("#start").val();
              var dataFimPadraoDateTime  = $("#end").val();
              var machinePrice  = $("#machinePrice").val();
              var discount  = $("#discount").val();



              // var total_days = (dataFimPadraoDateTime - dataComecoPadraoDateTime) / (1000 * 60 * 60 * 24);
              // alert('dsadadasdasda', total_days);

              document.getElementById("totalDays").innerHTML = " ";
              document.getElementById("startHiring").innerHTML = " ";
              document.getElementById("finishHiring").innerHTML = " ";
              document.getElementById("totalDays").innerHTML = " ";
              // document.getElementById("firstDeposit").innerHTML = " ";

              var day_start = new Date(dataComecoPadraoDateTime);
              var day_end = new Date(dataFimPadraoDateTime);
              var total_days = (day_end - day_start) / (1000 * 60 * 60 * 24);
              var findHiringPrice = (Math.round(total_days) * machinePrice) - discount;
              // var firstDepositPercentage = findHiringPrice * 0.20;
              var hiringPrice2 = findHiringPrice.toFixed(2);
              // var firstDepositPercentage2 = firstDepositPercentage.toFixed(2);

              document.getElementById("totalDays").innerHTML = "Total days : "+   Math.round(total_days);
              document.getElementById("startHiring").innerHTML = "Hiring starts on : "+ dataComecoPadraoDateTime;
              document.getElementById("finishHiring").innerHTML = "Finishing starts on : "+ dataFimPadraoDateTime;
              document.getElementById("totalDays").innerHTML = "Total days : "+   Math.round(total_days);
              document.getElementById("hiringPrice").innerHTML = "Hiring Price : £"+   hiringPrice2;
              // document.getElementById("firstDeposit").innerHTML = "First deposit Price (20%) :  £"+  firstDepositPercentage2;

              document.getElementById("inputStartHiring").value = "";
              document.getElementById("inputfinishHiring").value = "";
              document.getElementById("inputTotalDays").value = "";
              document.getElementById("inputHiringPrice").value = "";
              // document.getElementById("inputFirstDeposit").value = "";

              document.getElementById("inputStartHiring").value = dataComecoPadraoDateTime;
              document.getElementById("inputfinishHiring").value = dataFimPadraoDateTime;
              document.getElementById("inputTotalDays").value = total_days;
              document.getElementById("inputHiringPrice").value = findHiringPrice;
              // document.getElementById("inputFirstDeposit").value = firstDepositPercentage;
              
      
               });
            });
</script>



<script>
    $("#inputFirstDeposit").on("change",function(){
      $(this).val(parseFloat($(this).val()).toFixed(2));
    });
</script>


<script>
    $("#discount").on("change",function(){
      $(this).val(parseFloat($(this).val()).toFixed(2));
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

