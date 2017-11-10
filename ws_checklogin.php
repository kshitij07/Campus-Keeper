<?php
	include("../connection.php");
	if(isset($_POST['deviceid']) && isset($_POST['membertype'])){
		if($_POST['membertype']==1){
			$result=mysql_query("SELECT * FROM tbl_student WHERE deviceid = '".$_POST['deviceid']."'") or die(mysql_error());
			
			if(mysql_num_rows($result)>0){
				
				$row = mysql_fetch_array($result);
				$jsonarray=array("id"=>$row["id"],"name"=>$row["name"],"enroll_no"=>$row["enroll_no"],"hostel_id"=>$row["hostel_id"],"hostel_no"=>$row["hostel_no"],"room"=>$row["room"],"bed"=>$row["bed"],"branch"=>$row["branch"],"year"=>$row["year"],"email"=>$row["email"],"mobile"=>$row["mobile"],"fmobile"=>$row["fmobile"],"membertype"=>$row["membertype"]);
				$mainarray=array("status"=>"1","message"=>"Successfully Login.","data"=>$jsonarray);
			} else {
				$mainarray=array("status"=>"0","message"=>"Please enter valid username.");
			}
		} else if( $_POST['membertype']==2 || $_POST['membertype']==3 || $_POST['membertype']==4){
			$result=mysql_query("SELECT * FROM tbl_user WHERE deviceid = '".$_POST['deviceid']."'") or die(mysql_error());
		
			if(mysql_num_rows($result)>0){
			
				$row = mysql_fetch_array($result);
				$jsonarray=array("id"=>$row["id"],"name"=>$row["username"],"email"=>$row["email"],"mobile"=>$row["mobile"],"hostel_id"=>$row["hostel_id"],"membertype"=>$row["membertype"]);
				$mainarray=array("status"=>"1","message"=>"Successfully Login.","data"=>$jsonarray);
				
			} else {
				$mainarray=array("status"=>"0","message"=>"Somebody else has logged in with your account");
			}
		}
		
	}else{
		$mainarray=array("status"=>"0","message"=>"Please provide username and password.");
	}
	
	echo json_encode($mainarray);
	exit;
?>