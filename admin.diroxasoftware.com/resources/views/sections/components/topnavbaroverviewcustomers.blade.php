
<!-- Begin Page Content -->
<div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Overview about <a href="/section/customers/viewPage/{{$thisCustomer->id}}"> {{$thisCustomer->name}}</a> </h1>
          <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
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
                  <a href="/section/machines/{{$thisCustomer->id}}"> BIKES REGISTERED</a>
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{$NthisCustomerMachines}}</div>registered<br>
                  <!-- <a type="button" href="/section/customers/viewPage/allbikes/{{$thisCustomer->id}}" class="btn btn-primary"><b>ADD NEW BIKE</b></a> -->
                  <a type="button" href="/section/customers/createmachineonviewpage/{{$thisCustomer->id}}" class="btn btn-primary"><b>ADD NEW BIKE</b></a>
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
                <a href="/section/workOrder/index/{{$thisCustomer->id}}" style="color:green"> WORK ORDERS MADE</a>
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$NthisCustomerWK}}</div>actives<br>
                <!-- <a type="button" href="/section/workOrder/create" class="btn btn-primary"><b>ADD NEW BIKE</b></a> -->
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
                <a href="/section/sales/allsales/{{$thisCustomer->id}}" style="color:orange"> PRODUCTS BOUGHT</a>
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$NthisCustomerProductsBought}}</div>actives<br>
                <a href="/section/buysection/index" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                          class="fas fa-shopping-cart fa-sm text-white-50"></i> <b>GO TO THE CART</b></a>
              </div>
              <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
      </div>
    </div>
    </div>

    @if($Nappointments != 0)
    <div class="alert alert-warning">
          <p> This customer has {{$Nappointments}} appointments booked</p> 
          <a href="/section/appointments/index/{{$thisCustomer->id}}"> Check appointments</a>
    </div>
    @endif


