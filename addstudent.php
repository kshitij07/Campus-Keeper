
<?php
	include("/connection.php");
	if(isset($_POST["name"])){
		$sql="insert into tbl_student(name,enroll_no,password,hostel,branch,year,email,mobile) values('".$_POST["name"]."','".$_POST["enroll_no"]."','".$_POST["password"]."','".$_POST["hostel"]."','".$_POST["branch"]."','".$_POST["year"]."','".$_POST["email"]."','".$_POST["mobile"]."')";
		echo $sql;
		if(!mysql_query($sql)){
			echo "fail";
		}
		
	}
	mysql_close($conn); 
?>
<html>    
    <head>    
        <title>Registration Form</title>    
    </head>
    <body>    
        <link href = "new2.css" type = "text/css" rel = "stylesheet" action="/addstudent.php"/>    
        <h2>Sign Up</h2>    
        <form name = "form1" action="addstudent.php" method = "post" enctype = "multipart/form-data" >    
            <div class = "container">    
                <div class = "form_group">    
                    <label>Name:</label>    
                    <input type = "text" name = "name" value = "" required/>    
                </div>    
                <div class = "form_group">    
                    <label>Enrollment Number:</label>    
                    <input type = "text" name = "enroll_no" value = "" required/>    
                </div>   
                    
                <div class = "form_group">    
                    <label>Password	:</label>    
                    <input type = "text" name = "password" value = "" required/>    
				 </div>
				
				<div class = "form_group">    
                    <label>Hostel:</label>    
                    <input type = "text" name = "hostel" value = "" required/>    
                </div>
				<div class = "form_group">    
                    <label>Branch:</label>    
                    <input type = "text" name = "branch" value = "" required/>    
                </div>
				<div class = "form_group">    
                    <label>Year:</label>    
                    <input type = "text" name = "year" value = "" required/>    
                </div>
				
				<div class = "form_group">    
                    <label>Email:</label>    
                    <input type = "text" name = "email" value = "" required/>    
                </div>
				<div class = "form_group">    
                    <label>Mobile:</label>    
                    <input type = "text" name = "mobile" value = "" required/>    
                </div>
				<div>
					<input type="submit" value="Submit">
                </div>    
            </div>    
        </form>   
<br />`
		<a href="listing.php">Show All Students</a>
		
    </body>    
</html>    