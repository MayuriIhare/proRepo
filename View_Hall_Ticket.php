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
<title>Hall Ticket</title>
<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="9%" rowspan="3"><img src="images/sgbau_logo.png"  height="100" /></td>
    <td width="91%"><div align="center" class="style1">SANT GADGEBABA AMRAVATI UNIVERSITY </div></td>
  </tr>
  <tr>
    <td><div align="center">Examination Admission Card </div></td>
  </tr>
  <tr>
    <td><div align="center">FOUR YEAR B.E <?php if(isset($semester)){echo"$semester";}?> <?php if(isset($student_branch)){ $student_branch=strtoupper($student_branch);  echo"$student_branch";}?> (CGS) <?php if(isset($exam_type)){ $exam_type=strtoupper($exam_type); echo"$exam_type";}?>-<?php echo date("Y");?> </div></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="1" cellspacing="1" cellpadding="1">
      <tr>
        <td width="7%">Roll No </td>
        <td width="10%">College Code </td>
        <td width="10%">Center Code </td>
        <td width="14%">Examinee Category </td>
        <td width="9%">Gender M/F </td>
        <td width="6%">Medium</td>
        <td width="22%">Permanent Registration No. (PRN) </td>
        <td width="22%">Enrolment No / Registration No </td>
      </tr>
      <tr>
        <td><?php if(isset($roll_number)){echo"$roll_number";}?></td>
        <td>447</td>
        <td>447</td>
        <td><?php if(isset($category_of_the_examinee)){echo"$category_of_the_examinee";}?></td>
        <td><?php if(isset($student_gender)){echo"$student_gender";}?></td>
        <td>English</td>
        <td><?php if(isset($pnr)){echo"$pnr";}?></td>
        <td><?php if(isset($enrollment_num)){echo"$enrollment_num";}?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="1" cellspacing="1" cellpadding="1">
      <tr>
        <td colspan="3"><div align="left">
          <p><strong>Name of Examinee and address: </strong></p>
          <p><?php if(isset($student_name)){echo"$student_name";}?></p>
          <p><?php if(isset($student_address)){echo"$student_address";}?></p>
  
          </div></td>
        <td width="22%"><div align="center"><img src="<?php if(isset($profile_pic)){echo"$profile_pic";}?>" width="120px" height="150px" /></div></td>
      </tr>
      <tr>
        <td colspan="3"><p align="left"><strong>Name of Examination Center And Address: </strong></p>
          <p align="left">447-J. D. INSTITUTE OF ENGINEERING & TECHNOLOGY, YAVATMAL</p>          </td>
        <td><div align="center"><img src="<?php if(isset($signature_pic)){echo"$signature_pic";}?>" width="256" height="64" /><br />Signature of Examinee </div></td>
      </tr>
      <tr>
        <td width="10%"><div align="center"><strong>Sr. No </strong></div></td>
        <td width="40%"><div align="center"><strong>Name of Subject Offered </strong></div></td>
        <td width="28%"><div align="center"><strong>Subject Code </strong></div></td>
        <td>&nbsp;</td>
      </tr>
	  
<?php
include "dbconnect.php";
$sql="select * from subjects where semester='{$semester}' and group_name='{$group_name}'";
$res=mysqli_query($con,$sql);
$nor=mysqli_num_rows($res);
if($nor>0){
	$nnc=1;
	while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
		$s_cd=$row['subject_code'];
		$s_nm=$row['subject_name'];
		if (in_array($s_cd,$sub_nm)) {
		$search='(Practical)';
		if(preg_match("/{$search}/i", $s_nm)) {
			
		}else{
		
		?>
		<tr>
        <td><div align="center"><?php if(isset($nnc)){echo"$nnc";} ?></div></td>
        <td><div align="left"><?php if(isset($s_nm)){echo"$s_nm";} ?></div></td>
        <td><div align="center"><?php if(isset($s_cd)){echo"$s_cd";} ?></div></td>
        <td>&nbsp;</td>
		</tr>
	  
		<?php
		$nnc=$nnc+1;
			}
		}
	}
}
	
?>	  
      
 
	  
      <tr>
        <td colspan="2"><div align="left">
          <p>Examinee is Permitted to appear in exam </p>
          <p>&nbsp;</p>
          <p>________________________________________</p>
        </div>Director Board Of Examinations and Evaluation </td>
        <td><div align="left">
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>___________________________________</p>
        </div>          Sign og Principal &amp; Seal </td>
        <td>&nbsp;</td>
      </tr>
      
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="50%"><p><strong>Rules :</strong></p>
          <p align="left">1 For diagrams use 2 HB pencil or the black ball pen only to avoid the unclear picture.<br />
            1 For diagrams use 2 HB pencil or the black ball pen only to avoid the unclear picture.<br />
            2.Use black pen only to write ur answer.<br />
            3.Examination will be held as per scheduled date and the time.<br />
            4.Examination hall shall be opened half an hour before the scheduled time on the first day of exam and 15 minutes before on the days follow<br />
            5.The candidate should occupy his seat in examination hall10 min before the commencement of exam<br />
            6.No candidate will allowed to take examination without admission card if necessary the admission card can checked.<br />
            7.The officer in charge may allow The late comer examinee hoto half hour after commencement of exam <br />
            8.Nobody will be allowed to go out of the examination hall during first hour.<br />
            9. Examines shall not be allowed to hand over his answer book before an hour,if acted contrarily,the examines shall not be allowed to take entry in the exam hall again.<br />
            10.Every candidates should maintain descipline in the exam hall,during examination.<br />
            <br />  
          </p>          </td>
        <td width="50%"><div align="left">
          <p>
            11.No examiee should bring any kind of books,written papers of any objectionable materials in the exam hall<br />
            12.The duplicate admission card can be obtain on payment of 50<br />
            13.Each candidates will be given answer book in the hall,on the cover page he should write clearly name of exam,roll no.,enrollment no., permanent registration no,name of subject,paper,subject code,date etc. Important information be written whenever necessary,in his eligible own handwriting very carefully , relevant matter should not be writes<br />
            14.Every examinee should leave the hall only after handing over his answer book to the investigator. After his entire satisfaction.<br />
            15.Every examinee should sign attendance sheet at the centre ,for each paper<br />
            16.Office in charge of the centre has power to take disciplinery step if an examinee is found using unfair means in the hall or violating the above rules ,or any of the examination rules.<br />
            17.The candidate using unfair means in the exam hall still be liable for punishment order.31 /1982 of maharashtra malpractice acts succession 7 and 9 and also u/s 32(6)(a )(b) of M.U At,1994.<br />
            18.If the candidate is unable to present himself&nbsp;&nbsp; for any exam he shall not be entitled for refund of his fees paid for examination.<br />
            19.Mobiles /electronic equipment are not allowed in the examination premises.</p>

        </div></td>
        
      </tr>
      <tr>
        <td colspan="2"><div align="left">
          <p><strong>Note :</strong></p>
          <p>1 Examinee is required to keep this admission card in examination hall,which have to be produce to the supervisor/investigator or the authorised person of university as and when required .<br />
            2.No supplementary answer book will provided.</p>
        </div></td>
        <td width="0%"><div align="left"></div></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
