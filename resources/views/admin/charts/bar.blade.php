<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
        ["18-25",{{count($firstSet)}}, "#569DAA"],
        ["26-30", {{count($secondSet)}}, "#F79327"],
        ["31-40", {{count($thirdSet)}}, "#ACBCFF"],
        ["41-60", {{count($lastSet)}}, "#FFE194"]
      
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Age Distribution of Applicants",
        width: "100%",
        height: 300,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
      chart.draw(view, options);
  }
  </script>
<div id="barchart_values" style="width: 100%; height: 300px;"></div>