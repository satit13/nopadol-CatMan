<!DOCTYPE html>
<head>
	<title>Manage Category</title>  
	<link rel="stylesheet" href="dist\themes\default\style.min.css" />
	<link rel="stylesheet" href="css/style.css" />	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<link rel="stylesheet" href="css/bootstrap.css" />
<script>function check(){
	if(document.forms["insert"]["Thainame"].value=="" ||document.forms["insert"]["Thainame"].value==null ){
		alert("กรุณากรอกข้อมูลให้ครบถ้วน")
		document.forms["insert"]["Thainame"].focus();
		return false;
		}
		if(document.forms["insert"]["Engname"].value=="" ||document.forms["insert"]["Engname"].value==null ){
		alert("กรุณากรอกข้อมูลให้ครบถ้วน")
		document.forms["insert"]["Engname"].focus();
		return false;
		}
	}
</script>
</head>
<body>

<div id="header"><h1 class="hleft"> Manage Category</h1></div>
<div style="height: 55px;"></div>
	<?php
		//#root;#disable;disable;.disable;.disable
		//#family;#00009;ห้องน้ำ;.#;.undefined
		if(empty($_GET['id'])){
		$content = explode(";", $_GET['id']);
		$data = "root";
		$iddata ="disable";
		$name = "disable";
		$dataP = "disable";
		$idP = "disable";
			
			}else{
		$content = explode(";", $_GET['id']);
		$data = substr($content[0],1);
		$iddata =substr($content[1],1);
		$name = $content[2];
		$dataP = substr($content[3],1);
		$idP = substr($content[4],1);
			}
		//echo "ชื่อฐานข้อมูลที่ต้องการเพิ่ม $data <br>";

		//echo $_GET['id'];
		
		
		if($data == "root"){
			$data = "Family";
			$level = 0;
		}else if($data == "family"){
			$data = "Department";
			$level = 1;
		}else if($data == "Department"){
			$data = "category";
			$level = 2;
		}else if($data == "category"){
			$data = "subcate";
			$level = 3;
		}else if($data == "subcate"){
			$data = "items";
			$level = 4;
		}


		if($iddata == "disable"){
			$iddata = "";
		}

		/*
		echo "รหัสฐานข้อมูลที่ต้องการเพิ่ม $iddata <br>";
		echo "ชื่อรายการฐานข้อมูลที่ต้องการเพิ่ม $name <br>";
		echo "ชื่อฐานข้อมูลที่เชื่อมอยู่ $dataP <br>";
		echo "รหัสฐานข้อมูลที่เชื่อมอยู่ $idP <br>";*/

	?>
    <br><h1 class="head">เพิ่มข้อมูล</h1>
    <hr class="hr">
<div id="formInsert">
<table border="0">
<form name="insert" action="insert_json.php" method="GET" onSubmit="return check(this)">
<tr><td colspan="2" align="center"><?php echo "<h3>กรุณาเพิ่มข้อมูลของ $data ที่ท่านต้องการเพิ่ม</h3>"; ?>
	<input type="hidden" name="title" value="<?php echo $data; ?>">
	<input type="hidden" name="level" value="<?php echo $level; ?>">
</td></tr>
<tr><td align="right">
    <?php if($data=="Family"){echo '
    </td>
    <td>';
    echo '<input type="hidden" name="parent" class="form-control" value="'.$iddata.'" readonly>';}
	else{echo 'Parent Code:
    </td>
    <td>';
	echo '<input type="text" name="parent" class="form-control" value="'.$iddata.'" readonly>';}
	?>
    </td>
    </tr>
<tr><td align="right">
	Thai Name:
    </td>
    <td>
    <input type="text" name="Thainame" class="form-control">
    </td>
    </tr>
<tr><td align="right">
	Eng Name:
    </td>
    <td>
    <input type="text" name="Engname" class="form-control"> 
    </td>
    </tr>
<tr><td align="right">
	หมายเหตุ (Remark):
    </td>
    <td>
    <input type="text" name="remark" class="form-control" >
    </td>
    </tr>


		<?php

		if($data=='Department'){
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
						    	
			echo "<select class='form-control' name='cate' id='sel1'>";
			for($i=0;$i<$cntE;$i++){
					echo "<option value='".$expert['catCode'][$i]."'>".$expert['catCode'][$i]."</option>";
				
		}
			echo "</select>";
		}
		  echo "</td></tr>";

		  ?>

  <tr><td colspan="2" align="center"><button type="submit" class="btn btn-default">Submit</button>
  <input type="reset" value="clear" class="btn btn-danger"></td></tr>
</form>
</table>
</div>
<a href="manage_category.php" class="back">Cancel</a>
</body>
</html>