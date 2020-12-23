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

function create_chart_scatter (chart_id, graph_title, y_label, graph_headers, graph_data ) {
  var chart_element = document.getElementById(chart_id).getContext('2d');
  var data_to_plot = [];
  for (var i = 0; i < graph_data.length; i++) {
      var time = graph_headers[i];
      var time_formatted = format_time(time);
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
                  type: 'linear',
                  position: 'bottom',
                  display: true,
                  scaleLabel: {
                      display: true,
                      labelString: 'Time (hours)'
                  },
                  ticks: {
                      min: 0, // minimum value
                      max: 24 // maximum value
                  }
              }],
              yAxes: [{
                  scaleLabel: {
                    display: true,
                    labelString: y_label
                  },
                  ticks: {
                    beginAtZero: true
                  }
              }]
          }
      }
  });
}

function format_time(time) {
  //return time_hh(time);
  return time_hh_mm(time);
  //return time_hh_mm_ss(time);
}

function time_hh(time) {
  var time    = time.split(":")
  return time[0];
}

function time_hh_mm(time) {
  var time    = time.split(":");
  var hour    = time[0];
  var minute  = time[1];
      time    = hour.concat("." + minute);

  return time;
}

function time_hh_mm_ss(time) {
  var time = time.split(":");

  var hour   = parseInt(time[0]) * 3600;
  var minute = parseInt(time[1]) * 60;
  var second = parseInt(time[2]);

  var time_sec = hour + minute + second;
  var time_hr = time_sec / 3600;
  time = time_hr.toString();

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
