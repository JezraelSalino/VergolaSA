<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/jquery-ui-1.11.4/jquery-ui.min.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/jquery-ui-1.11.4/jquery-ui.theme.min.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/client-folder.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/Chart.js/css/demo.css'; ?>" />


<script src="<?php echo JURI::base().'jscript/jquery-2.1.4.min.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/jquery-ui-1.11.4/jquery-ui.min.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/jquery-dateFormat.min.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/Chart.js/Chart.min.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/Chart.js/legend.js'; ?>"></script>


<?php
	$user = JFactory::getUser();

//---------------- PREV YEAR Sales
	$year = date('Y');
	//echo $year;
	$year = (int)$year-1;
	$sql = "SELECT *, DATE_FORMAT(target_date,'%Y-%m') as yearMonth FROM ver_rep_sales_target WHERE rep_id='".$user->RepID."' AND year={$year}";
	$qResult = mysql_query($sql); 
	$r = mysql_fetch_assoc($qResult);

	$dFrom = substr($r['dateFromTo'], 0,10);
	$dTo = substr($r['dateFromTo'], -10,10);

	//echo $dFrom;return; 
	$dFrom = date("Y-m-01", strtotime($dFrom));
	$dTo = date("Y-m-t", strtotime($dTo));
	//echo $dFrom." ".$dTo;return;	

	//echo $dTo;return; 
	$sales_amount2_assoc = array(); 
	$sales_amount2 = array();
	$sales_period2 = array();
	$sales_target2 = array();
	
	//echo $dTo;return;

	$sql = "SELECT rep_id, SUM(total_rrp_gst) as sales_amount, DATE_FORMAT(contractdate,'%Y-%m') as yearMonth FROM ver_chronoforms_data_contract_list_vic AS c WHERE rep_id='{$user->RepID}' AND contractdate BETWEEN '{$dFrom}' AND '{$dTo}' GROUP BY YEAR(c.contractdate), MONTH(c.contractdate)";
	//echo $sql;return;
	$qSales = mysql_query($sql); 
	//print_r($s);return; 

 	$i=0;$sales_amount_total=0;$target_amount_total=0; $diffAmountTotal = 0; $runningDiffAmount = 0; 
 	mysql_data_seek($qResult, 0);  
	while ($r = mysql_fetch_assoc($qResult)) { 
		$sales = array(); 
		mysql_data_seek($qSales, 0); 
		while ($s = mysql_fetch_assoc($qSales)) { 
			if($s["yearMonth"]==$r["yearMonth"]){
				$sales = $s;
				//print_r($sales);
				break;
			} 
		} 
		
		$mDate = date_format(date_create($r["target_date"]),"F");
		$mDateShort = date_format(date_create($r["target_date"]),"M");
		$yDate = date_format(date_create($r["target_date"]),"Y");
		$fDate = date_format(date_create($r["target_date"]),"Y-m-d");
 
 
		array_push($sales_target2,$r['target_amount']);
			if($sales['sales_amount']>0){
				array_push($sales_amount2,$sales['sales_amount']);
				array_push($sales_amount2_assoc,array("yearMonth"=>$r["yearMonth"],"sales_amount"=>$sales['sales_amount']));
			}else{
				array_push($sales_amount2,0.00);
			}
			
			array_push($sales_period2,$mDateShort);

	}		

?>
 
 
<table id="tblSalesTarget" class="update-table" style="width:40%; display:inline-block;vertical-align: top; font-size:12px;">
    
	<?php  
		//print_r($user);return;
		//echo $user->RepID;return;
		//error_log("SELECT * FROM ver_rep_sales_target WHERE rep_id='".$user["RepID"]."'", 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');
		//echo $user->RepID;
		$year = date('Y');
		$qResult = mysql_query("SELECT *, DATE_FORMAT(target_date,'%Y-%m') as yearMonth FROM ver_rep_sales_target WHERE rep_id='".$user->RepID."' AND year={$year}");
		$r = mysql_fetch_assoc($qResult);

		$dFrom = substr($r['dateFromTo'], 0,10);
		$dTo = substr($r['dateFromTo'], -10,10);

		//set the date to the start and end of the month
		$dFrom = date("Y-m-01", strtotime($dFrom));
		$dTo = date("Y-m-t", strtotime($dTo));

		$sales_target = array();
		$sales_amount = array();
		$sales_period = array();
		
		//echo $dTo;return;

		$sql = "SELECT rep_id, SUM(total_rrp_gst) as sales_amount, DATE_FORMAT(contractdate,'%Y-%m') as yearMonth FROM ver_chronoforms_data_contract_list_vic AS c WHERE rep_id='{$user->RepID}' AND contractdate BETWEEN '{$dFrom}' AND '{$dTo}' GROUP BY YEAR(c.contractdate), MONTH(c.contractdate)";
		//echo $sql;
		$qSales = mysql_query($sql); 
		//print_r($s);return; 

	 	$i=0;$sales_amount_total=0;$target_amount_total=0; $diffAmountTotal = 0; $runningDiffAmount = 0; $prevYearMonthSalesTotal = 0; 
	 	mysql_data_seek($qResult, 0);  
		while ($r = mysql_fetch_assoc($qResult)) { 
			$sales = array(); 
			mysql_data_seek($qSales, 0); 
			while ($s = mysql_fetch_assoc($qSales)) { 
				if($s["yearMonth"]==$r["yearMonth"]){
					$sales = $s;
					//print_r($sales);
					break;
				} 
			} 

			$prevYearMonthSales = 0;
			//echo "no sales_amount2: ".count($sales_amount2);
			//print_r($sales_amount2_assoc);
			
			for($j=0;$j<count($sales_amount2_assoc);$j++){ 
				//echo $sales_amount2_assoc[$j]["yearMonth"];
				$prevYear = substr($r["yearMonth"],0,4);
				$prevYear = (int)$prevYear-1;
				//echo $prevYear;
				$prevYearMonth = $prevYear ."-". substr($r["yearMonth"],-2,2);
				
				if($sales_amount2_assoc[$j]["yearMonth"]==$prevYearMonth){
					$prevYearMonthSales = $sales_amount2_assoc[$j]["sales_amount"];
					//print_r($sales);
					break;
				} 
			} 

			$prevYearMonthSalesTotal += $prevYearMonthSales;

			 
			
			$mDate = date_format(date_create($r["target_date"]),"F");
			$mDateShort = date_format(date_create($r["target_date"]),"M");
			$yDate = date_format(date_create($r["target_date"]),"Y");
			$fDate = date_format(date_create($r["target_date"]),"Y-m-d");

			$diffAmount = $sales['sales_amount'] - $r['target_amount'];
			$runningDiffAmount += $diffAmount;

		 
			 


			if($i==0){echo "<tr><th >Month</th><th width='100'>Monthly Sales Prev</th><th width='100'>Monthly Sales <br/>({$yDate})</th><th>Target</th><th>Monthly Excess/Difference</th><th>YTD Excess/Difference</th></tr> ";}

			echo "<tr>";
			echo "<td>{$mDate}</td><td>$". ($prevYearMonthSales>0 ? number_format($prevYearMonthSales,2):0.00) ."</td><td>$".number_format($sales['sales_amount'],2)."</td><td>$".number_format($r['target_amount'],2)."</td><td>$". ($sales['sales_amount']>0 ? number_format($diffAmount,2):0.00) ."</td><td>$". ($sales['sales_amount']>0 ? number_format($runningDiffAmount,2):0.00) ."</td>";	
			echo "</tr>"; 

			$i++;
			$sales_amount_total+=$sales['sales_amount'];
			$target_amount_total+=$r['target_amount'];

			array_push($sales_target,$r['target_amount']);
			if($sales['sales_amount']>0){
				array_push($sales_amount,$sales['sales_amount']);
			}else{
				array_push($sales_amount,0.00);
			}
			
			array_push($sales_period,$mDateShort);

		}
		echo "<tr>"; 
		echo "<td><b>Total</b></td><td>$".number_format($prevYearMonthSalesTotal,2)."</td><td><b>$".number_format($sales_amount_total,2)."</b></td><td><b>$".number_format($target_amount_total,2)."</b></td><td> </td><td> </td>";	
		echo "</tr>"; 


	?>
 
	
	 
</table>
 
<div style="display:inline-block">
	<h3 style="margin:15px 0 10px 70px; text-decoration:underline;">Sales Graph</h3>
 	<canvas id="myChart" width="700" height="400" style="margin:0 0 0 50px;"></canvas>
 	<div id="placeholder"></div>
</div>

<table  class="update-table sales-table"  style="margin:30px 0 0 0; width:40%; display:inline-block;vertical-align: top; font-size:12px;">
<tbody>
	<tr><th >Month</th><th width='100'>Monthly Sales Prev</th><th width='100'>Monthly Sales <br/>({$yDate})</th><th>Target</th><th>Monthly Excess/Difference</th><th>YTD Excess/Difference</th></tr> 
</tbody>
</table>


<div style="display:inline-block; margin:30px 0 0 0; ">
	<h3 style="margin:15px 0 10px 70px; text-decoration:underline;">Prev Year Sales Graph</h3>
 	<canvas id="myChart2" width="700" height="400" style="margin:0 0 0 50px;"></canvas>
 	<div id="placeholder2"></div>
</div>

<script type="text/javascript">
	$(document).ready(function(){ 
		// Get the context of the canvas element we want to select
		//var ctx = document.getElementById("myChart").getContext("2d");
		//var myNewChart = new Chart(ctx).PolarArea(data);

		// Get context with jQuery - using jQuery's .get() method.
		
		var sales_amount = [<?php echo implode(",", $sales_amount); ?>];
		var sales_target = [<?php echo implode(",", $sales_target); ?>]; 
 
		var data = {
		    labels: [<?php echo "'".implode("','", $sales_period)."'"; ?>],
		    datasets: [
		        {
		            label: "Monthly Sales",
		            fillColor: "rgba(151,187,205,0.2)",
		            strokeColor: "rgba(151,187,205,1)",
		            pointColor: "rgba(151,187,205,1)",
		            pointStrokeColor: "#fff",
		            pointHighlightFill: "#fff",
		            pointHighlightStroke: "rgba(151,187,205,1)", 
		            data: sales_amount
		        },
		        {
		            label: "Target Sales",
		            fillColor: "rgba(220,220,220,0.2)",
		            strokeColor: "rgba(220,220,220,1)",
		            pointColor: "rgba(220,220,220,1)",
		            pointStrokeColor: "#fff",
		            pointHighlightFill: "#fff",
		            pointHighlightStroke: "rgba(220,220,220,1)",
		            data: sales_target
		        }
		    ]
		};


		var sales_amount2 = [<?php echo implode(",", $sales_amount2); ?>];
		var sales_target2 = [<?php echo implode(",", $sales_target2); ?>];

		var data2 = {
		    labels: [<?php echo "'".implode("','", $sales_period2)."'"; ?>],
		    datasets: [
		        {
		            label: "Monthly Sales",
		            fillColor: "rgba(151,187,205,0.2)",
		            strokeColor: "rgba(151,187,205,1)",
		            pointColor: "rgba(151,187,205,1)",
		            pointStrokeColor: "#fff",
		            pointHighlightFill: "#fff",
		            pointHighlightStroke: "rgba(151,187,205,1)", 
		            data: sales_amount2
		        },
		        {
		            label: "Target Sales",
		            fillColor: "rgba(220,220,220,0.2)",
		            strokeColor: "rgba(220,220,220,1)",
		            pointColor: "rgba(220,220,220,1)",
		            pointStrokeColor: "#fff",
		            pointHighlightFill: "#fff",
		            pointHighlightStroke: "rgba(220,220,220,1)",
		            data: sales_target2
		        }
		    ]
		};

		var options = {
		 	//Boolean - Show a backdrop to the scale label
		    scaleShowLabelBackdrop : true,

		    //String - The colour of the label backdrop
		    scaleBackdropColor : "rgba(255,255,255,0.75)",

		    // Boolean - Whether the scale should begin at zero
		    scaleBeginAtZero : true,

		    //Number - The backdrop padding above & below the label in pixels
		    scaleBackdropPaddingY : 2,

		    //Number - The backdrop padding to the side of the label in pixels
		    scaleBackdropPaddingX : 2,

		    //Boolean - Show line for each value in the scale
		    scaleShowLine : true,

		    //Boolean - Stroke a line around each segment in the chart
		    segmentShowStroke : true,

		    //String - The colour of the stroke on each segement.
		    segmentStrokeColor : "#fff",

		    //Number - The width of the stroke value in pixels
		    segmentStrokeWidth : 2,

		    //Number - Amount of animation steps
		    animationSteps : 70,

		    //String - Animation easing effect.
		    animationEasing : "easeOutBounce",

		    //Boolean - Whether to animate the rotation of the chart
		    animateRotate : true,

		    //Boolean - Whether to animate scaling the chart from the centre
		    animateScale : false,

		    //String - A legend template
		    legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",

		    animation: false, 

		    scaleLabel: function (valuePayload) {
					    return '$'+Number(valuePayload.value).toFixed(0).replace(/./g, function(c, i, a) {
    return i && c !== "." && ((a.length - i) % 3 === 0) ? ',' + c : c;
});
					}


		};

		// This will get the first returned node in the jQuery collection.
		//var myNewChart = new Chart(ctx);
		var ctx = $("#myChart").get(0).getContext("2d");
		var myLineChart = new Chart(ctx).Line(data, options);
		legend(document.getElementById('placeholder'), data);

		var ctx2 = $("#myChart2").get(0).getContext("2d");
		var myLineChart2 = new Chart(ctx2).Line(data2, options);
		legend(document.getElementById('placeholder2'), data2);

	});

 
 


</script> 
