<?php    
    
include "/connection.php";    
    
if(isset($_GET['id'])){    
	$sql = "delete from tbl_student where id = '".$_GET['id']."'";    
	mysql_query($sql);
}    
    
$sql = "select * from tbl_student";    
$result = mysql_query($sql);    
?>   
<html>    
    <body>   
		<a href="add.php">Add New Student</a>
        <table width = "100%" border = "1" cellspacing = "1" cellpadding = "1">    
            <tr>    
                <td>Id</td>    
                <td>Name</td>    				
                <td>Enrollment Number</td>    
                <td>Password</td>    
                <td>Hostel</td>    
                <td>Branch</td>
				<td>Year</td>
				<td>Email</td>
				<td>Mobile</td>
                <td colspan = "2">Action</td>    
            </tr>   
			<?php
			while($row = mysql_fetch_array($result)){				
			?>  
				<tr>  
					<td>  
						<?php echo $row["id"];?>  
					</td>  
					<td>  
						<?php echo $row["name"];?>  
					</td> 

					<td>  
						<?php echo $row["enroll_no"];?>  
					</td>  		
					<td>  
						<?php echo $row["password"];?>  
					</td>  
					<td>  
						<?php echo $row["hostel"];?>  
					</td>  
					<td>  
						<?php echo $row["branch"];?>  
					</td>
					<td>  
						<?php echo $row["year"];?>  
					</td>
					<td>  
						<?php echo $row["email"];?>  
					</td>
					<td>  
						<?php echo $row["mobile"];?>  
					</td>
					<td> <a href="admin.php?id=<?php echo $row["id"];?>" onclick="return confirm('Are You Sure')">Delete    
					</a> | <a href="addstudent.php?id=<?php echo $row["id"];?>" onclick="return confirm('Are You Sure')">Edit    
					</a> </td>  
					</tr>  
			<?php } ?>
        </table>    
    </body>    
</html>    