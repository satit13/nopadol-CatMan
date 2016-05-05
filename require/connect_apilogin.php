<?php
session_start();

$myfile = fopen("../setting/login.txt","r") or die("Unable to open file!");
$urllogin = fgets($myfile);
fclose($myfile);

$server1 = fopen("../setting/server.txt","r") or die("Unable to open file!");
$urlserver = fgets($server1);
fclose($server1);

if(isset($_POST['username'])){$username=$_POST['username'];}
if(isset($_POST['passwd'])){$passwd=$_POST['passwd'];}
	
$data = array (
	"userID" => $username,
	"pwd" => $passwd
	);


// json encode data
$data_string = json_encode($data); 
// the token
$token = 'your token here';
// set up the curl resource
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$urlserver.$urllogin);
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
$out=json_decode($output,true);
//echo $sub_y->{'docYear'};
$cnt=count($output);
//echo $out["userID"]."<br>";
//echo $out["userName"]."<br>";
//echo $out["levelID"]."<br>";
//echo $out["resp"]["success"]."<br>";
$_SESSION['login_type']=$out["userName"];
if($out["resp"]["success"]=="1"){echo "<script>window.location='../manage_category.php'</script>";}
else if($out["resp"]["success"]==""){
	$_SESSION['result'] = "<script language='javascript'>alert('Username หรือ Password ไม่ถูกต้อง');</script>";
	echo "<script>window.location='../index.php'</script>";
}

?>