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
  #BlackTypeStyle{
      color:black;
      font-size:22px;
  }

  #btnStyles{
    background-color:#060b30;
  }

  #PurpleButton{
    background-color:#060b30; color:white;
    /* style="background-color:#050d80" */
  }
</style>
</head>

      <span>
            @include('sections.components.topnavbar')
      </span>

    <!-- Page Content -->
    <div class="container">

  <!-- Jumbotron Header -->
  <header class="jumbotron my-4" style="background-color:#346beb; color:white" >
  <div class="row">
          <div class="col-md-6">
          @if(isset($nameText))
            <span>Seacrhing for <strong>{{$nameText}}</strong></span>
          @endif

            <h3 id="searchingFor">Search Page</h3>
            <strong><h5>Choose which data you would like to find and find it!</h5></strong>
          @if(isset($name))
                <h6>Searching for :  <strong>{{$name}} </h6></strong>
          @endif

          </div>
          <form  name="formSearch" class="form form-inline">
              @csrf

              <input type="text" name="nameText" id="nameText" class = "form-control"
                placeholder = "Name or text">
              <!-- <input type="text" name="sobre" id="" class = "form-control" placeholder = "Sobre"> -->

                <select name="searchOption" id="searchOption" class = "form-control ml-2" >
                      <option   value="products">Products</option>
                      <option   value="machines">Motorcycles</option>
                      <option   value="categories">Categories</option>
                </select>

               <button type="submit" class="btn btn-primary ml-2"  style="background-color:#050d80">Search</button>
            </form>
        </div>
</header>

<div class="alert  alert-warning d-none messageBox" role="alert">
</div>


<!-- Page Features -->
<div class="row text-center" id="h5" >
</div>
<!-- /.container -->

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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>

</script>
<script>
      $(function(){
        $('form[name="formSearch"]').submit(function(e){
          e.preventDefault();
          var text = $(this).find('input#nameText').val();
          var searchOption = $(this).find('select#searchOption').val();
          // alert('passou do preventdefault' + text );
          // console.log(searchOption);
          $.ajax({
            url: "{{ route('products.search') }}",
            type: "post",
            data: $(this).serialize(),
            dataType: 'json',
            success:function(response){
              $resp = response.data;
              console.log(response);
              if($resp == ''){
                $("#h5").empty();
                $msg = '<h4><strong>Seaching for: ' + text + ' in ' + searchOption +'</strong></h4>';
                $('.messageBox').removeClass('d-none').html($msg);
              }
              else{ // if we have a response in array, we'll filter which database table show

                if(searchOption == 'products'){
                $(".messageBox").empty();
                $("#h5").empty();
                $("#searchingFor").empty();
                    $("#searchingFor").append(`<h3 id="searchingFor">Search Page</h3>`);
                    // changing the jumbotron to MACHINES OPTIONS~
                    $("#searchOption").empty();
                    $("#searchOption").append(`

                      <option   value="products">Products</option>
                      <option   value="machines">Motorcycles</option>
                      <option   value="categories">Categories</option>
                `);

                if(text == ''){
                  $msg = '<h4><strong>Seaching for all  '  + searchOption +'</strong></h4>';
                }
                else {
                  $msg = '<h4><strong>Seaching for: ' + text + ' in ' + searchOption +'</strong></h4>';
                }
                $('.messageBox').removeClass('d-none').html($msg);
                $.each($resp, function (key, value){
                $("#h5").append(`
                        <div class="col-lg-3 col-md-6 mb-4">
                                <div class="card h-100">
                                  <img class="card-img-top" src="/storage/` + value.image +`"width="200" height="200">
                                  <div class="card-body">
                                <h4 class="card-title" style="color:black;"><strong>` + value.name + `</strong></h4>
                                <p class="card-text">SKU: <strong>` + value.SKU  + `</strong></p>
                              </div>
                              <div class="card-footer">
                                <a href="/section/searches/products/edit/` + value.id + `" class="btn btn-primary" style="background-color:#050d80">More details</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        `);
                    });
                  }
                else if(searchOption == 'categories'){
                $(".messageBox").empty();
                $("#h5").empty();
                $("#searchingFor").empty();
                    $("#searchingFor").append(`<h3 id="searchingFor">Search Page</h3>`);
                    // changing the jumbotron to MACHINES OPTIONS~
                    $("#searchOption").empty();
                    $("#searchOption").append(`
                    <option   value="categories">Categories</option>
                    <option   value="products">Products</option>
                    <option   value="machines">Motorcycles</option>
                `);

                if(text == ''){
                  $msg = '<h4><strong>Seaching for all  '  + searchOption +'</strong></h4>';
                }
                else {
                  $msg = '<h4><strong>Seaching for: ' + text + ' in ' + searchOption +'</strong></h4>';
                }
                $('.messageBox').removeClass('d-none').html($msg);
                $.each($resp, function (key, value){
                $("#h5").append(`
                        <div class="col-lg-3 col-md-6 mb-4">
                                <div class="card h-100">
                                  <img class="card-img-top" src="/storage/` + value.image +`"width="200" height="200">
                                  <div class="card-body">
                                <h4 class="card-title" style="color:black;"><strong>` + value.name + `</strong></h4>
                                <p class="card-text">Category: <strong>` + value.categoryName  + `</strong></p>
                              </div>
                              <div class="card-footer">
                                <a href="/section/searches/products/edit/` + value.id + `" class="btn btn-primary" style="background-color:#050d80">More details</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        `);
                    });
                  }
                    else if (searchOption == 'machines'){
                    $(".messageBox").empty();
                    $("#h5").empty();
                    $("#searchingFor").empty();
                    $("#searchingFor").append(`<h3 id="searchingFor">Search Page</h3>`);
                    // changing the jumbotron to MACHINES OPTIONS~
                    $("#searchOption").empty();

                    $("#searchOption").append(`
                      <option   value="machines">Motorcycles</option>
                      <option   value="products">Products</option>
                      <option   value="categories">Categories</option>
                    `);

                if(text == ''){
                  $msg = '<h4><strong>Seaching for all Motorcycles</strong></h4>';
                }
                else {
                  $msg = '<h4><strong>Seaching for: ' + text + ' in Motorcycles </strong></h4>';
                }

                $('.messageBox').removeClass('d-none').html($msg);
                $.each($resp, function (key, value){
                $("#h5").append(`

                    <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card h-100">
                              <div class="card-body">
                            <h4 class="card-title" style="color:black;"><strong>` + value.model + `</strong></h4>
                            <p class="card-text">Serial Number: <strong>` + value.serial_number  + `</strong></p>
                          </div>
                          <div class="card-footer">
                            <a href="/section/searches/machines/edit/` + value.id + `" class="btn btn-primary" style="background-color:#050d80">More details</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    `);
                });
                }
              }
            }
          });
        });
      });
</script>

</body>

</html>
