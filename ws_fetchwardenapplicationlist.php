<?php
	include("../connection.php");
	if(isset($_POST['warden_id'])){
		$sql="SELECT s.name, s.enroll_no, s.hostel_no, s.hostel_id, n.id normaloutpass_id, n.status, n.room, n.bed, n.address, n.fromdate, n.tilldate, n.purpose_of_leave, n.entrytime from tbl_student s, tbl_normaloutpass n, tbl_user u where s.id=n.student_id and n.hostel_id=u.hostel_id and (n.status=2 )and u.id='".$_POST['warden_id']."' order by n.id desc";
		$result=mysql_query($sql);
		
		if(mysql_num_rows($result)>0){
			
			$jsonarray = array();
			while($row = mysql_fetch_array($result))
				$jsonarray[]=array("status"=>$row["status"], "outpass_id"=>$row["normaloutpass_id"], "student_name"=>$row["name"],"hostel_id"=>$row["hostel_id"],"hostel_no"=>$row["hostel_no"],"room"=>$row["room"],"bed"=>$row["bed"],"address"=>$row["address"],"fromdate"=>$row["fromdate"],"tilldate"=>$row["tilldate"],"purpose_of_leave"=>$row["purpose_of_leave"], "entrytime"=>$row["entrytime"]);
			
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