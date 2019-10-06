<?php
include "dbconnect.php";

if(isset($_GET["stud_login"])){
	
	extract($_GET);
	
$sql="select * from student where pnr='{$pnr_number}' and password='{$password}'";

$res=mysqli_query($con,$sql);

if(mysqli_num_rows($res)>0){
	
	while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
		
		$status=$row["status"];
		
		if($status=="Approved"){
			
session_start();
session_regenerate_id();

$_SESSION["student_id"]=$row["student_id"];
$_SESSION["student_name"]=$row["student_name"];
$_SESSION["student_email"]=$row["student_email"];
$_SESSION["student_mobile"]=$row["student_mobile"];
$_SESSION["status"]=$row["status"];
$_SESSION["student_address"]=$row["student_address"];
$_SESSION["student_dob"]=$row["student_dob"];
$_SESSION["student_branch"]=$row["student_branch"];
$_SESSION["section"]=$row["section"];
$_SESSION["student_gender"]=$row["student_gender"];
$_SESSION["fathers_full_name"]=$row["fathers_full_name"];
$_SESSION["mothers_full_name"]=$row["mothers_full_name"];
$_SESSION["parent_mobile"]=$row["parent_mobile"];
$_SESSION["profile_pic"]=$row["profile_pic"];
$_SESSION["signature_pic"]=$row["signature_pic"];
$_SESSION["pnr"]=$row["pnr"];
$_SESSION["cast_category"]=$row["cast_category"];
$_SESSION["adhar_num"]=$row["adhar_num"];

exit(header("Location: ./Exam_Form.php"));

		
		}else{
		
exit(header("Location: ./Student_Login.php?msg=Your Current Status is Pending, Please Contact Class Incharge!"));
			
		}
	}
	
}else{

exit(header("Location: ./Student_Login.php?msg=Wrong PNR Number or Password!"));	
	
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
<form method="get" action="Student_Login.php" enctype="multipart/form-data">
<center>
<table width="80%" border="0" cellspacing="5" cellpadding="5" style="box-shadow: 25px 25px 75px grey;">
  <tr>
    <th colspan="4" bgcolor="#af5cd3" scope="col"><h1 align="center" class="style3">&nbsp;</h1>
    <h1 align="center" class="style3"><strong><span class="style1">Home Exam Management System</span></strong></h1>
    <p align="center" class="style3">&nbsp;</p></th>
  </tr>
  <tr>
    <td bgcolor="#6858d2"><div align="center"><a style="color:white;"href="index.php">Home</a></div></td>
    <td bgcolor="#6858d2"><div align="center"><a style="color:white;"href="Registration.php">Registration</a></div></td>
    <td bgcolor="#6858d2"><div align="center"><a style="color:white;"href="Login.php">Login</a></div></td>
    <td bgcolor="#6858d2"><div align="center"><a style="color:white;"href="Result.php">Result</a></div>      <div align="center"></div>      <div align="center"></div></td>
  </tr>
  <tr>
    <td height="400" colspan="4" bgcolor="#FFFFFF"><table width="100%" height="100%" border="0" cellpadding="5" cellspacing="5">
      <tr>
        <th width="27%" scope="col">&nbsp;</th>
        <th width="46%" scope="col"><div align="center">
          <h3><strong>Student Login </strong></h3>
        </div></th>
        <th width="27%" scope="col">&nbsp;</th>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
		
		<table width="100%" height="100" border="0" cellpadding="5" cellspacing="5">
          <tr>
            <td width="38%"><div align="right">PNR Number: </div></td>
            <td width="62%"><div align="left"><input type="text" pattern="[0-9]{12,12}" name="pnr_number" required=""/></div></td>
          </tr>
          <tr>
            <td><div align="right">Password: </div></td>
            <td><div align="left"><input type="password" name="password" required=""/></div></td>
          </tr>
		   <tr>
            <td></td>
            <td><div align="left"><input type="submit" name="stud_login" value="LOGIN"/></div></td>
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
	
	</td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#6858d2"><div align="center" style="color:white;" >Copyright @ JDIET Yavatmal </div></td>
  </tr>
</table>
</form>
</body>
</html>
