<div id="content">
<div class = "content-bg">
<div id="placeholder" style="width:600px;height:300px"></div>
<div id="pieholder" style="width:600px;height:300px"></div>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="../../excanvas.min.js"></script><![endif]-->
<script language="javascript" type="text/javascript" src="../plugins/analytics/libraries/flot/jquery.js"></script>
<script language="javascript" type="text/javascript" src="../plugins/analytics/libraries/flot/jquery.flot.js"></script>
<script language="javascript" type="text/javascript" src="../plugins/analytics/libraries/flot/jquery.flot.pie.js"></script>
<script type="text/javascript">

$(function() {

        var d1 = [];
        for (var i = 0; i < 14; i += 0.5) {
        d1.push([i, Math.sin(i)]);
        }

        var d2 = [[0, 3], [4, 8], [8, 5], [9, 13]];
        

        // A null signifies separate line segments

        var d3 = [[0, 12], [7, 12], null, [7, 2.5], [12, 2.5]];

        $.plot("#placeholder", [ d1, d2, d3 ]);

        // Add the Flot version string to the footer

        $("#footer").prepend("Flot " + $.plot.version + " &ndash; ");
        });

//Pie Chart 

/*//Generate Random Data
var data = [],
    series = Math.floor(Math.random() * 6) + 3;

for (var i = 0; i < series; i++) {
    data[i] = {
label: "Series" + (i + 1),
       data: Math.floor(Math.random() * 100) + 1
    }
}*/
        var data = [     
                  { label: "Series1",  data: [[3,60]]},
                  { label: "Series2",  data: [[1,30]]},
                  { label: "Series3",  data: [[1,90]]},
                  { label: "Series4",  data: [[1,70]]},
                  { label: "Series5",  data: [[210,220]]},
                  { label: "Series6",  data: [[20,0]]}
                ];

var pieholder = $("#pieholder");

$(function() {

        pieholder.unbind();

        $("#title").text("Default pie chart");
        $("#description").text("The default pie chart with no options set.");

        $.plot(pieholder, data, {
series: {
pie: { 
show: true,
radius: 1,
label: {
show: true,
formatter: labelFormatter,
background: {
    opacity: 0.8
    }
    }
}
},
legend: {
    show: false
}
});
});
function labelFormatter(label, series) {
        return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
            }
        </script>
        stuff



</div>
</div>
