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
                  { label: "Series1",  data: 60},
                  { label: "Series2",  data: 30},
                  { label: "Series3",  data: 90},
                  { label: "Series4",  data: 70},
                  { label: "Series5",  data: 220},
                  { label: "Series6",  data: 0}
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

$.getJSON('http://10.0.2.15/~jharvard/kutishaJAK/index.php/api?task=version', function(data){
    $("#footer").prepend(data['payload']['version'][0]['version'] + "  ");
    });

$.getJSON('http://10.0.2.15/~jharvard/kutishaJAK/index.php/api?task=incidents&by=catid&id=2', function(data){
  var dataSet = [];
    var dataLen = data['payload']['incidents'][0]['categories'][0]['category']['title']+ "---";
    $("#footer").prepend(dataLen);
    
    for (var i=0; i<data['payload']['incidents'].length; i++){
        for (var j=0; j<data['payload']['incidents'][i]['categories'].length; j++){
       var title = data['payload']['incidents'][i]['categories'][j]['category']['title'];
        var index = -1;
        index = dataSet.map(function(e) { return e.label}).indexOf(title);
        
        if(index === -1){   
            dataSet.push({ label: title, data: 1 });
        }else {
            console.log(dataSet[index]);
        };

       };
    };

   console.log(dataSet);

    /*$.each(data['payload']['incidents'], function(incidents)    {
       // debugger;
        console.log(incidents);
      
      incidents['categories'].foreach( function (category){
        console.log(category['title']);
      });*/
      
      //  console.log(incidents['categories']);
      //  console.log(incidents['categories']['category']['title']);
      //  $.each(incidents['categories'], function(category) {
      //     console.log(category.title);
      //  });
    // });
    });


function labelFormatter(label, series) {
        return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
}
</script>


<?php echo "hello World"; ?>

</div>
</div>
