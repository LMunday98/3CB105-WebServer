function create_chart_line (chart_id, graph_title, graph_headers, graph_data) {
  var chart_element = document.getElementById(chart_id).getContext('2d');

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

  var chart = new Chart(chart_element, {
    type: 'line',
    data: chartdata,
    options: {}
  });
}

function create_chart_scatter (chart_id, graph_title, graph_headers, graph_data) {
  var chart_element = document.getElementById(chart_id).getContext('2d');

  var graph_data = [
    { x: -10, y: 0  },
    { x: 0,   y: 10 },
    { x: 10,  y: 5  }
  ];

  var chart_data = {
      datasets: [{
          label: 'Scatter Dataset',
          data: graph_data
      }]
  }

  var scatterChart = new Chart(chart_element, {
      type: 'scatter',
      data: chart_data,
      options: {
          scales: {
              xAxes: [{
                  type: 'linear',
                  position: 'bottom'
              }]
          }
      }
  });
}
