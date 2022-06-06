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

      <span>
            @include('sections.components.topnavbaroverviewcustomers')
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
              @if(session('warning'))
              <div class="alert alert-warning">
                  {{ session('warning') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                  </button>
              </div>
          @endif


          @if(session('error'))
            <div class="alert alert-danger">
              {{ session('error') }}
            </div>
          @endif

          @if(session('NoProdsQuotes'))
            <div class="alert alert-warning">
              {{ session('NoProdsQuotes') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
    <?php
      $from = 'viewPage';
    ?>



         <!-- Page Heading -->
         <div class="d-sm-flex align-items-center justify-content-between">
           <h3 class="h3 mb-0 text-black-800" style="color:black;"><strong><b>{{$thisCustomer->name}}'s</b> Page</strong></h3>
           <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
           <ul class="nav justify-content-center">
              <li class="nav-item">
                <a  class="btn btn-block btn-info btn-group nav-link" href="/section/customers/edit/{{$thisCustomer->id}}/{{$from}}"><b>Edit Profile </b></a>
              </li>
              <li class="nav-item">
                <a  class="btn btn-block btn-primary btn-group nav-link" href="/section/customers/"> All Customer's</a>
              </li>
           </ul>
         </div>
   <br>


     @if(isset($thisCustomer) )
      <!-- Heading Row -->
            <div class="row align-items-center my-3" style="text-align:center;">
              <div class="col-lg-6">
                          <img class="img-fluid"  src="/storage/{{$thisCustomer->image}}"
                          style="width: 150; height: 200px;">
              </div>
              <!-- /.col-lg-8 -->
              <div class="col-lg-3">
                  <h4 style="color:black;" ><small><b>This Customer Data:</b></small></h4>
                  <h4 style="color:black;" ><b>Name:</b>  <small>{{$thisCustomer->name}}</small></h4>
                  @if($thisCustomer->telephone != '77777777777')
                    <h4 style="color:black;"><b>Contact Number:</b> <small>{{$thisCustomer->telephone}}</small> </h4>
                  @endif
                  @if(count($findNewTelephones) > 0)
                    @foreach($findNewTelephones as $nt)
                      <h4 style="color:black;"><b>Extra  Number:</b> <small>{{$nt->telephoneNumber}}</small></h4>
                    @endforeach
                  @endif
                  @if($thisCustomer->email != 'email@mail.com')
                    <h4 style="color:black;"><b>Email:</b>  <small>{{$thisCustomer->email}}</small></h4>
                  @endif
                  @if($thisCustomer->address != 'Customer Address')
                  <h4 style="color:black;"><b>Address:</b>  <small>{{$thisCustomer->address}}</small></h4>
                  @endif
                  <a href="/section/customers/edit/{{$thisCustomer->id}}/{{$from}}"><i class="fas fa-edit"></i><b> Edit Profile </b></a>
                  <a href="/section/customers/destroy/{{$thisCustomer->id}}" onclick="return confirm('Are you sure that you want delete this Customer?');" style="color:#eb2a1c; text-color:white;">
                  <i class="fas fa-trash"></i><b> Remove Profile</b></a>
              </div>
              <!-- /.col-md-4 -->
            </div>
       <!-- /.row -->
      @endif




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
