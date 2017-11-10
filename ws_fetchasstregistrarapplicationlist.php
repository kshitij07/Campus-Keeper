<?php
	include("../connection.php");
	if(isset($_POST['asst_registrar_id'])){
		$result=mysql_query("SELECT s.name, s.enroll_no, s.hostel_no, s.hostel_id, d.id dailyoutpass_id, d.status, d.address, d.fromtime, d.tilltime, d.purpose_of_leave, d.entrytime from tbl_student s, tbl_dailyoutpass d, tbl_user u where s.id=d.student_id and u.id='".$_POST['asst_registrar_id']."' order by entrytime desc");
		
		if(mysql_num_rows($result)>0){
			
			$jsonarray = array();
			while($row = mysql_fetch_array($result))
				$jsonarray[]=array("status"=>$row["status"], "outpass_id"=>$row["normaloutpass_id"], "student_name"=>$row["name"], "address"=>$row["address"],"fromtime"=>$row["fromtime"],"tilltime"=>$row["tilltime"],"purpose_of_leave"=>$row["purpose_of_leave"], "entrytime"=>$row["entrytime"]);
			
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