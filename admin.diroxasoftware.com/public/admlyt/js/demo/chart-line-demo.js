
  var idEliminar=0;
  var criadoEm=[];
  var valoresCategories=[];

  $(document).ready(function(){
    $.ajax({
      url: '/section/reports/products/allbycategories',
      method: 'POST',
      data:{ 
        id:1,
        _token: $('input[name="_token"]').val()
      }
  }).done(function(res){
      // alert(res);
      // alert('chegou aqui');
      // string to JSON
      var arreglo = JSON.parse(res);
      // alert(res);

      for(var x=0; x<arreglo.length; x++){
        // alert(10);
          console.log(arreglo);
          console.log(arreglo[x].id)
          console.log(arreglo[x].name)
          console.log(arreglo[x].SKU)
          console.log(arreglo[x].categoryName) 
          console.log(arreglo[x].created_at) 
          criadoEm.push(arreglo[x].created_at);
          valoresCategories.push(arreglo[x].totalNproducts);
       }
        generateLineChart();
     });
    });

// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function generateLineChart(){
// Pie Chart Example
var ctx = document.getElementsByClassName("line-chart");
var lineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: e,
    datasets: [{
      data: valoresCategories,
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
}