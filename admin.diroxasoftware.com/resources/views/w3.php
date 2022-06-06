<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <title>Diroxa Software</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('admlyt/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('admlyt/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<style>


body,html{
    height: 100%;
    width: 100%;
    margin: 0;
    padding: 0;
    background: #e74c3c !important;
    }

    .searchbar{
    margin-bottom: auto;
    margin-top: auto;
    height: 60px;
    background-color: #353b48;
    border-radius: 30px;
    padding: 10px;
    }

    .search_input{
    color: white;
    border: 0;
    outline: 0;
    background: none;
    width: 0;
    caret-color:transparent;
    line-height: 40px;
    transition: width 0.4s linear;
    }

    .searchbar:hover > .search_input{
    padding: 0 10px;
    width: 450px;
    caret-color:red;
    transition: width 0.4s linear;
    }

    .searchbar:hover > .search_icon{
    background: white;
    color: #e74c3c;
    }

    .search_icon{
    height: 40px;
    width: 40px;
    float: right;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    color:white;
    text-decoration:none;
    }

</style>

      <span>
            @include('sections.components.topnavbar')
      </span>


      @if (session('status'))
          <div class="alert alert-warning">
              {{ session('status') }}
          </div>
        @endif


      <?php
          $from = "welcomePage";
      ?>


        <!-- Begin Page Content -->
        <div class="container-fluid">


          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-black-800" style="color:black;"><strong><b>Dashboard</b></strong></h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!-- Content Row -->



          <!-- Content Row -->
          <div class="row">

              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-primary shadow h-100 py-2">
                      <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                      <a href="/section/customers"> User Active</a> </div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{$Ncustomer}}</div>
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
                  <div class="card border-left-success shadow h-100 py-2">
                      <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                      <a href="/section/machines">Users Motorcycles</a></div>
                                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$Nmachine}}</div>
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
                  <div class="card border-left-info shadow h-100 py-2">
                      <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                  <a href="/section/workOrder/index/"> Work Orders</a>
                                  </div>
                                  <div class="row no-gutters align-items-center">
                                      <div class="col-auto">
                                         <div class="h5 mb-0 font-weight-bold text-gray-800">
                                          {{$NworkOrder}}
                                         </div>actives
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
                  <div class="card border-left-warning shadow h-100 py-2">
                      <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                      <a href="section/workOrder/index/waitingforcollections"> Machines Waiting for Collection</a></div>
                                      <div class="col-auto">
                                         <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{$Nwkwaitingforcollection}}
                                         </div>waiting for collection
                                      </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          
      <!-- Content Row -->
         <h4 class="h3 mb-0 text-black-800" style="color:black;"><strong><b>Quick Access</b></strong></h4><br>
          <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4" >
                        <div class="card-body" ><b>Sales Reports</b></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a type="button" class="btn bnt-danger" href="/section/reports/SalesReports" style="color:black;">
                            <i class="fa fa-eye fa-1x " aria-hidden="true"></i>
                                Access Sales Reports</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body"><b>Products Reports</b></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a type="button" class="btn bnt-danger" href="/section/reports/products" style="color:black;">
                            <i class="fa fa-eye fa-1x " aria-hidden="true"></i>
                            Access Products Reports</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-info text-white mb-4">
                        <div class="card-body"><b>Quick Search All Pages</b></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a type="button" class="btn bnt-danger" href="/section/searches/index" style="color:black;">
                              <i class="fa fa-search fa-1x " aria-hidden="true"></i>
                              Go to All Pages Search</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body"><b>All Categories</b></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a type="button" class="btn bnt-danger"href="/section/categories/" style="color:black;">
                            <i class="fa fa-eye fa-1x " aria-hidden="true"></i>
                            Check All Categories</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                    </div>
            </div>

          <div class="row">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3">
                      <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                          </div>
                          <div class="col-auto">
                          </div>
                      </div>
                </div>
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-dark shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                          <a href="/section/carrito/index" style="color:black"> CART</a>
                          </div>
                          <div class="row no-gutters align-items-center">
                            <div class="col-md-6">
                             <i class="fa fa-shopping-cart fa-4x" aria-hidden="true"></i><br><br>
                              <a type="button" href="/section/buysection/index" class="btn btn-info" >
                              <i class="fa fa-plus fa-1x " aria-hidden="true"></i>
                                <b>MAKE NEW SELL</b></a>
                            </div>
                            <div class="col">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-dark shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                          <a href="/section/quote" style="color:black"> SEE ALL SALES SO FAR</a>
                          </div>
                              <h1><b>{{$NumberOfSales}} sales</b></h1>
                              <br>
                              <a type="button" href="/section/sales/allsales" class="btn btn-info">
                              <i class="fa fa-eye fa-1x " aria-hidden="true"></i>
                                  <b>SEE ALL SALES</b>
                              </a>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
          </div>
          <br>
          <div class="container h-60">
                  <form method="POST" action="/function/dashboardPageSearch">
                    @csrf
                      <div class="input-group" >
                        <input type="text" class="form-control searchBox" placeholder="Search by Customer Name" name="searchBox" id="searchBox" onChange="searchFunct(searchBox);">
                        <div class="input-group-btn">
                        <a  class="search_icon"><i class="fas fa-search"></i></a>
                    </form>
              </div>
            </div>

            <span id="tableTitle" class="d-none">
                  <div class="title ">
                    <div class="alert alert-warning">
                        <h5>Customers Found</h5>
                    </div>
                  </div>

                    <div class="row">
                    <table class="table">
                        <thead>
                          <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Contact Number:</th>
                            <th>Email</th>
                            <th scope="col">Actions</th>

                          </tr>
                        </thead>
                        <tbody class="dataTable" id="dataTable">

                        </tbody>
                      </table>
                  </div>
              </span>
          </form>
        </div>
        <br>

          <!-- Content Row -->

          <div class="row">

          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
        @if(isset($ProductbestSeller->image))
            <div class="col-lg-6 mb-4">
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Best Seller Product</h6>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <img src="/storage/{{$ProductbestSeller->image}}" class="card-img-top" style="width: 300px; height: 200px;!important">
                    </div>
                    <div class="col-md-6">
                      <ul>
                      <li><h4>Quantities Sold: <b>{{$ProductbestSeller->totalQuantitySales}}</b></h4></li>
                      <li><h4>Product Id: <b>{{$ProductbestSeller->id}}</b></h4></li>
                      <li><h4>Product Name: <b>{{$ProductbestSeller->name}}</b></h4></li>
                      </ul>
                    </div>
                  </div>
                </div>
                </div>
              </div>
        @endif
            <!-- Content Column -->
            <div class="col-lg-6 mb-4">
                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><h5 style = "color:orange"><strong>STAY ALERT</strong></h5 style="color:orange;"><strong  style="color:black;!important">Products in Low quantity</strong><small> products with 5 unities or less in stock</small></h6>
                  </div>
                  <div class="card-body">
                  @foreach($productslowquantities as $lowQuantitys)
                    <div class="h5 mb-0 font-weight-bold text-black-800" style="color:black;">{{$lowQuantitys->name}}<small style="color:red;"> only {{$lowQuantitys -> quantity}} itens</small> <a href="/section/products/edit/{{$lowQuantitys->id}}"> add more</a>
                    </div>
                  @endforeach
                  <a style="color:orange;" href="/section/reports/lowproducts">See all low products in Stock</a>
                    </div>
                  </div>
              </div>
          </div>
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



<script>
      $(document).ready(function(){
        // alert(1);

            // $('#ajaxSubmit').click(function(e){
              $(document).on("change", "#searchBox", function(e){

                var inputSearch = searchBox.value;
                // alert(inputSearch);
                // var comboCidades = $('#mselect option:selected').val();

               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               $.ajax({
                  url: "{{ url('/home/searchingCustomerAjax') }}",
                  method: 'post',
                  data: {
                     data: inputSearch,
                     _token: '{{csrf_token()}}'},

                  success: function(result){

                    $resp = result;
                    // console.log($resp);

                    if($resp == 0){
                        alert('Nothing was found matching this datas');
                        $('#dataTable').empty();
                        $("#tableTitle").addClass("d-none")
                        document.getElementById('searchBox').value = '';
                    }

                    else{

                      $("#tableTitle").removeClass("d-none")

                      $('#dataTable').empty();
                      $.each($resp, function (key, value){
                        $("#dataTable").append(`
                          <tr>
                                <td> <img src="/storage/`+ value.image + `" class="media-photo"
                                  style="width: 70px; height:70px;" alt="/storage/`+ value.image + `"></td>
                                <td>` + value.name + `</td>
                                <td>` + value.telephone + `</td>
                                <td>`+ value.email + `</td>
                                <td>
                                    <a href="/section/customers/viewPage/`+ value.id + `" class="btn btn-success btn-group"><b>View Page</b></a>
                                    <a href="/section/customers/edit/`+ value.id + `" class="btn btn-primary btn-group"><b>Edit</b></a>
                                    <a href="/section/customers/destroy/`+ value.id + `"  class="btn btn-danger btn-group"
                                    onclick="return confirm('Are you sure that you want delete this Customer?');">
                                    <b>Remove</b></a>
                                </td>

                          </tr>
                      `);

                  });
                  } // fim do else
                  },
                  error: function(jqXHR, textStatus, errorThrown, result) {
                      // console.log(jqXHR.responseJSON.errors)
                      Alert('Some ERROR try again');
                      $msg = 'oi';
                      $resp = jqXHR.responseJSON.errors;
                      $('.dataTable').empty();
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
  <script src="{{ asset('admlyt/vendor/chart.js/Chart.min.js') }}"></script>


  <!-- Page level custom scripts -->
  <script src="{{ asset('admlyt/js/demo/chart-area-demo.js') }}"></script>
  <script src="{{ asset('admlyt/js/demo/chart-pie-demo.js') }}"></script>


</body>

</html>
