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

</head>

      <span>
            @include('sections.components.topnavbar')
      </span>


      
        <!-- Begin Page Content -->
        <div class="container-fluid">

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

            @if(session('error'))
              <div class="alert alert-danger">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                  </button>
              </div>
          @endif


            <!-- Page Content -->
      <div class="container-fluid">
        <div class="py-5 bg-light">
            <div class="container">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="h3 m-0 font-weight-bold text-primary"><b>Sales Info's</b></h6>
              <a href="/section/sales/allsales" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                      class="fas fa-eye fa-sm text-white-50"></i> <b>ALL SALES</b></a>
          </div>
              <div class="row">
              
                  <?php
                    $max = 45;
                    $str = " $allsales->model";
                    $model=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                    $max = 26;
                    $str = " $allsales->serial_number";
                    $serial_number=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                    $max = 26;
                    $str = " $allsales->brand";
                    $brand=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                    $max = 26;
                    $str = " $allsales->brand";
                    $brand=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                    
                    if($allsales->status == 0){
                      $statusName = "PAID";
                    }
                    else if($allsales->status == 1){
                       $statusName = "AWAITING PAYMENT";
                    }
                    

                    $from = "viewsalespage";  

                    $paymentStart = date('d/m/Y', strtotime($allsales->created_at));


                    $price = number_format($allsales->price, 2, '.',',');
                    $totalToBePaid = number_format($allsales->totalToBePaid, 2, '.',',');
                    $total = number_format($allsales->sales_price, 2, '.',',');
                    $priceper1week = number_format($allsales->priceper1week, 2, '.',',');

                  ?>

                

                </div>

              <div class="row">
                <div class="col-md-6">
                    <div class="card-body">
                      <h3 class="card-title"><p><b>Status: </b><small><strong style="color:#060b30;">{{$statusName}}</strong></p></small></h3>
                      <h3 class="card-title"><p><b>Total to pay: </b><small><strong style="color:#060b30;">£{{$totalToBePaid}}</strong></p></small></h3>
                      <h3 class="card-title"><p><b>Total paid so far: </b><small><strong style="color:#060b30;">£{{$total}}</strong></p></small></h3>
                      <h3><b>First Amount Paid: </b><small><strong style="color:#060b30;">£{{$allsales->firstAmountPaid }}</strong></small></h3>
                      <h3><b>Payment Method: </b><small><strong style="color:#060b30;">{{$allsales->methodPayment}}</strong></small></h3>
                      <!-- <h3><b>Status: </b><small><strong style="color:#060b30;">{{$statusName}}</strong></small></h3> -->
                  </div>
                </div>
                <div class="col-md-6">
                        <h3><b>Payments Options: </b><small><strong style="color:#060b30;">{{$allsales->paymentsOptions}}</strong></small></h3>
                        <h3><b>Total Number of Payments:</b> <strong style="color:#060b30;">{{$allsales->Npayments}}</strong></small></h3>
                        <h3><b>Number of Payments Left: </b><small><strong style="color:#060b30;">{{$allsales->NpaymentsLeft}}</strong></small></h3>
                        <h3><b>First Payment: </b><small><strong style="color:#060b30;">{{$paymentStart}}</strong></small></h3>
                        <h3><b>Last Payment: </b><small><strong style="color:#060b30;">{{$allsales->lastPaymentDate}}</strong></small></h3>
                        @if($salesStatus == 1)
                          <a href="" class="btn btn-success" data-toggle="modal" data-target="#exampleModal"><b>MAKE NEW PAYMENT</b></a>
                        @endif
                        @if($salesStatus == 1)
                          <a href="" class="btn btn-info" data-toggle="modal" data-target="#exampleModal2"><b>CHECK NEXT PAYMENTS</b></a>
                        @endif
                  </div>
                  
              </div>
            </div>
        </div>

        <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><b>Products found in this sale</b></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <!-- 'name', 'serial_number', 'categorie', 'situation', 'year', 'brand', 'image', 'price', 'discount', 'about' -->

                      <th style="font-family:verdana; font-size:95%; color:#38393b;">Image</th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;">Name</th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;">Seling Price</th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;">Cost Price</th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;">Quantity Sold</th>
                     <th style="font-family:verdana; font-size:95%; color:#38393b;" scope="col">Actions</th>

                    </tr>
                  </thead>

                  <tbody>
                @foreach($ProductsinTheInvoice as $product)

                    <tr>
                    <?php

                    $max = 10;
                    $str = " $product->name ";
                    $name=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                    $max = 10;
                    $str = " $product->about ";
                    $about=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                    $Sell_Price = number_format($product->Sell_Price, 2, '.',',');
                    $Cost_Price = number_format($product->Cost_Price, 2, '.',',');

                    ?>


                    <td>
                    <img src="/storage/{{$product->image}}" class="img-fluid img-thumbnail"
                    style="width: 100px; height:100px;"alt="Sheep">
                    </td>

                    <td style="font-family:verdana; color:black;"><b>{{$name}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>£{{$Sell_Price}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>£{{$Cost_Price}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$product->quantity}}</b></td>
                    <td>
                        <!-- <a href="/section/products/view/{{ $product->productId }}" class="btn btn-primary btn-circle" style="background-color:#050d80"><i class="fas fa-eye"></i></a> -->
                        <a class="btn btn-success" href="/section/products/view/{{ $product->ProductId }}">View Product</a>                     
                    </td>
                    </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            </div>
          </div>

           <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><b>Payments maded</b></h6>
                <a href="/section/sales/allsales/invoice/{{$allsales->id}}/{{$from}}" class="btn btn-success btn-group">Check the General Invoice</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <!-- 'name', 'serial_number', 'categorie', 'situation', 'year', 'brand', 'image', 'price', 'discount', 'about' -->

                      <th style="font-family:verdana; font-size:95%; color:#38393b;">Id</th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;">Description</th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;">Sales Price (GBP)</th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;">Method Payment</th>
                      <th style="font-family:verdana; font-size:95%; color:#38393b;">Payment Number</th>
                     <th style="font-family:verdana; font-size:95%; color:#38393b;" scope="col">Actions</th>

                    </tr>
                  </thead>

                  <tbody>
                @foreach($findLatePaymentSales as $latePayment)

                    <tr>
                    <?php

                    $max = 10;
                    $str = " $latePayment->name ";
                    $name=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                    $max = 10;
                    $str = " $latePayment->about ";
                    $about=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                    $max = 10;
                    $str = " $latePayment->description ";
                    $description=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                    $sales_price = number_format($latePayment->sales_price, 2, '.',',');
                    $Cost_Price = number_format($latePayment->Cost_Price, 2, '.',',');

                    ?>


                    <td style="font-family:verdana; color:black;"><b>{{$latePayment->id}}</b></td>  
                    
                    <td style="font-family:verdana; color:black;"><b>{{$description}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>£{{$sales_price}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$latePayment->PaymentMethod}}</b></td>
                    <td style="font-family:verdana; color:black;"><b>{{$latePayment->invoiceNumber}}</b></td>
                    <td> 
                        <a href="/section/sales/latepaymentsinvoices/{{$latePayment->id}}/{{$latePayment->invoiceNumber}}/{{$from}}" style="background-color:#050d80" class="btn btn-block text-white btn-circle">
                                        <i class="fas fa-eye"></i>
                        </a>
                    </td>
                    
                    </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

          

    <form action="{{route('sales.makeApayment')}}" method="POST" name="formSearch">
        @csrf
          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Payments</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <h2 style="color:black; text-align:center;">Order Amount:</h2>
                          <h4 style="color:black; text-align:center;" id="orderAmount" name="orderAmount" class="orderAmount"
                              value="{{$totalToBePaid}}">£{{$totalToBePaid}}
                          </h4>
                        <br>
                        <div class="form-group">
                        <h2 style="color:black; text-align:center;">Pay Today:</h2>
                            <input id="payToday" name="payToday"  id="payToday"  
                                placeholder="NumberPayments" class="form-control" type="text" value="{{$allsales->firstAmountPaid }}"
                                disabled >

                            <input id="payToday" name="payToday"  id="payToday"  
                                placeholder="NumberPayments" class="form-control" type="text" value="{{$allsales->firstAmountPaid }}"
                                required hidden>

                                
                            <input id="thisSaleId" name="thisSaleId"  id="thisSaleId"  
                                 class="form-control" type="text" value="{{$allsales->id}}"
                                required hidden>
                        </div>

                        <span class="upfrontinicial" hidden>
                            <input id="upfrontBox" name="upfrontBox"  id="upfrontBox"  
                                value="1"
                                placeholder="NumberPayments" class="form-control" type="text"
                                required >
                        </span>
                        
                        <span id="NumberPayments" class="NumberPayments">

                        </span>

                        <span id="datePayments" class="datePayments">

                        </span>
                     

                         
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-block" id="procesar-compra">Make payment</button>
                    </div>
                    </div>
                    </form>
                </div>
            </div>

      </div>

      @if($showDates == true)
              <!-- Modal -->
              <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Payments</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <h2 style="color:black; text-align:center;">Payments Dates:</h2>
                            <ul>
                          
                                @foreach($allpaydays as $payday)
                                <li>
                                    <p style="color:black;">
                                      <b>£{{$totalToBePaid}} will be paid on: {{$payday}}</b>
                                    </p>
                                </li>
                                @endforeach
                            </ul>
                            
                        </div>
                        <div class="modal-footer">
                              <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
          </div>
        @endif




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

  




  </div>
  </div>


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
