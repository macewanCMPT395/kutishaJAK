<div id="content">
<div class = "content-bg">
<div id="placeholder" style="width:600px;height:300px"></div>
   <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="../../excanvas.min.js"></script><![endif]-->
   <script language="javascript" type="text/javascript" src="../plugins/analytics/libraries/flot/jquery.js"></script>
   <script language="javascript" type="text/javascript" src="../plugins/analytics/libraries/flot/jquery.flot.js"></script>
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

</script>
   stuff
</div>
</div>