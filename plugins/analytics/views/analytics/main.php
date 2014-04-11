<div id="content">
  <div class = "content-bg">
  <!-- BAR GRAPH -->
  <div>

    <hr size="5" noshade>
    <br>
    <center>
    <h1><font size="4">Bar Graph Displaying Frequency of Each Category</font></h1>
    <?php echo 'Year:<select id="selectYear2"><option value=0>ALL</option></select> &nbsp Month:';?>

    <select id="selectMonth2">
      <option value=0>ALL</option>
      <option value=01>January</option>
      <option value=02>February</option>
      <option value=03>March</option>
      <option value=04>April</option>
      <option value=05>May</option>
      <option value=06>June</option>
      <option value=07>July</option>
      <option value=08>August</option>
      <option value=09>September</option>
      <option value=10>October</option>
      <option value=11>November</option>
      <option value=12>December</option>
    </select>

    <?php echo '&nbsp <button onClick="GetSelectedItem(2);">Refine</button>';?>
    </center>
    <br>

  </div>
  <center><div id="barholder" style="width:950px;height:400px"></div></center><br>


  <!-- PIE CHART -->
  <div>

    <hr size="5" noshade>
    <br>
    <center>
    <h1><font size="4">Pie Chart Displaying Frequency of Each Category</font></h1>
    <?php echo 'Year:<select id="selectYear3"><option value=0>ALL</option></select> &nbsp Month:';?>

    <select id="selectMonth3">
      <option value=0>ALL</option>
      <option value=01>January</option>
      <option value=02>February</option>
      <option value=03>March</option>
      <option value=04>April</option>
      <option value=05>May</option>
      <option value=06>June</option>
      <option value=07>July</option>
      <option value=08>August</option>
      <option value=09>September</option>
      <option value=10>October</option>
      <option value=11>November</option>
      <option value=12>December</option>
    </select>

    <?php echo '&nbsp <button onClick="GetSelectedItem(3);">Refine</button>';?>
    </center>
    <br>

  </div>
  <center><div id="pieholder" style="width:600px;height:300px"></div></center><br>


  <style type="text/css">
  #description {
    margin: 15px 10px 20px 10px;
  }
  </style>


<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="../../excanvas.min.js"></script><![endif]-->
<script language="javascript" type="text/javascript" src="../plugins/analytics/libraries/flot/jquery.js"></script>
<script language="javascript" type="text/javascript" src="../plugins/analytics/libraries/flot/jquery.flot.js"></script>
<script language="javascript" type="text/javascript" src="../plugins/analytics/libraries/flot/jquery.flot.categories.js"></script>
<script language="javascript" type="text/javascript" src="../plugins/analytics/libraries/flot/jquery.flot.pie.js"></script>
      <script type="text/javascript">
 
      var barholder = $("#barholder");
var barOptions = { 
series: {
  bars: {
    show: true,
    barWidth: 0.8,
    align: "center"
  }
},
grid: {
  hoverable: true
},
xaxis: {
  mode: "categories",
  tickLength: 0,
  axisLabel:"Incident Categories"
}
};

var pieholder = $("#pieholder");
var pieOptions = {
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
grid:{
  hoverable: true
},
legend: {
  show: false
}
};

function pie(dataSet){
  pieholder.unbind();
  $.plot(pieholder, dataSet, pieOptions);
}

function bar(dataSet){
  var barDataSet = [];
  for (key in dataSet){
    barDataSet.push([dataSet[key]['label'],dataSet[key]['data']]);
  }
  $.plot(barholder, [ barDataSet ], barOptions);
}

//Inital Page Load
$.getJSON("<?php echo url::base(TRUE) . 'api?task=incidents'?>", function(data){
    var dataSet = [];
    for (var i = 0; i < data['payload']['incidents'].length; i++){
      for (var j = 0; j < data['payload']['incidents'][i]['categories'].length; j++){
	var title = data['payload']['incidents'][i]['categories'][j]['category']['title'];
	var index = -1;
	index = dataSet.map(function(e) { return e.label}).indexOf(title);
	if(index === -1){   
	  dataSet.push({ label: title, data: 1 });
	} else {
	  dataSet[index]['data']++;
	}
      }
    }
    pie(dataSet);
    bar(dataSet);
  });
//End First Json

function labelFormatter(label, series)
{
  return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
}

function GetSelectedItem(num)
{
  var month = document.getElementById("selectMonth" + num);
  var year = document.getElementById("selectYear" + num);
  var yearValSelect = year.options[year.selectedIndex].value;
  var yearTextSelect = year.options[year.selectedIndex].text;
  var monthValSelect = month.options[month.selectedIndex].value;

  if (num == 2){
    var label = $('#barholder');
    var label2 = '#barholder';
  }else if (num == 3) {
    var label = $('#pieholder');
    var label2 = '#pieholder';
  }
  label.load("<?php echo url::base(TRUE) . 'analytics'?> label2", function() {
      var dataSet = [];
      $.getJSON("<?php echo url::base(TRUE) . 'api?task=incidents'?>", function(data){
	  //Incidents is an array of incidents objects
	  for (var i = 0; i < data['payload']['incidents'].length; i++) {
	    var tempDate = data['payload']['incidents'][i]['incident']['incidentdate'];
	    var tempYear = tempDate.substring(0,4);
	    var tempMonth = tempDate.substring(5,7);
	    if ((monthValSelect == 0 || monthValSelect == tempMonth) && (yearValSelect == 0 || yearTextSelect == tempYear)) {
	      //Categories is an array of Category objects
	      for (var j = 0; j < data['payload']['incidents'][i]['categories'].length; j++) {
		var title = data['payload']['incidents'][i]['categories'][j]['category']['title'];
		var index = -1;
		index = dataSet.map(function(e) { return e.label }).indexOf(title);
		if (index === -1) {   
		  dataSet.push({ label: title, data: 1 });
		} else {
		  dataSet[index]['data']++;
		}
	      }
	    }
	  }

	  if (dataSet.length != 0) {
	    if(num == 3){ 
	      pie(dataSet);
	    }else if(num == 2){
	      bar(dataSet);
	    }
	  }else{
	    if(num == 3) var warning = 'pieholder';
	    if(num == 2) var warning = 'barholder';
        
	    document.getElementById(warning).innerHTML="<br><br><br><br><br><h2><b><font color='red' size='2'>NO VALUES WERE FOUND FOR THE SELECTED DATE</b></font></h2>";
	  }
	});	       
    });
}

//Fill Year Drop Down
var yearArray = [];
var graphCount = 3;

$.getJSON("<?php echo url::base(TRUE) . 'json'?>", function(data) {

    for (var i = 0; i < data['features'].length; i++) {
      var tempYear = data['features'][i]['properties']['timestamp'];
      var date = new Date(tempYear * 1000);
      tempYear = date.getFullYear();
      if (yearArray.length == 0) {
	yearArray.push(tempYear);
      } else {
	for (var j = 0; j <= yearArray.length; j++) {
	  var valExists = 0;
	  if (tempYear == yearArray[j]) {
	    valExists = 1;
	    break;
	  }
	}
	if (valExists == 0) {
	  yearArray.push(tempYear);
	} else {
	  valExists = 0;
	}
      }
    }
    yearArray.sort();
    for (var k = 2; k <= graphCount; k++) {
      yearDropdown(yearArray, k);
    }

  });

function yearDropdown(arrayInput, num)
{

  var yearSelected = document.getElementById("selectYear" + num);
  for (var i = 0; i < arrayInput.length; i++) {
    var element = document.createElement("option");
    element.textContent = arrayInput[i];
    element.value = (i + 1);
    yearSelected.appendChild(element);
  }

}

</script>

  </div>
</div>
