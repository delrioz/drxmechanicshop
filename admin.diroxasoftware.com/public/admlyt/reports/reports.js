      $(document).ready(function(){
        
            // $('#ajaxSubmit').click(function(e){
              $(document).on("click", "#ajaxSubmit", function(e){
             alert(11111)
               e.preventDefault();
                // var dataComecoPadraoDateTime = $(this).find('input#dataComecoPadraoDateTime').val();
                // var dataFimPadraoDateTime = $(this).find('input#dataFimPadraoDateTime').val();

                var dataComecoPadraoDateTime  = $("#start").val();
                var dataFimPadraoDateTime  = $("#end").val();
                
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               $.ajax({
                  url: "{{ url('/section/reports/SalesReports/searchajax') }}",
                  method: 'post',
                  data: {
                    dataFimPadraoDateTime: $('#dataFimPadraoDateTime').val(),
                     dataFimPadraoDateTime: $('#dataFimPadraoDateTime').val(),
                     _token: '{{csrf_token()}}'},

                  success: function(result){

                    // console.log('dasdasdasdsadas');
                    // alert('Customer Created!')
                    $('.invalidData').empty();
                    $msg = '<h4><strong>Machine successfull created</h4>';
                    $('.messageBox').removeClass('d-none').html($msg);
                      // $("#serial_number").empty();
                      document.getElementById('serial_number').value = '';
                      document.getElementById('model').value = '';
                      document.getElementById('brand').value = '';
                      document.getElementById('customer_report').value = '';
                      document.getElementById('first_observations').value = '';
          
                    // window.location.href = "{{ route('customer.index') }}";
                    //  console.log(result);
                  },
                  error: function(jqXHR, textStatus, errorThrown, result) {
                      // console.log(jqXHR.responseJSON.errors)
                      $msg = 'oi';
                      $resp = jqXHR.responseJSON.errors;
                      $('.messageBox').empty();
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