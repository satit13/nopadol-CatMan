<?php
session_start();
	$api=fopen("itemcode.txt","w");
		fwrite($api,"000;000");
		fclose($api);

	$val = "value=''";
?>
<!DOCTYPE html>
<head>
	<title>Manage Category</title>  
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  	<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<link rel="stylesheet" href="dist\themes\default\style.min.css" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/bootstrap.css" />	
    
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">

</head>
<body>
<div id="header"><h1 class="hleft"> ระบบจัดการโครงสร้างสินค้า</h1></div>
<div id="left" class="col-md-3">
Search : <input class="search-input form-control search"></input>
    <button onClick="open_all()" class="btn btn-primary btn-block btn-sm" id="open">เปิดทั้งหมด</button>
    </input><button onClick="close_all()"class="btn btn-primary btn-block btn-sm" id="close" style="display:none">ปิดทั้งหมด</button>
<div class="jstreeleft">
    
    <div><b><a href="#" onClick='return add_family(this)'>ROOT</a></b></div>


<div id="jstreeleft">
</div>
</div>
</div>


<script>
function getItem()
{
  $.ajax({ 
        url: "require/connect_apiItem.php" ,
        type: "POST",
        data: ''
      })
      .success(function(result) { //alert(result) 
        var obj = jQuery.parseJSON(result);  
        if(obj==''){
          all='<h1>Not Items!!</h1>';
              document.getElementById("content").innerHTML = all
			  
        }
        if(obj!=''){
          	///all='success';
          		var id = "";
          		var name = "";
          		var unit = "";
          	var all="<table border='0' width='100%'>";
          	all+="<tr><th>รหัสสินค้า</th><th>ชื่อสินค้า</th><th>หน่วยนับ</th></tr>";
          		 $.each(obj, function(key, val) {

          		 	all+="<tr><td align='center'>"+val["itemCode"]+"</td><td>"+val["itemName"]+"</td><td align='center'>"+val["unitCode"]+"</td>";
          		 	//all+="<td align='center'><button id='edit' class='btn btn-warning btn-block' value='"+val["itemCode"];
          		 	//all+="' onClick='return edit_item(this)'>edit</button></td>";
          		 	//all+="<td align='center'><button id='delete' class='btn btn-danger btn-block' value='"+val["itemCode"];
          		 	//all+="' onClick='return delete_item(this)'>delete</button></td></tr>";
					all+="</tr>";
          		 });
          	all+="</table>";
              document.getElementById("content").innerHTML = all;
			
          }

      });
}
//========= SHOW AND SlELECT REFRESH PAGE AUOT =======================////
//setInterval(getItem, 1000);   // sec = 1 second
function getfamily(){
	$.ajax({ 
        url: "require/connect_apifamily.php" ,
        type: "POST",
        data: ''
      }).success(function(result) { 
	  alert(result) 
        var obj = jQuery.parseJSON(result);  
        if(obj==''){
          all='<h1>Not Items!!</h1>';
              document.getElementById("content").innerHTML = all
			  
        }
        if(obj!=''){
	}
</script>

<div id="jstreeright" class="col-md-7 jstreeright">

	<div id='title'>
		
	</div>
	<div id='content'>
    
   
    </div>
     <div id='show_data'></div>
</div>

<div id="menu" class="col-md-2 main">
	<br>
<form action='insert_from.php' method='GET'>
	<div class="ltext">
	<input type='hidden' name='id' id='add' class="form-control">
	</div>
	<div class="rtext"><input type="submit" id="add_button" class="btn btn-primary btn-block btn-lg" <?php echo $val; ?> /></div>
</form>
<br><br>
<form action='move_item.php' method='GET'>
	<div class="ltext">
	<input type='hidden' name='item' id='move' class="form-control">
	</div>
	<div class="rtext"><button type="submit" id="move_button" class="btn btn-primary btn-block btn-lg" <?php echo $val; ?> > ย้าย Items</button></div>
    <br><br>
</form>

	<p><button type="button" class="btn btn-primary btn-block btn-lg" data-toggle="modal" data-target="#myModal" <?php echo $val; ?> >ค้นหาตามชื่อสินค้า</button>
    
<form name="edit" action='edit_form.php' method='GET'>
	<div class="ltext">
	<input type='hidden' name='id' id='edit' class="form-control">
	</div>
	<div class="rtext"><input type="submit" id="edit_button" class="btn btn-primary btn-block btn-lg" disabled="disabled" <?php echo $val; ?> />
    </div>
</form>
<br><br>
<form name="delete" action='delete.php' method='GET'>
	<div class="ltext">
	<input type='hidden' name='id' id='delete' class="form-control">
    
	</div>
	<div class="rtext"><input type="submit" id="delete_button" class="btn btn-primary btn-block btn-lg" disabled="disabled" <?php echo $val; ?>  onClick="return confirm('ต้องการลบข้อมูลนี้หรือไม่')"/></div>
</form>
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
    //array_multisort($fam['code'],SORT_ASC,$result);
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
		  //var_dump($rdepart) ;

		      $De = array();
		      foreach ($rdepart as $k => $v) {
		      $De['code'][$k] = $v['code'];
		      $De['thaiName'][$k] = $v['thaiName'];
		      $De['parentCode'][$k] = $v['parentCode'];
		      
		    	}
		    //array_multisort($De['code'],SORT_ASC,$rdepart);
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
		    //array_multisort($Ca['code'],SORT_ASC,$rcate);
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
		    //array_multisort($Sub['code'],SORT_ASC,$rsub);
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

    $(".search-input").keyup(function() {

        var searchString = $(this).val();
        console.log(searchString);
        $('#jstreeleft').jstree('search', searchString);
    });

    

    $('#jstreeleft').jstree({
        "core": {
    "check_callback" : function (op, node, parent, position, more) {

    if ((op === "move_node" || op === "copy_node") && parent.id === "#") {
        return false;
    }
    if ((op === "move_node" || op === "copy_node") && more.core && !confirm("ต้องการย้ายข้อมูล  "+node.text+" ไปยัง "+parent.text+" หรือไม่")) {
        return false;
    }
	if(node.parent === parent.id){
		return false;
		}
		if(node.text === "Other"){
		return true;
		}

    return true;
/*if ((op === "move_node" || op === "copy_node") && node.type && parent.id === "#") {
        return false;
    }
    if ((op === "move_node" || op === "copy_node") && more && more.core && !confirm("ต้องการย้ายข้อมูล  "+node.text+" ไปยัง "+parent.text+" หรือไม่")) {
        return false;
    }
	if(node.parent === parent.id){
		return false;
		}

    return true;
*/
		
      
	  
    },
	"themes" : { "stripes" : true },
	"animation" : 10,
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
       "plugins": [ "contextmenu", "dnd", "search","state","types","unique"]
        	
    });
    //$("#jstreeleft").bind('loaded.jstree', function (event, data) { 
	//$("#jstreeleft").jstree("open_all",id);
	//$("#jstreeleft").jstree("open_all","family:00009");
	//});
   


});

//====================================move node=======================================================
$("#jstreeleft").bind("move_node.jstree", function (e,data) { 
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
		xmlhttp.open("GET","move_node.php?level="+level_use+"&code="+id+"&name="+name+"&tonode="+tonode+"&fromnode="+fromnode,true);
		xmlhttp.send();
  //alert("Drop node " + data.node.id + " to " + data.parent);
		
    
  

  }
});	 
//====================================select node=======================================================
$('#jstreeleft')
  // listen for event
 .on('select_node.jstree', function (e, data) {
	var depart = <?php echo $Depart?>;
	var cate = <?php echo $cate?>;
	var subcate = <?php echo $subcate?>;
    var x, j, i = [], p = [];t = [];
    for(x = 0, j = data.selected.length; x < j; x++) {
    t.push(data.instance.get_node(data.selected[x]).text);
    i.push(data.instance.get_node(data.selected[x]).id);
	p.push(data.instance.get_node(data.selected[x]).parent);
	  
      //r.push(data.instance.get_node(data.selected[i]).parent);
    }
    var idf = i.join().split(":");
    var id=t.join()+";"+idf[1]+";"+p.join();

var d=0;


//=========================================table department===================================================
if(idf[0]=="family"){
	var all_value="<table border='0' width='100%'>";
	all_value+="<tr><th>หมวดหมู่</th><th>ชื่อหมวดหมู่(ไทย)</th><th>ชื่อหมวดหมู่(eng)</th><th>แก้ไข</th><th>ลบ</th></tr>";
var count = depart.length;
while(d < count){
	if(depart[d].parentCode === idf[1]){
	
	all_value+="<tr><td>"+ depart[d].code +" </td><td>"+ depart[d].thaiName+"</td><td>"+ depart[d].engName+"</td>";
	all_value+="<td><button value="+depart[d].code+" onclick='edit_cate(this,1)' class='btn btn-warning'>edit</button</td>";
	all_value+="<td><button value=Department:"+depart[d].code+" onclick='delete_cate(this,1)' class='btn btn-danger'>delete</button</td></tr>";
	}
	else{all_value+=""}
d++;
}
	all_value+="</table>";
//=========================================table cate===================================================
}else if(idf[0]=="Department"){
	var all_value="<table border='0' width='100%'>";
	all_value+="<tr><th>หมวดหมู่</th><th>ชื่อหมวดหมู่(ไทย)</th><th>ชื่อหมวดหมู่(eng)</th><th>แก้ไข</th><th>ลบ</th></tr>";
var count = cate.length;
while(d < count){
	if(cate[d].parentCode === idf[1]){
	
	all_value+="<tr><td>"+ cate[d].code +" </td><td>"+ cate[d].thaiName+"</td><td>"+ cate[d].engName+"</td>";
	all_value+="<td><button value="+cate[d].code+" onclick='edit_cate(this,2)' class='btn btn-warning'>edit</button</td>";
	all_value+="<td><button value=category:"+cate[d].code+" onclick='delete_cate(this,2)' class='btn btn-danger'>delete</button</td></tr>";
	}
	else{all_value+=""}
d++;
}
	all_value+="</table>";
//=========================================table sub cate===================================================
	}else if(idf[0]=="category"){
		var all_value="<table border='0' width='100%'>";
	all_value+="<tr><th>หมวดหมู่</th><th>ชื่อหมวดหมู่(ไทย)</th><th>ชื่อหมวดหมู่(eng)</th><th>แก้ไข</th><th>ลบ</th></tr>";
var count = subcate.length;
while(d < count){
	if(subcate[d].parentCode === idf[1]){
	
	all_value+="<tr><td>"+ subcate[d].code +" </td><td>"+ subcate[d].thaiName+"</td><td>"+ subcate[d].engName+"</td>";
	all_value+="<td><button value="+subcate[d].code+" onclick='edit_cate(this,3)' class='btn btn-warning'>edit</button</td>";
	all_value+="<td><button value=subcate:"+subcate[d].code+" onclick='delete_cate(this,3)' class='btn btn-danger'>delete</button</td></tr>";}
	else{all_value+=""}
d++;
}
	all_value+="</table>";
	}else if(idf[0]=="subcate"){
		var xmlhttp=new XMLHttpRequest();
				 xmlhttp.onreadystatechange=function() {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("content").innerHTML=xmlhttp.responseText;
					
				}
			}

		xmlhttp.open("GET","require/connect_apiItemshow.php?getid="+idf[1],true);
		xmlhttp.send();
		}
          	
			

			document.getElementById("content").innerHTML = all_value;
   	//alert(t.join())
    //alert(p.join())
	//alert(all_value)
	  $.ajax({
  method: "POST",
  url: "require/itemselect.php",
  data: { id: idf[1]}
})
  .done(function( msg ) {
    var str = msg;
    var title = i.join().split(":");
    var parent = p.join().split(":");
    var content = "#"+title[0]+";#"+title[1]+";"+t.join()+";."+parent[0]+";."+parent[1];
    $('#title').html('<h3>หมวดหมู่ '+t.join()+' รหัส '+title[1]+'</h3>');
   document.getElementById("add").value = content;
   document.getElementById("move").value = content;
   document.getElementById("edit").value = i.join();
   document.getElementById("delete").value = i.join();
   document.getElementById("edit_button").value = "แก้ไข "+t.join();
   document.getElementById("delete_button").value = "ลบ "+t.join();
   document.getElementById("add_button").value = "เพิ่มลูกของ "+t.join();
   
   if(title[0] != "subcate"){
document.getElementById("move_button").disabled = true;

   }else{document.getElementById("move_button").disabled = false;}

	var edit = document.forms["edit"]["id"].value;
	if(edit == null || edit == ""){document.getElementById("edit_button").disabled = true;}
   else{document.getElementById("edit_button").disabled = false;}
   
   var deleted = document.forms["delete"]["id"].value;
	//alert(deleted)
	if(deleted == null || deleted == ""){document.getElementById("delete_button").disabled = true;}
   else{document.getElementById("delete_button").disabled = false;}
   getItem()

    //alert(str)
  });
	//alert(r.join())
	//alert(s.join())
   
   
 //window.location="require/itemselect.php";//?id="+r.join('; ')+"&pid="+s.join();  
  });
function delete_cate(str,level){
	alert(str.value+" "+level)
		  if(confirm("ต้องการลบข้อมูลหรือไม่")){
	if(level==0){var levels="family"}
	else if(level==1){var levels="Department"}
	else if(level==2){var levels="category"}
	else if(level==3){var levels="subcate"}
	
	window.location="delete.php?level="+levels+"&id="+str.value;}
	}
  function edit_cate(str,level){

	if(level==0){var levels="family"}
	else if(level==1){var levels="Department"}
	else if(level==2){var levels="category"}
	else if(level==3){var levels="subcate"}
	//alert(str.value)
	window.location="edit_form.php?level="+levels+"&code="+str.value;
	}

  function delete_item(str){
	  
	//alert(str.value)
	window.location="delete.php?level=items&code="+str.value;
	}
  function edit_item(str){
	//alert(str.value)
	window.location="edit_form.php?level=items&code="+str.value;
	}
 function add_family(str){
 	  $.ajax({
  method: "POST",
  url: "require/itemselect.php",
  data: { id: ""}
})
 	$('#title').html('<h1>Root</h1>');
 	$('#content').html('<h1>Root Add family</h1>');
 	document.getElementById("move").value = "";
	document.getElementById("delete").value = "";
	document.getElementById("edit").value = "";
	document.getElementById("add").value = "#root;#disable;disable;.disable;.disable";
}
function open_all(){
	$("#jstreeleft").jstree("open_all");
	document.getElementById("close").style.display="block";
	document.getElementById("open").style.display="none";
	}
	
function close_all(){
	$("#jstreeleft").jstree("close_all");
	document.getElementById("close").style.display="none";
	document.getElementById("open").style.display="block";
	}
	</script>
<div class="setup"><a href="setting/setting.php" class="setup"></a></div>
<div class="logout"><a href="index.php" class="logout"></a></div>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align: center;">ค้นหาตามรายชื่อสินค้า </h4>
        </div>
        <div class="modal-body" style="text-align: center;">
           <form class="form-inline" action="move_allitem.php">
           		<input type="text" name="search" class="form-control"></input>
           		<button type="submit" class="btn btn-success"> Go </button>
           </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


</body>
</html>