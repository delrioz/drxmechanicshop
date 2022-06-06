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



        <?php
            $timeZone = new DateTimeZone('UTC');
            $todayDate = date("Y-m-d");
            $todayDate2 = date("d/m/Y");
            $data1 = DateTime::createFromFormat ('d/m/Y', $todayDate2, $timeZone);
            $data2 = DateTime::createFromFormat ('d/m/Y', $finishHiringDate, $timeZone);

            /** Testa se sao validas */
            if (!($data1 instanceof DateTime)) {
              // echo 'Invalid Date!!';
            }

            if (!($data2 instanceof DateTime)) {
              // echo 'Invalid Date!!';
            }

            /** Compara as datas normalmente com operadores de comparacao < > = e !=*/
            if ($data1 > $data2) {
              $resultado = date_diff($data2, $data1);
              $msgHireStatus = "DELAYED"; 
            }
            else if ($data1 < $data2) {
              // echo 'Data de entrada menor que data de saida!';
              $msgHireStatus = "ON TIME THE HIRING WILL FINISH ON THE NEXT ";
              $msgHireStatus = "ONTIME";  
            }
            else {
              $msgHireStatus = "TILLTODAY"; 
            }
        ?>


            @if($msgHireStatus == "ONTIME")
                  <form action="{{route('hiremachine.editingAndGettingPayment')}}" method="POST" id="registro" name="registro" enctype="multipart/form-data">
                          @csrf
                @else
                  <form action="{{route('hiremachine.finishHiringGetPayment')}}" method="POST" id="registro" name="registro" enctype="multipart/form-data">
                          @csrf
            @endif

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

     
      <input id="customerId" name="customerId"  id="customerId"
              value="{{$thisHiringInfos->customerId}}" hidden
              placeholder="customerId" class="form-control" type="text" >

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
                                   

                                        <h3 style="color:black;"><b>Hiring Informations</b></h3>
                                        <h5><b>Price per day: £{{ $machinePrice}}</b></h5>
                                        <input type="text" name="todayDate" id="todayDate" value="{{$todayDate}}" hidden>

                                        <label for="start" style="color:black!important;">Start date:</label>
                                            <input type="text" id="start2" name="dataComecoPadraoDateTime2"
                                            value="{{$startHiringDate}}"  disabled>
                                            

                                        <label for="start" style="color:black!important;">Final date:</label>
                                            <input type="text" id="end2" name="dataFimPadraoDateTime2"
                                            value="{{$finishHiringDate}}" disabled>
                                            
                                            <input type="text" id="start" name="dataComecoPadraoDateTime"
                                            value="{{$startHiringDateNoFormated}}"  hidden>
                                            
                                            <input type="text" id="end" name="dataFimPadraoDateTime"
                                            value="{{$finishHiringDateNoFormated}}" hidden>


                                            <input type="text" id="finishEarlyDate" name="finishEarlyDate"
                                            value="{{$todayDate}}" hidden>
                                            
                                            <input type="text" id="todayDateFormated" name="todayDateFormated"
                                            value="{{$todayDate2}}" hidden>


                                        <!-- <input type="submit" value="search"> -->
                                        <!-- <div class="alert alert-warning">
                                          <p>{{$msgHireStatus}}</p>
                                        </div>
                                         -->
                                         @if($msgHireStatus == "ONTIME")
                                            @if($status == "OPEN")
                                              <button type="submit" class="btn btn-info" id="chooseDateBtn" value="Search">Deliver early</button><br><hr>
                                            @endif
                                        @endif

                                        <p><b>Choosed Machine: {{$thisMachine->model}}</b></p>
                                        <p style="color:black;"><b id="startHiring">Hiring starts on : <strong>{{$startHiringDate}}</strong></b></p>
                                        <p style="color:black;"><b id="finishHiring">Finishing starts on : <strong>{{$finishHiringDate}}</strong></b></p>
                                        <p style="color:black;"><b id="totalDays">Total days : <strong>{{$totalDaysNumber}}</strong></b></p>
                                        <p style="color:black;"><b id="hiringPriceFixed">Old Hiring Price : £{{$hiringPrice}}</b></p>
                                        <p style="color:black;"><b id="hiringPrice"></b></p>

                                        @if($status == "OPEN")
                                        <label for="discount" style="color:black!important;"><b>Hiring Price:</b></label>
                                                <input type="text" id="hiringPriceField" name="hiringPriceField"
                                                    value="{{$hiringPrice}}" required><br>
                                                    
                                            <label for="discount" style="color:black!important;"><b>Discount(GBP):</b></label>
                                              <input type="input" id="discount" name="discount"
                                                  value="{{$discount}}" required>   
                                            
                                            <p style="color:black;"><b>First deposit Price :</b>
                                                  <input type="input" id="inputFirstDeposit" name="inputFirstDeposit"
                                                    value="{{$firstDepositPrice}}" required>
                                            </p>                
                                        @else
                                            <p style="color:black;"><b>Hiring Price : <strong>£{{$hiringPrice}}</strong></b></p>
                                            <p style="color:black;"><b>Discount(GBP): <strong>£{{$discount}}</strong></b></p>
                                            <p style="color:black;"><b>First deposit Price : <strong>£{{$firstDepositPrice}}</strong></b></p>

                                        @endif

                                        @if($status == "OPEN")
                                            <div class="alert  alert-danger d-none messageBoxDelayed" role="alert">
                                            </div>

                                            <div class="alert  alert-warning d-none messageBoxDueToday" role="alert">
                                            </div>

                                            <div class="alert  alert-success d-none messageBoxOnTime" role="alert">
                                            </div>
                                        @endif

                                        @if($status == "OPEN")
                                          <div class="alert alert-info">
                                              <p><b>If you want charge anything extra from the customer. Please, set the amount to be charged on this input. 
                                              <br>And add any observations in the "about" section if is necessary.</b></p>
                                          </div>
                                        @else
                                        <div class="alert alert-danger">
                                              <p><b>This machine hiring has been finished</b>
                                          </div>
                                        @endif

                                  
                                            <input id="machinePrice" name="machinePrice"
                                                  maxlength="191"
                                                  placeholder="machinePrice" class="form-control" type="text"
                                                  value="{{$machinePrice}}"
                                                  hidden>

                                            <input id="machineId" name="machineId"
                                                maxlength="191"
                                                placeholder="machineId" class="form-control" type="text"
                                                value="{{$thisMachine->id}}"
                                                hidden>

                                            <input type="text" id="start" name="dataComecoPadraoDateTime"
                                               value="{{$startHiringDateNoFormated}}"  hidden>

                                            <!-- <input type="text" id="end" name="dataFimPadraoDateTime"
                                               value="{{$finishHiringDateNoFormated}}" > -->


                                               @if($status == "OPEN")
                                                <div class="form-row">
                                                        <label for="" style="color:black;"> <b>Observations /Extra infos about this hiring</b> </label>
                                                    <div class="form-group col-md-12">
                                                        <textarea  class="form-control" id="about" rows="3" name="about" placeholder="about" id="about" required>{{$about}}</textarea>
                                                    </div>
                                                </div>
                                              @else
                                              <div class="form-row">
                                                        <label for="" style="color:black;"> <b>Observations /Extra infos about this hiring</b> </label>
                                                    <div class="form-group col-md-12">
                                                        <textarea  class="form-control" id="about" rows="3" name="about" placeholder="about" id="about" disabled>{{$about}}</textarea>
                                                    </div>
                                                </div>
                                              @endif

                                              @if($status == "OPEN")
                                                <div class="form-row">
                                                        <label for="" style="color:black;"> <b>Extra amount to be charged</b> </label>
                                                    <div class="form-group col-md-12">
                                                          <input id="extraCost" name="extraCost"
                                                          maxlength="191" value="0.00"
                                                          placeholder="extraCost" class="form-control" type="text" required>
                                                    </div>
                                                </div>
                                              @else
                                                <div class="form-row">
                                                        <label for="" style="color:black;"> <b>Extra amount to be charged</b> </label>
                                                    <div class="form-group col-md-12">
                                                          <input id="extraCost" name="extraCost"
                                                          maxlength="191" value="0.00"
                                                          placeholder="extraCost" class="form-control" type="text" disabled>
                                                    </div>
                                                </div>
                                              @endif

                                    <input type="text" id="hiringMachineId"  name="hiringMachineId" value="{{$thisHiringInfos->hiringMachineId}}" hidden>

                                    @if(($thiscustomercheck) != "empty")
                                        <input type="text" id="customerId"  name="customerId" value="{{$thisCustomer->id}}" hidden>
                                    @endif

                                    </div>
                            </div>


                        @if($status == "OPEN")
                          <a type="button" class="btn btn-success" href="/section/hiremachine/checkfirstinvoice/{{$thisHiringInfos->hiringMachineId}}">
                              <i class="fa fa-eye fa-1x " aria-hidden="true"></i>
                              <b>Check the first Invoice</b>
                          </a>
                        @endif

                        
                        @if($status == "OPEN")
                              <input type="text" id="inputTotalDays"    name="inputTotalDays" value="{{$totalDaysNumber}}" hidden>
                              <input type="text" id="nDaysleft"  name="nDaysleft" hidden>
                              <input type="text" id="inputStartHiring"  name="inputStartHiring" value="{{$startHiringDateNoFormated}}" hidden>
                              <input type="text" id="inputfinishHiring" name="inputfinishHiring" value="{{$finishHiringDateNoFormated}}" hidden>
                              <input type="text" id="inputHiringPrice"  name="inputHiringPrice" value="{{$hiringPrice}}" hidden>

                              <input type="text" id="newFinishDate"  name="newFinishDate" value="{{$todayDate2}}" hidden>

                              <button type="submit" class="btn btn-info">
                                    <i class="fa fa-save fa-1x " aria-hidden="true"></i>
                                    <b>Conclude Hiring and Get Last invoice</b>
                              </button>
                        @else
                              <a type="button" class="btn btn-info" href="/section/hiremachine/checklastinvoice/{{$thisHiringInfos->hiringMachineId}}">
                                    <i class="fa fa-save fa-1x " aria-hidden="true"></i>
                                    <b>Check the Last invoice</b>
                              </a>
                        @endif

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
                                  @elseif(($routebacktoviewpage ==  "allmachineshiringpage"))
                                  <a type="button" class="btn btn-danger" href="/section/internalMachines/view/{{$thisHiringInfos->machineId}}">
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
            // var dataComecoPadraoDateTime  = $("#start").val();
            var dataFimPadraoDateTime  = $("#end").val();
            var todayDate  = $("#todayDate").val();
            var day_start = new Date(todayDate);
            var day_end = new Date(dataFimPadraoDateTime);
            var total_days = (day_end - day_start) / (1000 * 60 * 60 * 24);
            // alert(total_days);
            // messageBoxDelayed, messageBoxDueToday, messageBoxOnTime

            if(total_days < 0){
                // alert('DELAYED');
                total_days = (total_days * -1);
                $msg = `THIS MACHINE IS  ${total_days}  DAYS DELAYED`;
                $('.messageBoxDelayed').removeClass('d-none').html($msg);
            }
            else if(total_days == 0){
              // alert('DELIVER TODAY');
                $msg = ' THIS HIRING FINISH TODAY';
                $('.messageBoxDueToday').removeClass('d-none').html($msg);
            }
            else{
                // alert('on time');
                $msg = (`THIS MACHINE IS ON TIME ${total_days} DAYS TO FINISH`);
                $('.messageBoxOnTime').removeClass('d-none').html($msg);
            }
            
            document.getElementById("nDaysleft").value = total_days;
        // document.getElementById("finishHiring").innerHTML = " ";

</script>


<!-- AQUI TBM NAO FUNCIONA TALVEZ NO EDIT  -->
<script>
      $(document).ready(function(){
              
              // $('#ajaxSubmit').click(function(e){
              $(document).on("click", "#chooseDateBtn", function(e){
              e.preventDefault();
              // alert(1);

              var dataComecoPadraoDateTime  = $("#start").val();
              var dataFimPadraoDateTime  = $("#finishEarlyDate").val();
              var machinePrice  = $("#machinePrice").val();
              var todayDate  = $("#todayDate").val();
              var todayDateFormated  = $("#todayDateFormated").val();
              document.getElementById("discount").value = 0.00;

              var dataComecoPadraoDateTime2  = $("#dataComecoPadraoDateTime2").val();
            
              var total_days = (dataFimPadraoDateTime - dataComecoPadraoDateTime) / (1000 * 60 * 60 * 24);

              // alert('dsadadasdasda', total_days);
              document.getElementById("end2").value = todayDateFormated;
              document.getElementById("end").value = dataFimPadraoDateTime;
              document.getElementById("totalDays").innerHTML = " ";
              document.getElementById("startHiring").innerHTML = " ";
              document.getElementById("finishHiring").innerHTML = " ";
              document.getElementById("totalDays").innerHTML = " ";
              // document.getElementById("firstDeposit").innerHTML = " ";

              
              var discount  = $("#discount").val();
              var day_start = new Date(dataComecoPadraoDateTime);
              var day_end = new Date(dataFimPadraoDateTime);
              var total_days = (day_end - day_start) / (1000 * 60 * 60 * 24);
              var findHiringPrice = (Math.round(total_days) * machinePrice) - discount;
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



              document.getElementById("totalDays").innerHTML = "Total days : "+   Math.round(total_days);
              document.getElementById("startHiring").innerHTML = "Hiring starts on : "+ dateJustCreated;
              document.getElementById("finishHiring").innerHTML = "Finishing starts on : "+ dateEndJustCreated;
              document.getElementById("totalDays").innerHTML = "Total days : "+   Math.round(total_days);
              document.getElementById("hiringPrice").innerHTML = "Suggested Hiring Price : £"+   hiringPrice2;
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
              document.getElementById("hiringPriceField").value = "";
              document.getElementById("hiringPriceField").value = hiringPrice2;
      
               });
            });
</script>


<!-- <script>
      $(document).ready(function(){
            // $('#ajaxSubmit').click(function(e){
              $(document).on("change", "#discount", function(e){
               e.preventDefault();

               var dataComecoPadraoDateTime  = $("#start").val();
               var dataFimPadraoDateTime  = $("#end").val();
               var machinePrice  = $("#machinePrice").val();
               var discount  = $("#discount").val();
               var hiringPriceField  = $("#hiringPriceField").val();


               
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


              document.getElementById("totalDays").innerHTML = "Total days : "+   Math.round(total_days);
              document.getElementById("startHiring").innerHTML = "Hiring starts on : "+ dataComecoPadraoDateTime;
              document.getElementById("finishHiring").innerHTML = "Finishing starts on : "+ dataFimPadraoDateTime;
              document.getElementById("totalDays").innerHTML = "Total days : "+   Math.round(total_days);
              document.getElementById("hiringPrice").innerHTML = "Suggested Hiring Price : £"+   hiringPrice2;
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
</script> -->

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

              var newHiringFieldPrice = hiringPriceField - discount;
              var newHiringFieldPrice = newHiringFieldPrice.toFixed(2);

              document.getElementById("hiringPriceField").value = "";
              // document.getElementById("inputFirstDeposit").value = "";
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
    $("#extraCost").on("change",function(){
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

