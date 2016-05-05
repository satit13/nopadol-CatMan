<?php
	if(isset($_GET['id'])){
	$code=explode(":", $_GET['id']);
/*
	echo "level :".$code[0]."<br>";
	echo "code  :".$code[1];
*/
	$level = $code[0];
	$code = $code[1];

		switch ($level) {
			case 'family':
				$level=0;
				break;		
			case 'Department':
				$level=1;
				break;
			case 'category':
				$level=2;
				break;
			case 'subcate':
				$level=3;
				break;
			case 'items':
				$level=4;
				break;			
		}
	}

$myfile = fopen("setting/delete.txt","r") or die("Unable to open file!");
$urldelete = fgets($myfile);;
fclose($myfile);
	$data = array (
	"levelID" => $level,
	"code" => $code
	);
// json encode data
$data_string = json_encode($data); 
// the token
$token = 'your token here';
// set up the curl resource
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$urldelete);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string)                                                                       
));       
// execute the request
$output = curl_exec($ch);
//echo $output;

echo "<script>window.location='manage_category.php'</script>";

?>