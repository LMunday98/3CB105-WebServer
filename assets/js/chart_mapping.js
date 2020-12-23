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

function storeCoordinate(xVal, yVal, array) {
    array.push({x: xVal, y: yVal});
}

function create_chart_scatter (chart_id, graph_title, graph_headers, graph_data) {
  var chart_element = document.getElementById(chart_id).getContext('2d');

  var data_to_plot = [];

/*
graph_data.forEach((item, i) => {
  var temp_array = { x: graph_headers(i), y: graph_data(i)};
  graph_data.push(temp_array);
});
*/

var arrayLength = graph_data.length;
for (var i = 0; i < arrayLength; i++) {
    storeCoordinate(parseFloat(graph_headers[i]), graph_data[i], data_to_plot);
    //Do something
}
/*
graph_data.forEach(function (item, index) {
  storeCoordinate(graph_headers[index], item, data_to_plot);
});
*/






  var chart_data = {
      datasets: [{
          label: 'Scatter Dataset',
          data: data_to_plot
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
