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
$urlmove = fgets($myfile);;
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
	"levelID" => "4",
	"fromNode" => $fromnode,
	"fromNodeName" => $fromnodename,
	"toNode" => $tonode,
	"toNodeName" =>  $tonodename,
	"code" => $item,
	"name1" => $name1
	);
	
$data_string = json_encode($data);
//echo var_dump(json_decode($data_string));
echo $data_string; 

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



/*$item2=$_POST['data2'];
$parent1=$_POST['pid1'];
$parent2=$_POST['pid2'];
//$b_data = array ("subCatCode" => $b_select
	//);
	//echo $item1."<br>";
	//echo $item2."<br>";
	//echo $parent1."<br>";
	//echo $parent2."<br>";
	
$item_ex1 = explode("--[",$item1);
$item_exp1 = array ();
$cnt1=count($item_ex1);$j=1;
$all1="";
while($j<$cnt1){
	$item_exp1[$j]=explode("]--",$item_ex1[$j]);
	//echo $item_exp1[$j][0]."<br>";
	if($j==($cnt1-1)){$all1.= "{".$item_exp1[$j][0]."}";}
	else{$all1.= "{".$item_exp1[$j][0]."},";}
	$j++;
	}
json_encode($all1);

$data = array (
	"levelID" => "4",
	"toNode" => $parent1,
	"code" => $all1
	);
	
	
$item_ex2 = explode("--[",$item2);
$item_exp2 = array ();
$cnt2=count($item_ex2);$i=1;
$all2="";
while($i<$cnt2){
	$item_exp2[$i]=explode("]--",$item_ex2[$i]);
	//echo $item_exp2[$i][0]."<br>";
	if($i==($cnt2-1)){$all2.= "{".$item_exp2[$i][0]."}";}
	else{$all2.= "{".$item_exp2[$i][0]."},";}
	$i++;
	}
json_encode($all2);

$data2 = array (
	"levelID" => "4",
	"toNode" => $parent2,
	"code" => $all2
	);
	
$data_string = json_encode($data); 
echo $data_string;
echo "<br>";
$data_string2 = json_encode($data2); 
echo $data_string2;
//echo "<textarea width='500'>$all</textarea>";
*/

?>

</body>
</html>