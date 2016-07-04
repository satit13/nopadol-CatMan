<!DOCTYPE html>
<head>
	<title>Manage Category</title>  
	<link rel="stylesheet" href="dist\themes\default\style.min.css" />
	<link rel="stylesheet" href="css/style.css" />	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<link rel="stylesheet" href="css/bootstrap.css" />
<script>function check(){
	if(document.forms["edit"]["Thainame"].value=="" ||document.forms["edit"]["Thainame"].value==null ){
		alert("กรุณากรอกข้อมูลให้ครบถ้วน")
		document.forms["edit"]["Thainame"].focus();
		return false;
		}
		if(document.forms["edit"]["Engname"].value=="" ||document.forms["edit"]["Engname"].value==null ){
		alert("กรุณากรอกข้อมูลให้ครบถ้วน")
		document.forms["edit"]["Engname"].focus();
		return false;
		}
	}
</script>
</head>
<body>
<div id="header"><h1 class="hleft"> Manage Category</h1></div>
<div style="height: 55px;"></div>
<br><h1 class="head">แก้ไขข้อมูล</h1>
    <hr class="hr">
	<?php

/*$parent = "";
$code = "";
$thainame = "";
$engname = "";
$remark = "";*/

	if(isset($_GET['id'])){
	$code=explode(":", $_GET['id']);

	$level = $code[0];
	$code = $code[1];
	}

	if(isset($_GET['level'])&&isset($_GET['code'])){
	
	$level = $_GET['level'];
	$code = $_GET['code'];
	}
	if($level=='items'){
		$linkOld = "itemcode.txt";
		$lopen = fopen($linkOld, 'r');     
	    $link = fgets($lopen, 4096);    
	    fclose($lopen); 
	    if(empty($link)){ $link='""';}else{$link=$link;}
	    $id = explode(";", $link);
		$parent= $id[1];
	}else{
		$parent = "";
	}
	switch ($level) {
		case 'family':
				echo "<p style='display:none'>";
				require("require/connect_apifamily.php");
				$out_F=json_decode($end,true);
				echo "</p>";
				$fsub = array();
				$cntF=0;
				foreach ($out_F as $row) {
				  $fsub[$row['code']]['code'] = $row['code'];
				  $fsub[$row['code']]['thaiName'] = $row['thaiName'];
				  $fsub[$row['code']]['parentCode'] = $row['parentCode'];
				  $fsub[$row['code']]['engName'] = $row['engName'];
				  $fsub[$row['code']]['remark'] = $row['remark'];
				 
				}
				  $fsub = array_values($fsub);

				      $fam = array();
				      foreach ($fsub as $k => $v) {
				      $fam['code'][$k] = $v['code'];
				      $fam['thaiName'][$k] = $v['thaiName'];
				      $fam['parentCode'][$k] = $v['parentCode'];
				      $fam['engName'][$k] = $v['engName'];
				      $fam['remark'][$k] = $v['remark'];
				      
				    	}
				    $cntF=count($fsub);
				    for($i=0;$i<$cntF;$i++){
				    	if($code == $fam['code'][$i]){
				    		$parent = $fam['parentCode'][$i];
				    		$code = $fam['code'][$i];
				    		$thainame = $fam['thaiName'][$i];
				    		$engname = $fam['engName'][$i];
				    		$remark = $fam['remark'][$i];
				    	}
				    }
				
			break;
		
		case 'Department':
			echo "<p style='display:none'>";
				require("require/connect_apiDepartment.php");
				$out_D=json_decode($Depart,true);
				echo "</p>";				
				$Dsub = array();
				$cntD=0;
				foreach ($out_D as $row) {
				  $dsub[$row['code']]['code'] = $row['code'];
				  $dsub[$row['code']]['thaiName'] = $row['thaiName'];
				  $dsub[$row['code']]['parentCode'] = $row['parentCode'];
				  $dsub[$row['code']]['engName'] = $row['engName'];
				  $dsub[$row['code']]['remark'] = $row['remark'];				  
				  $dsub[$row['code']]['expertCode'] = $row['expertCode'];
				 
				}
				  $dsub = array_values($dsub);

				      $Depart = array();
				      foreach ($dsub as $k => $v) {
				      $Depart['code'][$k] = $v['code'];
				      $Depart['thaiName'][$k] = $v['thaiName'];
				      $Depart['parentCode'][$k] = $v['parentCode'];
				      $Depart['engName'][$k] = $v['engName'];
				      $Depart['remark'][$k] = $v['remark'];
				      $Depart['expertCode'][$k] = $v['expertCode'];
				      
				    	}
				    $cntD=count($dsub);
				    for($i=0;$i<$cntD;$i++){
				    	if($code == $Depart['code'][$i]){
				    		$parent = $Depart['parentCode'][$i];
				    		$code = $Depart['code'][$i];
				    		$thainame = $Depart['thaiName'][$i];
				    		$engname = $Depart['engName'][$i];
				    		$remark = $Depart['remark'][$i];
				    		$expertCode = $Depart['expertCode'][$i];
				    	}
				    }


			break;
		case 'category':
				echo "<p style='display:none'>";
				require("require/connect_apicategory.php");
				$out_C=json_decode($cate,true);
				echo "</p>";				
				$Csub = array();
				$cntC=0;
				foreach ($out_C as $row) {
				  $csub[$row['code']]['code'] = $row['code'];
				  $csub[$row['code']]['thaiName'] = $row['thaiName'];
				  $csub[$row['code']]['parentCode'] = $row['parentCode'];
				  $csub[$row['code']]['engName'] = $row['engName'];
				  $csub[$row['code']]['remark'] = $row['remark'];
				 
				}
				  $csub = array_values($csub);

				      $Ca = array();
				      foreach ($csub as $k => $v) {
				      $Ca['code'][$k] = $v['code'];
				      $Ca['thaiName'][$k] = $v['thaiName'];
				      $Ca['parentCode'][$k] = $v['parentCode'];
				      $Ca['engName'][$k] = $v['engName'];
				      $Ca['remark'][$k] = $v['remark'];
				      
				    	}
				    $cntC=count($csub);
				    for($i=0;$i<$cntC;$i++){
				    	if($code == $Ca['code'][$i]){
				    		$parent = $Ca['parentCode'][$i];
				    		$code = $Ca['code'][$i];
				    		$thainame = $Ca['thaiName'][$i];
				    		$engname = $Ca['engName'][$i];
				    		$remark = $Ca['remark'][$i];
				    	}
				    }
			break;
		case 'subcate':
				echo "<p style='display:none'>";
				require("require/connect_apisubcate.php");
				$out_S=json_decode($subcate,true);
				echo "</p>";				
				$sub = array();
				$cntS=0;
				foreach ($out_S as $row) {
				  $sub[$row['code']]['code'] = $row['code'];
				  $sub[$row['code']]['thaiName'] = $row['thaiName'];
				  $sub[$row['code']]['parentCode'] = $row['parentCode'];
				  $sub[$row['code']]['engName'] = $row['engName'];
				  $sub[$row['code']]['remark'] = $row['remark'];
				 
				}
				  $sub = array_values($sub);

				      $SCa = array();
				      foreach ($sub as $k => $v) {
				      $SCa['code'][$k] = $v['code'];
				      $SCa['thaiName'][$k] = $v['thaiName'];
				      $SCa['parentCode'][$k] = $v['parentCode'];
				      $SCa['engName'][$k] = $v['engName'];
				      $SCa['remark'][$k] = $v['remark'];
				      
				    	}
				    $cntS=count($sub);
				    for($i=0;$i<$cntS;$i++){
				    	if($code == $SCa['code'][$i]){
				    		$parent = $SCa['parentCode'][$i];
				    		$code = $SCa['code'][$i];
				    		$thainame = $SCa['thaiName'][$i];
				    		$engname = $SCa['engName'][$i];
				    		$remark = $SCa['remark'][$i];
				    	}
				    }
			break;
		case 'items':
				echo "<p style='display:none'>";
		$myfile = fopen("setting/items.txt","r") or die("Unable to open file!");
		$urlitems = fgets($myfile);;
		fclose($myfile);
				
						$data = array (
							"subCatCode" => $parent
							);
						// json encode data
						$data_string = json_encode($data); 
						// the token
						$token = 'your token here';
						// set up the curl resource
						$ch = curl_init();
						curl_setopt($ch, CURLOPT_URL,$urlitems);
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
						// output the profile information - includes the header
						//echo $output."<br>";
						//$sub = substr($output,9);
						$item = "[";
						$sub = explode(":[",$output);
						$item .= substr($sub[1],0,-1);
						echo $item;
						$out_I=json_decode($item,true);
						echo "</p>";
						$isub = array();
						$cntI=0;
						foreach ($out_I as $row) {
						  $isub[$row['itemCode']]['itemCode'] = $row['itemCode'];
						  $isub[$row['itemCode']]['itemName'] = $row['itemName'];
						  $isub[$row['itemCode']]['unitCode'] = $row['unitCode'];
						 
						}
						  $isub = array_values($isub);

						      $Items = array();
						      foreach ($isub as $k => $v) {
						      $Items['itemCode'][$k] = $v['itemCode'];
						      $Items['itemName'][$k] = $v['itemName'];
						      $Items['unitCode'][$k] = $v['unitCode'];
						      
						    	}
						    $cntI=count($isub);
						    for($i=0;$i<$cntI;$i++){
						    	if($code == $Items['itemCode'][$i]){
						    		$code = $Items['itemCode'][$i];
						    		$thainame = $Items['itemName'][$i];
						    		$unitcode = $Items['unitCode'][$i];
						    	}
						    }
			break;
	}
/*echo $thainame."<br>";
echo $engname;*/

?>

<div id="formInsert">
<table border="0">
<form name="edit" action="edit.php" method="GET" onSubmit="return check(this)">
<tr><td colspan="2" align="center"><?php echo "<h3>กรุณาแก้ไขข้อมูล $level ที่ท่านต้องการ</h3>"; ?>
	<input type="hidden" name="title" value="<?php echo $level; ?>">
</td></tr>
<tr><td align="right">
    Parent Code :
    </td>
    <td>
    <input type="text" name="parent" class="form-control" value="<?php echo $parent; ?>" readonly>
    </td>
    </tr>
<tr><td align="right">
    Code :
    </td>
    <td>
    <input type="text" name="code" class="form-control" value="<?php echo $code; ?>" readonly>
    </td>
    </tr>
<tr><td align="right">
	Thai Name :
    </td>
    <td>
    <input type="text" name="Thainame" class="form-control" value="<?php echo $thainame; ?>">
    </td>
    </tr>
<?php if($level!='items'){?><tr><td align="right">
	Eng Name :
    </td>
    <td>
    <input type="text" name="Engname" class="form-control" value="<?php echo $engname; ?>"> 
    </td>
    </tr>

<tr><td align="right">
	หมายเหตุ (Remark) :
    </td>
    <td>
    <input type="text" name="remark" class="form-control" value="<?php echo $remark; ?>">
    </td>
    </tr>

		<?php
		if($level=='Department'){
			echo "<tr><td align='right'>
			    ผู้จัดการ (Cate) :
			    </td>
			    <td>";
			require('require/connect_apiExpertteam.php');
						$out_E=json_decode($expert,true);
						$Esub = array();
						$cntI=0;
						foreach ($out_E as $row) {
						  $Esub[$row['catCode']]['catCode'] = $row['catCode'];
						}
						  $Esub = array_values($Esub);

						      $expert = array();
						      foreach ($Esub as $k => $v) {
						      $expert['catCode'][$k] = $v['catCode'];
						    	}
						    $cntE=count($Esub);

			$selected = '';
						    	
			echo "<select class='form-control' name='cate' id='sel1'>";
			for($i=0;$i<$cntE;$i++){
				if($expertCode == $expert['catCode'][$i]){
				$selected = "selected = 'selected=selected'";
					echo "<option value='".$expert['catCode'][$i]."'".$selected.">".$expert['catCode'][$i]."</option>";
				}else{
					echo "<option value='".$expert['catCode'][$i]."'>".$expert['catCode'][$i]."</option>";
				}
		}
			echo "</select>";
		}
		  echo "</td></tr>";
		  ?>
		
   
    <?php }else{ ?>

    <tr><td align="right">
	หน่วยนับ :
    </td>
    <td>
    <input type="text" name="unitcode" class="form-control" value="<?php echo $unitcode; ?>">
    </td>
    </tr>
<?php } ?>
  <tr><td colspan="2" align="center"><button type="submit" class="btn btn-default">Submit</button>
  <input type="reset" value="clear" class="btn btn-danger"></button></td></tr>
</form>
</table>
</div>
<a href="manage_category.php" class="back">Cancel</a>
</body>
</html>