<?php
	include("../connection.php");
	if(isset($_POST['scanned'])){
		
		$result=mysql_query("SELECT * FROM tbl_student WHERE enroll_no = '".$_POST['scanned']."'") or die(mysql_error());
		
		if(mysql_num_rows($result)>0){
			$row = mysql_fetch_array($result);
			// user authentication details are correct
			$jsonarray=array("id"=>$row["id"],"name"=>$row["name"],"enroll_no"=>$row["enroll_no"],"hostel_id"=>$row["hostel_id"],"hostel_no"=>$row["hostel_no"],"room"=>$row["room"],"bed"=>$row["bed"],"branch"=>$row["branch"],"year"=>$row["year"],"email"=>$row["email"],"mobile"=>$row["mobile"],"fmobile"=>$row["fmobile"],"membertype"=>$row["membertype"]);
			$mainarray=array("status"=>"1","message"=>"Successfully Login.","data"=>$jsonarray);
		
		} else {
			$mainarray=array("status"=>"0","message"=>"Please enter valid username.");
		}
	
	}else{
		$mainarray=array("status"=>"0","message"=>"Please provide username and password.");
	}
	
	echo json_encode($mainarray);
	exit;
?>