<?php

include "dbconnect.php";

if(isset($_POST['stud_registration']))
{
extract($_POST);

if(isset($student_mobile) && !empty($student_mobile)){

$sql="select * from student where student_mobile='{$student_mobile}'";	
$res=mysqli_query($con,$sql);
$nor=mysqli_num_rows($res);
	if($nor>0){
exit(header("Location: ./Student_Registration.php?msg=Duplicate Mobile Number!&type=error"));				
	}
}

$sql="select * from student where adhar_num='{$adhar_num}'";	
$res=mysqli_query($con,$sql);
$nor=mysqli_num_rows($res);
	if($nor>0){
exit(header("Location: ./Student_Registration.php?msg=Duplicate Aadhar Number!&type=error"));				
	}




if(isset($student_email) && !empty($student_email)){

$sql="select * from student where student_email='{$student_email}'";	
$res=mysqli_query($con,$sql);
$nor=mysqli_num_rows($res);
	if($nor>0){
exit(header("Location: ./Student_Registration.php?msg=Duplicate Email ID!&type=error"));				
	}
}


$new_image_name=$student_mobile;

if(isset($_FILES["profile_pic"])){

$fn=$_FILES["profile_pic"]["name"];

$file_data=explode(".",$fn);

$file_ext=end($file_data);

$save_to="./images/profile/$new_image_name.jpg";

if($file_ext=="png" || $file_ext=="jpg" || $file_ext=="jpeg" || $file_ext=="gif"){

move_uploaded_file($_FILES["profile_pic"]["tmp_name"],$save_to);

}else{

exit(header("Location: ./Student_Registration.php?msg=Please Upload Image File Only!&type=error"));

}
}
$profile_pic=$save_to;


$new_image_name=$student_mobile;

if(isset($_FILES["signature_pic"])){

$fn=$_FILES["signature_pic"]["name"];

$file_data=explode(".",$fn);

$file_ext=end($file_data);

$save_to="./images/signature/$new_image_name.jpg";

if($file_ext=="png" || $file_ext=="jpg" || $file_ext=="jpeg" || $file_ext=="gif" || $file_ext=="PNG" || $file_ext=="JPG" || $file_ext=="JPEG" || $file_ext=="GIF"){

move_uploaded_file($_FILES["signature_pic"]["tmp_name"],$save_to);

}else{

exit(header("Location: ./Student_Registration.php?msg=Please Upload Image File Only!&type=error"));

}
}
$signature_pic=$save_to;


$sql = ("INSERT INTO student(cast_category,adhar_num,student_name,student_address,student_email,student_mobile,student_dob,student_branch,section,student_gender,fathers_full_name,mothers_full_name,parent_mobile,profile_pic,signature_pic) 

VALUES('$cast_category','$adhar_num','$student_name','$student_address','$student_email','$student_mobile','$student_dob','$student_branch','$section','$student_gender','$fathers_full_name','$mothers_full_name','$parent_mobile','$profile_pic','$signature_pic')");

if(mysqli_query($con,$sql)){ 

exit(header("Location: ./Student_Registration.php?msg=Student Registered Successfully!&type=success"));

}else{

die(mysqli_error($con));

exit(header("Location: ./Student_Registration.php?msg=Something went wrong, Please Try Again!&type=error"));

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
<form method="post" action="Student_Registration.php" enctype="multipart/form-data">
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
          <h3><strong>Student Registration </strong></h3>
        </div></th>
        <th width="27%" scope="col">&nbsp;</th>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
		
		<table width="100%" border="0" cellspacing="5" cellpadding="5">
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
            <td width="38%" ><div align="right">Full Name: </div></td>
            <td width="62%" ><div align="left"><input type="text" name="student_name" required=""/></div></td>
          </tr>
          <tr>
            <td><div align="right">Address: </div></td>
            <td><div align="left"><textarea name="student_address" required="" rows="3"></textarea></div></td>
          </tr>
          <tr>
            <td><div align="right">Email: </div></td>
            <td><div align="left"><input type="email" name="student_email" required=""/></div></td>
          </tr>
          <tr>
            <td><div align="right">Mobile Number: </div></td>
            <td><div align="left"><input type="text" name="student_mobile" pattern="[0-9]{10,10}" maxlength="10" required=""/></div></td>
          </tr>
          <tr>
            <td><div align="right">Date of Birth: </div></td>
            <td><div align="left"><input type="date" name="student_dob" required=""/></div></td>
          </tr>
          <tr>
            <td><div align="right">Branch: </div></td>
            <td><div align="left"><select name="student_branch"><option value=""> Please select Branch </option>
			<option value="Computer Science & Engineering">Computer Science & Engineering</option>
			<option value="Information Technology">Information Technology</option>
			<option value="Electronics & Telecommunication Engineering">Electronics & Telecommunication Engineering</option>
			<option value="Electrical Engineering">Electrical Engineering</option>
			<option value="Civil Engineering">Civil Engineering</option>
			<option value="Mechanical Engineering">Mechanical Engineering</option>
			<option value="Textile Engineering">Textile Engineering</option>
			<option value="Chemical Engineering">Chemical Engineering</option>
			</select></div></td>
          </tr>
          <tr>
            <td><div align="right">Section: </div></td>
            <td><select name="section">
              <option value=""> Please select Section </option>
              <option value="SECTION A">SECTION A</option>
              <option value="SECTION B">SECTION B</option>
              <option value="SECTION C">SECTION C</option>
              <option value="SECTION D">SECTION D</option>
              <option value="SECTION E">SECTION E</option>
              <option value="SECTION F">SECTION F</option>
              <option value="SECTION G">SECTION G</option>
              <option value="SECTION H">SECTION H</option>
            </select>
            </td>
          </tr>
          <tr>
            <td><div align="right">Gender: </div></td>
            <td><div align="left">Male <input type="radio" name="student_gender" required="" value="Male"/> &nbsp;&nbsp; Female <input type="radio" name="student_gender" required="" value="Female"/></div></td>
          </tr>
		  <tr>
            <td><div align="right">Cast Category: </div></td>
            <td><div align="left"><input type="text" name="cast_category" required="" > </div></td>
          </tr>
		 <tr>
            <td><div align="right">Adhar Number: </div></td>
            <td><div align="left"><input type="text" name="adhar_num" pattern="[0-9]{12,12}" maxlength="12" required=""/></div></td>
          </tr>
		  
          <tr>
            <td><div align="right">Fathers's Full Name: </div></td>
            <td><div align="left"><input type="text" name="fathers_full_name" required=""/></div></td>
          </tr>
          <tr>
            <td><div align="right">Mother's Full Name: </div></td>
            <td><div align="left"><input type="text" name="mothers_full_name" required=""/></div></td>
          </tr>
          <tr>
            <td><div align="right">Parent's Mobile Number: </div></td>
            <td><div align="left"><input type="text" name="parent_mobile" pattern="[0-9]{10,10}" maxlength="10" required=""/></div></td>
          </tr>
          <tr>
            <td><div align="right">Passport Photo: </div></td>
            <td><div align="left"><input type="file" name="profile_pic" required="" accept="image/*"/></div></td>
          </tr>
          <tr>
            <td><div align="right">Signature: </div></td>
            <td><div align="left"><input type="file" name="signature_pic" required="" accept="image/*"/></div></td>
          </tr>
		   <tr>
            <td></td>
            <td><div align="left"><input type="submit" name="stud_registration" value="SUBMIT"/></div></td>
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
