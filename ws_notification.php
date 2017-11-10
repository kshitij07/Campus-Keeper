<?php
	define( 'API_ACCESS_KEY', 'AAAA9elg1VQ:APA91bE0pNCOXbhDWQBBAIWXaFkDah6HuTIlajAkjVA3HlhkvCeRLN6m1nRaA-_atHmRah1rdf6WVIgyy3MYT9zJrazOMDF8u5cKfOmreRWLZXSykM3w5VWcKoG8dc2hS_VjBTt2WHXU' );
	
	$fcmid="dhWpN-Ai0DY:APA91bHZzY1kOmzWslru4Z1qYuQEK44TQepzVwXH6td5hoBbLtJoSERv5mKsbs4r5l4-s3VSWhe48mbm6KVkOyBsM-XOw_J5_v_2-NxJPoJSF7HVtBGbY6hnFMb0mEcqXWZhjHBMDYky";
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
			echo $result;
			exit;
			curl_close( $ch );
			#Echo Result Of FireBase Server
	}
?>