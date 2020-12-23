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
  for (var i = 0; i < graph_data.length; i++) {
      storeCoordinate(filterTimeFormat(graph_headers[i]), graph_data[i], data_to_plot);
  }

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

function filterTimeFormat(time) {
	var decimal_places = 2;
	// Maximum number of hours before we should assume minutes were intended. Set to 0 to remove the maximum.
	var maximum_hours = 15;
	// 3
	var int_format = time.match(/^\d+$/);
	// 1:15
	var time_format = time.match(/([\d]*):([\d]+)/);
	// 10m
	var minute_string_format = time.toLowerCase().match(/([\d]+)m/);
	// 2h
	var hour_string_format = time.toLowerCase().match(/([\d]+)h/);

	if (time_format != null) {
		hours = parseInt(time_format[1]);
		minutes = parseFloat(time_format[2]/60);
		time = hours + minutes;
	} else if (minute_string_format != null || hour_string_format != null) {
		if (hour_string_format != null) {
			hours = parseInt(hour_string_format[1]);
		} else {
			hours = 0;
		}
		if (minute_string_format != null) {
			minutes = parseFloat(minute_string_format[1]/60);
		} else {
			minutes = 0;
		}
		time = hours + minutes;
	} else if (int_format != null) {
		// Entries over 15 hours are likely intended to be minutes.
		time = parseInt(time);
		if (maximum_hours > 0 && time > maximum_hours) {
			time = (time/60).toFixed(decimal_places);
		}
	}
	time = parseFloat(time).toFixed(decimal_places);

	return time;
}
