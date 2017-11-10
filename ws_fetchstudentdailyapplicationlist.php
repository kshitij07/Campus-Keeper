<?php
	include("../connection.php");
	if(isset($_POST['student_id'])){
		$result=mysql_query("SELECT * FROM tbl_dailyoutpass WHERE student_id = '".$_POST['student_id']."' order by entrytime desc") or die(mysql_error());
		
		$student_name=mysql_query("select tbl_student.name from tbl_student where tbl_student.id='".$_POST['student_id']."'");
		if(mysql_num_rows($result)>0){
			$row1=mysql_fetch_array($student_name);
			$jsonarray = array();
			while($row = mysql_fetch_array($result))
				$jsonarray[]=array("id"=>$row["id"],"student_id"=>$row["student_id"],"student_name"=>$row1["name"],"address"=>$row["address"],"fromtime"=>$row["fromtime"],"tilltime"=>$row["tilltime"],"purpose_of_leave"=>$row["purpose_of_leave"],"entrytime"=>$row["entrytime"]);
			
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