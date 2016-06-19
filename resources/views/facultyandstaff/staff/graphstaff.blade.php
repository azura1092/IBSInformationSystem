@extends('facultyandstaff.staff.dash-staff')
	<script type="text/javascript" src="js/loader.js"></script>
    <script type="text/javascript" src="js/jsapi.js"></script>
	<script type="text/javascript">
      google.charts.load('current', {'packages':['geochart', 'corechart', 'corechart']});
      google.charts.setOnLoadCallback(init);

      function init () {
	    drawRegionsMap();
	    drawStuff(); 
	    drawChart();
		}	
      function drawRegionsMap() {
    		<?php
    		$php_array = $places;
    		$js_array = json_encode($php_array);
    		echo "var javascript_array = ". $js_array . ";\n";
    		?>
    		
    		var dataArray = [['Country','IBS Graduates']];
     
    		for (var i = 0; i < javascript_array.length; i++){
    		  dataArray.push([javascript_array[i].country, javascript_array[i].num]) 
    		}

    		var inputs = google.visualization.arrayToDataTable(dataArray);
    		
            var options = {
              colorAxis: {colors: ['#a9c056', 'black', '#00853f']},
              backgroundColor: '#33383e',
              datalessRegionColor: 'rgb(248, 187, 208)',
              defaultColor: '#f5f5f5'};

            var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

            chart.draw(inputs, options);
      }
      function drawStuff() {
        <?php
          $php_array = $population;
          $js_array = json_encode($php_array);
          echo "var javascript_array = ". $js_array . ";\n";
          ?>

          var dataArray = [['Year', 'Number of Graduates']];

      for (var i = 0; i < javascript_array.length; i++){
        dataArray.push([javascript_array[i].yeargrad, javascript_array[i].num]) 
      }

         var data = google.visualization.arrayToDataTable(dataArray);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1]);

      var options = {
        title: "Number of IBS Graduates Per Year",
        width: 1000,
        colors:['#a9c056'],
        height: 600,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("top_x_div"));
      chart.draw(view, options);

      }

      

      function drawChart() {
        <?php
    $php_array = $majors;
    $js_array = json_encode($php_array);
    echo "var javascript_array = ". $js_array . ";\n";
    ?>

    var dataArray = [['Major','Number of Graduates']];

    for (var i = 0; i < javascript_array.length; i++){
      dataArray.push([javascript_array[i].major, javascript_array[i].num]) 
    }

    var inputs = google.visualization.arrayToDataTable(dataArray);
        

        var options = {
          title: 'Distribution of IBS Majors',
          is3D: true,
          slices: [{}, {color: 'black'}, {color:'#a9c056'}, {}, {color: '#ff7e66'}]
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(inputs, options);
      }
    </script>
 
@section('content')
      
       <legend><h2>Data Visualization</h2></legend>

    <table class="table">
   
                    <tr>
                        <td class="container-fluid" id="top_x_div" style="width: 1000px; height: 400px; margin-left:10%;">
                      </td>
                        
                    </tr>

                    <tr>
                        <td class="container-fluid" id="piechart_3d" style="width: 700px; height: 500px; margin-top:10%;">
                      </td>
                        
                    </tr>

                    <tr>
                        <td class="container-fluid" id="regions_div" style="width: 900px; height: 400px; margin-left:25%;">
                      </td>
                        
                    </tr>
        
</tbody>
        </table>


@endsection    

