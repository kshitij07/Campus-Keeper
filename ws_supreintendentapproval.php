<?php
	include("../connection.php");
	if(isset($_POST['status']) && isset($_POST['outpass_id'])){
		$result=mysql_query("update tbl_normaloutpass set status='".$_POST['status']."' where tbl_normaloutpass.id='".$_POST['outpass_id']."'");
		if($result!=null){
			
			if($_POST['status']==2){
				define( 'API_ACCESS_KEY', 'AAAA9elg1VQ:APA91bE0pNCOXbhDWQBBAIWXaFkDah6HuTIlajAkjVA3HlhkvCeRLN6m1nRaA-_atHmRah1rdf6WVIgyy3MYT9zJrazOMDF8u5cKfOmreRWLZXSykM3w5VWcKoG8dc2hS_VjBTt2WHXU' );
				$sql="select fcmid from tbl_user u, tbl_normaloutpass n where n.hostel_id=u.hostel_id and n.status='".$_POST['status']."' and membertype=2";
				$result=mysql_query($sql);
				$row=mysql_fetch_assoc($result);
				$fcmid=$row['fcmid'];
				
				if($fcmid!=''){
					#API access key from Google API's Console
					
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
				$sql="select fcmid from tbl_student s, tbl_normaloutpass n where n.student_id=s.id and n.status='".$_POST['status']."'";				
				$result=mysql_query($sql);
				$row=mysql_fetch_assoc($result);
				$fcmid=$row['fcmid'];
				if($fcmid!=''){
					#API access key from Google API's Console
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
			}
			$mainarray=array("status"=>"1","message"=>"Record updated successfully.");
		} else {
			// user not found
			$mainarray=array("status"=>"0","message"=>"Please contact administrator.");
		}
		
	}else{
		$mainarray=array("status"=>"0","message"=>"Please provide all the entries.");
	}
	echo json_encode($mainarray);
	exit;
?>