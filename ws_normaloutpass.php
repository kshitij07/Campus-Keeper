<?php
	include("../connection.php");
	if(isset($_POST['student_id']) && isset($_POST['address']) && isset($_POST['fromdate'])&& isset($_POST['tilldate']) && isset($_POST['purpose_of_leave']) ){
		$sql="select tbl_student.id, tbl_hostel.id hid,tbl_student.hostel_no, tbl_student.room, tbl_student.bed from tbl_student,tbl_hostel where tbl_hostel.id=tbl_student.hostel_id and tbl_student.id=".$_POST['student_id'];
		$result=mysql_query($sql);
		
		if($row = mysql_fetch_assoc($result)){
			$sql="insert into tbl_normaloutpass (student_id, hostel_id, hostel_no, room, bed, address,fromdate, tilldate, purpose_of_leave, entrytime, status) 
				values('".$_POST['student_id']."','".$row['hid']."','".$row['hostel_no']."','".$row['room']."','".$row['bed']."','".$_POST['address']."',
				'".$_POST['fromdate']."','".$_POST['tilldate']."','".$_POST['purpose_of_leave']."',now(), '1')";
				
			$result=mysql_query($sql) or null;
				
			if($result!=null){
				$mainarray=array("status"=>"1","message"=>"Application has been uploaded.");
				$sql="select fcmid from tbl_user where hostel_id='".$row['hid']."' and membertype=3";
				$result=mysql_query($sql);
				$row=mysql_fetch_assoc($result);
				$fcmid=$row['fcmid'];
				if($fcmid!=''){
					#API access key from Google API's Console
						define( 'API_ACCESS_KEY', 'AAAA9elg1VQ:APA91bE0pNCOXbhDWQBBAIWXaFkDah6HuTIlajAkjVA3HlhkvCeRLN6m1nRaA-_atHmRah1rdf6WVIgyy3MYT9zJrazOMDF8u5cKfOmreRWLZXSykM3w5VWcKoG8dc2hS_VjBTt2WHXU' );
						$registrationIds = $fcmid;
					#prep the bundle
						 $msg = array
							  (
							'body' 	=> 'New leave application arrived',
							'title'	=> 'Student leave application'
							  );
						$fields = array
								(
									'to'		=> $registrationIds,
									'notification'	=> $msg
								);
						
						
						$headers = array
								(
									'Authorization: key='.API_ACCESS_KEY,
									'Content-Type: application/json'
								);
					#Send Reponse To FireBase Server	
							$ch = curl_init();
							curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
							curl_setopt( $ch,CURLOPT_POST, true );
							curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
							curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
							curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
							curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
							$result = curl_exec($ch );
							curl_close( $ch );
					#Echo Result Of FireBase Server
				}
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