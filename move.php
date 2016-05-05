<?php
echo "<meta charset='utf-8'>";
$myfile = fopen("setting/move.txt","r") or die("Unable to open file!");
$urlmove = fgets($myfile);
fclose($myfile);

if(empty($_POST['FromNode'])||empty($_POST['toNode'])||empty($_POST['item_id'])){
	echo "<script>alert('ท่านให้ข้อมูลไม่ครบ กรุณาเลือกข้อมูลให้ครบ!!!')
		window.history.back(1)
		</script>
	";
}
//echo "Level = 4<br>";
$FN = explode(":", $_POST['FromNode']);

if($FN[1]=="ไม่มี subcate ต้นทาง"){
	$FN[1]="";
}
if($FN[0]==""){
	$FN[0]="0";
}
$fromnode = $FN[0];//fromNode
$fromnodename = $FN[1];//fromName

$TN = explode(";", $_POST['toNode']);

$tonode = $TN[1]; // ToNode
$tonodename = $TN[0]; // ToName

$cnt = count($_POST['item_id']);


for($i=0;$i<$cnt;$i++){
$IT = explode(";", $_POST['item_id'][$i]);

$item = $IT[0]; //code
$name1 = $IT[1]; // name1



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


}echo $output;
	echo "<script>
		window.location='move_item.php'
		</script>
	";
?>