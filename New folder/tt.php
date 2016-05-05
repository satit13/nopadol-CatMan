<!doctype html>
<html>
<head>
<meta charset="utf-8">

<title>Untitled Document</title>
</head>

<body>
<?php 
header('Content-type: application/json;charset=utf-8');


$myfile = fopen("setting/move.txt","r") or die("Unable to open file!");
$urlmove = fgets($myfile);
fclose($myfile);


if(isset($_GET['level']) && $_GET['level']!=""){  
    $level= $_GET['level']; // ตัวอย่าง  
}
//====================================== ITEM =============================================
if(isset($_GET['code']) && $_GET['code']!=""){  
    $item= $_GET['code']; // ตัวอย่าง  
}
if(isset($_GET['name']) && $_GET['name']!=""){  
    $name1= $_GET['name']; // ตัวอย่าง  
}

//====================================== FROMNODE =========================================

if(isset($_GET['fromnode']) && $_GET['fromnode']!=""){  
    $fromnode= $_GET['fromnode']; // ตัวอย่าง  
}

//=================================== TONODE ==============================================

if(isset($_GET['tonode']) && $_GET['tonode']!=""){  
    $tonode= $_GET['tonode']; // ตัวอย่าง  
}
//=========================================================================================
$fromnodename="";$tonodename="";

//====================================family=============================
if($level==1){
require("require/connect_apifamily.php");

$f_out=json_decode($end,true);
$f_result = array();
foreach ($f_out as $f_row) {
  $f_result[$f_row['code']]['code'] = $f_row['code'];
  $f_result[$f_row['code']]['thaiName'] = $f_row['thaiName'];
 
}
  $f_result = array_values($f_result);

      
$fnt=count($f_result);
$f_dd = array_values($f_result);
	for($f=0;$f<$fnt;$f++){
		if($fromnode==$f_result[$f]['code']){
		$fromnodename =$f_result[$f]['thaiName'];}
		
		if($tonode==$f_result[$f]['code']){
		$tonodename =$f_result[$f]['thaiName'];}

	}
//====================================department=============================
}else if($level==2){
require("require/connect_apiDepartment.php");

$d_out=json_decode($Depart,true);
$d_result = array();
foreach ($d_out as $d_row) {
  $d_result[$d_row['code']]['code'] = $d_row['code'];
  $d_result[$d_row['code']]['thaiName'] = $d_row['thaiName'];
 
}
  $d_result = array_values($d_result);

      
$dnt=count($d_result);
$d_dd = array_values($d_result);
	for($d=0;$d<$dnt;$d++){
		if($fromnode==$d_result[$d]['code']){
		$fromnodename =$d_result[$d]['thaiName'];}
		
		if($tonode==$d_result[$d]['code']){
		$tonodename =$d_result[$d]['thaiName'];}

	}
//====================================category=============================	
}else if($level==3){
require("require/connect_apicategory.php");

$c_out=json_decode($cate,true);
$c_result = array();
foreach ($c_out as $c_row) {
  $c_result[$c_row['code']]['code'] = $c_row['code'];
  $c_result[$c_row['code']]['thaiName'] = $c_row['thaiName'];
 
}
  $c_result = array_values($c_result);

      
$cnt=count($c_result);
$c_dd = array_values($c_result);
	for($c=0;$c<$cnt;$c++){
		if($fromnode==$c_result[$c]['code']){
		$fromnodename =$c_result[$c]['thaiName'];}
		
		if($tonode==$c_result[$c]['code']){
		$tonodename =$c_result[$c]['thaiName'];}

	}
}




//====================================sub-category=============================

$data = array (
	"levelID" => $level,
	"fromNode" => $fromnode,
	"fromNodeName" => $fromnodename,
	"toNode" => $tonode,
	"toNodeName" =>  $tonodename,
	"code" => $item,
	"name1" => $name1
	);
	
$data_string = json_encode($data);
echo var_dump($data);
//echo var_dump(json_decode($data_string));
/* 
$t_ch = curl_init();
curl_setopt($t_ch, CURLOPT_URL,$urlmove);
curl_setopt($t_ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($t_ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($t_ch, CURLOPT_POST, true);
curl_setopt($t_ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($t_ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string)                                                                       
));
$output = curl_exec($t_ch);
echo $output;
*/
?>

</body>
</html>