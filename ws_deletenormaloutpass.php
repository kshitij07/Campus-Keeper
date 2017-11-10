<?php
require_once("../connection.php");
if(!empty($_GET["id"])) {
	$result = mysqli_query($conn,"DELETE FROM tbl_normaloutpass WHERE id=".$_GET["id"]);
}
?>
insert into tbl_firm(firm_name,address,location,city_id,state_id,pin_code,phone_no,tin_no,details,updatedatetime,updated_by,company_id) values ('L.IC.','Kanpur+Road','2','1','27','284002','05102447766','12345','hzfhfzhz',now(),1,1)