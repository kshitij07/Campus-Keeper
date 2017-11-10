<?php
	include("../connection.php");
	if(isset($_POST['student_id'])){
		$result=mysql_query("SELECT s.name, s.enroll_no, s.hostel_no, s.hostel_id, s.room, s.bed, s.mobile, s.fmobile from tbl_student s where s.id='".$_POST['student_id']."'");	
		
		if(mysql_num_rows($result)>0){
			
			$jsonarray = array();
			while($row = mysql_fetch_array($result))
				$jsonarray[]=array("enroll_no"=>$row["enroll_no"],"student_name"=>$row["name"],"hostel_id"=>$row["hostel_id"],"hostel_no"=>$row["hostel_no"],"room"=>$row["room"],"bed"=>$row["bed"],"mobile"=>$row["mobile"], "fmobile"=>$row["fmobile"]);
			
			$mainarray=array("status"=>"1","message"=>"Applications found.","data"=>$jsonarray);
		}else{
				$mainarray=array("status"=>"0","message"=>"Parser error.");
		}
	} else {
			$mainarray=array("status"=>"0","message"=>"No Application");
	}	
	echo json_encode($mainarray);
	exit;
?>