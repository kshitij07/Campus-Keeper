<?php
	include("../connection.php");
	if(isset($_POST['warden_status']) && isset($_POST['outpass_id'])){
		
		$result=mysql_query("update tbl_normaloutpass set warden_status='".$_POST['warden_status']."' where tbl_normaloutpass.id='".$_POST['outpass_id']."'");
	
		
			if($result!=null){
				$mainarray=array("status"=>"1","message"=>"Record updated successfully.");
			} else {
				// user not found
				$mainarray=array("status"=>"0","message"=>"Please contact administrator.");
			}
		
	}else{
		$mainarray=array("status"=>"0","message"=>"Please provide all the entries.");
	}
	echo json_encode($mainarray);
	exit;
?>