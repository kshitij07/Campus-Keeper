<?php  
       $servername = "localhost";  
       $username = "root";  
       $password = "";  
       $conn = mysql_connect ($servername , $username , $password) or die("unable to connect to host");  
       mysql_select_db ('db_coll',$conn) or die("unable to connect to database"); 
?>   