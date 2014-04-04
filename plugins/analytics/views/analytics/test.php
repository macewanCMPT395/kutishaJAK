<h1><?php echo $heading; ?></h1>

<!DOCTYPE html>
<html>
<head>
</head>
<body>
<form>
Select your favorite browser:
<select id="monthSel">
   <option value=0>ALL</option>
   <option value=1>January</option>
   <option value=2>February</option>  
   <option value=3>March</option>
   <option value=4>April</option>
   <option value=5>May</option>
   <option value=6>June</option>
   <option value=7>July</option>  
   <option value=8>August</option>
   <option value=9>September</option>
   <option value=10>October</option>
   <option value=11>November</option>
   <option value=12>December</option>
   </select>

<button onClick="GetSelectedItem();">Refine</button>

<script>
   function GetSelectedItem()
    {
        var e = document.getElementById("monthSel");
        var strSel = "The Value is: " + e.options[e.selectedIndex].value + " and text is: " + e.options[e.selectedIndex].text;
        console.log(strSel);

	$.getJSON("<?php echo url::base(TRUE) . 'api?task=version'?>", function(data) {
	    $("#footer").prepend("hello " + data['payload']['version'][0]['version']);
	  });
    }

var year = [];

$.getJSON("<?php echo url::base(TRUE) . 'api?task=incidents'?>", function(data) {
    for (var i = 0; i < data['payload']['incidents'].length; i++) {
      var tempYear = data['payload']['incidents'][i]['incident']['incidentdate'];
      tempYear = tempYear.substring(0,4);
      console.log(tempYear + "t");
      if (year.length == 0) {
	year.push(tempYear);
      } else {
	for (var j = 0; j <= year.length; j++) {
	  var valExists = 0;
	  if (tempYear == year[j]) {
	    valExists = 1;
	    break;
	  }
	}
	if (valExists == 0) {
	  year.push(tempYear);
	} else {
	  valExists = 0;
	}
      }
    }
    year.sort();
    console.log(year.length);
    for (var k = 0; k < year.length; k++) {
      console.log(year[k]);
    }
    yearDropdown(year);
 });

function yearDropdown(arrayInput) {
  var yearSelected = document.getElementById("selectYear");
  for (var i = 0; i < arrayInput.length; i++) {
    console.log(arrayInput[i] + "z");
    var element = document.createElement("option");
    element.textContent = arrayInput[i];
    element.value = (i + 1);
    yearSelected.appendChild(element);
  }
}

</script>

</form>
</body>
</html>
<?php

  /*
   *
   * @Create an HTML drop down menu
   *
   * @param string $name The element name and ID
   *
   * @param int $selected The month to be selected
   *
   * @return string
   *
   */
function monthDropdown($name="year", $selected="All", $yearArray)
 {
   $dd = '<select name="'.$name.'" id="'.$name.'">';

   $months = array(
		   1 => 'january',
		   2 => 'february',
		   3 => 'march',
		   4 => 'april',
		   5 => 'may',
		   6 => 'june',
		   7 => 'july',
		   8 => 'august',
		   9 => 'september',
		   10 => 'october',
		   11 => 'november',
		   12 => 'december');
   /*** the current month ***/
   $selected = is_null($selected) ? date('n', time()) : $selected;

   for ($i = 1; $i <= 12; $i++)
     {
       $dd .= '<option value="'.$i.'"';
       if ($i == $selected)
	 {
	   $dd .= ' selected';
	 }
       /*** get the month ***/
       $dd .= '>'.$months[$i].'</option>';
     }
   $dd .= '</select>';
   return $dd;
 }


/*** example usage ***/
$name = 'myYearDropdown';

//echo yearDropdown($name);
echo '<select id="selectYear"><option value=0>All</option></select>';
echo '<button onClick="GetSelectedItem();">Refine</button>';
                                                                                                                                                                                                                                                                                                                     ?>
