<?php
	include("../connection.php");
	if(isset($_POST['student_id']) && isset($_POST['address']) && isset($_POST['fromtime'])&& isset($_POST['tilltime']) && isset($_POST['purpose_of_leave']) ){
		$sql="select tbl_student.id, tbl_hostel.id hid,tbl_student.hostel_no, tbl_student.room, tbl_student.bed from tbl_student,tbl_hostel where tbl_hostel.id=tbl_student.hostel_id and tbl_student.id=".$_POST['student_id'];
		$result=mysql_query($sql);
		
		if($row = mysql_fetch_assoc($result)){
			$result=mysql_query("insert into tbl_dailyoutpass (student_id, address,fromtime, tilltime, purpose_of_leave, entrytime) 
				values('".$_POST['student_id']."','".$_POST['address']."', '".$_POST['fromtime']."','".$_POST['tilltime']."','".$_POST['purpose_of_leave']."',now())") or null;
			
			if($result!=null){
				$mainarray=array("status"=>"1","message"=>"Application has been uploaded.");
			} else {
				// user not found
				$mainarray=array("status"=>"0","message"=>"Please contact administrator.");
			}
		}else{
			$mainarray=array("status"=>"2","message"=>"Unable to save, please contact administrator.");
		}
	}else{
		$mainarray=array("status"=>"0","message"=>"Please provide all the entries.");
	}
	echo json_encode($mainarray);
	exit;
?>