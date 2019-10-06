<?php
session_start();

function send_my_msg($mobileNumber,$message,$route="default"){

$authKey = "264550Aan8xTsndd5c723654";

//Sender ID,While using route4 sender id should be 6 characters long.
$senderId = "CBCMSN";

$message = urlencode($message);
//Prepare you post parameters
$postData = array(
    'authkey' => $authKey,
    'mobiles' => $mobileNumber,
    'message' => $message,
    'sender' => $senderId,
    'route' => $route
);

//API URL
$url="https://control.msg91.com/api/sendhttp.php";

// init the resource
$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData
    //,CURLOPT_FOLLOWLOCATION => true
));


//Ignore SSL certificate verification
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

//get response
$output = curl_exec($ch);

//Print error if any
if(curl_errno($ch))
{
    //echo 'error:' . curl_error($ch);
}

curl_close($ch);

//echo $output;
	
}


if(isset($_SESSION["staff_id"]) && isset($_SESSION["designation"]) && !empty($_SESSION["designation"]) && $_SESSION["designation"]=="staff"){
	
	$staff_ids=$_SESSION["staff_id"];
	$name=$_SESSION["staff_name"];
		$designation=$_SESSION["designation"];
	
}elseif(isset($_SESSION["designation"]) && !empty($_SESSION["designation"]) && $_SESSION["designation"]=="HOD"){

exit(header("Location: ../Admin/index.php"));

}else{

session_unset();
session_destroy();	
exit(header("Location: ../Staff_Login.php?msg=Please Login First!"));	

}

include "../dbconnect.php";

$sql = ("SELECT class_inchage FROM staff where staff_id='{$staff_ids}'");

$result=@mysqli_query($con,$sql);

$nor=@mysqli_num_rows($result);
$count=1;
if($nor>=1){

	while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
		
		$ci=$row["class_inchage"];
	}
}
?>


<?php
include "../dbconnect.php";

if(isset($_GET['student_id']) && isset($_GET['act']))
{

extract($_GET);

$sql="select * from student";

$pwd=rand(10000000,99999999);
$c_yr=date("y");
$clg_code="447";
$code=rand(1000000,9999999);
$PNR_NO=$c_yr.$clg_code.$code;

if($act=="Approved"){
	
$sql = ("update student SET status=\"Approved\", pnr='{$PNR_NO}', password='{$pwd}' where student_id='{$student_id}'");


}elseif($act=="InActive"){
	
$sql = ("update student SET status=\"InActive\" where student_id='{$student_id}'");

}


if(mysqli_query($con,$sql)){ 

if($act=="Approved"){
	
	$message="Dear $stud_name,Your Registration is Completed Successfully, Your PNR Number is: $PNR_NO and password is: $pwd";

send_my_msg($stud_mobile,$message,4);

}
exit(header("Location: ./View_and_Manage_Students.php?msg=Status Changed Successfully!&type=success"));

}else{
	
$pwd=rand(10000000,99999999);
$c_yr=date("y");
$clg_code="447";
$code=rand(1000000,9999999);
$PNR_NO=$c_yr.$clg_code.$code;

if($act=="Approved"){
	
$sql = ("update student SET status=\"Approved\", pnr='{$PNR_NO}', password='{$pwd}' where student_id='{$student_id}'");


}elseif($act=="InActive"){
	
$sql = ("update student SET status=\"InActive\" where student_id='{$student_id}'");

}


if(mysqli_query($con,$sql)){ 

if($act=="Approved"){
	
	$message="Dear $stud_name,Your Registration is Completed Successfully, Your PNR Number is: $PNR_NO and password is: $pwd";

send_my_msg($stud_mobile,$message,4);

}
exit(header("Location: ./View_and_Manage_Students.php?msg=Status Changed Successfully!&type=success"));

}else{

die(mysqli_error($con));

exit(header("Location: ./View_and_Manage_Students.php?msg=Something Went Wrong, Please Try Again!&type=success"));

}

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
    <th colspan="4" bgcolor="#af5cd3" scope="col"><h1 align="center" class="style3">&nbsp;</h1>
    <h1 align="center" class="style3"><strong><span class="style1">Home Exam Management System</span></strong></h1>
    <p align="center" class="style3">&nbsp;</p></th>
  </tr>
  <tr>
    <td bgcolor="#6858d2"><div align="center"><a style="color:white;"href="index.php">Home</a></div></td>
    <td bgcolor="#6858d2"><div align="center"><a style="color:white;"href="View_and_Manage_Students.php">View and Manage Students</a></div>      
      <div align="center"></div></td>
    <td bgcolor="#6858d2"><div align="center"><a style="color:white;"href="Marks_Upload.php">Marks Upload</a></div>      <div align="center"></div></td>
    <td bgcolor="#6858d2"><div align="center"><a style="color:white;"href="Logout.php">Logout</a></div></td>
  </tr>
  <tr>
    <td height="400" colspan="4" bgcolor="#FFFFFF">
	
	<center>
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
      <table width="100%" height="100%" border="0" cellpadding="5" cellspacing="5">
        <tr>
          <th width="2%" height="54" scope="col">&nbsp;</th>
          <th width="96%" scope="col"><div align="center">
            <h3>View And Manage Students </h3>
          </div></th>
          <th width="2%" scope="col">&nbsp;</th>
        </tr>
        <tr>
          <td height="282">&nbsp;</td>
          <td><table width="100%" border="1" cellpadding="5" cellspacing="5" bordercolor="#000000">
            <tr bgcolor="#009999">
              <th bordercolor="#000000" scope="col"><div align="center"><strong>Sr. No </strong></div></th>
              <th bordercolor="#000000" scope="col"><div align="center">Image</div></th>
              <th bordercolor="#000000" scope="col"><div align="center"><strong>Student Name</strong></div></th>
              <th bordercolor="#000000" scope="col"><div align="center"><strong>Email ID </strong></div></th>
              <th bordercolor="#000000" scope="col"><div align="center"><strong>Mobile Number </strong></div></th>
              <th bordercolor="#000000" scope="col"><div align="center"><strong>Status</strong></div></th>
              <th bordercolor="#000000" scope="col"><div align="center"><strong>Action</strong></div></th>
            </tr>
<?php
include "../dbconnect.php";

$sql = ("SELECT * FROM student where section='{$ci}'");

$result=@mysqli_query($con,$sql);

$nor=@mysqli_num_rows($result);
$count=1;
if($nor>=1){

	while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
		
		extract($row);
		?>
		<tr>
              <td  bordercolor="#000000"><div align="left"><?php if(isset($count)){echo"$count";} ?></div></td>
			  <td width="12%" bordercolor="#000000"><div align="center"><img src=".<?php if(isset($profile_pic)){echo"$profile_pic";} ?>" width="120" height="150" /></div></td>
              <td  bordercolor="#000000"><div align="left"><?php if(isset($student_name)){echo"$student_name";} ?></div></td>
              <td  bordercolor="#000000"><div align="left"><?php if(isset($student_email)){echo"$student_email";} ?></div></td>
              <td  bordercolor="#000000"><div align="left"><?php if(isset($student_mobile)){echo"$student_mobile";} ?></div></td>
			  <td  bordercolor="#000000"><div align="left"><?php if(isset($status)){echo"$status";} ?></div></td>
              <td  bordercolor="#000000"><div align="left">
			  <?php
			  if($status=="InActive"){
				?>  
				<a href="./View_and_Manage_Students.php?student_id=<?php if(isset($student_id)){echo"$student_id";} ?>&act=Approved&stud_mobile=<?php if(isset($student_mobile)){echo"$student_mobile";} ?>&stud_name=<?php if(isset($student_name)){echo"$student_name";} ?>" style="color:green;"> Active </a> 
				<?php
			  }elseif($status=="Approved"){
				?>  
				<a href="./View_and_Manage_Students.php?student_id=<?php if(isset($student_id)){echo"$student_id";} ?>&act=InActive" style="color:red;"> InActive </a> 
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
    <td colspan="3" bgcolor="#FFFFFF"><div align="center">Copyright @ JDIET Yavatmal </div></td>
  </tr>
</table>
</body>
</html>
