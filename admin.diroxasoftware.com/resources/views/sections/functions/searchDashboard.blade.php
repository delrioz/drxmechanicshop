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

  <style>
  #titleLetter{
      color:#050d80;
  }
  #paragsStyle{
      color:black;
      font-size:17px;
  }
  #BlackTypeStyle{
      color:black;
      font-size:22px;
  }

  </style>
</head>

      <span>
            @include('sections.components.topnavbar')
      </span>

      
      @if (session('status'))
          <div class="alert alert-warning">
              {{ session('status') }}
          </div>
        @endif
        
     <!-- Begin Page Content -->
     <div class="container-fluid">

         <!-- Page Heading -->
         <div class="d-sm-flex align-items-center justify-content-between mb-4">
           <h3 class="h3 mb-0 text-gray-800">{{$thisCustomer->name}}</h3>
           <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
         </div>


   <br>

   <!-- Begin Page Content -->
   <div class="container-fluid">
     <!-- Begin Page Content -->

     @if(isset($thisCustomer) )

               <!-- Content Row -->
               <div class="row">

                 <!-- Content Column -->
                 <div class="col-lg-12 mb-4">

                   <!-- Project Card Example -->
                   <div class="card shadow mb-4">
                     <div class="card-header py-3">
                       <h6 class="m-0 font-weight-bold text-primary">Customer Found</h6>
                     </div>
                     <div class="card-body">
                     <div class="row">
                       <div class="col-md-6">
                         <img class="img-fluid"  src="/storage/{{$thisCustomer->image}}"
                          style="width: 150; height: 200px;">
                       </div>
                     <div class="col-md-6">
                       <h4 style="color:black;" >Name:  <small>{{$thisCustomer->name}}</small></h4>
                       <h4 style="color:black;">Telephone: <small>{{$thisCustomer->telephone}}</small> </h4>
                       <h4 style="color:black;">Email:  <small>{{$thisCustomer->email}}</small></h4>
                       <h4 style="color:black;">Address:  <small>{{$thisCustomer->address}}</small></h4>  
                       </div>
                       </div>
                     </div>
                     </div>
                   </div>
                </div>

        @endif


<!-- Begin Page Content -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">ALL MACHINES FROM {{$thisCustomer->name}}
     <a  class="m-0 font-weight-bold text-success"href="/section/customers/createmachineonviewpage/{{$thisCustomer->id}}">ADD NEW MACHINE</a></h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
          <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->

            <th>Id</th>
            <th>Serial Number</th>
            <th>Model</th>
            <th>Brand</th>
            <th>Owner</th>
           <th scope="col">Actions</th>

          </tr>
        </thead>
@if(count($allmachineswithowner) > 0)
        <tbody>
          @foreach($allmachineswithowner as $machine)

          <tr>
          <?php

          $max = 26;
          $str = " $machine->id";
          $machineId=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

          $max = 26;
          $str = " $machine->customerName";
          $owner=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


          $max = 26;
          $str = " $machine->brand";
          $brand=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

          $max = 26;
          $str = " $machine->serial_number";
          $serial_number=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

          $max = 26;
          $str = " $machine->model";
          $model=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

          ?>

          <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->

          <td>{{$machineId}}</td>
          <td>{{$serial_number}}</td>
          <td>{{$model}}</td>
          <td>{{$brand}}</td>
          <td>{{$owner}}</td>

          <td>
              <a href="/section/machines/viewPage/{{$machine->id}}" class="btn btn-success btn-group">View Page</a>
              <a href="/section/machines/edit/{{$machine->id}}" class="btn btn-primary btn-group">Edit</a>
              <a href="/section/machines/destroy/{{$machine->id}}"  class="btn btn-danger btn-group"
              onclick="return confirm('Are you sure that you want delete this Machine?');">
                  Remove</a>
          </td>
          </tr>
      @endforeach
    </tbody>
@endif 

@if(count($allmachineswithowner) <= 0)
    <div class="alert alert-danger">
        <h5>{{$thisCustomer->name}} has no machines created his name</h5>
    </div>
@endif
      </table>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



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
