<?php
	include("../connection.php");
	if(isset($_POST['student_id'])){
		$sql="SELECT * from tbl_normaloutpass where (status>=1)and student_id='".$_POST['student_id']."' order by id desc limit 1";
		$result=mysql_query($sql);
		if(mysql_num_rows($result)>0){
			$jsonarray = array();
			$row = mysql_fetch_array($result);
			date_default_timezone_set('Asia/Calcutta');
			$today = date("Y-m-d");
			$new_date=strtotime($row["fromdate"]);
			$date=date('Y-m-d',$new_date);
			if($row["status"]==3 || $row["status"]==5){
				if($row["entrytime"]>=$today){
					$jsonarray[]=array("status"=>$row["status"], "outpass_id"=>$row["id"], "hostel_id"=>$row["hostel_id"],"hostel_no"=>$row["hostel_no"],"room"=>$row["room"],"bed"=>$row["bed"],"address"=>$row["address"],"fromdate"=>$row["fromdate"],"tilldate"=>$row["tilldate"],"purpose_of_leave"=>$row["purpose_of_leave"], "entrytime"=>$row["entrytime"]);
					$mainarray=array("status"=>"10","message"=>"Applications found.","data"=>$jsonarray);
					echo json_encode($mainarray);
					exit;
				}		
			}else if($row["status"]==1 && $date>=$today){
				$jsonarray[]=array("status"=>$row["status"], "outpass_id"=>$row["id"], "hostel_id"=>$row["hostel_id"],"hostel_no"=>$row["hostel_no"],"room"=>$row["room"],"bed"=>$row["bed"],"address"=>$row["address"],"fromdate"=>$row["fromdate"],"tilldate"=>$row["tilldate"],"purpose_of_leave"=>$row["purpose_of_leave"], "entrytime"=>$row["entrytime"]);
				$mainarray=array("status"=>"10","message"=>"Applications found.","data"=>$jsonarray);
				echo json_encode($mainarray);
				exit;
			}else if($row["status"]==2 && $date>=$today){
				$jsonarray[]=array("status"=>$row["status"], "outpass_id"=>$row["id"], "hostel_id"=>$row["hostel_id"],"hostel_no"=>$row["hostel_no"],"room"=>$row["room"],"bed"=>$row["bed"],"address"=>$row["address"],"fromdate"=>$row["fromdate"],"tilldate"=>$row["tilldate"],"purpose_of_leave"=>$row["purpose_of_leave"], "entrytime"=>$row["entrytime"]);
				$mainarray=array("status"=>"10","message"=>"Applications found.","data"=>$jsonarray);
				echo json_encode($mainarray);
				exit;	
			}else if($row["status"]==4){
				$jsonarray[]=array("status"=>$row["status"], "outpass_id"=>$row["id"], "hostel_id"=>$row["hostel_id"],"hostel_no"=>$row["hostel_no"],"room"=>$row["room"],"bed"=>$row["bed"],"address"=>$row["address"],"fromdate"=>$row["fromdate"],"tilldate"=>$row["tilldate"],"purpose_of_leave"=>$row["purpose_of_leave"], "entrytime"=>$row["entrytime"]);
				$mainarray=array("status"=>"10","message"=>"Applications found.","data"=>$jsonarray);
				echo json_encode($mainarray);
				exit;
			}
		}
		
		$sql="SELECT * from tbl_dailyoutpass where status>=1 and student_id='".$_POST['student_id']."' order by id desc limit 1";
		$result=mysql_query($sql);
		if(mysql_num_rows($result)>0){
			$jsonarray = array();
			$row = mysql_fetch_array($result);
			date_default_timezone_set('Asia/Calcutta');
			$today = date("Y-m-d H:i:s");
			$todaytime = time();
			echo $todaytime;
			exit;
			if($row["status"]==3){
				if($row["entrytime"]>=$today){
					$jsonarray[]=array("status"=>$row["status"], "outpass_id"=>$row["id"],"address"=>$row["address"],"fromtime"=>$row["fromtime"],"tilltime"=>$row["tilltime"],"purpose_of_leave"=>$row["purpose_of_leave"], "entrytime"=>$row["entrytime"]);
					$mainarray=array("status"=>"11","message"=>"Applications found.","data"=>$jsonarray);
					echo $json_encode($mainarray);
					exit;
				}
			}else if($row["status"]==1 && $row["tilltime"]>$today){
				
				$jsonarray[]=array("status"=>$row["status"], "outpass_id"=>$row["id"],"address"=>$row["address"],"fromtime"=>$row["fromtime"],"tilltime"=>$row["tilltime"],"purpose_of_leave"=>$row["purpose_of_leave"], "entrytime"=>$row["entrytime"]);
				$mainarray=array("status"=>"11","message"=>"Applications found.","data"=>$jsonarray);
				echo json_encode($mainarray);
				exit;
				
			}else{
				$jsonarray[]=array("status"=>$row["status"], "outpass_id"=>$row["id"],"address"=>$row["address"],"fromtime"=>$row["fromtime"],"tilltime"=>$row["tilltime"],"purpose_of_leave"=>$row["purpose_of_leave"], "entrytime"=>$row["entrytime"]);
				$mainarray=array("status"=>"11","message"=>"Applications found.","data"=>$jsonarray);
				echo json_encode($mainarray);
				exit;
			}
		}else{
			$mainarray=array("status"=>"2","message"=>"Applications not found.");
		}
	
		
	} else {
			$mainarray=array("status"=>"0","message"=>"Fill Application");
	}	
	echo json_encode($mainarray);
	exit;
?>