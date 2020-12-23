function create_chart (graph_title, graph_headers, graph_data) {
  var ctx = document.getElementById('myChart').getContext('2d');

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
