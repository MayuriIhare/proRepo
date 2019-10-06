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
      <table width="100%" height="100%" border="0" cellpadding="5" cellspacing="5">
        <tr>
          <th width="25%" scope="col">&nbsp;</th>
          <th width="50%" scope="col"><div align="center">
              <h3><strong>Assign Class Incharge </strong></h3>
          </div></th>
          <th width="25%" scope="col">&nbsp;</th>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><table width="100%" border="1" cellspacing="5" cellpadding="5">
            <tr bgcolor="#66CCCC">
              <th width="12%" scope="col"><div align="center">Sr. No </div></th>
              <th width="20%" scope="col"><div align="center">SECTION</div></th>
              <th width="50%" scope="col"><div align="center">CLASS INCHARGE NAME </div></th>
              <th width="18%" scope="col"><div align="center">ACTION</div></th>
            </tr>
            <tr>
              <form method="post" action="Assign_Class_Incharge.php">
                <td>1</td>
                <td>SECTION A </td>
                <td><select name="staff_name" required="">
                    <option value=""> Please Select Class Inchage </option>
<?php 
include "dbconnect.php";

$sql="select * from staff where status='Approved' and designation='staff'";
$res=mysqli_query($con,$sql);
$nor=mysqli_num_rows($res);
if($nor>0){
	while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
		extract($row);
	?>	
	<option value="<?php if(isset($staff_id)){echo"$staff_id";}?>"> <?php if(isset($staff_name)){echo"$staff_name";}?> </option>
	<?php
	}
	
}

?>                   

				   
                </select></td>
                <td><input type="hidden" name="section" value="SECTION A" />
                    <input type="submit" name="Update_class_incharge" value="UPDATE" />
                </td>
              </form>
            </tr>
            <tr>
              <form method="post" action="Assign_Class_Incharge.php">
                <td>2</td>
                <td>SECTION B </td>
                <td><select name="staff_name" required="">
                    <option value=""> Please Select Class Inchage </option>
               <?php 
include "dbconnect.php";

$sql="select * from staff where status='Approved' and designation='staff'";
$res=mysqli_query($con,$sql);
$nor=mysqli_num_rows($res);
if($nor>0){
	while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
		extract($row);
	?>	
	<option value="<?php if(isset($staff_id)){echo"$staff_id";}?>"> <?php if(isset($staff_name)){echo"$staff_name";}?> </option>
	<?php
	}
	
}

?> 
                </select></td>
                <td><input type="hidden" name="section" value="SECTION B" />
                    <input type="submit" name="Update_class_incharge" value="UPDATE" />
                </td>
              </form>
            </tr>
            <tr>
              <form method="post" action="Assign_Class_Incharge.php">
                <td>3</td>
                <td>SECTION C </td>
                <td><select name="staff_name" required="">
                    <option value=""> Please Select Class Inchage </option>
                 <?php 
include "dbconnect.php";

$sql="select * from staff where status='Approved' and designation='staff'";
$res=mysqli_query($con,$sql);
$nor=mysqli_num_rows($res);
if($nor>0){
	while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
		extract($row);
	?>	
	<option value="<?php if(isset($staff_id)){echo"$staff_id";}?>"> <?php if(isset($staff_name)){echo"$staff_name";}?> </option>
	<?php
	}
	
}

?> 
                </select></td>
                <td><input type="hidden" name="section" value="SECTION C" />
                    <input type="submit" name="Update_class_incharge" value="UPDATE" />
                </td>
              </form>
            </tr>
            <tr>
              <form method="post" action="Assign_Class_Incharge.php">
                <td>4</td>
                <td>SECTION D </td>
                <td><select name="staff_name" required="">
                 <option value=""> Please Select Class Inchage </option>
				 <?php 
include "dbconnect.php";

$sql="select * from staff where status='Approved' and designation='staff'";
$res=mysqli_query($con,$sql);
$nor=mysqli_num_rows($res);
if($nor>0){
	while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
		extract($row);
	?>	
	<option value="<?php if(isset($staff_id)){echo"$staff_id";}?>"> <?php if(isset($staff_name)){echo"$staff_name";}?> </option>
	<?php
	}
	
}

?> 
                </select></td>
                <td><input type="hidden" name="section" value="SECTION D" />
                    <input type="submit" name="Update_class_incharge" value="UPDATE" />
                </td>
              </form>
            </tr>
            <tr>
              <form method="post" action="Assign_Class_Incharge.php">
                <td>5</td>
                <td>SECTION E </td>
                <td><select name="staff_name" required="">
                    <option value=""> Please Select Class Inchage </option>
                  <?php 
include "dbconnect.php";

$sql="select * from staff where status='Approved' and designation='staff'";
$res=mysqli_query($con,$sql);
$nor=mysqli_num_rows($res);
if($nor>0){
	while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
		extract($row);
	?>	
	<option value="<?php if(isset($staff_id)){echo"$staff_id";}?>"> <?php if(isset($staff_name)){echo"$staff_name";}?> </option>
	<?php
	}
	
}

?> 
                </select></td>
                <td><input type="hidden" name="section" value="SECTION E" />
                    <input type="submit" name="Update_class_incharge" value="UPDATE" />
                </td>
              </form>
            </tr>
            <tr>
              <form method="post" action="Assign_Class_Incharge.php">
                <td>6</td>
                <td>SECTION F </td>
                <td><select name="staff_name" required="">
                    <option value=""> Please Select Class Inchage </option>
                   <?php 
include "dbconnect.php";

$sql="select * from staff where status='Approved' and designation='staff'";
$res=mysqli_query($con,$sql);
$nor=mysqli_num_rows($res);
if($nor>0){
	while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
		extract($row);
	?>	
	<option value="<?php if(isset($staff_id)){echo"$staff_id";}?>"> <?php if(isset($staff_name)){echo"$staff_name";}?> </option>
	<?php
	}
	
}

?> 
                </select></td>
                <td><input type="hidden" name="section" value="SECTION F" />
                    <input type="submit" name="Update_class_incharge" value="UPDATE" />
                </td>
              </form>
            </tr>
            <tr>
              <form method="post" action="Assign_Class_Incharge.php">
                <td>7</td>
                <td>SECTION G </td>
                <td><select name="staff_name" required="">
                    <option value=""> Please Select Class Inchage </option>
                  <?php 
include "dbconnect.php";

$sql="select * from staff where status='Approved' and designation='staff'";
$res=mysqli_query($con,$sql);
$nor=mysqli_num_rows($res);
if($nor>0){
	while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
		extract($row);
	?>	
	<option value="<?php if(isset($staff_id)){echo"$staff_id";}?>"> <?php if(isset($staff_name)){echo"$staff_name";}?> </option>
	<?php
	}
	
}

?> 
                </select></td>
                <td><input type="hidden" name="section" value="SECTION G" />
                    <input type="submit" name="Update_class_incharge" value="UPDATE" />
                </td>
              </form>
            </tr>
            <tr>
              <form method="post" action="Assign_Class_Incharge.php">
                <td>8</td>
                <td>SECTION H </td>
                <td><select name="staff_name" required="">
                    <option value=""> Please Select Class Inchage </option>
                   <?php 
include "dbconnect.php";

$sql="select * from staff where status='Approved' and designation='staff'";
$res=mysqli_query($con,$sql);
$nor=mysqli_num_rows($res);
if($nor>0){
	while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
		extract($row);
	?>	
	<option value="<?php if(isset($staff_id)){echo"$staff_id";}?>"> <?php if(isset($staff_name)){echo"$staff_name";}?> </option>
	<?php
	}
	
}

?> 
                </select></td>
                <td><input type="hidden" name="section" value="SECTION A" />
                    <input type="submit" name="Update_class_incharge" value="UPDATE" />
                </td>
              </form>
            </tr>
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
