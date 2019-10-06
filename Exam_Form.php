<?php
session_start();

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

$form_number="447/".$student_id.microtime(true);

$form_numr=explode(".",$form_number);

$form_number=$form_numr[0];

include "dbconnect.php";

if(isset($_POST['submit'])){
extract($_POST);
$exam_year=date("y");

$sqsl="select * from forms where student_id='{$student_id}' and semester='{$semester}' and exam_type='{$exam_type}' and exam_year='{$exam_year}'";
$rres=mysqli_query($con,$sqsl);
if(mysqli_num_rows($rres)>0){
exit(header("Location: ./Exam_Form.php?msg=Form Already Filled!&type=error"));
}

echo $count=count($subject_codes);
$mysub=null;
$cnt=1;
for($i=0;$i<$count;$i++){
	$mysub["subject".$cnt."_cod"]=$subject_codes[$i];
	$cnt=$cnt+1;
}
extract($mysub);

$form_fill_date=date("d-m-Y H:i:s");

$form_id =  str_replace(".", "", microtime(true)) + rand(1,999999);
while(strlen($form_id)>=18){
	$form_id =  str_replace(".", "", microtime(true)) + rand(1,999999);	
}
$sql = ("INSERT INTO forms(form_number,exam_year,form_fill_date,form_id,student_id,semester,group_name,category_of_the_examinee,subject8_cod,subject7_cod,subject6_cod,subject5_cod,subject4_cod,subject3_cod,subject2_cod,subject1_cod,enrollment_num,exam_type) 
VALUES('$form_number','$exam_year','$form_fill_date','$form_id','$student_id','$semester','$group','$category_of_the_examinee','$subject8_cod','$subject7_cod','$subject6_cod','$subject5_cod','$subject4_cod','$subject3_cod','$subject2_cod','$subject1_cod','$enrollment_num','$exam_type')");
if(mysqli_query($con,$sql)){ 
$_SESSION["form_id"]=$form_id;
exit(header("Location: ./View_Form.php"));
}else{
die(mysqli_error($con));
exit(header("Location: ./View_Form.php?msg=msg=Something went wrong, Please Try Again!&type=error"));
}	
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Home Examination System</title>

<script  type="text/javascript">
function getSubjects(){
	
	var xmlhttp;
 
 	var category=document.getElementById("category").value;
	var semester=document.getElementById("semester").value;
	var group=document.getElementById("group").value;
	
	document.getElementById("semester").disabled = true;
	document.getElementById("group").disabled = true;
	
	var str = "category="+category+"&semester="+semester+"&group="+group+"";
	
      if (window.XMLHttpRequest)
      {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
      }
      else
      {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }	
 
      xmlhttp.onreadystatechange = function() {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
          document.getElementById("subject_list").innerHTML = xmlhttp.responseText;
        }
      }
 
      xmlhttp.open("GET","subject_calculation.php?"+str, true);
      xmlhttp.send();
	
}
</script>
</head>

<body style="background-color:#dddddd;">

<center>

<table width="80%" border="0" cellspacing="5" cellpadding="5" style="box-shadow: 25px 25px 75px grey;">
  <tr>
    <th colspan="4" bgcolor="#af5cd3" scope="col"><h1 align="center" class="style3">&nbsp;</h1>
    <h1 align="center" class="style3"><strong><span class="style1">Home Exam Management System</span></strong></h1>
    <p align="center" class="style3">&nbsp;</p></th>
  </tr>
  <tr>
    <td bgcolor="#6858d2"><div align="center"><a style="color:white;"href="Exam_Form.php">Exam Form</a></div></td>
    <td bgcolor="#6858d2"><div align="center"><a style="color:white;"href="Print_Form.php">Print Form</a></div></td>
    <td bgcolor="#6858d2"><div align="center"><a style="color:white;"href="logout.php">Logout</a></div></td>

  </tr>
  <tr>
    <td height="400" colspan="4" bgcolor="#FFFFFF">

	<table width="100%" height="100%" border="0" cellpadding="5" cellspacing="5">
      <tr>
        <th width="27%" scope="col">&nbsp;</th>
        <th width="46%" scope="col"><div align="center">
          <h3><strong>Exam Form</strong></h3>
        </div></th>
        <th width="27%" scope="col">&nbsp;</th>
      </tr>
      <tr>
        
        <td colspan="3">
<form action="Exam_Form.php" method="post">	
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
		<table width="100%" border="0" cellspacing="5" cellpadding="5">
  <tr>
    <th width="6%" scope="col"><div align="left"> <img src="images/sgbau_logo.png" width="" height="60" /></div></th>
    <th width="44%" scope="col"><h2 align="left">Sant Gadge Baba Amravati University</h2></th>
    <th width="50%" scope="col"><div align="right">Student Exam Application Report </div></th>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="1" cellspacing="1" cellpadding="1">
      <tr>
        <th width="18%" scope="row"><div align="left">College  </div></th>
        <td width="82%"><div align="left">: 447-J. D. INSTITUTE OF ENGINEERING & TECHNOLOGY, YAVATMAL</div></td>
      </tr>
      <tr>
        <th scope="row"><div align="left">Programme /Course Name </div></th>
        <td><div align="left">: Bachelor of Engineering - <?php if(isset($student_branch)){echo"$student_branch";}?></div></td>
      </tr>
      <tr>
        <th scope="row"><div align="left">Exam Name </div></th>
        <td><div align="left">: BATCHELOR OF ENGINEERING SEMESTER</div></td>
      </tr>
      <tr>
        <th scope="row"><div align="left">Branch Name </div></th>
        <td><div align="left">: <?php if(isset($student_branch)){echo"$student_branch";}?></div></td>
      </tr>
      <tr>
        <th scope="row"><div align="left">Category of the Examinee </div></th>
        <td><div align="left">: <select name="category_of_the_examinee" required="" id="category">
		<option value="">Please Select Category </option>
		<option value="Regular">0-Regular </option>
		<option value="Ex">1-Ex </option>
		</select>
		</td>
      </tr>
      <tr>
        <th scope="row"><div align="left">PRN No. </div></th>
        <td><div align="left">: <?php if(isset($pnr)){echo"$pnr";}?></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="1" cellspacing="1" cellpadding="1">
      <tr>
        <td colspan="5"><div align="left"><strong>University Details </strong></div></td>
        </tr>
      <tr>
        <td width="18%"><div align="left">Exam Type </div></td>
        <td width="32%"><div align="left">:<select name="exam_type" required="">
		<option value="">Please Select Exam Type </option>
		<option value="Winter">Winter </option>
		<option value="Summer">Summer </option>
		</select></div></td>
        <td width="18%">&nbsp;</td>
        <td width="11%"><div align="left">Medium</div></td>
        <td width="21%"><div align="left">: English</div></td>
      </tr>
      <tr>
        <td><div align="left">Enrollment No. </div></td>
        <td><div align="left">:<input type="text" name="enrollment_num" value="" placeholder="Enter Enrollment Number"></div></td>
        <td>&nbsp;</td>
        <td><div align="left">Exam Form No </div></td>
        <td><div align="left">:<?php if(isset($form_number)){echo"$form_number";}?></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="1" cellspacing="1" cellpadding="1">
      <tr>
        <td colspan="2"><div align="left"><strong>General Details </strong></div>          <div align="left"></div></td>
        <td colspan="2" rowspan="9"><table width="100%" border="0" cellspacing="1" cellpadding="1">
          <tr>
            <td><div align="center"><img src="<?php if(isset($profile_pic)){echo"$profile_pic";}?>" height="150" /></div></td>
          </tr>
          <tr>
            <td><div align="center"><img src="<?php if(isset($signature_pic)){echo"$signature_pic";}?>" height="64" /></div></td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td width="18%"><div align="left">Full Name </div></td>
        <td width="40%"><div align="left">:<?php if(isset($student_name)){echo"$student_name";}?></div></td>
        </tr>
     
      <tr>
        <td><div align="left">Mother's Name </div></td>
        <td><div align="left">:<?php if(isset($mothers_full_name)){echo"$mothers_full_name";}?></div></td>
        </tr>
      <tr>
        <td><div align="left">Sex</div></td>
        <td><div align="left">:<?php if(isset($student_gender)){echo"$student_gender";}?></div></td>
        </tr>
      <tr>
        <td><div align="left">Date of Birth (dd-mm-yyyy) </div></td>
        <td><div align="left">:<?php if(isset($student_dob)){echo"$student_dob";}?></div></td>
        </tr>
      <tr>
        <td><div align="left">Cast Category </div></td>
        <td><div align="left">:<?php if(isset($cast_category)){echo"$cast_category";}?></div></td>
        </tr>
      <tr>
        <td><div align="left">Mobile No. </div></td>
        <td><div align="left">:<?php if(isset($student_mobile)){echo"$student_mobile";}?></div></td>
        </tr>
      <tr>
        <td ><div align="left">Adhar No. </div></td>
        <td ><div align="left">:<?php if(isset($adhar_num)){echo"$adhar_num";}?></div></td>
        </tr>
      <tr>
        <td width="12%"><div align="left">Email Address </div></td>
        <td width="30%"><div align="left">:<?php if(isset($student_email)){echo"$student_email";}?></div></td>
      </tr>
      <tr>
        <td ><div align="left">Fee Paid Amount </div></td>
        <td><div align="left">:</div></td>
        <td width="20%"><div align="left">Fee Paid Date. </div></td>
        <td><div align="left">:</div></td>
      </tr>
      <tr>
        <td><div align="left">Correspondence Permanent Address </div></td>
        <td colspan="3"><div align="left">:<?php if(isset($student_address)){echo"$student_address";}?></div>          <div align="left"></div>          <div align="left"></div></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3">
	<select name="semester" required="" id="semester">
		<option value="">Please Select Semester </option>
		<option value="SEM I">SEM I </option>
		<option value="SEM II">SEM II </option>
		</select>
		
		<select name="group" required="" id="group">
		<option value="">Please Select Group </option>
		<option value="Group A">Group A </option>
		<option value="Group B">Group B </option>
		</select>
		<input type="button"  value="Get Subjects" onClick="getSubjects()"/>	<input type="reset"  value="Reset" onClick="window.location.reload();"/>
		
		<div id="subject_list"></div>

</td>
		</tr>
  <tr>
    <td colspan="3">
	
	</td>
  </tr>
</table>
</form>
		
		</td>
        
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

</body>
</html>
