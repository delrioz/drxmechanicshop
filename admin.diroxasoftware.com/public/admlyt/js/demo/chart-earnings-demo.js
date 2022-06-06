
  var idEliminar=0;
  var month=[];
  var totalSalesAmount=[];
  var monthsWithName=[];
  

  $(document).ready(function(){
    $.ajax({
      url: '/section/reports/SalesReports/salesreportsmonthly',
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
          console.log('arreglo');

            if(arreglo[x].totalSalesAmount == null){
              arreglo[x].totalSalesAmount = 0;
            }

            if(arreglo[x].date == 1){
              monthsWithName.push('January')
            }
            else if(arreglo[x].date == 2){
              monthsWithName.push('Feb')
            }
            else if(arreglo[x].date == 3){
              monthsWithName.push('March')
            }
            else if(arreglo[x].date == 4){
              monthsWithName.push('April')
            }
            else if(arreglo[x].date == 5){
              monthsWithName.push('May')
            }
            else if(arreglo[x].date == 6){
              monthsWithName.push('June')
            }
            else if(arreglo[x].date == 7){
              monthsWithName.push('July')
            }
            else if(arreglo[x].date == 8){
              monthsWithName.push('August')
            }
            else if(arreglo[x].date == 9){
              monthsWithName.push('September')
            }
            else if(arreglo[x].date == 10){
              monthsWithName.push('October')
            }
            else if(arreglo[x].date == 11){
              monthsWithName.push('November')
            }
            else if(arreglo[x].date == 12){
              monthsWithName.push('December')
          }
          totalSalesAmount.push(arreglo[x].totalSalesAmount.toFixed(2));
       }
        generatePieChart();
     });
    });

// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function generatePieChart(){
// Pie Chart Example
var ctx = document.getElementById("line-chart-earnings");
var lineChartEarnings = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: monthsWithName,
    datasets: [
    { 
      data:  totalSalesAmount,
      label: "Amount in £",
      fill:false, // da ou nao a sombra no grafico
      lineTension: 0.1,
      backgroundColor: "rgba(75,192,192,0.4)",
      borderColor: "rgba(75,192,192,1)",
      borderCapStyle: 'butt',
      borderDash: [],
      borderDashOffset: 0.0,
      borderJoinStyle: 'mitter',
      pointBorderColor: "rgba(75,192,192,1)",
      pointBackgroundColor: "#fff",
      pointBorderWidth: 1,
      pointHoverRadius: 5,
      pointHoverBackgroundColor: "rgba(75,192,192,1)",
      pointHoverBorderColor: "rgba(220,220,220,1)",
      pointHoverBorderWidth: 2,
      pointRadius: 1,
      pointHitRadius: 10,
    },
  
  ],
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