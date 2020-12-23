function create_chart_line (chart_id, graph_title, graph_headers, graph_data ) {
  var chart_element = document.getElementById(chart_id).getContext('2d');

  var graph_col_bg = 'rgb(255, 99, 132)';
  var graph_col_bdr = 'rgb(255, 99, 132)';

  var chartdata = {
      labels: graph_headers,
      datasets: [{
          label: graph_title,
          backgroundColor: graph_col_bg,
          borderColor: graph_col_bdr,
          data: graph_data,
          showLine: 0
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

function create_chart_scatter (chart_id, graph_title, graph_headers, graph_data ) {
  var chart_element = document.getElementById(chart_id).getContext('2d');
  var data_to_plot = [];
  for (var i = 0; i < graph_data.length; i++) {
      var time = graph_headers[i];
      var time_formatted = filterTimeFormat(time);
      storeCoordinate(time_formatted, graph_data[i], data_to_plot);
      //storeCoordinate(graph_headers[i], graph_data[i], data_to_plot);
      console.log(time, ", ", time_formatted);
  }

  var chart_data = {
      datasets: [{
          label: graph_title,
          data: data_to_plot
      }]
  };

  var scatterChart = new Chart(chart_element, {
      type: 'scatter',
      data: chart_data,
      options: {
          scales: {
              xAxes: [{
                type: 'time',
                time: {
                  parser: 'm:s.SSS',
                  unit: 'seconds',
                  unitStepSize: 5,
                  min: '1:0.0',
                  max: '2:0.0',
                  displayFormats: {
                    'seconds': 'm.s'
                  }
                }
              }]

              ,
              yAxes: [{
                  scaleLabel: {
                    display: true,
                    labelString: 'Temperature (°C)'
                    }
              }]
          }
      }
  });
}

function filterTimeFormat(time) {
	var str = time;
  var res = str.split(":");

  var hour = res[0] + ":";
  var minute = res[1] + ".";
  var second = res[2];

  var time_str = hour.concat(minute);
  var time_str = time_str.concat(second);

  console.log(time_str);

	return time;
}

function hide_all() {
  var divsToHide = document.getElementsByClassName("hideable"); //divsToHide is an array
  for(var i = 0; i < divsToHide.length; i++){
      divsToHide[i].style.display = "none"; // depending on what you're doing
  }
}

function change_display(element_id) {
  hide_all();
  var x = document.getElementById(element_id);
  x.style.display = "block";
}
