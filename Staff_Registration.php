<?php

include "dbconnect.php";

if(isset($_POST['staff_registration']))
{
extract($_POST);

if(isset($mobile) && !empty($mobile)){

$sql="select * from staff where mobile='{$mobile}'";	
$res=mysqli_query($con,$sql);
$nor=mysqli_num_rows($res);
	if($nor>0){
exit(header("Location: ./Staff_Registration.php?msg=Duplicate Mobile Number!&type=error"));				
	}
}

if(isset($email) && !empty($email)){

$sql="select * from staff where email='{$email}'";	
$res=mysqli_query($con,$sql);
$nor=mysqli_num_rows($res);
	if($nor>0){
exit(header("Location: ./Staff_Registration.php?msg=Duplicate Email ID!&type=error"));				
	}
}



$sql = ("INSERT INTO staff(staff_name,email,mobile,password) 

VALUES('$staff_name','$email','$mobile','$password')");

if(mysqli_query($con,$sql)){ 

exit(header("Location: ./Staff_Registration.php?msg=Staff Registered Successfully!&type=success"));

}else{

die(mysqli_error($con));

exit(header("Location: ./Staff_Registration.php?msg=msg=Something went wrong, Please Try Again!&type=error"));

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
<form method="post" action="Staff_Registration.php" enctype="multipart/form-data">
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
          <h3><strong>Staff Registration </strong></h3>
        </div></th>
        <th width="27%" scope="col">&nbsp;</th>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
		
		<table width="100%" height="100%" border="0" cellpadding="5" cellspacing="5">
           <tr>
            <th width="38%" colspan="2"><div align="center"> 
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
			</div></th>
            
          </tr>
		  <tr>
            <th width="38%" ><div align="right">Name: </div></th>
            <th width="62%" ><div align="left"><input type="text" name="staff_name" required=""/></div></th>
          </tr>
          <tr>
            <td><div align="right">Email: </div></td>
            <td><div align="left"><input type="email" name="email" required=""/></div></td>
          </tr>
          <tr>
            <td><div align="right">Mobile Number: </div></td>
            <td><div align="left"><input type="text" name="mobile" pattern="[0-9]{10,10}" maxlength="10" required=""/></div></td>
          </tr>
          <tr>
            <td><div align="right">Password: </div></td>
            <td><div align="left"><input type="password" name="password" required="" /></div></td>
          </tr>
		   <tr>
            <td></td>
            <td><div align="left"><input type="submit" name="staff_registration" value="SUBMIT"/></div></td>
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
