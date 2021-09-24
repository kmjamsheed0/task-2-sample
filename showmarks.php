<?php
$user_name = "root";
$password = "root";
$server = "localhost";
$database = "student";
$regno = $_POST['regno'];
$db_handle = new mysqli($server,$user_name,$password);
if(!$db_handle){
	die("Could not Connect: " . mysql_error());
	}
$db_found= mysqli_select_db($db_handle,$database);
if($db_found){
		$SQL= "SELECT * FROM mark WHERE regno='".$regno."'";
		/*$SQL= "SELECT * FROM mark WHERE regno=?";*/
		/*$SQL->bind_param("s", $regno);
		$SQL->execute();
		$result_set = $SQL->get_result();*/
		$result_set = mysqli_query($db_handle, $SQL);
		/*$result_set=$db_handle->query($SQL);*/
		/*$record=mysql_fetch_array($record);*/
		/*$record=$result_set->fetch_assoc();*/
	
	$record = mysqli_fetch_array($result_set, MYSQLI_ASSOC);
	if($record)
	{
		echo " fetched";
	}
	else
	{
		echo " not fetched";
	}
	echo "<BR>MARK LIST";
	echo "<BR>";
	echo "<BR>Reg. no.:".$record['regno'];
	echo "<BR>Name  :".$record['sname'];
	echo "<BR>Dept  :".$record['sgroup'];
	echo "<BR>Mark1 :".$record['mark1'];
	echo "<BR>Mark2  :".$record['mark2'];
	echo "<BR>Mark3  :".$record['mark3'];
	echo "<BR>Result   :".compute_result($record['mark1'],$record['mark2'],$record['mark3']);
	}
else
	{echo"<BR>student Database not found ";}
mysqli_close($db_handle);

function compute_result($m1,$m2,$m3)
{	$tmarks=$m1 + $m2+$m3;
	if(($m1<45)||($m2<45)||($m3<45))
		$result="Failed";
		elseif($tmarks<150)
		$result="Passed";
		elseif($tmarks<180)
		$result="B+";
		elseif($tmarks<225)
		$result="A+";
		else
		$result="OS";
		return $result;
}
?>