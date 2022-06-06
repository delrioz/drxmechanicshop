      $(document).ready(function(){
        
            $('#ajaxSubmitAndAddmachine').click(function(e){
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });

               $.ajax({
                  url: "{{ url('/section/costumers/createAjaxandAddmachine') }}",
                  method: 'post',
                  data: {
                     name: $('#name').val(),
                     telephone: $('#telephone').val(),
                     email: $('#email').val(),
                     _token: '{{csrf_token()}}'},
                  success: function(result){
                    alert('Customer Created!')
                    window.location.href = "{{ route('customer.index') }}";
                     console.log(result);
                  }});
               });
            });