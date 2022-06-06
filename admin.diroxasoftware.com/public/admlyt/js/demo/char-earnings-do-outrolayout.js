
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
          totalSalesAmount.push(arreglo[x].totalSalesAmount);
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
  type: 'line',
  data: {
    labels: monthsWithName,
    datasets: [
    { 
        label: "Amount in £",
        lineTension: 0.3,
        backgroundColor: "rgba(2,117,216,0.2)",
        borderColor: "rgba(2,117,216,1)",
        pointRadius: 5,
        pointBackgroundColor: "rgba(2,117,216,1)",
        pointBorderColor: "rgba(255,255,255,0.8)",
        pointHoverRadius: 5,
        pointHoverBackgroundColor: "rgba(2,117,216,1)",
        pointHitRadius: 50,
        pointBorderWidth: 2,
        data: totalSalesAmount,
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