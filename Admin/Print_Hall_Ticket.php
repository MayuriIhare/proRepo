<?php
session_start();
if(isset($_SESSION["staff_id"]) && isset($_SESSION["designation"]) && !empty($_SESSION["designation"]) && $_SESSION["designation"]=="HOD"){
	
	$name=$_SESSION["staff_name"];
		$designation=$_SESSION["designation"];
	
}elseif(isset($_SESSION["designation"]) && !empty($_SESSION["designation"]) && $_SESSION["designation"]=="staff"){

exit(header("Location: ../Staff/index.php"));

}else{

session_unset();
session_destroy();	
exit(header("Location: ../Staff_Login.php?msg=Please Login First!"));	

}
?>


<?php
include "dbconnect.php";

if(isset($_POST['Update_class_incharge']))
{

extract($_POST);


$sql = ("update staff SET class_inchage='{$section}' where staff_id='{$staff_name}'");


if(mysqli_query($con,$sql)){ 

exit(header("Location: ./Assign_Class_Incharge.php?msg=Updated Successfully!&type=success"));

}else{

die(mysqli_error($con));

exit(header("Location: ./Assign_Class_Incharge.php?msg=Something Went Wrong, Please Try Again!&type=success"));

}

}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Home Examination System</title><style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 45px;
}
.style3 {color: #333333; }
-->
</style></head>

<body style="background-color:#dddddd;">
<center>
<table width="80%" border="0" cellspacing="5" cellpadding="5" style="box-shadow: 25px 25px 75px grey;">
  <tr>
    <th colspan="6" bgcolor="#af5cd3" scope="col"><h1 align="center" class="style3">&nbsp;</h1>
    <h1 align="center" class="style3"><strong><span class="style1">Home Exam Management System</span></strong></h1>
    <p align="center" class="style3">&nbsp;</p></th>
  </tr>
   <tr>
    <td bgcolor="#6858d2"><div align="center"><a style="color:white;"href="index.php">Home</a></div></td>
    <td bgcolor="#6858d2"><div align="center"><a style="color:white;"href="View_and_Manage_Staff.php">View and Manage Staff </a></div></td>
    <td bgcolor="#6858d2"><div align="center"><a style="color:white;"href="Assign_Class_Incharge.php">Assign Class Incharge </a></div></td>
   <td bgcolor="#6858d2"><div align="center"><a style="color:white;"href="Upload_External_Marks.php">Upload External Marks </a></div></td>
   <td bgcolor="#6858d2"><div align="center"><a style="color:white;"href="Print_Hall_Ticket.php">Print Hall Ticket </a></div></td>
    <td bgcolor="#6858d2"><div align="center"><a style="color:white;"href="Logout.php">Logout</a></div></td>
  </tr>
  <tr>
    <td height="400" colspan="6" bgcolor="#FFFFFF"> <?php
if(isset($_GET["msg"])){
$msg=$_GET["msg"];
if(isset($_GET["type"])){
$type=$_GET["type"];
}
?>
<center><p <?php if(isset($type) && $type=="error"){echo"style=\"color:red;\"";}?><?php if(isset($type) && $type=="success"){echo"style=\"color:green;\"";}?> ><?php echo"$msg";?></p></center>
<?php
}
?><center>
     
<form method="get" action="View_Hall_Ticket.php" enctype="multipart/form-data">

		<table width="100%" height="100" border="0" cellpadding="5" cellspacing="5">
          <tr>
            <td width="38%"><div align="right">Semester: </div></td>
            <td width="62%"><div align="left">
			<select name="semester" required="" id="semester">
				<option value="">Please Select Semester </option>
				<option value="SEM I">SEM I </option>
				<option value="SEM II">SEM II </option>
			</select>
			</div></td>
          </tr>
          <tr>
            <td><div align="right">Exam Type: </div></td>
            <td><div align="left">
			<select name="exam_type" required="">
				<option value="">Please Select Exam Type </option>
				<option value="Winter">Winter </option>
				<option value="Summer">Summer </option>
			</select>
			</div></td>
          </tr>
		   <tr>
            <td></td>
            <td><div align="left"><input type="submit" name="print_hall_ticket" value="VIEW & PRINT"/></div></td>
          </tr>
        </table>
		
	  </form>
	  
	  
	  
	  
	  
	  
	  
	  
    </center></td>
  </tr>
  <tr>
    <td colspan="6" bgcolor="#6858d2"><div align="center" style="color:white;" >Copyright @ JDIET Yavatmal </div></td>
  </tr>
</table>
</body>
</html>
