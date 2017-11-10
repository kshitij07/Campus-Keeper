<?php
	include("../connection.php");
	$result=mysql_query("SELECT * FROM tbl_student") or die(mysql_error());
	$students=array();
	while($row=mysql_fetch_array($result)){
		$students[]=array("id"=>$row["id"],"name"=>$row["name"]);
	}	
	$mainarray=array("status"=>"1","message"=>"Successfully Login.","data"=>$students);
	echo json_encode($mainarray);
	exit;
?>