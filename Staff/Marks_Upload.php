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

if(isset($_POST['submit']))
{
extract($_POST);


$marks_for1="IPM";

$sql="select * from marks where roll_number='{$roll_number}' and marks_for='{$marks_for1}'";	
$res=mysqli_query($con,$sql);
$nor=mysqli_num_rows($res);
if($nor>0){
exit(header("Location: ./Marks_Upload.php?msg=Marks for roll number $roll_number already uploaded!&type=error"));				
}

$marks_for2="EPM";

$sql="select * from marks where roll_number='{$roll_number}' and marks_for='{$marks_for2}'";	
$res=mysqli_query($con,$sql);
$nor=mysqli_num_rows($res);
if($nor>0){
exit(header("Location: ./Marks_Upload.php?msg=Marks for roll number $roll_number already uploaded!&type=error"));				
}

$marks_for3="ITM";

$sql="select * from marks where roll_number='{$roll_number}' and marks_for='{$marks_for3}'";	
$res=mysqli_query($con,$sql);
$nor=mysqli_num_rows($res);
if($nor>0){
exit(header("Location: ./Marks_Upload.php?msg=Marks for roll number $roll_number already uploaded!&type=error"));				
}

$sql = ("INSERT INTO marks(roll_number,subject1_cod,subject2_cod,subject3_cod,subject4_cod,subject1_marks,subject2_marks,subject3_marks,subject4_marks,marks_for) 
VALUES('$roll_number','$subject1p','$subject2p','$subject3p','$subject4p','$subject1ip_marks','$subject2ip_marks','$subject3ip_marks','$subject4ip_marks','$marks_for1')
,('$roll_number','$subject1p','$subject2p','$subject3p','$subject4p','$subject1ep_marks','$subject2ep_marks','$subject3ep_marks','$subject4ep_marks','$marks_for2')");

if(mysqli_query($con,$sql)){ 

$sql = ("INSERT INTO marks(roll_number,subject1_cod,subject2_cod,subject3_cod,subject4_cod,subject1_marks,subject2_marks,subject3_marks,subject4_marks,marks_for) 
VALUES('$roll_number','$subject1t','$subject2t','$subject3t','$subject4t','$subject1it_marks','$subject2it_marks','$subject3it_marks','$subject4it_marks','$marks_for3')");
mysqli_query($con,$sql); 
exit(header("Location: ./Marks_Upload.php?msg=Marks Uploaded Successfully!&type=success"));

}else{

die(mysqli_error($con));

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
</style>
<script>
function myFunction(str) {

  location.replace("./Marks_Upload.php?roll_number="+str)
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
    <td bgcolor="#6858d2"><div align="center"><a style="color:white;"href="index.php">Home</a></div></td>
    <td bgcolor="#6858d2"><div align="center"><a style="color:white;"href="View_and_Manage_Students.php">View and Manage Students</a></div>      <div align="center"></div></td>
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
          
          <th width="96%" scope="col"><div align="center">
            <h3>Upload Marks</h3>
          </div></th>
         
        </tr>
        <tr>
          
          <td>
<form action="Marks_Upload.php" method="post">			  
		<table width="100%" border="1" cellspacing="5" cellpadding="5">
<tr>
   <td style="width:20%" rowspan="2"><div align="center">
   <?php
if(isset($_GET['roll_number']) && !empty($_GET['roll_number'])){
$roll_number=$_GET['roll_number'];
}
?>
      <label> Roll Number: <input type="number" name="roll_number" value="<?php if(isset($roll_number) && !empty($roll_number)){echo"$roll_number";} ?>" style="width:80%" onchange="myFunction(this.value)" /></label>
	  <br/>
	  
    </div>
	</td>

	<td>
	<div align="center"> 
	  <select name="subject1p" style="width:95%">
	  <option value="">Practical Subjects</option>
<?php
if(isset($_GET['roll_number']) && !empty($_GET['roll_number'])){
$roll_number=$_GET['roll_number'];
$sql = ("SELECT * FROM forms where roll_number='{$roll_number}'");
$result=@mysqli_query($con,$sql);
$nor=@mysqli_num_rows($result);
if($nor>=1){
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
for($x=1;$x<=8;$x++){
$sc=$row['subject'.$x.'_cod'];
$sql9 = ("SELECT * FROM subjects where subject_code='{$sc}' limit 1");
$result9=@mysqli_query($con,$sql9);
$nor9=@mysqli_num_rows($result9);
if($nor9>=1){
while($row9=mysqli_fetch_array($result9,MYSQLI_ASSOC)){
	$sn=$row9['subject_name'];
	$search='(Practical)';
		if(preg_match("/{$search}/i",$sn)) {
			
			?>
	<option value="<?php echo"$sc"; ?>"><?php echo"$sn"; ?></option>
	<?php
	
		}else{
	
}
}
}
}
}
}
}
?>

      </select>
      
	  <br/><br/>
	  <select name="subject1ip_marks" style="width:95%">
	  <option value="">Internal Practical Marks</option>
	  <option value="AB">AB</option>
	  <?php 
	  for($z=0;$z<=25;$z++){
		?>
			<option value="<?php echo"$z"; ?>"><?php echo"$z"; ?></option>
		<?php 
	  }
	  ?>
      </select>
	  
	  <br/><br/>
	  <select name="subject1ep_marks" style="width:95%">
	  <option value="">External Practical Marks</option>
	  <option value="AB">AB</option>
	  <?php 
	  for($z=0;$z<=25;$z++){
		?>
			<option value="<?php echo"$z"; ?>"><?php echo"$z"; ?></option>
		<?php 
	  }
	  ?>
      </select>
	</div>
	</td>
	
		<td>
	<div align="center"> 
	  <select name="subject2p" style="width:95%">
	  <option value="">Practical Subjects</option>
<?php
if(isset($_GET['roll_number']) && !empty($_GET['roll_number'])){
$roll_number=$_GET['roll_number'];
$sql = ("SELECT * FROM forms where roll_number='{$roll_number}'");
$result=@mysqli_query($con,$sql);
$nor=@mysqli_num_rows($result);
if($nor>=1){
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
for($x=1;$x<=8;$x++){
$sc=$row['subject'.$x.'_cod'];
$sql9 = ("SELECT * FROM subjects where subject_code='{$sc}' limit 1");
$result9=@mysqli_query($con,$sql9);
$nor9=@mysqli_num_rows($result9);
if($nor9>=1){
while($row9=mysqli_fetch_array($result9,MYSQLI_ASSOC)){
	$sn=$row9['subject_name'];
	$search='(Practical)';
		if(preg_match("/{$search}/i",$sn)) {
			
			?>
	<option value="<?php echo"$sc"; ?>"><?php echo"$sn"; ?></option>
	<?php
	
		}else{
	
}
}
}
}
}
}
}
?>
      </select>
      
	  <br/><br/>
	  <select name="subject2ip_marks" style="width:95%">
	  <option value="">Internal Practical Marks</option>
	  <option value="AB">AB</option>
	  <?php 
	  for($z=0;$z<=25;$z++){
		?>
			<option value="<?php echo"$z"; ?>"><?php echo"$z"; ?></option>
		<?php 
	  }
	  ?>
      </select>
	  
	  <br/><br/>
	  <select name="subject2ep_marks" style="width:95%">
	  <option value="">External Practical Marks</option>
	  <option value="AB">AB</option>
	  <?php 
	  for($z=0;$z<=25;$z++){
		?>
			<option value="<?php echo"$z"; ?>"><?php echo"$z"; ?></option>
		<?php 
	  }
	  ?>
      </select>
	</div>
	</td>
	
		<td>
	<div align="center"> 
	  <select name="subject3p" style="width:95%">
	  <option value="">Practical Subjects</option>
<?php
if(isset($_GET['roll_number']) && !empty($_GET['roll_number'])){
$roll_number=$_GET['roll_number'];
$sql = ("SELECT * FROM forms where roll_number='{$roll_number}'");
$result=@mysqli_query($con,$sql);
$nor=@mysqli_num_rows($result);
if($nor>=1){
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
for($x=1;$x<=8;$x++){
$sc=$row['subject'.$x.'_cod'];
$sql9 = ("SELECT * FROM subjects where subject_code='{$sc}' limit 1");
$result9=@mysqli_query($con,$sql9);
$nor9=@mysqli_num_rows($result9);
if($nor9>=1){
while($row9=mysqli_fetch_array($result9,MYSQLI_ASSOC)){
	$sn=$row9['subject_name'];
	$search='(Practical)';
		if(preg_match("/{$search}/i",$sn)) {
			
			?>
	<option value="<?php echo"$sc"; ?>"><?php echo"$sn"; ?></option>
	<?php
	
		}else{
	
}
}
}
}
}
}
}
?>
      </select>
      
	  <br/><br/>
	  <select name="subject3ip_marks" style="width:95%">
	  <option value="">Internal Practical Marks</option>
	  <option value="AB">AB</option>
	  <?php 
	  for($z=0;$z<=25;$z++){
		?>
			<option value="<?php echo"$z"; ?>"><?php echo"$z"; ?></option>
		<?php 
	  }
	  ?>
      </select>
	  
	  <br/><br/>
	  <select name="subject3ep_marks" style="width:95%">
	  <option value="">External Practical Marks</option>
	  <option value="AB">AB</option>
	  <?php 
	  for($z=0;$z<=25;$z++){
		?>
			<option value="<?php echo"$z"; ?>"><?php echo"$z"; ?></option>
		<?php 
	  }
	  ?>
      </select>
	</div>
	</td>
	
		<td>
	<div align="center"> 
	  <select name="subject4p" style="width:95%">
	  <option value="">Practical Subjects</option>
<?php
if(isset($_GET['roll_number']) && !empty($_GET['roll_number'])){
$roll_number=$_GET['roll_number'];
$sql = ("SELECT * FROM forms where roll_number='{$roll_number}'");
$result=@mysqli_query($con,$sql);
$nor=@mysqli_num_rows($result);
if($nor>=1){
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
for($x=1;$x<=8;$x++){
$sc=$row['subject'.$x.'_cod'];
$sql9 = ("SELECT * FROM subjects where subject_code='{$sc}' limit 1");
$result9=@mysqli_query($con,$sql9);
$nor9=@mysqli_num_rows($result9);
if($nor9>=1){
while($row9=mysqli_fetch_array($result9,MYSQLI_ASSOC)){
	$sn=$row9['subject_name'];
	$search='(Practical)';
		if(preg_match("/{$search}/i",$sn)) {
			
			?>
	<option value="<?php echo"$sc"; ?>"><?php echo"$sn"; ?></option>
	<?php
	
		}else{
	
}
}
}
}
}
}
}
?>
      </select>
      
	  <br/><br/>
	  <select name="subject4ip_marks" style="width:95%">
	  <option value="">Internal Practical Marks</option>
	  <option value="AB">AB</option>
	  <?php 
	  for($z=0;$z<=25;$z++){
		?>
			<option value="<?php echo"$z"; ?>"><?php echo"$z"; ?></option>
		<?php 
	  }
	  ?>
      </select>
	  
	  <br/><br/>
	  <select name="subject4ep_marks" style="width:95%">
	  <option value="">External Practical Marks</option>
	  <option value="AB">AB</option>
	  <?php 
	  for($z=0;$z<=25;$z++){
		?>
			<option value="<?php echo"$z"; ?>"><?php echo"$z"; ?></option>
		<?php 
	  }
	  ?>
      </select>
	</div>
	</td>
	
</tr>
<tr>
  <td>
  	<br/>
	<div align="center"> 
	  <select name="subject1t" style="width:95%">
	  <option value="">Theory Subjects</option>
<?php
if(isset($_GET['roll_number']) && !empty($_GET['roll_number'])){
$roll_number=$_GET['roll_number'];
$sql = ("SELECT * FROM forms where roll_number='{$roll_number}'");
$result=@mysqli_query($con,$sql);
$nor=@mysqli_num_rows($result);
if($nor>=1){
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
for($x=1;$x<=8;$x++){
$sc=$row['subject'.$x.'_cod'];
$sql9 = ("SELECT * FROM subjects where subject_code='{$sc}' limit 1");
$result9=@mysqli_query($con,$sql9);
$nor9=@mysqli_num_rows($result9);
if($nor9>=1){
while($row9=mysqli_fetch_array($result9,MYSQLI_ASSOC)){
	$sn=$row9['subject_name'];
	$search='(Practical)';
		if(preg_match("/{$search}/i",$sn)) {
			
	}else{
			?>
	<option value="<?php echo"$sc"; ?>"><?php echo"$sn"; ?></option>
	<?php
}
}
}
}
}
}
}
?>
      </select>
      
	  <br/><br/>
	  <select name="subject1it_marks" style="width:95%">
	  <option value="">Internal Theory Marks</option>
	  <option value="AB">AB</option>
	  <?php 
	  for($z=0;$z<=20;$z++){
		?>
			<option value="<?php echo"$z"; ?>"><?php echo"$z"; ?></option>
		<?php 
	  }
	  ?>
      </select>
	  
	</div>
	</td>
	<td>
	<br/>
	<div align="center"> 
	  <select name="subject2t" style="width:95%">
	  <option value="">Theory Subjects</option>
<?php
if(isset($_GET['roll_number']) && !empty($_GET['roll_number'])){
$roll_number=$_GET['roll_number'];
$sql = ("SELECT * FROM forms where roll_number='{$roll_number}'");
$result=@mysqli_query($con,$sql);
$nor=@mysqli_num_rows($result);
if($nor>=1){
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
for($x=1;$x<=8;$x++){
$sc=$row['subject'.$x.'_cod'];
$sql9 = ("SELECT * FROM subjects where subject_code='{$sc}' limit 1");
$result9=@mysqli_query($con,$sql9);
$nor9=@mysqli_num_rows($result9);
if($nor9>=1){
while($row9=mysqli_fetch_array($result9,MYSQLI_ASSOC)){
	$sn=$row9['subject_name'];
	$search='(Practical)';
		if(preg_match("/{$search}/i",$sn)) {
			
	}else{
			?>
	<option value="<?php echo"$sc"; ?>"><?php echo"$sn"; ?></option>
	<?php
}
}
}
}
}
}
}
?>
      </select>
      
	  <br/><br/>
	  <select name="subject2it_marks" style="width:95%">
	  <option value="">Internal Theory Marks</option>
	  <option value="AB">AB</option>
	  <?php 
	  for($z=0;$z<=20;$z++){
		?>
			<option value="<?php echo"$z"; ?>"><?php echo"$z"; ?></option>
		<?php 
	  }
	  ?>
      </select>
	  
	</div>
	</td>
	<td>	<br/>
	<div align="center"> 
	  <select name="subject3t" style="width:95%">
	  <option value="">Theory Subjects</option>
<?php
if(isset($_GET['roll_number']) && !empty($_GET['roll_number'])){
$roll_number=$_GET['roll_number'];
$sql = ("SELECT * FROM forms where roll_number='{$roll_number}'");
$result=@mysqli_query($con,$sql);
$nor=@mysqli_num_rows($result);
if($nor>=1){
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
for($x=1;$x<=8;$x++){
$sc=$row['subject'.$x.'_cod'];
$sql9 = ("SELECT * FROM subjects where subject_code='{$sc}' limit 1");
$result9=@mysqli_query($con,$sql9);
$nor9=@mysqli_num_rows($result9);
if($nor9>=1){
while($row9=mysqli_fetch_array($result9,MYSQLI_ASSOC)){
	$sn=$row9['subject_name'];
	$search='(Practical)';
		if(preg_match("/{$search}/i",$sn)) {
			
	}else{
			?>
	<option value="<?php echo"$sc"; ?>"><?php echo"$sn"; ?></option>
	<?php
}
}
}
}
}
}
}
?>
      </select>
      
	  <br/><br/>
	  <select name="subject3it_marks" style="width:95%">
	  <option value="">Internal Theory Marks</option>
	  <option value="AB">AB</option>
	  <?php 
	  for($z=0;$z<=20;$z++){
		?>
			<option value="<?php echo"$z"; ?>"><?php echo"$z"; ?></option>
		<?php 
	  }
	  ?>
      </select>
	  
	</div>
	</td>
	<td>	<br/>
	<div align="center"> 
	  <select name="subject4t" style="width:95%">
	  <option value="">Theory Subjects</option>
<?php
if(isset($_GET['roll_number']) && !empty($_GET['roll_number'])){
$roll_number=$_GET['roll_number'];
$sql = ("SELECT * FROM forms where roll_number='{$roll_number}'");
$result=@mysqli_query($con,$sql);
$nor=@mysqli_num_rows($result);
if($nor>=1){
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
for($x=1;$x<=8;$x++){
$sc=$row['subject'.$x.'_cod'];
$sql9 = ("SELECT * FROM subjects where subject_code='{$sc}' limit 1");
$result9=@mysqli_query($con,$sql9);
$nor9=@mysqli_num_rows($result9);
if($nor9>=1){
while($row9=mysqli_fetch_array($result9,MYSQLI_ASSOC)){
	$sn=$row9['subject_name'];
	$search='(Practical)';
		if(preg_match("/{$search}/i",$sn)) {
			
	}else{
			?>
	<option value="<?php echo"$sc"; ?>"><?php echo"$sn"; ?></option>
	<?php
}
}
}
}
}
}
}
?>
      </select>
      
	  <br/><br/>
	  <select name="subject4it_marks" style="width:95%">
	  <option value="">Internal Theory Marks</option>
	  <option value="AB">AB</option>
	  <?php 
	  for($z=0;$z<=20;$z++){
		?>
			<option value="<?php echo"$z"; ?>"><?php echo"$z"; ?></option>
		<?php 
	  }
	  ?>
      </select>
	  
	</div>
	</td>
	
</tr>
<tr>
    <td colspan="5"><div align="center"><br>
	<input type="submit" name="submit" value="Submit">
	</div></td>
  </tr>
</table>
</form>
<br/>
		  
		  </td>
         
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
