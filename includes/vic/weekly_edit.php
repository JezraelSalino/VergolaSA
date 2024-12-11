<?php	
	$connect = mysqli_connect("localhost", "root", "pass123", "vergola_quotedb_sa_v1_as_live");
	// $connect = mysqli_connect("localhost", "root", "", "vergola_quotedb_sa_v1_as_live");
	$id = $_POST["id"];
	$text = $_POST["text"];
	$column_name = $_POST["column_name"];
	$sql_weekly = "UPDATE ver_chronoforms_data_contract_vergola_vic SET ".$column_name."='".$text."' WHERE DATE_FORMAT(schedule_completion, '%V')='".$id."'";
	echo $sql_weekly;
	if(mysqli_query($connect, $sql_weekly))
	{
		echo 'Data Updated';
	}
 ?>
