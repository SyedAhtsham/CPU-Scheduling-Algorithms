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

.tb2
{
	width: 800px;
	border: none;
	text-align: left;
	padding-left: 5px;
}

</style>



<body style="background-color:#d9ecd9">

<br>

<br>

<center><h2><u>CPU Scheduling Algorithms Simulator</u></h2></center>
	<br>
	<br>

<!-- <form action="index3.php" method="get">
<label>Enter the Number of Processess: </label>
<input type="number" name="" id="process">
<button id="submit">Submit</button><br><br> -->






<?php


$nOP = $_POST["nOP"];


echo '<center><div>';
echo  'Number of Processess: &nbsp<b>'.$nOP.'</b><br>';

echo nl2br("\n");

echo ('<pre><h2 style="color: red;">*Please Enter the Processes in their Sequence i.e., in their Ascending order of Arrival Time..</h2></pre><br>');
$output = "";
	$output .='<form name="input" action="index4.php?nOP='.$nOP.'" method="post">';

$output .= '<label style="font-size: 18px;"><b>Enter Arrival Time</b></label> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  <label style="font-size: 18px;"><b>Enter Processing Time</b></label><br><br>';
	for ($i = 0;  $i < $nOP; $i++) {
		$output .= 'P'.($i+1).' Arrival Time: <input type="number" name="arrivalTime[]" value="0" required>  &nbsp &nbsp &nbsp &nbsp   P'.($i+1).' Processing Time: <input type="number" name = "processingTime[]" required> <br><br>';

		}

$output .= '<br><p>Please select CPU Scheduling Algorithm:</p>
  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp<input type="radio" id="" name="algo" value="First Come First Serve (FCFS)" required>
  <label for="">First Come First Serve (FCFS)</label><br> 
  <input type="radio" id="" name="algo"  value="Shortest Job First (SJF)" required>
  <label for="">Shortest Job First (SJF)</label><br> &nbsp &nbsp &nbsp &nbsp &nbsp
  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp<input type="radio" id="" name="algo" value="Shortest Remaining Job First (SRJF)" required>
<label > Shortest Remaining Job First (SRJF) </label>
<br><br>';

	$output .= '<input type="submit" style="border: 4px solid black; background-color: blue; color: white; width: 120px; height: 40px;" id="submit" value="Submit"><br><br>';
		echo $output;

		echo '</div></center>';



?>


<br>
<br>



</body>
</html>


