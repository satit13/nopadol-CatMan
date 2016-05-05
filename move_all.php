<?php
echo "<meta charset='utf-8'>";
$myfile = fopen("setting/move.txt","r") or die("Unable to open file!");
$urlmove = fgets($myfile);
fclose($myfile);

$type = explode(";", $_POST['toNode']);
/*echo $_POST['FromNode']."<br />";
echo $_POST['item_id'][0]."<br />";*/
if($type[2]=="#"){
		echo "<script>alert('ท่านให้ข้อมูลไม่ครบ กรุณาเลือกข้อมูลให้ครบ!!!')
		window.history.back(1);
		</script>";
}else{
	$type = explode(":", $type[2]);



if($type[0]=="category"){
	
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
	/*$fromnode = $FN[0];//fromNode
	$fromnodename = $FN[1];//fromName*/

	$TN = explode(";", $_POST['toNode']);

	$tonode = $TN[1]; // ToNode
	$tonodename = $TN[0]; // ToName

	$cnt = count($_POST['item_id']);
	if($cnt <= 20){
	for($i=0;$i<$cnt;$i++){
			$IT = explode(";", $_POST['item_id'][$i]);
			$fromnode = $IT[2];//Fromnode
			$fromnodename = $IT[3];//Fromname
			$item = $IT[0]; //code
			$name1 = $IT[1]; // name1

			/*echo "ย้ายจาก".$fromnode.":";
			echo $fromnodename."<br>";
			echo "item คือ ".$item.":";
			echo $name1."<br>";
			echo "ย้ายไปยัง ".$tonode.":";
			echo $tonodename."<br><hr>";*/


		echo "<script>
		    if(confirm('ท่านต้องการย้าย item $item : $name1 จาก subcate $fromnodename ไปยัง $tonodename หรือไม่? ')){
		    }else{
		        window.history.back(1);
		    }
		</script>";

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
	}else{
		echo "<script>alert('ท่านไม่ควรเลือก สินค้าเกิน 20 อัน เพราะอาจทำให้เซริ์ฟเวอร์ ทำงานเกินขีดจำกัดได้ กรุณาเลือกใหม่')
			window.history.back(1)
			</script>
		";
	}
}else{
		echo "<script>alert('ท่านให้ข้อมูลไม่ครบ กรุณาเลือกข้อมูลให้ครบ!!!')
			window.history.back(1)
			</script>
		";
}

}

	echo "<script>
		window.location='manage_category.php'
		</script>
	";
?>