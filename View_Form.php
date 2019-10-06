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

if(isset($_SESSION["form_id"]) && empty($_GET['semester']) && empty($_GET['exam_type'])){
	
$form_id =$_SESSION["form_id"];
$sql = ("SELECT * FROM forms where form_id='{$form_id}' and student_id='{$student_id}'");
$result=@mysqli_query($con,$sql);
$nor=@mysqli_num_rows($result);
if($nor>=1){
	while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
		extract($row);
	}
}else{
exit(header("Location: ./Print_Form.php?msg=Something Went Wrong, Please Contact HOD!&type=error"));	
}

$sub_nm=null;
$sub_nm[0]= $subject1_cod;
$sub_nm[1]= $subject2_cod;
$sub_nm[2]= $subject3_cod;
$sub_nm[3]= $subject4_cod;
$sub_nm[4]= $subject5_cod;
$sub_nm[5]= $subject6_cod;
$sub_nm[6]= $subject7_cod;
$sub_nm[7]= $subject8_cod;

}elseif(isset($_GET['semester']) && isset($_GET['exam_type']) && !empty($_GET['semester']) && !empty($_GET['exam_type'])){

$smstr=$_GET['semester'];
$etyp=$_GET['exam_type'];
$c_yr=date("y");

$sql = ("SELECT * FROM forms where semester='{$smstr}' and exam_type='{$etyp}' and exam_year='{$c_yr}'");
$result=@mysqli_query($con,$sql);
$nor=@mysqli_num_rows($result);
if($nor>=1){
	while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
		extract($row);
	}
}else{
exit(header("Location: ./Print_Form.php?msg=Something Went Wrong, Please Contact HOD!&type=error"));	
}


$sub_nm=null;
$sub_nm[0]= $subject1_cod;
$sub_nm[1]= $subject2_cod;
$sub_nm[2]= $subject3_cod;
$sub_nm[3]= $subject4_cod;
$sub_nm[4]= $subject5_cod;
$sub_nm[5]= $subject6_cod;
$sub_nm[6]= $subject7_cod;
$sub_nm[7]= $subject8_cod;


}	else{
session_unset();
session_destroy();	
exit(header("Location: ./Student_Login.php?msg=Please Login First!&type=error"));	
}

}else{
session_unset();
session_destroy();	
exit(header("Location: ./Student_Login.php?msg=Please Login First!&type=error"));	
}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Home Examination System</title>
<style>
td{
font-size:13px;	
}
</style>
</head>

<body>

<center>

	<table width="100%" height="100%" border="0" cellpadding="1" cellspacing="1">
    <tr>
        
        <td colspan="3">
	
<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <th width="3%" scope="col"><div align="left"> <img src="images/sgbau_logo.png" width="" height="20" /></div></th>
    <th width="44%" scope="col"><div align="left">Sant Gadge Baba Amravati University</div></th>
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
        <td><div align="left">: BATCHELOR OF ENGINEERING <?php if(isset($semester)){echo"$semester";}?> (CGS) EXAMINATION OF <?php if(isset($exam_type)){$exam_t=strtoupper($exam_type); echo"$exam_t"; $eyr=date("Y"); echo"-$eyr";}?> </div></td>
      </tr>
      <tr>
        <th scope="row"><div align="left">Branch Name </div></th>
        <td><div align="left">: <?php if(isset($student_branch)){echo"$student_branch";}?></div></td>
      </tr>
      <tr>
        <th scope="row"><div align="left">Category of the Examinee </div></th>
        <td><div align="left">: <?php if(isset($category_of_the_examinee)){ if($category_of_the_examinee=="Regular"){echo"0 - $category_of_the_examinee";}elseif($category_of_the_examinee=="Ex"){echo"1 - $category_of_the_examinee";} }?>
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
        <td width="32%"><div align="left">:<?php if(isset($exam_type)){echo"$exam_type";}?></div></td>
        <td width="18%">&nbsp;</td>
        <td width="11%"><div align="left">Medium</div></td>
        <td width="21%"><div align="left">: English</div></td>
      </tr>
      <tr>
        <td><div align="left">Enrollment No. </div></td>
        <td><div align="left">:<?php if(isset($enrollment_num)){echo"$enrollment_num";}?></div></td>
        <td>&nbsp;</td>
        <td width="18%"><div align="left" >Exam Form No </div></td>
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
        <td><div align="left">Date of Birth</div></td>
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
        <td><div align="left">Permanent Address </div></td>
        <td colspan="3"><div align="left">:<?php if(isset($student_address)){echo"$student_address";}?></div>          <div align="left"></div>          <div align="left"></div></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3">
		
	<table width="100%" border="1" cellspacing="1" cellpadding="1">	
	<tr>
        <td width="30%"><div align="center"><strong>Subject Code </strong></div></td>
        <td width="70%"><div align="center"><strong>Subject Name </strong></div></td>
    </tr>	
	
<?php
include "dbconnect.php";
$sql="select * from subjects where semester='{$semester}' and group_name='{$group_name}'";
$res=mysqli_query($con,$sql);
$nor=mysqli_num_rows($res);
if($nor>0){
	while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
		$s_cd=$row['subject_code'];
		$s_nm=$row['subject_name'];
		if (in_array($s_cd,$sub_nm)) {
		
		?>
		
		<tr>
        <td><div align="left"><?php if(isset($s_cd)){echo"$s_cd";} ?></div></td>
        <td><div align="left"><?php if(isset($s_nm)){echo"$s_nm";} ?></div></td>
		</tr>
	  
		<?php
		
		}
	}
}
	
?>
	
</table>
<center>
</td>
		</tr>
  <tr>
    <td colspan="3">
		<table width="100%" border="0" align="left" cellpadding="1" cellspacing="1">
      <tr>
        <td colspan="3"><div align="left">I solemnly affirm that the information given by me in this application form is true and correct. i have read and accept all instructions given with this application form. </div></td>
        </tr>
      <tr>
        <td width="12%"><div align="left">Place</div></td>
        <td width="44%"><div align="left">:</div></td>
        <td width="44%" rowspan="2"><div align="center">______________________________________________________</div></td>
      </tr>
      <tr>
        <td><div align="left">Date</div></td>
        <td><div align="left">:</div></td>
        </tr>
      <tr>
        <td colspan="2"><div align="left"></div></td>
        <td><div align="center">
          <p>Examinee's Signature </p>
          </div></td>
      </tr>
      <tr>
        <td colspan="3"><div align="center"><strong>Principal's Certificate </strong></div></td>
        </tr>
      <tr>
        <td colspan="3"><div align="left">Certified that the applicant has fully complied all conditions &amp; provisions prescribed in concern ordinance, rule &amp; regulations. There is no objection regarding his/her character which could be a disqualification for appearing in the examination. </div></td>
        </tr>
      <tr>
        <td colspan="3"><div align="left">The examinee is eligible for admitting in this examination. </div></td>
        </tr>
      <tr>
        <td><div align="left">Place</div></td>
        <td><div align="left">:</div></td>
        <td rowspan="2"><div align="center">_____________________________________________________________</div></td>
      </tr>
      <tr>
        <td><div align="left">Date</div></td>
        <td><div align="left">:</div></td>
        </tr>
      <tr>
        <td colspan="2"><div align="left"></div></td>
        <td><div align="center">Principal's Signature &amp; Stamp </div></td>
      </tr>
      <tr>
        <td><div align="left">Printed Date </div></td>
        <td colspan="2"><div align="left">:</div></td>
      </tr>
    </table>
	</td>
  </tr>
</table>
</td>
        
      </tr>
     
    </table>
	


</body>
</html>
