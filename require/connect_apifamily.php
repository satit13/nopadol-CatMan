<?php
echo "<meta charset='utf-8'>";
$server1 = fopen("setting/server.txt","r") or die("Unable to open file!");
$urlserver = fgets($server1);
fclose($server1);

$myfile = fopen("setting/family.txt","r") or die("Unable to open file!");
$urlfamily = fgets($myfile);
fclose($myfile);
$token = 'your token here';
// set up the curl resource
$data = array (
	"search" => "",
	);
$data_string = json_encode($data); 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$urlserver.$urlfamily);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
//curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string)                                                                       
));       
// execute the request
$output = curl_exec($ch);
$end = "[";
$sub = explode("[",$output);
$end .= substr($sub[1],0,-1);
//echo $end;


?>