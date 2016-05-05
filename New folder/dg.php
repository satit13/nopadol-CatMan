<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.1.1/themes/default/style.min.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.1.1/jstree.min.js"></script>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
    </head>
<body>
<?php
require("require/connect_apifamily.php");
$out_w=json_decode($end,true);
$result = array();
$cntf=0;
$all="";
foreach ($out_w as $row) {
  $result[$row['code']]['code'] = $row['code'];
  $result[$row['code']]['thaiName'] = $row['thaiName'];
 
}
  $result = array_values($result);

      $fam = array();
      foreach ($result as $k => $v) {
      $fam['code'][$k] = $v['code'];
      $fam['thaiName'][$k] = $v['thaiName'];
      
    }
    array_multisort($fam['code'],SORT_ASC,$result);
    $cntf=count($result);
//==========================================================================================================///
//==================================================== Department =========================================////
    	echo "<div style='display:none;'>";
		require("require/connect_apiDepartment.php");
		$out_D=json_decode($Depart,true);
		echo "</div>";

		$rdepart = array();
		$cntD=0;
		foreach ($out_D as $row) {
		  $rdepart[$row['code']]['code'] = $row['code'];
		  $rdepart[$row['code']]['thaiName'] = $row['thaiName'];
		  $rdepart[$row['code']]['parentCode'] = $row['parentCode'];
		 
		}
		  $rdepart = array_values($rdepart);

		      $De = array();
		      foreach ($rdepart as $k => $v) {
		      $De['code'][$k] = $v['code'];
		      $De['thaiName'][$k] = $v['thaiName'];
		      $De['parentCode'][$k] = $v['parentCode'];
		      
		    	}
		    array_multisort($De['code'],SORT_ASC,$rdepart);
		    $cntD=count($rdepart);
//==============================================================================================================
//==================================================== category =========================================////
    	echo "<div style='display:none;'>";
		require("require/connect_apicategory.php");
		$out_C=json_decode($cate,true);
		echo "</div>";

		$rcate = array();
		$cntC=0;
		foreach ($out_C as $row) {
		  $rcate[$row['code']]['code'] = $row['code'];
		  $rcate[$row['code']]['thaiName'] = $row['thaiName'];
		  $rcate[$row['code']]['parentCode'] = $row['parentCode'];
		 
		}
		  $rcate = array_values($rcate);

		      $Ca = array();
		      foreach ($rcate as $k => $v) {
		      $Ca['code'][$k] = $v['code'];
		      $Ca['thaiName'][$k] = $v['thaiName'];
		      $Ca['parentCode'][$k] = $v['parentCode'];
		      
		    	}
		    array_multisort($Ca['code'],SORT_ASC,$rcate);
		    $cntC=count($rcate);
//==============================================================================================================
//==================================================== subcate =========================================////
    	echo "<div style='display:none;'>";
		require("require/connect_apisubcate.php");
		$out_S=json_decode($subcate,true);
		echo "</div>";

		$rsub = array();
		$cntS=0;
		foreach ($out_S as $row) {
		  $rsub[$row['code']]['code'] = $row['code'];
		  $rsub[$row['code']]['thaiName'] = $row['thaiName'];
		  $rsub[$row['code']]['parentCode'] = $row['parentCode'];
		 
		}
		  $rsub = array_values($rsub);

		      $Sub = array();
		      foreach ($rsub as $k => $v) {
		      $Sub['code'][$k] = $v['code'];
		      $Sub['thaiName'][$k] = $v['thaiName'];
		      $Sub['parentCode'][$k] = $v['parentCode'];
		      
		    	}
		    array_multisort($Sub['code'],SORT_ASC,$rsub);
		    $cntS=count($rsub);
//==============================================================================================================
?>
<?php
////============================================  family ======================================================
  for($i=0;$i<$cntf;$i++){
    $all.= '{ "id" : "family:'.$fam['code'][$i].'", "parent" : "#", "text" : "'.$fam['thaiName'][$i].'", "type" : "family" },';
    ////================================================ Department =================================================
    	
		     for($d=0;$d<$cntD;$d++){
		     	if($De['parentCode'][$d]==$fam['code'][$i]){
			    $all.= '{ "id" : "Department:'.$De['code'][$d].'", "parent" : "family:'.$fam['code'][$i].'", "text" : "'.$De['thaiName'][$d].'", "type" : "department" },';
				//=============================================== Category  =====================================================	
				for($c=0;$c<$cntC;$c++){
				     	if($Ca['parentCode'][$c]==$De['code'][$d]){
					    $all.= '{ "id" : "category:'.$Ca['code'][$c].'", "parent" : "Department:'.$De['code'][$d].'", "text" : "'.$Ca['thaiName'][$c].'", "type" : "category" },';
					//=============================================== Sub-cate  =====================================================	
						 for($s=0;$s<$cntS;$s++){
						     	if($Sub['parentCode'][$s]==$Ca['code'][$c]){
							    $all.= '{ "id" : "subcate:'.$Sub['code'][$s].'", "parent" : "category:'.$Ca['code'][$c].'", "text" : "'.$Sub['thaiName'][$s].'", "type" : "subcate" },';
								}
							}
						}
				}
				}
			}

  }
//echo $all;
?>

<div id="jstree"></div>

<script type="text/javascript" >
$('#jstree').jstree({
  "core": {
    "check_callback": true,
    "data": [
     <?php echo $all; ?>
    ]
  },
  "types": {
    "#": {
      "valid_children": ["family"]
    },
    "family": {
      "valid_children": ["department"]
    },
    "department": {
      "valid_children": ["category"]
    },
    "category": {
      "valid_children": ["subcate"]
    },
    "subcate": {
      "valid_children": []
    }
  },
  "plugins": ["types", "dnd"]
});

</script>
</body>
</html>