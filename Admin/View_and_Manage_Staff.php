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

if(isset($_GET['staff_id']) && isset($_GET['act']))
{

extract($_GET);

$sql="select * from staff";

if($act=="Approved"){
	
$sql = ("update staff SET status=\"Approved\" where staff_id='{$staff_id}'");


}elseif($act=="InActive"){
	
$sql = ("update staff SET status=\"InActive\" where staff_id='{$staff_id}'");

}


if(mysqli_query($con,$sql)){ 

exit(header("Location: ./View_and_Manage_Staff.php?msg=Status Changed Successfully!&type=success"));

}else{

die(mysqli_error($con));

exit(header("Location: ./View_and_Manage_Staff.php?msg=Something Went Wrong, Please Try Again!&type=success"));

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
    <td height="400" colspan="6" bgcolor="#FFFFFF"><center>
      <table width="100%" height="100%" border="0" cellpadding="5" cellspacing="5">
        <tr>
          <th width="5%" height="54" scope="col">&nbsp;</th>
          <th width="90%" scope="col"><div align="center">
            <h3>View And Manage Staff </h3>
          </div></th>
          <th width="5%" scope="col">&nbsp;</th>
        </tr>
        <tr>
          <td height="282">&nbsp;</td>
          <td><table width="100%" border="1" cellpadding="5" cellspacing="5" bordercolor="#000000">
            <tr bgcolor="#009999">
              <th bordercolor="#000000" scope="col"><div align="center"><strong>Sr. No </strong></div></th>
              <th bordercolor="#000000" scope="col"><div align="center"><strong>Staff Name</strong></div></th>
              <th bordercolor="#000000" scope="col"><div align="center"><strong>Email ID </strong></div></th>
              <th bordercolor="#000000" scope="col"><div align="center"><strong>Mobile Number </strong></div></th>
			  <th bordercolor="#000000" scope="col"><div align="center"><strong>Status</strong></div></th>
              <th bordercolor="#000000" scope="col"><div align="center"><strong>Action</strong></div></th>
            </tr>
<?php
include "dbconnect.php";

$sql = ("SELECT * FROM staff where designation='staff'");

$result=@mysqli_query($con,$sql);

$nor=@mysqli_num_rows($result);
$count=1;
if($nor>=1){

	while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
		
		extract($row);
		?>
		<tr>
              <td  bordercolor="#000000"><div align="left"><?php if(isset($count)){echo"$count";} ?></div></td>
              <td  bordercolor="#000000"><div align="left"><?php if(isset($staff_name)){echo"$staff_name";} ?></div></td>
              <td  bordercolor="#000000"><div align="left"><?php if(isset($email)){echo"$email";} ?></div></td>
              <td  bordercolor="#000000"><div align="left"><?php if(isset($mobile)){echo"$mobile";} ?></div></td>
			  <td  bordercolor="#000000"><div align="left"><?php if(isset($status)){echo"$status";} ?></div></td>
              <td  bordercolor="#000000"><div align="left">
			  <?php
			  if($status=="InActive"){
				?>  
				<a href="./View_and_Manage_Staff.php?staff_id=<?php if(isset($staff_id)){echo"$staff_id";} ?>&act=Approved" style="color:green;"> Active </a> 
				<?php
			  }elseif($status=="Approved"){
				?>  
				<a href="./View_and_Manage_Staff.php?staff_id=<?php if(isset($staff_id)){echo"$staff_id";} ?>&act=InActive" style="color:red;"> InActive </a> 
				<?php	  
				  
			  }
			  ?>
			  </div></td>
            </tr>
		<?php
		$count=$count+1;
	}
	
}

?>
            

          </table></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </center></td>
  </tr>
  <tr>
    <td colspan="6" bgcolor="#6858d2"><div align="center" style="color:white;" >Copyright @ JDIET Yavatmal </div></td>
  </tr>
</table>
</body>
</html>
