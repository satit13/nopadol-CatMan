<?php
echo "<meta charset='utf-8'>";
$myfile = fopen("setting/insert.txt","r") or die("Unable to open file!");
$urlinsert = fgets($myfile);;
fclose($myfile);

if(empty($_GET['cate'])){
	$_GET['cate']="";
}
/*
echo "รหัส parent ".$_GET['level']."<br>";
echo "ฐานข้อมูลที่จะเพิ่ม ".$_GET['title']."<br>";
echo "Node ที่ใช้เกาะ ".$_GET['parent']."<br>";
echo "ชื่อรายการ ".$_GET['Thainame']."<br>";
echo "ชื่อรายการ ".$_GET['Engname']."<br>";
echo "หมายเหตุ ".$_GET['remark']."<br>";
echo "ผู้จัดการ ".$_GET['cate']."<br>";*/

/*$json = '{"level":"'.$_GET['level'].'","parent":"'.$_GET['parent'].'","thainame":"'.$_GET['Thainame'].'","engname":"'.$_GET['Engname'].'","remark":"'.$_GET['remark'].'"}';*/

//echo $json."<br>";
//echo "<br><br><br>";

//$js=json_encode($json);
//$data_string = json_decode($js);

$data = array (
	"levelID" => $_GET['level'],
	"parentCode" => $_GET['parent'],
	"thaiName" => $_GET['Thainame'],
	"engName" => $_GET['Engname'],
	"remark" => $_GET['remark'],
	"expertCode" => $_GET['cate']
	);
// json encode data
$data_string = json_encode($data); 
// the token
$token = 'your token here';
// set up the curl resource
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$urlinsert);
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
echo "<script>alert('เพิ่มข้อมูลเรียบร้อยแล้ว !!')</script>";
echo "<script>window.location='manage_category.php'</script>";
?>