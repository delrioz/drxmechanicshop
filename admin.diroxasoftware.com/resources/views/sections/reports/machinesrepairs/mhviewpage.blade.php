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
              @if(session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                    </button>
              </div>
          @endif



        
          <!-- Begin Page Content -->
          <div class="container-fluid">
          <!-- Begin Page Content -->

            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-black-800"><strong style="color:black;">THIS MACHINE HIRING REPORTS</strong><br></h1>
              <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
              </div>

          <?php
            $hoje = date('d/m/Y');
          ?>
          


          <?php
                $max = 26;
                $str = " $overviewpricesinfoshiremachines->internalmachineModel";
                $model=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                $max = 26;
                $str = " $overviewpricesinfoshiremachines->internalmachineBrand";
                $brand=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                $max = 26;
                $str = " $overviewpricesinfoshiremachines->internalmachineSnumber";
                $serial_number=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                $priceperday = number_format($overviewpricesinfoshiremachines->priceperday, 2, '.',',');
                $totalHireMachineIncome = number_format($overviewpricesinfoshiremachines->totalHireMachineIncome, 2, '.',',');
                $totaldiscount = number_format($overviewpricesinfoshiremachines->totaldiscount, 2, '.',',');
                $totalextracost = number_format($overviewpricesinfoshiremachines->totalextracost, 2, '.',',');


                $start = date('d/m/Y', strtotime($overviewpricesinfoshiremachines->internalMachineDateCreatedAt));

                $from = "machinehireviewpage";

            ?>

        <div class="show-range">
        </div>

            <!-- Content Row -->
            <div class="row">
              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        <a style="color:blue"> TOTAL TIMES HIRED </a>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><strong style="color:green;" id="seeopenworks" class="seeopenwrks">{{$Nhiredmachinebycustomer}}</strong></div>
                        <b>How many times this machine was hired</b>
                      </div>
                      <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        <a style="color:blue"> TOTAL INCOME WITH THIS MACHINE HIRED </a>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><strong style="color:green;" id="seeopenworks" class="seeopenwrks">£{{$totalHireMachineIncome}}</strong></div>
                        <b>Amount spent with this hired machine</b>
                      </div>
                      <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        <a style="color:blue">TOTAL DISCOUNT</a>
                        </div>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><strong style="color:green;" id="seeopenworks" class="seeopenwrks">£{{$totaldiscount}}</strong></div>
                              <b>Amount total with discount on this hiring machine</b>
                          </div>
                          <div class="col">
                          </div>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Pending Requests Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        <a style="color:blue"> TOTAL EXTRA COST </a>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><strong style="color:green;" id="seeopenworks" class="seeopenwrks">£{{$totalextracost}}</strong></div>
                          <b>Total amount from extra cost prices</b>
                      </div>
                      <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
              </div>
              </div>
            </div>


     
   
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

                              <div class="form-group col-md-6">
                              @if(count($allproducts)  > 0)
                                        <div class="form-group">
                                            <div class="form-group col-md-12">
                                              <label for="" style='color:black;'><b>Products</b></label><br>
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
                          </div>

                          <div class="row">
                                      <div class="form-group col-md-6">
                                            <label for="" style="color:black;"><b>STATUS</b></label>
                                                        <select id="condition" name="condition" class="form-control categoriesOptions" disabled>
                                                            <option value="0">AVAILABLE FOR HIRING</option>
                                                            <option value="1">UNAVAILABLE FOR HIRING</option>
                                                        </select>
                                      </div>

                                      <div class="form-group col-md-6">
                                            <label for="" style="text-align:center;color:black;"><b>Price per Day (GBP)</b></label>
                                                  <input id="machinePrice" name="machinePrice"
                                                  maxlength="191"
                                                  placeholder="machinePrice" class="form-control" type="text"
                                                  value="{{$machinePrice}}"
                                                  disabled>
                                                  
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
                                      </div>
                                </div>
                                
                                </div>
                        </section>
      <!-- /.container-fluid -->

            
       <!-- Page Heading -->
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">History machine  hiring</h6>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                        <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->
                            <th style="font-family:verdana; font-size:100%; color:#38393b;" >Id</th>
                            <th style="font-family:verdana; font-size:100%; color:#38393b;" >Serial Number</th>
                            <th style="font-family:verdana; font-size:100%; color:#38393b;" >Model</th>
                            <th style="font-family:verdana; font-size:100%; color:#38393b;" >Brand</th>
                            <th style="font-family:verdana; font-size:100%; color:#38393b;" >Hired by</th>
                            <th style="font-family:verdana; font-size:100%; color:#38393b;" >Status</th>
                            <th style="font-family:verdana; font-size:100%; color:#38393b;" >Started At</th>
                            <th style="font-family:verdana; font-size:100%; color:#38393b;"  scope="col">Actions</th>
                        </tr>
                        </thead>

                        <tbody>
            @foreach($hiredmachinebycustomer as $customerandmachine)

                        <tr>

                        <?php
                            $max = 26;
                            $str = " $customerandmachine->customerName";
                            $owner=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                            $max = 26;
                            $str = " $customerandmachine->brand";
                            $brand=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                            $max = 26;
                            $str = " $customerandmachine->internalmachinesSnumber";
                            $serial_number=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                            $max = 26;
                            $str = " $customerandmachine->model";
                            $model=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                            $start = date('d/m/Y', strtotime($customerandmachine->created_at));

                            $sttsNumer = $customerandmachine->hiringMachinesStatus;
                            if($sttsNumer == 0){
                                $status = "ON HIRE";
                              }
                              else{
                                $status = "AVAILABLE";
                              }

                              if ($sttsNumer == 0)
                              {
                                  $ShowStatus = "ON HIRE";
                                  $statusHiringMachine = "OPEN";

                                  $color = "color:orange";
                              }
                              else if ($sttsNumer == 1)
                              {
                                  $ShowStatus = "HIRE FINISHED";
                                  $statusHiringMachine = "CLOSED";
                                  $color = "color:green";
                              }
                              
                        ?>

                        <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->


                        <td style="font-family:verdana; font-size:100%; color:black;"><b>{{$customerandmachine->internalmachinesid}}</b></td>
                        <td style="font-family:verdana; font-size:100%; color:black;"><b>{{$serial_number}}</b></td>
                        <td style="font-family:verdana; font-size:100%; color:black;"><b>{{$model}}</b></td>
                        <td style="font-family:verdana; font-size:100%; color:black;"><b>{{$brand}}</b></td>
                        <td style="font-family:verdana; font-size:100%; color:black;"><b>{{$owner}}</b></td>
                        <!-- <td style="font-family:verdana; font-size:100%; color:black;"><b>{{$start}}</b></td> -->
                        <td>
                            @if($sttsNumer == 1 )
                                  <h5><span class="badge badge-danger" style="font-family:verdana; color:white;"><b>{{$ShowStatus}}</b></span></h5>
                                @elseif($sttsNumer == 0)
                                  <h5><span class="badge badge-warning" style="font-family:verdana; color:white;"><b>{{$ShowStatus}}</b></span></h5>
                                @elseif($sttsNumer == 2)
                                <h5><span class="badge badge-warning" style="font-family:verdana; color:white;"><b>{{$ShowStatus}}</b></span></h5>
                            @endif
                      </td>
                      <td style="font-family:verdana; font-size:100%; color:black;"><b>{{$start}}</b></td>
            
                      <td>
                            <!-- <a href="/section/machines/viewPage/{{$customerandmachine}}" class="btn btn-success btn-group">View Page</a> -->
                            <a href="/section/allhiremachiness/viewPage/{{$customerandmachine->Hid}}/{{$customerandmachine->machineId}}/{{$statusHiringMachine}}/{{$from}}" class="btn btn-success btn-group"><b>View Page</b></a>

                      </td>
                        </tr>
                    @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
            </div>

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
              var discount  = $("#discount").val();



              // var total_days = (dataFimPadraoDateTime - dataComecoPadraoDateTime) / (1000 * 60 * 60 * 24);
              // alert('dsadadasdasda', total_days);

              document.getElementById("totalDays").innerHTML = " ";
              document.getElementById("startHiring").innerHTML = " ";
              document.getElementById("finishHiring").innerHTML = " ";
              document.getElementById("totalDays").innerHTML = " ";
              document.getElementById("firstDeposit").innerHTML = " ";

              var day_start = new Date(dataComecoPadraoDateTime);
              var day_end = new Date(dataFimPadraoDateTime);
              var total_days = (day_end - day_start) / (1000 * 60 * 60 * 24);
              var findHiringPrice = (Math.round(total_days) * machinePrice) - discount;
              var firstDepositPercentage = findHiringPrice * 0.20;
              var hiringPrice2 = findHiringPrice.toFixed(2);
              var firstDepositPercentage2 = firstDepositPercentage.toFixed(2);

              document.getElementById("totalDays").innerHTML = "Total days : "+   Math.round(total_days);
              document.getElementById("startHiring").innerHTML = "Hiring starts on :"+ dataComecoPadraoDateTime;
              document.getElementById("finishHiring").innerHTML = "Finishing starts on :"+ dataFimPadraoDateTime;
              document.getElementById("totalDays").innerHTML = "Total days : "+   Math.round(total_days);
              document.getElementById("hiringPrice").innerHTML = "Hiring Price : £"+   Math.round(hiringPrice2);
              document.getElementById("firstDeposit").innerHTML = "First deposit Price (20%) :  £"+  firstDepositPercentage2;


              // <input type="text" id="inputStartHiring">
              // <input type="text" id="inputfinishHiring">
              // <input type="text" id="inputTotalDays">
              // <input type="text" id="inputHiringPrice">
              // <input type="text" id="inputFirstDeposit">

              document.getElementById("inputStartHiring").value = "";
              document.getElementById("inputfinishHiring").value = "";
              document.getElementById("inputTotalDays").value = "";
              document.getElementById("inputHiringPrice").value = "";
              document.getElementById("inputFirstDeposit").value = "";

              document.getElementById("inputStartHiring").value = dataComecoPadraoDateTime;
              document.getElementById("inputfinishHiring").value = dataFimPadraoDateTime;
              document.getElementById("inputTotalDays").value = total_days;
              document.getElementById("inputHiringPrice").value = findHiringPrice;
              document.getElementById("inputFirstDeposit").value = firstDepositPercentage;

              

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

