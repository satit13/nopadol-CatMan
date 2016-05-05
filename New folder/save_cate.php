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
if(isset($_GET['fromnodename']) && $_GET['fromnodename']!=""){  
    $fromnodename= $_GET['fromnodename']; // ตัวอย่าง  
}

//=================================== TONODE ==============================================

if(isset($_GET['tonode']) && $_GET['tonode']!=""){  
    $tonode= $_GET['tonode']; // ตัวอย่าง  
}
if(isset($_GET['tonodename']) && $_GET['tonodename']!=""){  
    $tonodename= $_GET['tonodename']; // ตัวอย่าง  
} 
//=========================================================================================

$data = array (
	"levelID" => "3",
	"fromNode" => $fromnode,
	"fromNodeName" => $fromnodename,
	"toNode" => $tonode,
	"toNodeName" =>  $tonodename,
	"code" => $item,
	"name1" => $name1
	);
	
$data_string = json_encode($data);
//echo var_dump($data_string);
//echo var_dump(json_decode($data_string));
//echo $data_string;  
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

?>

</body>
</html>