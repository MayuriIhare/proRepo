<?php
session_start();
ob_start();
include "dbconnect.php";
if(isset($_REQUEST['roll_number']) && isset($_REQUEST['sem'])){
extract($_REQUEST);

$sql="select * from forms where roll_number='{$roll_number}' and semester='{$sem}'";	
$res=mysqli_query($con,$sql);
$nor=mysqli_num_rows($res);
if($nor>0){
while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
	$student_id=$row['student_id'];
	$exam_type=$row['exam_type'];
	$exam_year=$row['exam_year'];
	$semester=$row['semester'];
	$group_name=$row['group_name'];
	
$sql1="select * from student where student_id='{$student_id}'";	
$res1=mysqli_query($con,$sql1);
$nor1=mysqli_num_rows($res1);
if($nor1>0){
while($row1=mysqli_fetch_array($res1,MYSQLI_ASSOC)){
	extract($row1);
	}
}else{
	exit(header("Location: ./Result.php?msg=No Records Found!"));
}
	
}
}else{
	exit(header("Location: ./Result.php?msg=No Records Found!"));
}
}

if(isset($_SESSION['grace']) && !empty($_SESSION['grace'])){
	$cntg=count($_SESSION['grace']);
	if($cntg>1){
		unset($_SESSION['grace']);
		
	}else{
$_SESSION['gracemarks']="true";		
	}
}

if(isset($_SESSION['condo']) && !empty($_SESSION['condo'])){
	
	echo $cntc=count($_SESSION['condo']);
	if($cntc>2){
		unset($_SESSION['condo']);
$_SESSION['condomarks']="false";			
	}else{
$tcct=0;
$sql39="select subject_code from subjects group by subject_code";	
$res39=mysqli_query($con,$sql39);
$nor39=mysqli_num_rows($res39);
if($nor39>0){
while($row39=mysqli_fetch_array($res39,MYSQLI_ASSOC)){
	$subject_code=$row39['subject_code'];
	if(isset($_SESSION['condo'][$subject_code])){
		$tcct=$tcct+$_SESSION['condo'][$subject_code];
		
	}
	
	}
}
if($tcct<=6){
	$_SESSION['condottl']=$tcct;
$_SESSION['condomarks']="true";		
}else{
unset($_SESSION['condo']);
}	
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Home Examination System</title>
 
</head>

<body style="background-color:#dddddd;">
    <form method="post" action="Result.php" enctype="multipart/form-data">
        <center>
            <table width="80%" border="0" cellspacing="5" cellpadding="5" style="box-shadow: 25px 25px 75px grey;">
                <tr>
                    <th colspan="4" bgcolor="#af5cd3" scope="col">
                        <h1 align="center" class="style3">&nbsp;</h1>
                        <h1 align="center" class="style3"><strong><span class="style1">Home Exam Management System</span></strong></h1>
                        <p align="center" class="style3">&nbsp;</p>
                    </th>
                </tr>
                <tr>
                    <td bgcolor="#6858d2">
                        <div align="center"><a style="color:white;" href="index.php">Home</a></div>
                    </td>
                    <td bgcolor="#6858d2">
                        <div align="center"><a style="color:white;" href="Registration.php">Registration</a></div>
                    </td>
                    <td bgcolor="#6858d2">
                        <div align="center"><a style="color:white;" href="Login.php">Login</a></div>
                    </td>
                    <td bgcolor="#6858d2">
                        <div align="center"><a style="color:white;" href="Result.php">Result</a></div>
                        <div align="center"></div>
                        <div align="center"></div>
                    </td>
                </tr>
                <tr>
                    <td height="400" colspan="4" bgcolor="#FFFFFF">

                        <div class="row">

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="well with-header">
                                    <div class="header bg-sonic-silver">
                                        <span>Result Details</span>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="print_result" style="border: 1px solid; background:#fff none repeat scroll 0 0; padding: 5px; width:100%">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <table width="100%" style=" margin-bottom: 14px;">
                                                            <tbody>
                                                                <tr align="center">
                                                                    <td><img alt="" src="./S.G.B.A. University, Amravati_files/sgbau_logo(1).jpg" height="60"></td>
                                                                </tr>
                                                                <tr align="center">
                                                                    <td style="font-size:15px;font-weight: bold;" align="center">Results - <?php $sset=strtoupper($exam_type); echo"$sset"; ?> <?php echo"$exam_year"; ?></td>
                                                                </tr>
                                                                <tr align="center">
                                                                    <td style="font-size:15px;font-weight: bold;" align="center"> FOUR YEAR B.E. <?php $ssm=strtoupper($semester); echo"$ssm"; ?>  <?php $ssgn=strtoupper($group_name); echo"$ssgn"; ?> (<?php $ssb=strtoupper($student_branch); echo"$ssb"; ?>) (CGS) </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <table style="width: 80%; margin-left:35px;margin-bottom:10px;">
                                                            <tbody>
                                                                <tr style=" text-align: left;">
                                                                    <td style="font-family:Arial;font-weight:bold; font-size:15px; ">Name </td>
                                                                    <td>:&nbsp;&nbsp;&nbsp;</td>
                                                                    <td style="font-family:Arial;font-weight:bold; font-size:15px; "><?php echo"$student_name"; ?> </td>
                                                                </tr>
                                                               
                                                                <tr style=" text-align: left;">
                                                                    <td style="font-family:Arial;font-weight:bold; font-size:15px; ">Roll Number </td>
                                                                    <td>:&nbsp;&nbsp;&nbsp;</td>
                                                                    <td style="font-family:Arial;font-weight:bold; font-size:15px; "><?php echo"$roll_number"; ?> </td>
                                                                </tr>
                                                                <tr style=" text-align: left;">
                                                                    <td style="font-family:Arial;font-weight:bold; font-size:15px; ">PRN </td>
                                                                    <td>:&nbsp;&nbsp;&nbsp;</td>
                                                                    <td style="font-family:Arial;font-weight:bold; font-size:15px; "><?php echo"$pnr"; ?> </td>
                                                                </tr>
                                                                <tr style=" text-align: left;">
                                                                    <td style="font-family:Arial; font-weight:bold; font-size:15px; "> College </td>
                                                                    <td>:&nbsp;&nbsp;&nbsp;</td>
                                                                    <td style="font-family:Arial;font-weight:bold; font-size:15px; ">Jawaharlal Darda Institute of Engineering and Technology,Yavatmal </td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table id="print_data" border="1" style="width: 98%; padding: 5px; margin: 10px; text-align: center;border: 1px solid;border-collapse: collapse;
    border-spacing: 0;">
                                                            <thead>
                                                                <tr>
                                                                    <th style="font-weight:bold; font-family:Arial; font-size:13.6px; border:1px solid;padding:12px; ">Subject</th>
                                                                    <th style="font-weight:bold; font-family:Arial; font-size:13.6px; border:1px solid; padding:12px;">Paper</th>
                                                                    <th style="font-weight:bold; font-family:Arial; font-size:13.6px; border:1px solid; padding:12px;">Max Marks</th>

                                                                    <th style="font-weight:bold; font-family:Arial; font-size:13.6px; border:1px solid;padding:12px;">Marks Scored</th>
                                                                    <th style="font-weight:bold; font-family:Arial; font-size:13.6px; border:1px solid;padding:12px;">Grade Point</th>
                                                                    <th style="font-weight:bold; font-family:Arial; font-size:13.6px; border:1px solid;padding:12px;">Grade</th>
                                                                    <th style="font-weight:bold; font-family:Arial; font-size:13.6px; border:1px solid;padding:12px;">Remarks</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody style="font-family: Arial; font-weight: bold; font-size: 13px;">
<?php
if(isset($_REQUEST['roll_number']) && isset($_REQUEST['sem'])){
extract($_REQUEST);
$CheckPass="Pass";	
$sql2="select * from forms where roll_number='{$roll_number}' and semester='{$sem}'";	
$res2=mysqli_query($con,$sql2);
$nor2=mysqli_num_rows($res2);
if($nor2>0){
while($row2=mysqli_fetch_array($res2,MYSQLI_ASSOC)){

for($c=1;$c<=4;$c++){
	
$subject_cod=$row2['subject'.$c.'_cod'];
	
$sql3="select * from subjects where subject_code='{$subject_cod}'";	
$res3=mysqli_query($con,$sql3);
$nor3=mysqli_num_rows($res3);
if($nor3>0){
while($row3=mysqli_fetch_array($res3,MYSQLI_ASSOC)){
	$subject_name=$row3['subject_name'];
	}
}

$sql4="select * from marks where roll_number='{$roll_number}' and marks_for='ETM'";	
$res4=mysqli_query($con,$sql4);
$nor4=mysqli_num_rows($res4);
if($nor4>0){
while($row4=mysqli_fetch_array($res4,MYSQLI_ASSOC)){
		$ETM_marks=null;
		if($subject_cod==$row4['subject1_cod']){
			$ETM_marks=$row4['subject1_marks'];
		}elseif($subject_cod==$row4['subject2_cod']){
			$ETM_marks=$row4['subject2_marks'];
		}elseif($subject_cod==$row4['subject3_cod']){
			$ETM_marks=$row4['subject3_marks'];
		}elseif($subject_cod==$row4['subject4_cod']){
			$ETM_marks=$row4['subject4_marks'];
		}
	}
}


$sql5="select * from marks where roll_number='{$roll_number}' and marks_for='ITM'";	
$res5=mysqli_query($con,$sql5);
$nor5=mysqli_num_rows($res5);
if($nor5>0){
while($row5=mysqli_fetch_array($res5,MYSQLI_ASSOC)){
		$ITM_marks=null;
		if($subject_cod==$row5['subject1_cod']){
			$ITM_marks=$row5['subject1_marks'];
		}elseif($subject_cod==$row5['subject2_cod']){
			$ITM_marks=$row5['subject2_marks'];
		}elseif($subject_cod==$row5['subject3_cod']){
			$ITM_marks=$row5['subject3_marks'];
		}elseif($subject_cod==$row5['subject4_cod']){
			$ITM_marks=$row5['subject4_marks'];
		}
	}
}

?>

<tr>
<td rowspan="2" style="text-align:left;"><?php if(isset($subject_name)){ echo"$subject_name"; } ?></td>
<td>THEORY</td>
<td>80</td>
<td>
<?php 
if(isset($_SESSION['gracemarks']) && $_SESSION['gracemarks']=="true" && isset($_SESSION['grace'][$subject_cod])){
	
$ETM_marks=($_SESSION['grace'][$subject_cod]+$ETM_marks);

echo"$ETM_marks"."*";

}elseif(isset($_SESSION['condomarks']) && $_SESSION['condomarks']=="true" && isset($_SESSION['condo'][$subject_cod])){

$ETM_marks=($_SESSION['condo'][$subject_cod]+$ETM_marks);

echo "$ETM_marks"."**";

}else{

echo"$ETM_marks"; 

} ?>
</td>
<td rowspan="2">
<?php if(isset($ITM_marks) && isset($ETM_marks)){ 

if($ETM_marks=="AB" || $ITM_marks=="AB"){
	$grade_points="-";
}else{
	$grade_points=($ETM_marks+$ITM_marks);

if(isset($_SESSION['gracemarks'])){
	
}else{
if($grade_points<40 && (40-$grade_points)<=3)
{
$_SESSION['grace'][$subject_cod]=(40-$grade_points);
}
}

if(isset($_SESSION['condomarks'])){
	
}else{
if($grade_points<40 && (40-$grade_points)<=6)
{
$_SESSION['condo'][$subject_cod]=(40-$grade_points);
}
}
}

$gp=null;

if($grade_points=="-"){
	$gp="-";
}elseif($grade_points>=80 && $grade_points<=100){
	$gp=10;
}elseif($grade_points>=70 && $grade_points<80){
	$gp=9;
}elseif($grade_points>=60 && $grade_points<70){
	$gp=8;
}elseif($grade_points>=55 && $grade_points<60){
	$gp=7;
}elseif($grade_points>=50 && $grade_points<55){
	$gp=6;
}elseif($grade_points>=45 && $grade_points<50){
	$gp=5;
}elseif($grade_points>=40 && $grade_points<45){
	$gp=4;
}elseif($grade_points>=00 && $grade_points<40){
	$gp=0;
}
echo"$gp";
 } ?>
</td>
<td rowspan="2">
<?php
if($gp==10){
$grade="AA";
}elseif($gp==9){
$grade="AB";
}elseif($gp==9){
$grade="AB";
}elseif($gp==8){
$grade="BB";
}elseif($gp==7){
$grade="BC";
}elseif($gp==6){
$grade="CC";
}elseif($gp==5){
$grade="CD";
}elseif($gp==4){
$grade="DD";
}elseif($gp==0){
$grade="FF";
$CheckPass="Fail";
}elseif($gp=="-"){
$grade="ZZ";
$CheckPass="Fail";
}

echo"$grade";
?>
</td>
<td rowspan="2"></td>
</tr>
<tr>
<td>I.A.</td>
<td>20</td>
<td><?php if(isset($ITM_marks)){ echo"$ITM_marks"; } ?></td>
</tr>
<?php
}	
	/////////////////////////////////////////////////////////////////////////////////////
	
	
for($c=5;$c<=8;$c++){
	
$subject_cod=$row2['subject'.$c.'_cod'];
	
$sql3="select * from subjects where subject_code='{$subject_cod}'";	
$res3=mysqli_query($con,$sql3);
$nor3=mysqli_num_rows($res3);
if($nor3>0){
while($row3=mysqli_fetch_array($res3,MYSQLI_ASSOC)){
	$subject_name=$row3['subject_name'];
	}
}

$sql4="select * from marks where roll_number='{$roll_number}' and marks_for='EPM'";	
$res4=mysqli_query($con,$sql4);
$nor4=mysqli_num_rows($res4);
if($nor4>0){
while($row4=mysqli_fetch_array($res4,MYSQLI_ASSOC)){
		$EPM_marks=null;
		if($subject_cod==$row4['subject1_cod']){
			$EPM_marks=$row4['subject1_marks'];
		}elseif($subject_cod==$row4['subject2_cod']){
			$EPM_marks=$row4['subject2_marks'];
		}elseif($subject_cod==$row4['subject3_cod']){
			$EPM_marks=$row4['subject3_marks'];
		}elseif($subject_cod==$row4['subject4_cod']){
			$EPM_marks=$row4['subject4_marks'];
		}
	}
}


$sql5="select * from marks where roll_number='{$roll_number}' and marks_for='IPM'";	
$res5=mysqli_query($con,$sql5);
$nor5=mysqli_num_rows($res5);
if($nor5>0){
while($row5=mysqli_fetch_array($res5,MYSQLI_ASSOC)){
		$IPM_marks=null;
		if($subject_cod==$row5['subject1_cod']){
			$IPM_marks=$row5['subject1_marks'];
		}elseif($subject_cod==$row5['subject2_cod']){
			$IPM_marks=$row5['subject2_marks'];
		}elseif($subject_cod==$row5['subject3_cod']){
			$IPM_marks=$row5['subject3_marks'];
		}elseif($subject_cod==$row5['subject4_cod']){
			$IPM_marks=$row5['subject4_marks'];
		}
	}
}

?>

<tr>
<td rowspan="2" style="text-align:left;"><?php if(isset($subject_name)){ echo"$subject_name"; } ?></td>
<td>PRACTICAL</td>
<td>25</td>
<td><?php if(isset($EPM_marks)){ echo"$EPM_marks"; } ?></td>
<td rowspan="2">
<?php if(isset($IPM_marks) && isset($EPM_marks)){ 

if($EPM_marks=="AB" || $IPM_marks=="AB"){
	$grade_points="-";
}else{
	$grade_points=(($EPM_marks+$IPM_marks)/50)*100;
}

$gp=null;

if($grade_points=="-"){
	$gp="-";
}elseif($grade_points>=85 && $grade_points<=100){
	$gp=10;
}elseif($grade_points>=80 && $grade_points<85){
	$gp=9;
}elseif($grade_points>=75 && $grade_points<80){
	$gp=8;
}elseif($grade_points>=70 && $grade_points<75){
	$gp=7;
}elseif($grade_points>=65 && $grade_points<70){
	$gp=6;
}elseif($grade_points>=60 && $grade_points<65){
	$gp=5;
}elseif($grade_points>=50 && $grade_points<60){
	$gp=4;
}elseif($grade_points>=00 && $grade_points<50){
	$gp=0;
}
echo"$gp";
 } ?>
</td>
<td rowspan="2">
<?php
if($gp==10){
$grade="AA";
}elseif($gp==9){
$grade="AB";
}elseif($gp==9){
$grade="AB";
}elseif($gp==8){
$grade="BB";
}elseif($gp==7){
$grade="BC";
}elseif($gp==6){
$grade="CC";
}elseif($gp==5){
$grade="CD";
}elseif($gp==4){
$grade="DD";
}elseif($gp==0){
$grade="FF";
$CheckPass="Fail";
}elseif($gp=="-"){
$grade="ZZ";
$CheckPass="Fail";
}

echo"$grade";
?>
</td>
<td rowspan="2"></td>
</tr>
<tr>
<td>I.A. (Practical)</td>
<td>25</td>
<td><?php if(isset($IPM_marks)){ echo"$IPM_marks"; } ?></td>
</tr>
<?php
}

	
}
}
}
?>
                                                                
                                                                
																
																
																
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table align="center" style="width:65%;line-height:60px;">
                                                            <tbody style="font-family: Arial; font-weight: bold; font-size: 13px;">
                                                                <tr>
                                                                    <td align="center">Max Marks :</td>
                                                                    <td> 600 </td>
                                                                    <td align="center">Result :</td>
                                                                    <td align="right"> <?php if(isset($CheckPass)){ echo"$CheckPass"; } ?>
                                                                    </td>

                                                                    <td align="right">SGPA :</td>
                                                                    <td>8.07</td>

                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table>
                                                            <tbody style="width:auto;font-family: Arial; font-weight: bold; font-size: 12px;">
                                                                <tr>
                                                                    <td>Abbreviation:&nbsp;&nbsp;</td>
<?php
$sql2="select * from forms where roll_number='{$roll_number}' and semester='{$sem}'";	
$res2=mysqli_query($con,$sql2);
$nor2=mysqli_num_rows($res2);
if($nor2>0){
while($row2=mysqli_fetch_array($res2,MYSQLI_ASSOC)){
for($c=1;$c<=8;$c++){
$subject_cod=$row2['subject'.$c.'_cod'];
	
$sql3="select * from subjects where subject_code='{$subject_cod}' limit 1";	
$res3=mysqli_query($con,$sql3);
$nor3=mysqli_num_rows($res3);
if($nor3>0){
while($row3=mysqli_fetch_array($res3,MYSQLI_ASSOC)){
	$subject_name=$row3['subject_name'];
	?>
	
	<td><?php echo"$subject_cod"; ?>-<?php echo"$subject_name"; ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	
	<?php
	}
}

}
}
}

?>                                                                   
                                                                    
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                           
                                                    <td align="left" style="font-family: Arial; font-weight: bold; font-size: 13px;">
                                                        Date of declaration: 11-02-2019
                                                        <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@= Passes by incentive marks vide ordinance no. 1 of 1985
                                                        <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*= Passes by Grace Marks vide Ordinance no. 18 of 2001
                                                        <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;**= Passes by condonation marks vide ordinance no. 18 of 2001
                                                        <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"Sant Gadge Baba Amravati University, Amravati is not responsible for any inadvertent error that may have incepted due to internet error and bugs in the result being published on net.
                                                        <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <font color="red">The Result/Marks statement published on net are for immediate information to the Student"</font> Original mark sheets have been issued by the University via respective colleges and only these Marks statement is considered as <font color="red">Authentic for any purpose.</font>"
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <a class="btn btn-warning btn-lg" href="javascript:void(0);" onclick="printConfirm();">Print</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            function printConfirm() {
                               
                                var divToPrint = document.getElementById('print_result');
                                newWin = window.open("");
                                newWin.document.write(divToPrint.outerHTML);
                                newWin.print();
                                newWin.close();
                               
                            }
                        </script>

                    </td>
                </tr>
                <tr>
                    <td colspan="4" bgcolor="#6858d2">
                        <div align="center" style="color:white;">Copyright @ JDIET Yavatmal </div>
                    </td>
                </tr>
            </table>
    </form>
</body>

</html>
<?php
if(isset($_SESSION['redirect']) && $_SESSION['redirect']=="true"){
$_SESSION['redirect']="false";	
exit(header("Location: ./Result_Details2.php?roll_number=$roll_number&sem=$sem&test=true"));
}
?>