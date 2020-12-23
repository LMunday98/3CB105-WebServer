map_chart();

function map_chart () {
  var ctx = document.getElementById('myChart').getContext('2d');

  var graph_title = 'Temperature v Time';
  var graph_data = [0, 10, 5, 2];
  //var graph_headers = ['One', 'Two', 'Three', 'Four']

  var graph_col_bg = 'rgb(255, 99, 132)';
  var graph_col_bdr = 'rgb(255, 99, 132)';

  var chartdata = {
      labels: graph_headers,
      datasets: [{
          label: graph_title,
          backgroundColor: graph_col_bg,
          borderColor: graph_col_bdr,
          data: graph_data
      }]
  };

  var chart = new Chart(ctx, {
    type: 'line',
    data: chartdata,
    options: {}
  });
}
