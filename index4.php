<?php
error_reporting(0);
ini_set('display_errors', 0);
?>
<!DOCTYPE html>
<html>
<head>
	<title>CPU Scheduling</title>

<style type="text/css">
	

.tb1
{
	background-color: #ADD8E6;
	border: 2px solid black;
	border-collapse: collapse;
	width: 800px;
	height: 50px;
	text-align: center;
}

.tb3
{
	background-color: #ADD8E6;
	border: 2px solid black;
	border-collapse: collapse;

	width: 400px;
	height: 50px;
	text-align: center;
}

.tb2
{
	width: 800px;
	border: none;
	text-align: left;
	padding-left: 2px;
}

.tb4
{
	
	border: none;
	text-align: left;
	padding-left: 10px;
}

</style>



<body style="background-color:#d9ecd9">

<br>
<br>


<?php




$nOP = $_GET["nOP"];
$arrivalTime = $_POST["arrivalTime"];
$processingTime = $_POST["processingTime"];
$algo = $_POST["algo"];

echo '<center><div>';

echo "<center><u><h3>CPU $algo Algorithm Simulation</h3></u></center><br>";


echo  'Number of Processess: <b>'.$nOP.'</b><br>';

echo '<br><label> Selected CPU Scheduling Algorithm:  </label>
  			<b>'.$algo.'</b>
<br><br><h4><u>Table of Processes</u></h4>';



$outputT = "";


	$outputT .='<table class="tb3"><tr>
				
				<th class="tb3">Process</th>
				<th class="tb3"> Arrival Time</th>
				<th class="tb3"> Burst Time</th>

				</tr>
	';

	for ($i = 0;  $i < $nOP; $i++) {
		$outputT .= '<tr><td class="tb3">P'.($i+1).'</td>
					<td class="tb3">'.$arrivalTime[$i].'</td>
					<td class="tb3">'.$processingTime[$i].'</td></tr>
		';

		}

$outputT .= '</table>';
		echo $outputT;

echo '<br><br><h4><u>Gantt Chart for the Given Processess</u></h4>';

	
		echo '</div></center>';


//========================================================
//========================================================
//========================================================
//========================================================
//========================================================
//========================================================


?>
<?php


if($algo == "First Come First Serve (FCFS)")
{

$at = $arrivalTime;
 $pt = $processingTime;

$tt = array();
 $tat = array();
$wt = array();
 $temp = 0;
 $sum = 0;

$tt[0] = $at[0] + $pt[0];
$tat[0] = $tt[0] - $at[0];
$wt[0] = $tat[0] - $pt[0];

$sum = $tat[0];
 $sum2 = $wt[0];

for ($i = 1; $i<$nOP; $i++)
{
	if($at[$i]>$tt[$i-1])
	{
		$temp = $at[$i] - $tt[$i-1];
	}
	$tt[$i] = $tt[$i-1] + $temp + $pt[$i];
	$tat[$i] = $tt[$i] - $at[$i];
	

$wt[$i] = $tat[$i]-$pt[$i];
$sum2 = $sum2+$wt[$i];
	$sum = $sum + $tat[$i];
	$temp = 0;

}

 $avg1 = $sum / $nOP;

$avg2 = $sum2/$nOP;



echo '<center><div>';
 
 $output1 = "";
$output1 .= '<table class="tb1"> <tr class="tb1">';
for($i = 0; $i<$nOP; $i++)
{

$output1 .= '

<td class="tb1" style="width: '.(((($pt[$i])*800)/100)*$pt[$i]).'px;">P'.($i+1).'</td>';


}

$output1 .= '</tr></table>';

echo $output1;

$output2 = "";
$output2 .= '<center><table class="tb2"> <tr class="tb2">';

$output2 .= '<td class="tb2" style="padding-left: 0px; width: '.(((($pt[0])*800)/100)*$pt[0]).'px;">'.$at[0].' </td>';

for($i = 0; $i<$nOP-1; $i++)
{
	$output2 .= '<td class="tb2" style="width: '.(((($pt[$i+1])*800)/100)*$pt[$i+1]).'px;"> '.$tt[$i].'</td>';
}

	$output2 .= '<td  class="tb4" style="padding-left: 0px; width: 1px;">'.$tt[$i].' </td>';

$output2 .= '</tr> </table></center><br> ';



echo $output2;
echo '</div></center>';
echo ("\n");
echo ("\n");


echo '<center> &nbsp &nbsp &nbsp   &nbspAverage Turn Around Time <b>(Avg TAT)</b>: &nbsp &nbsp'.$avg1.' </center><br>';

echo '<center> Average Wait Time <b>(Avg WT)</b>: &nbsp &nbsp &nbsp'.$avg2.' </center><br>';



}
else if($algo == "Shortest Job First (SJF)")
{
	

$at = $arrivalTime;
 $pt = $processingTime;




$pID = array();

for($i=0; $i<$nOP; $i++)
{
	$pID[$i] = $i;
}

$mat = array();

for($i=0; $i<$nOP; $i++)
{
	$mat[$i] = array(6);
}

for($i=0; $i<$nOP; $i++)
{
	$mat[$i][0] = $pID[$i];
	$mat[$i][1] = $at[$i];
	$mat[$i][2] = $pt[$i]; 
}



for($i=0; $i<$nOP; $i++)
{
	
	for($j=0; $j<$nOP-$i-1; $j++)
	{
		if($mat[$j][1] > $mat[$j+1][1])
		{ 
			for($k=0; $k<5; $k++)
			{
				$temp = $mat[$j][$k];
				$mat[$j][$k] = $mat[$j+1][$k];
				$mat[$j+1][$k] = $temp;
			}

		}

	}


}

$tempVar = 0;
$val = -1;

	$mat[0][3] = $mat[0][1] + $mat[0][2]; 
    $mat[0][5] = $mat[0][3] - $mat[0][1]; 
    $mat[0][4] = $mat[0][5] - $mat[0][2];

for($i=1; $i<$nOP; $i++) 
    { 
        $tempVar = $mat[$i-1][3]; 
         $low = $mat[$i][2]; 
        for( $j=$i; $j<$nOP; $j++) 
        { 
            if($tempVar >= $mat[$j][1] && $low >= $mat[$j][2]) 
            { 
                $low = $mat[$j][2]; 
                $val = $j; 
            } 
        } 
        $mat[$val][3] = $tempVar + $mat[$val][2]; 
        $mat[$val][5] = $mat[$val][3] - $mat[$val][1]; 
        $mat[$val][4] = $mat[$val][5] - $mat[$val][2]; 
        for( $k=0; $k<6; $k++) 
        { 
				$temp = $mat[$val][$k];
				$mat[$val][$k] = $mat[$i][$k];
				$mat[$i][$k] = $temp;

        } 
    } 




// $tempPT = array();
// $temp2 = array();
// $tempAT = array();

// $isIt = false;

    $total1 = 0;
    $total2 = 0;

for($i=0; $i<$nOP; $i++)
{
	$total1 += $mat[$i][4];
	$total2 += $mat[$i][5];

}

$tt = array();

for ($i = 0; $i<$nOP; $i++)
{
	// if($at[$i]>$tt[$i-1])
	// {
	// 	$temp = $at[$i] - $tt[$i-1];
	// }
	$tt[$i] = $mat[$i][1] + $mat[$i][5];

}

$averageTAT = $total2/$nOP;
$averageWT = $total1/$nOP;




echo '<center><div>';

$output1 ="";
 
$output1 .= '<table class="tb1"> <tr class="tb1">';
for($i = 0; $i<$nOP; $i++)
{

$output1 .= '

<td class="tb1" style="width: '.(((($mat[$i][2])*800)/100)*$mat[$i][2]).'px;">P'.($mat[$i][0]+1).'</td>';
}

$output1 .= '</tr></table>';

echo $output1;

$output2 = "";
$output2 .= '<center><table class="tb2"> <tr class="tb2">';

$output2 .= '<td class="tb2" style="padding-left: 0px; width: '.(((($mat[0][2])*800)/100)*$mat[0][2]).'px;">'.$at[0].' </td>';

for($i = 0; $i<$nOP-1; $i++)
{
	
	
	$output2 .= '<td class="tb2" style="width: '.(((($mat[$i+1][2])*800)/100)*$mat[$i+1][2]).'px;"> '.$tt[$i].'</td>';
}

	$output2 .= '<td  class="tb4" style="padding-left: 0px; width: 1px;">'.$tt[$i].' </td>';
$output2 .= '</tr> </table></center><br> ';


echo '</div></center>';
echo $output2;

echo ("\n");
echo ("\n");


echo '<center> &nbsp &nbsp &nbsp   &nbspAverage Turn Around Time <b>(Avg TAT)</b>: &nbsp &nbsp'.$averageTAT.' </center><br>';

echo '<center> Average Wait Time <b>(Avg WT)</b>: &nbsp &nbsp &nbsp'.$averageWT.' </center><br>';





}

else 
{
	

$at = $arrivalTime;
 $pt = $processingTime;


class Process {
    public $pid;
    public $bt;
    public $art;
}

$proc = array();

for($i=0; $i<$nOP; $i++)
{
	$aProc = new Process();
	$aProc->pid = $i;
	$aProc->bt = $pt[$i];
	$aProc->art = $at[$i];
	$proc[$i] = $aProc;
}

$rt = $pt;



$wt = array($nOP);

$complete = 0;
$t = 0; $minm = PHP_INT_MAX; $shortest = 0;
$check = false;
$previousShortest = -1;
echo '<center><div>';

$output1 ="";
 
$output1 .= '<table class="tb1"> <tr class="tb1">';

 $output2 = "";
$output2 .= '<center><table class="tb2"> <tr class="tb2">';

while ($complete != $nOP) {
	# code...

        // Find process with minimum 
        // remaining time among the 
        // processes that arrives till the 
        // current time` 
	for($j=0; $j<$nOP; $j++)
	{
		if(($proc[$j]->art <= $t)&&($rt[$j] < $minm) && $rt[$j] > 0)
		{
			$minm = $rt[$j];
			$shortest = $j;
			$check = true;

		}
	}

	if($check == false)
	{
		$t++;
		continue;
	}

//reduce the remaining time by one
	$rt[$shortest]--;

//Update minimum
	$minm = $rt[$shortest];
	if($minm == 0)
	{
		$minm = PHP_INT_MAX;
	}

//if a process gets completely
// executed
	if($rt[$shortest] == 0)
	{
		$complete++;
		$check = false;

		//Find finish time of the cuerrent 
		//process
		$finish_time = $t+1;

		$wt[$shortest] = $finish_time - $proc[$shortest]->bt - $proc[$shortest]->art;

		if($wt[$shortest] < 0)
		{
			$wt[$shortest] = 0;
		}


	}

	if($shortest != $previousShortest)
	{
		$output1 .= '

<td class="tb1" style="width: '.(((($t)*800)/100)*$t).'px;">P'.($shortest+1).'</td>';

	$output2 .= '<td class="tb2" style="width: '.(((($t+1)*800)/100)*($t+1)).'px;"> '.($t).'</td>';

$previousShortest = $shortest;

	}

	$t++;

}

$output2 .= '<td  class="tb4" style="padding-left: 0px; width: 1px;">'.$t.' </td>';
 $output2 .= '</tr> </table></center><br> ';

$output1 .= '</tr></table>';

echo $output1;





echo '</div></center>';
echo $output2;
echo '<br>';
echo '<br>';


$totalTAT = 0; $totalWT = 0;
$tt = array();
for($i=0; $i<$nOP; $i++)
{
	$totalTAT += $proc[$i]->bt + $wt[$i];
	$totalWT += $wt[$i];
	$tt[$i] = ($proc[$i]->bt + $wt[$i])+$proc[$i]->art;
}

$avgTAT = $totalTAT/$nOP;
$avgWT = $totalWT/$nOP;


// echo '<center><div>';

// $output1 ="";
 
// $output1 .= '<table class="tb1"> <tr class="tb1">';
// for($i = 0; $i<$nOP; $i++)
// {

// $output1 .= '

// <td class="tb1" style="width: '.(((($proc[$i]->bt)*800)/100)*$proc[$i]->bt).'px;">P'.($proc[$i]->pid+1).'</td>';
// }

// $output1 .= '</tr></table>';

// echo $output1;

// $output2 = "";
// $output2 .= '<center><table class="tb2"> <tr class="tb2">';

// $output2 .= '<td class="tb2" style="padding-left: 0px; width: '.(((($proc[0]->bt)*800)/100)*$proc[0]->bt).'px;">'.$proc[0]->art.' </td>';

// for($i = 0; $i<$nOP-1; $i++)
// {
	
	
// 	$output2 .= '<td class="tb2" style="width: '.(((($proc[$i+1]->bt)*800)/100)*$proc[$i+1]->bt).'px;"> '.$tt[$i].'</td>';
// }

// 	$output2 .= '<td  class="tb4" style="padding-left: 0px; width: 1px;">'.$tt[$i].' </td>';
// $output2 .= '</tr> </table></center><br> ';


// echo '</div></center>';
// echo $output2;


echo ("\n");
echo ("\n");

echo ("\n");
echo ("\n");

echo '<center> &nbsp &nbsp &nbsp   &nbspAverage Turn Around Time <b>(Avg TAT)</b>: &nbsp &nbsp'.$avgTAT.' </center><br>';

echo '<center> Average Wait Time <b>(Avg WT)</b>: &nbsp &nbsp &nbsp'.$avgWT.' </center><br>';


}

?>


<br>
<br>



</body>
</html>



