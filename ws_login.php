<?php
	include("../connection.php");
	if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['membertype']) && isset($_POST['deviceid'])){
		if($_POST['membertype']==1){
			$result=mysql_query("SELECT * FROM tbl_student WHERE enroll_no = '".$_POST['username']."'") or die(mysql_error());
			
			if(mysql_num_rows($result)){
				
				$row = mysql_fetch_array($result);
				$pass=$row['password'];
				
				if ($pass == md5($_POST['password'])) {
					// user authentication details are correct
					$jsonarray=array("id"=>$row["id"],"name"=>$row["name"],"enroll_no"=>$row["enroll_no"],"hostel_id"=>$row["hostel_id"],"hostel_no"=>$row["hostel_no"],"room"=>$row["room"],"bed"=>$row["bed"],"branch"=>$row["branch"],"year"=>$row["year"],"email"=>$row["email"],"mobile"=>$row["mobile"],"fmobile"=>$row["fmobile"],"membertype"=>$row["membertype"], "deviceid"=>$row["deviceid"]);
					$mainarray=array("status"=>"1","message"=>"Successfully Login.","data"=>$jsonarray);
					$sql="UPDATE tbl_student SET deviceid='".$_POST['deviceid']."' WHERE enroll_no='".$_POST['username']."';";
					mysql_query($sql);
				}else{
					$mainarray=array("status"=>"0","message"=>"Please enter valid password.");
				}
			} else {
				$mainarray=array("status"=>"0","message"=>"Please enter valid username.");
			}
		} else if( $_POST['membertype']==2 || $_POST['membertype']==3 || $_POST['membertype']==4){
			$result=mysql_query("SELECT * FROM tbl_user WHERE username = '".$_POST['username']."'") or die(mysql_error());
		
			if(mysql_num_rows($result)>0){
			
				$row = mysql_fetch_array($result);
				$pass=$row['password'];
				
				if ($pass == md5($_POST['password'])) {
					// user authentication details are correct
					$jsonarray=array("id"=>$row["id"],"name"=>$row["username"],"email"=>$row["email"],"mobile"=>$row["mobile"],"hostel_id"=>$row["hostel_id"],"membertype"=>$row["membertype"], "deviceid"=>$row["deviceid"]);
					$mainarray=array("status"=>"1","message"=>"Successfully Login.","data"=>$jsonarray);
					$sql="UPDATE tbl_user SET deviceid='".$_POST['deviceid']."' where username='".$_POST['username']."'";
					mysql_query($sql);
				}else{
					$mainarray=array("status"=>"0","message"=>"Please enter valid password.");
				}
			} else {
				$mainarray=array("status"=>"0","message"=>"Please enter valid username.");
			}
		}
		
		else {
            // user not found
            $mainarray=array("status"=>"0","message"=>"Please enter valid username.");
        }
	}else{
		$mainarray=array("status"=>"0","message"=>"Please provide username and password.");
	}
	
	echo json_encode($mainarray);
	exit;
?>