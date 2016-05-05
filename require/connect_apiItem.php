<?php
/**
 *  Example API call
 *  Create a new profile in a database
 */
// the databaseID
//$databaseID = 1;
//echo "<meta charset='utf-8'>";
	/*$linkOld = "itemcode.txt";
	$lopen = fopen($linkOld, 'r');     
    $link = fgets($lopen, 4096);    
    fclose($lopen); 
    if(isset($link)){$link=$link;
	$id = explode(";", $link);
	$id1= $id[1];
	}else 
	*/
	if(isset($_GET['xxx'])){
		$id1=$_GET['xxx'];
	}
echo $id1;
	
$data = array (
	"search" => "",
	"subCatCode" => $id1
	);
$server1 = fopen("setting/server.txt","r") or die("Unable to open file!");
$urlserver = fgets($server1);
fclose($server1);	
	
$myfile = fopen("setting/items.txt","r") or die("Unable to open file!");
$urlitems = fgets($myfile);
fclose($myfile);

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
//echo $item;


?>