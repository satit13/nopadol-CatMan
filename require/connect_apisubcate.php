<?php
$myfile = fopen("setting/subcate.txt","r") or die("Unable to open file!");
$urlsubcate = fgets($myfile);
fclose($myfile);

$server1 = fopen("setting/server.txt","r") or die("Unable to open file!");
$urlserver = fgets($server1);
fclose($server1);

$token = 'your token here';
$data = array (
	"search" => "",
	);
$data_string = json_encode($data); 
// set up the curl resource
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$urlserver.$urlsubcate);
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
// output the profile information - includes the header
//echo $output."<br>";
//$sub = substr($output,9);
$subcate = "[";
$sub = explode("[",$output);
$subcate .= substr($sub[1],0,-1);
//echo $subcate;


?>