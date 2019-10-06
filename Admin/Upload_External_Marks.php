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

if(isset($_POST['submit']))
{
extract($_POST);

$marks_for="ETM";

$sql="select * from marks where roll_number='{$roll_number}' and marks_for='{$marks_for}'";	
$res=mysqli_query($con,$sql);
$nor=mysqli_num_rows($res);
	if($nor>0){
exit(header("Location: ./Upload_External_Marks.php?msg=Marks for roll number $roll_number already uploaded!&type=error"));				
	}

$sql = ("INSERT INTO marks(roll_number,subject1_cod,subject2_cod,subject3_cod,subject4_cod,subject1_marks,subject2_marks,subject3_marks,subject4_marks,marks_for) 
VALUES('$roll_number','$subject1','$subject2','$subject3','$subject4','$subject1_marks','$subject2_marks','$subject3_marks','$subject4_marks','$marks_for')");

if(mysqli_query($con,$sql)){ 

exit(header("Location: ./Upload_External_Marks.php?msg=Marks Uploaded Successfully!&type=success"));

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

</style>
<script>
function myFunction(str) {

  location.replace("./Upload_External_Marks.php?roll_number="+str)
}
</script>
</head>

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
      <table width="100%" height="100%" border="0" cellpadding="1" cellspacing="10">
        <tr>
          <th width="100%" scope="col"><div align="center">
              <h3><strong>External Theory Marks </strong></h3>
          </div></th>
        </tr>
        <tr>
<td>
		  
<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td>
   <?php
if(isset($_GET['roll_number']) && !empty($_GET['roll_number'])){
$roll_number=$_GET['roll_number'];
}
?>
<form action="Upload_External_Marks.php" method="post">	
	<table width="100%" border="1" cellspacing="5" cellpadding="5">
	<tr>
    <td style="width:20%"><div align="center">
      <label> Roll Number: <input type="number" name="roll_number" value="<?php if(isset($roll_number) && !empty($roll_number)){echo"$roll_number";} ?>" style="width:80%" onchange="myFunction(this.value)"/></label>
    </div></td>

	    <td><div align="center"> 
	<select name="subject1" style="width:95%">
	  <option value="">Subject</option>
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
	  <select name="subject1_marks" style="width:95%">
	  <option value="">Marks</option>
	  <option value="AB">AB</option>
	  <?php 
	  for($z=0;$z<=80;$z++){
		?>
			<option value="<?php echo"$z"; ?>"><?php echo"$z"; ?></option>
		<?php 
	  }
	  ?>
      </select>
	  </div></td>
	  
	      <td><div align="center"> 
	<select name="subject2" style="width:95%">
	  <option value="">Subject</option>
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
	 	  <select name="subject2_marks" style="width:95%">
	  <option value="">Marks</option>
	  <option value="AB">AB</option>
	  <?php 
	  for($z=0;$z<=80;$z++){
		?>
			<option value="<?php echo"$z"; ?>"><?php echo"$z"; ?></option>
		<?php 
	  }
	  ?>
      </select>
	  </div></td>
	  
	      <td><div align="center"> 
	<select name="subject3" style="width:95%">
	  <option value="">Subject</option>
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
	 	  <select name="subject3_marks" style="width:95%">
	  <option value="">Marks</option>
	  <option value="AB">AB</option>
	  <?php 
	  for($z=0;$z<=80;$z++){
		?>
			<option value="<?php echo"$z"; ?>"><?php echo"$z"; ?></option>
		<?php 
	  }
	  ?>
      </select>
	  </div></td>
	  
	      <td><div align="center"> 
	<select name="subject4" style="width:95%">
	  <option value="">Subject</option>
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
	 	  <select name="subject4_marks" style="width:95%">
	  <option value="">Marks</option>
	  <option value="AB">AB</option>
	  <?php 
	  for($z=0;$z<=80;$z++){
		?>
			<option value="<?php echo"$z"; ?>"><?php echo"$z"; ?></option>
		<?php 
	  }
	  ?>
      </select>
	  </div></td>
  </tr>
</table>


	
	</td>
  </tr>
  <tr>
    <td><div align="center"><br>
	<input type="submit" name="submit" value="Submit">
	</div></td>
  </tr>
</table>
</form>
		  
		  </td>
        
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
