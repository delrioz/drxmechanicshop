<script>
      
      
      $(function(){
        $('button[id="procesar-compra"]').click(function(e){
            e.preventDefault(); 
            alert('procesar-pago');
            alert('chamando o processar compra');
            procesarCompra();
            alert('chamado');

            var dados = procesarCompra();
            // window.location = "/section/carrito/generatingInvoice/"+data;


        
        alert('ajax');
        
        $.ajax({
          url: 'http://localhost:8000/section/carrito/generatingInvoice/'+dados ,
          type: 'post',
          data: {data: dados,  _token: '{{csrf_token()}}'},
          success: function(result){
             alert('here') ;

             window.location = "/section/carrito/generatingInvoice/"+data;

            );
          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert(' n deu')
          }
        });
      });
    });
  </script>