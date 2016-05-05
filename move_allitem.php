<?php
	$val = "value=''";
?>
<!DOCTYPE html>
<head>
	<title>Manage Items</title>  
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  	<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<link rel="stylesheet" href="dist\themes\default\style.min.css" />	
	<link rel="stylesheet" href="css/bootstrap.css" />	
	<link rel="stylesheet" href="css/style.css" />
    
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">

</head>
<body>
<div id="header"><h1 class="hleft"> Manage Items</h1></div>

<div class="col-md-9 jstreecenter">
	<div id="title"></div>

	<div id="jstreecenter">

	
	   <?php
	   echo "<div style='display:none;'>"; 
	   if(empty($item)){
	   $item = explode(";",$_GET['item']);
	   $cateid = substr($item[1], 1);
	   $subcateN = $item[2];
		}

	   if(empty($_GET['search'])){
	   		$_GET['search']="";
	   		echo "<script> alert('ท่านยังไม่ได้กรอกข้อมูลที่ต้องการค้นหา !!') </script>";
	   		echo "<script> window.location='manage_category.php' </script>";
	   }
	   if(empty($_GET['sub'])){
	   		$_GET['sub']="";
	   }else{
	   		$subcateN=$_GET['sub'];
	   }
	   if(empty($_GET['subcate'])){
	   		$_GET['subcate']="";
	   }else{
	   		$subcateN=$_GET['subcate'];
	   }
	   if(empty($_GET['cateid'])){
	   		$_GET['cateid']="";
	   }else{
	   		$cateid=$_GET['cateid'];
	   }

	  

		$data = array (
			"subCatCode" => "",
		    "search" => $_GET['search']
			);
		$myfile = fopen("setting/items.txt","r") or die("Unable to open file!");
		$urlitems = fgets($myfile);;
		fclose($myfile);

		// json encode data
		$data_string = json_encode($data); 
		// the token
		$token = 'your token here';
		// set up the curl resource
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$urlitems);//http://s01xp.dyndns.org:8080/SmartQWs/pickup/search");
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
		//echo $item;
		echo "</div>";
		//echo $item;
	   if($item=="[]"){
	   	echo "<script>
	   	alert('ไม่มี Items') 
	   	</script>
	   	<script>
	   	window.history.back(1)
	   	</script>";
	   }else{
	   	$out_w=json_decode($item,true);
		echo "</div>";

		$result = array();
		$cntf=0;
		$all="";
			foreach ($out_w as $row) {
			  $result[$row['itemCode']]['itemCode'] = $row['itemCode'];
			  $result[$row['itemCode']]['itemName'] = $row['itemName'];
			  $result[$row['itemCode']]['subCatCode'] = $row['subCatCode'];
			  $result[$row['itemCode']]['subCatName'] = $row['subCatName'];
			 
			}
		  $result = array_values($result);

		      $items = array();
			      foreach ($result as $k => $v) {
			      $items['itemCode'][$k] = $v['itemCode'];
			      $items['itemName'][$k] = $v['itemName'];
			      $items['subCatCode'][$k] = $v['subCatCode'];
			      $items['subCatName'][$k] = $v['subCatName'];
			      
			    }
		    //array_multisort($items['itemCode'],SORT_ASC,$result);
		    $cntf=count($result);


		    


			   	if(empty($_GET['all'])){
			   		$chk1="";
			   		$chk="<a href='move_allitem.php?cateid=$cateid&sub=$subcateN&all=1&subcate=$_GET[subcate]&search=$_GET[search]'>เลือกทั้งหมด</a>";
			   	}else if($_GET['all']==1){
			   		$chk1="checked='checked'";
			   		$chk="<a href='move_allitem.php?cateid=$cateid&sub=$subcateN&all=0&subcate=$_GET[subcate]&search=$_GET[search]'>ยกเลิกทั้งหมด</a>";
		   		}
		   		if($_GET['search']){
		   			echo "<h3>ค้นหาตามชื่อ ".$_GET['search']."</h3>";
		   		}else{
			   		if($cateid==""){$_GET['sub']="ไม่มี subcate ต้นทาง"; $cateid="0";}else{$_GET['sub']=$_GET['sub']; $cateid=$cateid;}
			   		echo "<h3>Subcate ".$subcateN."<br>รหัส ".$cateid."</h3>";
		   		}

	   		
	   		?>
	   		<form class='form-inline'>
           		<input type='text' name='search' class='form-control'></input>
           		<button type='submit' class='btn btn-success'> Search </button>
           </form>
           <form action='move_all.php' method='POST' class="form-inline">
           <?php
            echo "<input type='hidden' name='FromNode' id='FromNode' class='form-control' value='$cateid:$subcateN'>";
	   		echo "<input type='hidden' name='toNode' id='toNode' class='form-control'><div id='item'></div><hr>";
	   		echo "<table width='100%'>";
	   		echo "<tr><th align='center'>$chk</th><th align='center'>รหัสสินค้า</th><th align='center'>รายการ</th><th>รหัส subcate</th><th>ชื่อ subcate </th></tr>";

		   		for($i=0;$i<$cntf;$i++){
		   			echo "<tr><td align='center'><input type='checkbox' name='item_id[]' value='".$items['itemCode'][$i].";".$items['itemName'][$i].";".$items['subCatCode'][$i].";".$items['subCatName'][$i]."' $chk1></td><td align='center'>".$items['itemCode'][$i]."</td><td>".$items['itemName'][$i]."</td><td>".$items['subCatCode'][$i]."</td><td>".$items['subCatName'][$i]."</td></tr>";
		   		}
	   		echo "</table>";
	   		   	
	   }
	   ?>

	</div>
</div>
<!--/////////////////////////////////////////////////////////////////////////////////////////// -->
<div class="col-md-3 jstreeright_i">
	<h3>Subcate ปลายทาง</h3>
    Search : <input class="search-input2 form-control search"></input>
	<div id="jstreeright">
	   
	</div>
</div>
<?php
//============================================ family ============================================================
echo "<div style='display:none;'>";
require("require/connect_apifamily.php");
$out_w=json_decode($end,true);
echo "</div>";

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
    $all.= '{ "id" : "family:'.$fam['code'][$i].'", "parent" : "#", "text" : "'.$fam['thaiName'][$i].'", "type" : "family" , "select_id" : "'.$fam['code'][$i].'" },';
    ////================================================ Department =================================================
    	
		     for($d=0;$d<$cntD;$d++){
		     	if($De['parentCode'][$d]==$fam['code'][$i]){
			    $all.= '{ "id" : "Department:'.$De['code'][$d].'", "parent" : "family:'.$fam['code'][$i].'", "text" : "'.$De['thaiName'][$d].'", "type" : "department" , "select_id" : "'.$De['code'][$d].'" },';
				//=============================================== Category  =====================================================	
					for($c=0;$c<$cntC;$c++){
				     	if($Ca['parentCode'][$c]==$De['code'][$d]){
					    $all.= '{ "id" : "category:'.$Ca['code'][$c].'", "parent" : "Department:'.$De['code'][$d].'", "text" : "'.$Ca['thaiName'][$c].'", "type" : "category" , "select_id" : "'.$Ca['code'][$c].'" },';
						    //============================================= subCate =====================================================
						    for($s=0;$s<$cntS;$s++){
						     	if($Sub['parentCode'][$s]==$Ca['code'][$c]){
							    $all.= '{ "id" : "subcate:'.$Sub['code'][$s].'", "parent" : "category:'.$Ca['code'][$c].'", "text" : "'.$Sub['thaiName'][$s].'", "type" : "subcate" , "select_id" : "'.$Sub['code'][$s].'" },';
								}
							}
						}
					}
			 
				}
			}

  }
//echo $all;

?>

	<script src="dist\jstree.min.js"></script>
	<script >
$(function() {

    $(".search-input2").keyup(function() {

        var searchString = $(this).val();
        console.log(searchString);
        $('#jstreeright').jstree('search', searchString);
    });

    

    $('#jstreeright').jstree({
        "core": {
    "check_callback" : function (op, node, parent, position, more) {

    if ((op === "move_node" || op === "copy_node") && node.type && parent.id === "#") {
        return false;
    }
    if ((op === "move_node" || op === "copy_node") && more && more.core && !confirm("ต้องการย้ายข้อมูล  "+node.text+" ไปยัง "+parent.text+" หรือไม่"+more.core)) {
        return false;
    }
    return true;

		
      
	  
    },
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
	  ,"icon" : "images/folder-red1.png"
    },
    "department": {
      "valid_children": ["category"]
	  ,"icon" : "images/folder-yello1.png"
    },
    "category": {
      "valid_children": ["subcate"]
	  ,"icon" : "images/folder-green1.png"
    },
    "subcate": {
      "valid_children": []
	  ,"icon" : "images/folder-pink1.png"
    }
  },
        "search": {

            "case_insensitive": true,
            "show_only_matches" : false

        },
       "plugins": ["types","search","unique"]
        	
    });
    //$("#jstreeleft").bind('loaded.jstree', function (event, data) { 
	//$("#jstreeleft").jstree("open_all",id);
	//$("#jstreeleft").jstree("open_all","family:00009");
	//});
   


});

//====================================move node=======================================================
$("#jstreeright").bind("move_node.jstree", function (e,data) { 
  // level
  var level=data.node.parents.length;
  var level_use = (level-1);
  // id
  var ids = data.node.id.split(":");
  var id = ids[1];  
  var name = data.node.text;
  // form
  var fromnodes = data.old_parent.split(":");
  var fromnode = fromnodes[1];
  //var fromnodename = getTextNodes(data.old_parent);
  // to
  var tonodes = data.parent.split(":");
  var tonode = tonodes[1];

  
  if(tonode==fromnode){
	  	alert("กรุณาย้ายข้อมูลให้ถูกต้อง");
		 e.preventDefault()
		return false;
		

		
	}else{
		
		
    //var alerts = "ย้าย "+id+" "+name+" จาก "+fromnode+" "+fromnodename+" ไปที่ "+tonode +" "+tonodename+" เรียบร้อยแล้ว"
			//alert(level_use+" "+id+" "+name+" "+ fromnode+" "+tonode+" ")
				var xmlhttp=new XMLHttpRequest();
				 xmlhttp.onreadystatechange=function() {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("show_data").innerHTML=xmlhttp.responseText;
					
				}
			}
			var alerts = "ย้าย "+id+" "+name+" เรียบร้อยแล้ว"
			//var alerts = "ย้าย "+id+" "+name+" จาก "+fromnode+" "+fromnodename+" ไปที่ "+tonode +" "+tonodename+" เรียบร้อยแล้ว"
			alert(alerts)
		xmlhttp.open("GET","tt.php?level="+level_use+"&code="+id+"&name="+name+"&tonode="+tonode+"&fromnode="+fromnode,true);
		xmlhttp.send();
  //alert("Drop node " + data.node.id + " to " + data.parent);
		
    
  

  }
    
});	 
//====================================select node=======================================================
$('#jstreeright')
  // listen for event
 .on('select_node.jstree', function (e, data) {
    var x, j, i = [], p = [];t = [];
    for(x = 0, j = data.selected.length; x < j; x++) {
    t.push(data.instance.get_node(data.selected[x]).text);
    i.push(data.instance.get_node(data.selected[x]).id);
	p.push(data.instance.get_node(data.selected[x]).parent);
	  
      //r.push(data.instance.get_node(data.selected[i]).parent);
    }
    var idf = i.join().split(":");
    var id=t.join()+";"+idf[1]+";"+p.join();
    var move = "<h4>ต้องการย้าย items ไปยัง subcate "+t.join()+" </h4>";
   // alert(id)
    document.getElementById("item").innerHTML = move;
    document.getElementById("toNode").value = id;

   /* alert(t.join())
    alert(i.join())
    alert(p.join())*/
   // alert(id)

	//alert(r.join())
	//alert(s.join())
   
   
 //window.location="require/itemselect.php";//?id="+r.join('; ')+"&pid="+s.join();  
  });
$("#jstreeright").bind("open_node.jstree", function (event, data) { 
  var obj =  data.instance.get_node(data.node, true);
  if(obj) {
     obj.siblings('.jstree-open').each(function () { data.instance.close_node(this, 0); }); 
  }
});
</script>
<div align="center" style="padding-top: 10px;"><br><br><br><button type="submit" class="btn btn-warning">Move</button> 
	</form>
<div class="back"><a href="manage_category.php" class="back"></a></div>
<div id='show_data'></div>

</body>
</html>
