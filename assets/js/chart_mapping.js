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

function format_time(time) {
  var time    = time.split(":");
  var hour    = time[0];
  var minute  = time[1];
      time    = hour.concat(minute);

  return time;
}

function calc_array_m(time, divisions) {
  var range = 60 / divisions;
  var coefficient = 0;
  var min = 0;
  var max = 0;

  for (var i = 0; i < divisions; i++) {
    coefficient = i + 1;
    min = i * range;
    max = (coefficient * range) - 1;
    if (min <= time && time <= max) {
      break;
    }
  }
  return min;
}

function concat_h_m(given_hour, given_min) {
  //time_str = given_hour + given_min;
  var hour = given_hour + "";
  var minute = given_min + "";
  var time_str = hour.concat(minute);
  return time_str;
}

function get_time_m(time) {
  var time    = time.split(":");
  return parseInt(time[1]);
}

function get_time_h(time) {
  var time    = time.split(":");
  return parseInt(time[0]);
}

function calc_avg_time_index(time, divisions) {
  array_index_m = calc_array_m(get_time_m(time), divisions);
  array_index_h = get_time_h(time);
  array_index = concat_h_m(array_index_h, array_index_m);
  return array_index;
}

function calc_avg_time_data(times, data, divisions) {
  var data_to_plot = [];
  var time_index = "00";
  var avg_data = 0;
  var avg_count = 0;
  for (var i = 0; i < times.length; i++) {
    time = times[i];
    current_data_val = parseInt(data[i]);
    current_time_index = calc_avg_time_index(time, divisions);
    if (time_index == current_time_index) {
      avg_data = avg_data + current_data_val;
      avg_count++;
    } else {
      time_index = current_time_index;
      avg_data = avg_data / avg_count;

      var mV = (calc_array_m(get_time_m(time), divisions)) / 60;
      var hV = get_time_h(time);
      var yCor = parseFloat(hV) + parseFloat(mV);
      var xCor = avg_data;
      storeCoordinate(yCor, xCor, data_to_plot);
      console.log("hV: ", hV, ", mV: ", mV, ", yCor: ", yCor, ", xCor: ", xCor);

      avg_data = 0;
      avg_count = 0;
    }
  }
  return data_to_plot;
}

function create_chart_scatter (chart_id, graph_title, y_label, graph_headers, graph_data ) {
  var chart_element = document.getElementById(chart_id).getContext('2d');

  var times = graph_headers;
  var data = graph_data
  var divisions = 4;
  data_to_plot = calc_avg_time_data(times, data, divisions);

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
