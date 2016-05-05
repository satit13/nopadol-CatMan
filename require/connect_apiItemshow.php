<?php
$myfile = fopen("../setting/items.txt","r") or die("Unable to open file!");
$urlitems = fgets($myfile);
fclose($myfile);

$server1 = fopen("../setting/server.txt","r") or die("Unable to open file!");
$urlserver = fgets($server1);
fclose($server1);



	if(isset($_GET['getid'])){
		$id1=$_GET['getid'];
	}
	
$data = array (
	"search" => "",
	"subCatCode" => $id1
	);


// json encode data
$data_string = json_encode($data); 
// the token
$token = 'your token here';
// set up the curl resource
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$urlserver.$urlitems);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string)                                                                       
));       
// execute the request
$output = curl_exec($ch);
// output the profile information - includes the header
//echo $output."<br>";
//$sub = substr($output,9);
$item = "[";
$sub = explode(":[",$output);
$item .= substr($sub[1],0,-1);
$out=json_decode($item,true);
$result = array();

echo"<table border='0' width='100%'>";
echo"<tr><th>รหัสสินค้า</th><th>ชื่อสินค้า</th><th>หน่วยนับ</th></tr>";
foreach ($out as $row) {
  $result[$row['itemCode']]['itemCode'] = $row['itemCode'];
  $result[$row['itemCode']]['itemName'] = $row['itemName'];
  $result[$row['itemCode']]['unitCode'] = $row['unitCode'];
 
}
  $result = array_values($result);

      
$bnt=count($result);
$b_dd = array_values($result);
for($b=0;$b<$bnt;$b++){
	
echo"<tr><td>".$result[$b]['itemCode']." </td><td>".$result[$b]['itemName']."</td><td>".$result[$b]['unitCode']."</td></tr>";
}

echo "</table>";

?>