
<!DOCTYPE html>
<!-- # "current" => "anuncio"]) -->
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="css/app.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <title>Diroxa Software</title>
</head>

<style>

    #footer{
        color: white;

        background: purple;


    }

    #links{
        background: orange;
    }



    #btnRoxo {
    background: rgb(87, 13, 119);
    color: #fff;
    border-color: purple;
}



</style>
<body>

<header>



</header>


<div class="container-fluid" >
    <div class="container search-table">
           <div class="meusposts">
    <br />
    <br />
    <br />
<br>

     <div class="search-list" id="servicosanunciados">
     <h3>Open Work Orders</h3>
  </div>
  <a href="/section/workOrder/create"  class="btn btn-primary btn-group">Open new Work Order</a><br>
  <br>
  



<div class="container">
  <div class="row">
    <div class="col-12">
		<table class="table table-image">
		  <thead>
		    <tr>        

		    <th scope="col"></th>

            <!-- 'name', 'customer_report', 'first_observations', 'previous_observations', 'customer', 'vehicle', 'status', 'typeofpayment' -->


            <th scope="col">Name</th>
            <th scope="col">Customer_report</th>
            <th scope="col">First_observations</th>
            <th scope="col">Previous_observations</th>
            <th scope="col">Customer</th>
            <th scope="col">Vehicle</th>
            <th scope="col">Status</th>

            <th scope="col">Actions</th>

		    </tr>
		  </thead>
		  <tbody>

      @foreach($allworkOrders as $workOrder)

      <?php

            $max = 13;
            $str = " $workOrder->name ";
            $name=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


            $max = 13;
            $str = " $workOrder->customer_report ";
            $customer_report=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

            $max = 13;
            $str = " $workOrder->first_observations ";
            $first_observations=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

            $max = 13;
            $str = " $workOrder->previous_observations ";
            $previous_observations=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

            
            $max = 13;
            $str = " $workOrder->customer ";
            $customer=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

            
            $max = 13;
            $str = " $workOrder->vehicle ";
            $vehicle=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


            $max = 13;
            $str = " $workOrder->status ";
            $status=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


            $max = 13;
            $str = " $workOrder->typeofpayment ";
            $typeofpayment=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

            

        ?>

          <td></td>
          <td>{{$name}}</td>
          <td>{{$customer_report}}</td>
          <td>{{$first_observations}}</td>
          <td>{{$previous_observations}}</td>
          <td>{{$customer}}</td>
          <td>{{$vehicle}}</td>
          <td>{{$status}}</td>
            <td>

            <a href="/section/workOrder/edit/{{$workOrder->id}}" class="btn btn-primary btn-group">Edit</a>


            <a href="/section/workOrder/destroy/{{$workOrder->id}}"  class="btn btn-danger btn-group"
              onclick="return confirm('Are you sure that you want delete this workOrder?');">
                      Remove</a>
        </td>
		    <tr>
    </tr>

    @endforeach






		  </tbody>
		</table>
    </div>
  </div>
</div>


</body>

</html>
