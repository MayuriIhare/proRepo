	<?php
session_start();
include "dbconnect.php";
if(isset($_SESSION["student_id"])){
$student_id =$_SESSION["student_id"];
$student_name =$_SESSION["student_name"];
$student_email =$_SESSION["student_email"];
$student_mobile =$_SESSION["student_mobile"];
$status =$_SESSION["status"];
$student_address =$_SESSION["student_address"];
$student_dob =$_SESSION["student_dob"];
$student_branch =$_SESSION["student_branch"];
$section =$_SESSION["section"];
$student_gender =$_SESSION["student_gender"];
$fathers_full_name =$_SESSION["fathers_full_name"];
$mothers_full_name =$_SESSION["mothers_full_name"];
$parent_mobile =$_SESSION["parent_mobile"];
$profile_pic =$_SESSION["profile_pic"];
$signature_pic =$_SESSION["signature_pic"];
$pnr =$_SESSION["pnr"];
$cast_category =$_SESSION["cast_category"];
$adhar_num =$_SESSION["adhar_num"];
}else{
session_unset();
session_destroy();	
exit(header("Location: ./Student_Login.php?msg=Please Login First!"));	
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Home Examination System</title><style type="text/css">
</style></head>

<body style="background-color:#dddddd;">
<form method="get" action="View_Hall_Ticket.php" enctype="multipart/form-data">
<center>
<table width="80%" border="0" cellspacing="5" cellpadding="5" style="box-shadow: 25px 25px 75px grey;">
  <tr>
    <th colspan="5" bgcolor="#af5cd3" scope="col"><h1 align="center" class="style3">&nbsp;</h1>
    <h1 align="center" class="style3"><strong><span class="style1">Home Exam Management System</span></strong></h1>
    <p align="center" class="style3">&nbsp;</p></th>
  </tr>
  <tr>
    

 <td bgcolor="#6858d2"><div align="center"><a style="color:white;"href="Exam_Form.php">Exam Form</a></div></td>
    <td bgcolor="#6858d2"><div align="center"><a style="color:white;"href="Print_Form.php">Print Form</a></div></td>
    <td bgcolor="#6858d2"><div align="center"><a style="color:white;"href="Print_Hall_Ticket.php">Print Hall Ticket</a></div></td>
    <td bgcolor="#6858d2"><div align="center"><a style="color:white;"href="logout.php">Logout</a></div></td>
</tr>
  <tr>
    <td height="400" colspan="5" bgcolor="#FFFFFF"><table width="100%"  border="0" cellpadding="5" cellspacing="5">
      <tr>
        <th width="27%" scope="col">&nbsp;</th>
        <th width="46%" scope="col"><div align="center">
          <h3><strong>Enter Exam Details </strong></h3>
        </div></th>
        <th width="27%" scope="col">&nbsp;</th>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
			<?php
if(isset($_GET["msg"])){
$msg=$_GET["msg"];
if(isset($_GET["type"])){
$type=$_GET["type"];
}
?>
<center><p <?php if(isset($type) && $type=="error"){echo"style=\"color:red;\"";}?><?php if(isset($type) && $type=="success"){echo"style=\"color:green;\"";}?> ><?php echo"$msg";?></p></center>
<?php
}
?>
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
		
		
		</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
	</td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#6858d2"><div align="center" style="color:white;" >Copyright @ JDIET Yavatmal </div></td>
  </tr>
</table>
</form>
</body>
</html>