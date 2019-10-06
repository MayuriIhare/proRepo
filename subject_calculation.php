<?php
if(isset($_GET['category']) && isset($_GET['semester']) && isset($_GET['group'])){
$semester=$_GET['semester'];
$group=$_GET['group'];
$category=$_GET['category'];

if(isset($category) && !empty($category)){
	echo"<p></p>";
}else{
	
echo"<p style=\"color:red;\">please select Category</p>";	

die();
}

include "dbconnect.php";

$sql="select * from subjects where semester='{$semester}' and group_name='{$group}'";

$res=mysqli_query($con,$sql);

$nor=mysqli_num_rows($res);

if($nor>0){
?>
<input type="hidden" name="semester" value="<?php if(isset($semester)){echo"$semester";} ?>">
<input type="hidden" name="group" value="<?php if(isset($group)){echo"$group";} ?>">		
<table width="100%" border="1" cellspacing="1" cellpadding="1">	
 <tr>
        <td width="30%"><div align="center"><strong>Subject Code </strong></div></td>
        <td width="70%"><div align="center"><strong>Subject Name </strong></div></td>
      </tr>	
	<?php
$cnt=1;	
	while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
		
		extract($row);
		?>
		
		<tr>
        <td><?php if(isset($category) && !empty($category)){
			
			if($category=="Regular"){
			
			?><div align="left"><input type="checkbox" name="subject_codes[]" value="<?php if(isset($subject_code)){echo"$subject_code";} ?>" checked=""> <?php
			
			}elseif($category=="Ex"){
			
			?><div align="left"><input type="checkbox" name="subject_codes[]" value="<?php if(isset($subject_code)){echo"$subject_code";} ?>"> <?php
			
			}
			
			}else{
		
		
		
			}			
		?><?php if(isset($subject_code)){echo"$subject_code";} ?></div></td>
        <td><div align="left"><?php if(isset($subject_name)){echo"$subject_name";} ?></div></td>
		</tr>
	  
		<?php
		$cnt=$cnt+1;
	}
?>
		
</table>		
<br><br>
<center><input type="submit" name="submit" value="SAVE & SUBMIT"></center>

<?php	
	
}else{
	echo"no values1";
}
	
	
}else{

echo"no values";	
	
}
?>


     
     


    
 