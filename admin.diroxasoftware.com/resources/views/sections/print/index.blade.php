<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Teste de impressão direta</title>

  <link rel="stylesheet" href="css/bootstrap.min.css" >
  <link href="{{ asset('filesprintqio/css/bootstrap.min.css') }}" rel="stylesheet">

</head>

<body>

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal">Teste de Impressão direta</h5>
  <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-dark" href="https://github.com/batistajb/impressao_direto" target="_blank">
      <img class="mb-2" src="assets/brand/github.svg" alt="" width="50" height="50">
    </a>
  </nav>
</div>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-4">Página teste</h1>
  <p class="lead">
    Não esquecer de instalar o <a href="https://qz.io/download/" target="_blank"> QZ.io </a> e deixá-lo em execução.
  </p>
</div>


<div class="container">
  <div class="card-deck mb-3 text-center">
    <div class="card mb-12 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Impressoras</h4>
      </div>
      <div class="card-body">
        <div class="col-12">
          <div class="row">
            <div class="col-8">
              <div class="row">
                <label class="col-4">
                  Impressoras Disponíveis
                </label>
                <select class="form-control col-8" id="select"></select>
              </div>
            </div>
            <div class="col-4">
              <button type="button" class="btn btn-lg btn-outline-primary js-print">Imprimir um teste</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="pt-4 my-md-5 pt-md-5 border-top">
    <div class="row">
      <div class="col-12 col-md">
        <small class="d-block mb-3 text-muted"><a href="https://github.com/batistajb/impressao_direto" target="_blank">batistajb </a> &copy; 2017-2021</small>
      </div>
    </div>
  </footer>
</div>

</body>
<script src="{{ asset('filesprintqio/js/qz/qz-tray.js') }}"></script>
<script src="{{ asset('filesprintqio/js/index.js') }}"></script>
</html>
