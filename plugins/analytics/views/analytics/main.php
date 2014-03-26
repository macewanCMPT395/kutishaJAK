<div id="content">
<div class = "content-bg">
<div id="placeholder" style="width:600px;height:300px"></div>
<div id="pieholder" style="width:600px;height:300px"></div>
<style type="text/css">
#description {
        margin: 15px 10px 20px 10px;
            }
</style>
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

//Array for pie chart
var dataSet = [];


$.getJSON('http://10.0.2.15/~jharvard/kutishaJAK/index.php/api?task=incidents', function(data){

    //Incidents is an array of incidents objects
    for (var i=0; i<data['payload']['incidents'].length; i++){
        //Categories is an array of Category objects
        for (var j=0; j<data['payload']['incidents'][i]['categories'].length; j++){
           //Each Incident has multiple Categorical Names
           var title = data['payload']['incidents'][i]['categories'][j]['category']['title'];
            var index = -1;
            index = dataSet.map(function(e) { return e.label}).indexOf(title);
            
            if(index === -1){   
                dataSet.push({ label: title, data: 1 });
            }else {
                dataSet[index]['data']++;
            };
        };
    };

//Pie Chart Code
var pieholder = $("#pieholder");

$(function() {

pieholder.unbind();
$.plot(pieholder, dataSet, {
series: {
pie: { 
show: true,
radius: 1,
label: {
threshold: 0.04,
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

});


function labelFormatter(label, series) {
        return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
}
</script>
</div>
</div>
