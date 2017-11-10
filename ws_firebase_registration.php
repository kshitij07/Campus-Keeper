<?php
	include("../connection.php");
	if(isset($_POST['id']) && isset($_POST['fcmid']) && isset($_POST['memberType'])){
		if($_POST['memberType']==1){
			mysql_query("update tbl_student set fcmid='".$_POST['fcmid']."' where id=".$_POST['id']) or die(mysql_error());
			
				
		} else if( $_POST['memberType']==2 || $_POST['memberType']==3 || $_POST['memberType']==4){
			mysql_query("update tbl_user set fcmid='".$_POST['fcmid']."' where id=".$_POST['id']) or die(mysql_error());
		}
		$mainarray=array("status"=>"1","message"=>"Successfully registered.");
		
	}else{
		$mainarray=array("status"=>"0","message"=>"Please provide id.");
	}
	
	echo json_encode($mainarray);
	exit;
?>