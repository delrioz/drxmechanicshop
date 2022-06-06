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
         <form action="{{route('hiremachine.update')}}" method="POST" id="registro" name="registro" enctype="multipart/form-data">
            @csrf
            <section class="testimonial py-3" id="testimonial">
                <div class="container"  style="box-shadow: 0 4px 12px 0 rgba(0, 0, 2, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.19)">
                    <div class="row ">
                        <div class="col-md-12 py-5 border">
                        @if(($thiscustomercheck) != "empty")
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
                                            $routeBack = "hiresmachinesviewpage";
                                        ?> 
                                        
                                        <a href="/section/customers/edit/{{$thisCustomer->id}}/{{$routeBack}}" type="button" class="btn btn-success"><b>Se all this Customer Data</b></a>

                                </div>
                            @else
                              <div class="alert alert-warning">
                                <h5>The customer data was deleted</h5>
                              </div>
                            @endif
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
                                  <div class="form-group col-md-6">
                                        <label for="" style="color:black;"><b>MACHINE VALUE</b></label>
                                            <input id="valueMachine" name="valueMachine"
                                              maxlength="191" value="{{$thisMachine->valueMachine}}"
                                              placeholder="0.00" class="form-control" type="text" disabled>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="" style="color:black;"><b>SUGGESTED DEPOSIT</b></label>
                                            <input id="depositSuggest" name="depositSuggest"
                                                  maxlength="191" value="{{$thisMachine->depositSuggest}}"
                                                  placeholder="0.00" class="form-control" type="text" disabled>
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

                                              <input type="text" id="hiringMachineId"  name="hiringMachineId" value="{{$thisHiringInfos->hiringMachineId}}" hidden>

                                            
                                  </div>
                                  <div class="form-group col-md-3">
                                        <label for="" style="text-align:center;color:black;"><b>Price per 2 Days (GBP)</b></label>
                                              <input 
                                              maxlength="191"
                                              placeholder="machinePrice" class="form-control" type="text"
                                              id="machinePrice2days" name="machinePrice2days"
                                              value="{{$twodaysprice}}"
                                              disabled>
                                  </div>
                                  <div class="form-group col-md-3">
                                        <label for="" style="text-align:center;color:black;"><b>Price per 3 Days (GBP)</b></label>
                                              <input 
                                              maxlength="191"
                                              placeholder="machinePrice" class="form-control" type="text"
                                              id="machinePrice3days" name="machinePrice3days"
                                              value="{{$threedaysprice}}"
                                              disabled>
                                  </div>
                                  <div class="form-group col-md-3">
                                        <label for="" style="text-align:center;color:black;"><b>Price per 1 week (GBP)</b></label>
                                              <input 
                                              maxlength="191"
                                              placeholder="machinePrice" class="form-control" type="text"
                                              id="machinePrice1week" name="machinePrice1week"
                                              value="{{$oneweekprice}}"
                                              disabled>
                                  </div>
                              </div>

                            <hr>
                            
                            <div class="row">
                                <div class="col-md-12">
                                        <?php
                                            $hoje = date('d/m/Y');
                                            $startHiringDateFormated = date('d/m/Y', strtotime($startHiringDate));
                                            $finishHiringDateFormated = date('d/m/Y', strtotime($finishHiringDate));

                                        ?>
                                                <h3 style="color:black;"><b>Hiring Informations</b></h3>

                                                @if(session('error'))
                                                  <div class="alert alert-danger">
                                                    {{ session('error') }}
                                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                  <span aria-hidden="true">&times;</span>
                                                      </button>
                                                  </div>
                                                @endif
                                                
                                                <h5><b>Price per day: £<b>{{ $machinePrice}}</b></h5>
                                                <label for="start" style="color:black!important;"><b>Old Start date:</b></label>
                                                    <input value="{{$startHiringDateFormated}}"  disabled>

                                                <label for="start" style="color:black!important;"><b>Old Final date:</b></label>
                                                    <input value="{{$finishHiringDateFormated}}" disabled>

                                                    <input value="{{$startHiringDate}}"  hidden>
                                                    <input value="{{$finishHiringDate}}" hidden>
                                                    <br><br>
                                                <label for="start" style="color:black!important;">Start date:</label>
                                                    <input type="date" id="start" name="dataComecoPadraoDateTime"
                                                    value="{{$startHiringDate}}">

                                                <label for="start" style="color:black!important;">Final date:</label>
                                                    <input type="date" id="end" name="dataFimPadraoDateTime"
                                                    value="{{$finishHiringDate}}">

                                                <button type="submit" class="btn btn-info" id="chooseDateBtn" value="Search">Choose date</button><br><hr>
                                                <!-- <input type="submit" value="search"> -->
                                                <p><b>Choosed Machine: {{$thisMachine->model}}</b></p>
                                                <p style="color:black;"><b id="startHiring">Hiring starts on : <strong>{{$startHiringDateFormated}}</strong></b></p>
                                                <p style="color:black;"><b id="finishHiring">Finishing starts on : <strong>{{$finishHiringDateFormated}}</strong></b></p>
                                                <p style="color:black;"><b id="totalDays">Total days : <strong>{{$totalDaysNumber}}</strong></b></p>

                                                <p style="color:black;"><b id="hiringPriceFixed">Old Hiring Price : £{{$hiringPrice}}</b></p>
                                                <p style="color:black;"><b id="hiringPrice"></b></p>
                                                
                                                <label for="discount" style="color:black!important;"><b>Hiring Price:</b></label>
                                                <input type="text" id="hiringPriceField" name="hiringPriceField"
                                                    value="{{$hiringPrice}}" required><br>

                                                <label for="discount" style="color:black!important;"><b>Discount(GBP):</b></label>
                                                <input type="input" id="discount" name="discount"
                                                    value="{{$discount}}" required>                                              

                                                <!-- <p style="color:black;"><b id="firstDeposit">First deposit Price (20%) : <strong>£</strong></b></p> -->

                                                <p style="color:black;"><b>First deposit Price :</b>
                                                    <input type="input" id="inputFirstDeposit" name="inputFirstDeposit"
                                                      value="{{$firstDepositPrice}}" required>
                                                </p>
                                    </div>
                                              <input type="text" id="from"  name="from" value="{{$from}}" hidden>

                            </div>


                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check fa-1x " aria-hidden="true"></i>
                            <b>Save Infos</b>
                        </button>

                        @if(($thiscustomercheck) != "empty")
                              @if(($routebacktoviewpage ==  "machinehireviewpage"))
                                <a type="button" class="btn btn-danger" href="/section/hiringMachine/reportsMachineHireviewPage/{{$thisHiringInfos->hiringMachineId}}/{{$thisCustomer->id}}">
                                    <i class="fa fa-exit fa-1x " aria-hidden="true"></i>
                                    <b>Back</b>
                                </a>
                                @elseif(($routebacktoviewpage ==  "machinehire"))
                                <a type="button" class="btn btn-danger" href="/section/reports/machinehire">
                                    <i class="fa fa-exit fa-1x " aria-hidden="true"></i>
                                    <b>Back</b>
                                </a>
                                @elseif(($routebacktoviewpage ==  "machinehire"))
                                <a type="button" class="btn btn-danger" href="/section/customers/viewPage/{{$thisCustomer->id}}">
                                    <i class="fa fa-exit fa-1x " aria-hidden="true"></i>
                                    <b>Back</b>
                                </a>
                                @else
                                <a type="button" class="btn btn-danger" href="/section/customers/viewPage/{{$thisCustomer->id}}">
                                    <i class="fa fa-exit fa-1x " aria-hidden="true"></i>
                                    <b>Back</b>
                                </a>
                              @endif
                          @endif

                          
                            <input type="text" id="inputStartHiring"  name="inputStartHiring" value="{{$startHiringDate}}" hidden>
                            <input type="text" id="inputfinishHiring" name="inputfinishHiring" value="{{$finishHiringDate}}" hidden>
                            <input type="text" id="inputTotalDays"    name="inputTotalDays" value="{{$totalDaysNumber}}" hidden>
                            <input type="text" id="inputHiringPrice"  name="inputHiringPrice" value="{{$hiringPrice}}" hidden>
                            
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
              
              var dataComecoPadraoDateTime  = $("#start").val();
              var dataFimPadraoDateTime  = $("#end").val();
              var machinePrice  = $("#machinePrice").val();
              var machinePrice2days  = $("#machinePrice2days").val();
              var machinePrice3days  = $("#machinePrice3days").val();
              var machinePrice1week  = $("#machinePrice1week").val();

              document.getElementById("discount").value = 0.00;

              // var total_days = (dataFimPadraoDateTime - dataComecoPadraoDateTime) / (1000 * 60 * 60 * 24);
              // alert('dsadadasdasda', total_days);

              document.getElementById("totalDays").innerHTML = " ";
              document.getElementById("startHiring").innerHTML = " ";
              document.getElementById("finishHiring").innerHTML = " ";
              document.getElementById("totalDays").innerHTML = " ";
              

              var discount  = $("#discount").val();
              var day_start = new Date(dataComecoPadraoDateTime);
              var day_end = new Date(dataFimPadraoDateTime);
              var total_days = (day_end - day_start) / (1000 * 60 * 60 * 24);
              var findHiringPrice = (Math.round(total_days) * machinePrice) - discount;
              var findHiringPrice2 = (Math.round(total_days) * machinePrice);

              // var firstDepositPercentage = findHiringPrice * 0.20;
              var hiringPrice2 = findHiringPrice.toFixed(2);
              // var firstDepositPercentage2 = firstDepositPercentage.toFixed(2);

              //montando a data começo
              var outraData = new Date(dataComecoPadraoDateTime);
              var newDay = outraData.getDate();
              var newMonth = outraData.getMonth() + 1; // pois a contagem dos meses começa do 0
              var newYear = outraData.getFullYear();
              if(newDay < 10){
                      newDay = `0${newDay}`;
              }

              if(newMonth < 10){
                newMonth = `0${newMonth}`;
              }
              var dateJustCreated = `${newDay}/${newMonth}/${newYear}`;


              //montando a data final
              var outraData2 = new Date(dataFimPadraoDateTime);
              var newDay = outraData2.getDate();
              var newMonth = outraData2.getMonth() + 1; // pois a contagem dos meses começa do 0
              var newYear = outraData2.getFullYear();
              if(newDay < 10){
                      newDay = `0${newDay}`;
              }

              if(newMonth < 10){
                newMonth = `0${newMonth}`;
              }
              var dateEndJustCreated = `${newDay}/${newMonth}/${newYear}`;
              
              
            // if the hiring is 1, 2 ,3 or 1 week
              if(total_days == 2){
                hiringPrice2 = machinePrice2days;
                findHiringPrice = hiringPrice2;
              }
              else if(total_days == 3){
                hiringPrice2 = machinePrice3days;
                findHiringPrice = hiringPrice2;
              }
              else if(total_days == 7){
                hiringPrice2 = machinePrice1week;
                findHiringPrice = hiringPrice2;
              }

              document.getElementById("totalDays").innerHTML = "Total days : "+   Math.round(total_days);
              document.getElementById("startHiring").innerHTML = "Hiring starts on :"+ dateJustCreated;
              document.getElementById("finishHiring").innerHTML = "Finishing starts on :"+ dateEndJustCreated;
              document.getElementById("totalDays").innerHTML = "Total days : "+   Math.round(total_days);
              document.getElementById("hiringPrice").innerHTML = "Suggested Hiring Price : £"+   hiringPrice2;
              // document.getElementById("hiringPrice").innerHTML = "Hiring Price : £"+   hiringPrice2;
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
              document.getElementById("hiringPrice").value = hiringPrice2;
              document.getElementById("hiringPriceField").value = hiringPrice2;

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
               var hiringPriceField  = $("#hiringPriceField").val();
               
              //  alert(dataFimPadraoDateTime);
               
              var total_days = (dataFimPadraoDateTime - dataComecoPadraoDateTime) / (1000 * 60 * 60 * 24);
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
              var findHiringPrice2 = (Math.round(total_days) * machinePrice);

              // var firstDepositPercentage = findHiringPrice * 0.20;
              // var firstDepositPercentage2 = firstDepositPercentage.toFixed(2);
              var hiringPrice2 = findHiringPrice.toFixed(2);
              var newHiringFieldPrice = hiringPriceField - discount;
              var newHiringFieldPrice = newHiringFieldPrice.toFixed(2);

                //montando a data começo
              var outraData = new Date(dataComecoPadraoDateTime);
              var newDay = outraData.getDate();
              var newMonth = outraData.getMonth() + 1; // pois a contagem dos meses começa do 0
              var newYear = outraData.getFullYear();
              if(newDay < 10){
                      newDay = `0${newDay}`;
              }

              if(newMonth < 10){
                newMonth = `0${newMonth}`;
              }
              var dateJustCreated = `${newDay}/${newMonth}/${newYear}`;


              //montando a data final
              var outraData2 = new Date(dataFimPadraoDateTime);
              var newDay = outraData2.getDate();
              var newMonth = outraData2.getMonth() + 1; // pois a contagem dos meses começa do 0
              var newYear = outraData2.getFullYear();
              if(newDay < 10){
                      newDay = `0${newDay}`;
              }

              if(newMonth < 10){
                newMonth = `0${newMonth}`;
              }
              var dateEndJustCreated = `${newDay}/${newMonth}/${newYear}`;


              document.getElementById("totalDays").innerHTML = "Total days : "+   Math.round(total_days);
              document.getElementById("startHiring").innerHTML = "Hiring starts on : "+ dateJustCreated;
              document.getElementById("finishHiring").innerHTML = "Finishing starts on : "+ dateEndJustCreated;
              document.getElementById("totalDays").innerHTML = "Total days : "+   Math.round(total_days);
              // document.getElementById("hiringPrice").innerHTML = "Suggested Hiring Price : £"+   hiringPrice2;
              // document.getElementById("hiringPrice").innerHTML = "Hiring Price : £"+   hiringPrice2;
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
              document.getElementById("hiringPrice").value = hiringPrice2;
              document.getElementById("hiringPriceField").value = newHiringFieldPrice;

              // document.getElementById("inputFirstDeposit").value = firstDepositPercentage;
              
      
               });
            });
</script>


<script>
      $(document).ready(function(){
        
            // $('#ajaxSubmit').click(function(e){
              $(document).on("change", "#hiringPriceField", function(e){
               e.preventDefault();
               var hiringNewPrice  = $("#hiringPriceField").val();
               var discount  = $("#discount").val();
               var finalHiringNewPrice = (hiringNewPrice) - discount;
               var finalHiringNewPrice = finalHiringNewPrice.toFixed(2);

               document.getElementById("hiringPriceField").value = finalHiringNewPrice;


              //  document.getElementById("inputHiringPrice").value = hiringPrice2;
              //  document.getElementById("hiringPrice").value = hiringPrice2;
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

<script>
    $("#hiringPrice").on("change",function(){
      $(this).val(parseFloat($(this).val()).toFixed(2));
    });
</script>


<script>
    $("#hiringPriceField").on("change",function(){
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

