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

     <!-- Begin Page Content -->
     <div class="container-fluid">

         <!-- Page Heading -->
         <div class="d-sm-flex align-items-center justify-content-between mb-4">
           <h1 class="h3 mb-0 text-black-800" style="color:black;"><b>Searching Products in Machines</b></h1>
           <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
         </div>

         <div class="alert alert-info">
            @if(isset($name))
              <h4><p><b>Type the Machine mode/name and we we'll show you all products in this Machine</b></p></h4>
              <h5><b>Searching for {{$name}}</b></h5>
            @endif

         </div>
         <!-- Content Row -->

   <br><br><br>

   <div class="container h-100">
   <div class="d-flex justify-content-center h-100">
   <form  name="formSearch" method="POST" action="{{route('productsinmachines.search')}}" class="form form-inline">
              @csrf
                      <input type="text" name="name" id="name" class = "form-control" 
                        placeholder = "Search by a machine's name">
                      <!-- <input type="text" name="sobre" id="" class = "form-control" placeholder = "Sobre"> -->
                      <button type="submit" class="btn btn-primary ml-2"  style="background-color:#050d80">Search</button>
      </form>

     </div>
   </div>
   </div>
   <br>

   <!-- Begin Page Content -->
   <div class="container-fluid">
     <!-- Begin Page Content -->

     @if(isset($allmachinedatas) )

              <?php
                  $formateddate = date('d-m-Y', strtotime($allmachinedatas->created_at));
              ?>

               <!-- Content Row -->
               <div class="row">

                 <!-- Content Column -->
                 <div class="col-lg-6 mb-4">

                   <!-- Project Card Example -->
                   <div class="card shadow mb-4">
                     <div class="card-header py-3">
                       <h6 class="m-0 font-weight-bold text-primary"><b>Machine found</b></h6>
                     </div>
                     <div class="card-body">
                       <h4 style="color:black;"><b>Model:</b>  <small>{{$allmachinedatas->model}}</small></h4>
                       <h4 style="color:black;"><b>Id:</b> <small>{{$allmachinedatas->id}}</small> </h4>
                       <h4 style="color:black;"><b>Serial_number:</b>  <small>{{$allmachinedatas->serial_number}}</small></h4>
                       <h4 style="color:black;"><b>Brand:</b>  <small>{{$allmachinedatas->brand}}</small></h4>
                       <h4 style="color:black;"><b>Owner:</b>  <small>{{$allmachinedatas->customerName}}</small></h4>
                       <h4 style="color:black;"><b>Created at:</b>  <small>{{$formateddate}}</small></h4>

                       </div>
                     </div>
                   </div>

                     <!-- Content Column -->
                     <div class="col-lg-6 mb-4">

                       <!-- Project Card Example -->
                       <div class="card shadow mb-4">
                         <div class="card-header py-3">
                           <h6 class="m-0 font-weight-bold text-primary"><b>Products found in this machine</b></h6>
                         </div>
                         <div class="card-body">
                          @foreach($allproducts as $prod)
                           <h5><a href="/section/products/view/{{$prod->productId}}">{{$prod->productName}}</a></h5>
                          @endforeach
                           </div>
                         </div>
                       </div>
                       </div>

        @endif


<!-- Page Heading -->
<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
 <h6 class="m-0 font-weight-bold text-primary"><b>Products</b></h6>
</div>
<div class="card-body">
 <div class="table-responsive">
   <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
     <thead>
       <tr>
         <th style="font-family:verdana; font-size:95%; color:#38393b;">Image</th>
         <th style="font-family:verdana; font-size:95%; color:#38393b;">SKU</th>
         <th style="font-family:verdana; font-size:95%; color:#38393b;">Name</th>
         <th style="font-family:verdana; font-size:95%; color:#38393b;">Category</th>
         <th style="font-family:verdana; font-size:95%; color:#38393b;">Sell Price</th>
         <th style="font-family:verdana; font-size:95%; color:#38393b;">Cost Price</th>
         <th style="font-family:verdana; font-size:95%; color:#38393b;">Quantity</th>
         <th style="font-family:verdana; font-size:95%; color:#38393b;" scope="col">Actions</th>

       </tr>
     </thead>

@if(count($allproducts) > 0)
     <tbody>
                 @foreach($allproducts as $product)

                 <tr>
                 <?php

                 $max = 19;
                 $str = " $product->productName ";
                 $name=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                 $max = 10;
                 $str = " $product->about ";
                 $about=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                 if($product-> quantity <= 5){
                   $statusQuantity = "low quantity";
                 }
                 else{
                   $statusQuantity = "";
                 }
                 ?>


                 <td><img src="/storage/{{$product->image}}" class="card-img-top" style="width: 120px; height: 100px;!important"></td>
                 <td style="font-family:verdana; color:black;"><b>{{$product-> productSku}}</b></td>
                 <td style="font-family:verdana; color:black;"><b>{{$name}}</b></td>
                 <td style="font-family:verdana; color:black;"><b>{{$product-> categoryName}}</b></td>
                 <td style="font-family:verdana; color:green;"><strong><b>£{{$product->Sell_Price}}</b></strong></td>
                 <td style="font-family:verdana; color:red;"><strong><b>£{{$product->Cost_Price}}</b></strong></td>
                 <td style="font-family:verdana; color:orange;"><strong><b>{{$product-> quantity}}</strong><br><h7 style="color:red;">{{$statusQuantity}}</h7></b></td>
                 <td>
                     <a href="/section/products/view/{{$product->productId}}" class="btn btn-primary btn-group"><b>View</a>
                     <!-- <a href="/section/products/destroy/{{$product->productId}}"  class="btn btn-danger btn-group"
                     onclick="return confirm('Are you sure that you want delete this Product?');">
                             Remove</a> -->
                 </td>
                 </tr>
             @endforeach
               </tbody>
               @else
               <div class="alert alert-warning">
                 <h4>No products found in this machine. Try again or other model</h4>
               </div>
               @endif
   </table>
 </div>
</div>

</div>


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

   <!-- end of container fluid  -->
   </div>

 <script type="text/javascript">


 </script>
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
