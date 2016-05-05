<?php
	$api=fopen("itemcode.txt","w");
		fwrite($api,"000;000");
		fclose($api);

	$val = "value=''";
?>
<!DOCTYPE html>
<head>
	<title>jstree basic demos</title>  
	<link rel="stylesheet" href="dist\themes\default\style.min.css" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/bootstrap.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">

</head>
<body onLoad="check()">
<div id="header"><h1>header</h1></div>
<div id="left" class="col-md-3 jstreeleft">
    Search : <input class="search-input form-control search"></input>
    <div><b><a href="#" onClick='return add_family(this)'>ROOT</a></b></div>


<div id="jstreeleft">
   
</div>
</div>


<script>
function getItem()
{

  $.ajax({ 
        url: "connect_apiItem.php" ,
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
          	var all="<table border='0' width='98%'>";
          	all+="<tr><th>รหัสสินค้า</th><th>ชื่อสินค้า</th><th>หน่วยนับ</th><th>แก้ไข</th><th>ลบ Item</th></tr>";
          		 $.each(obj, function(key, val) {

          		 	all+="<tr><td align='center'>"+val["itemCode"]+"</td><td>"+val["itemName"]+"</td><td align='center'>"+val["unitCode"]+"</td>";
          		 	all+="<td align='center'><button id='edit' class='btn btn-warning btn-block' value='"+val["itemCode"];
          		 	all+="' onClick='return edit_item(this)'>edit</button></td>";
          		 	all+="<td align='center'><button id='delete' class='btn btn-danger btn-block' value='"+val["itemCode"];
          		 	all+="' onClick='return delete_item(this)'>delete</button></td></tr>";

          		 });
          	all+="</table>";
              document.getElementById("content").innerHTML = all
          }

      });
}
//========= SHOW AND SlELECT REFRESH PAGE AUOT =======================////
setInterval(getItem, 1000);   // sec = 1 second
</script>

<div id="jstreeright" class="col-md-7 jstreeright">
	<div id='title'>
		
	</div>
	<div id='content'></div>
</div>

<div id="menu" class="col-md-2 main">
	<br>
<form action='insert_from.php' method='GET'>
	<div class="ltext">
	<input type='hidden' name='id' id='add' class="form-control">
	</div>
	<div class="rtext"><button type="submit" id="add_button" class="btn btn-primary btn-block" <?php echo $val; ?> > Add </button></div>
</form>
<br><br>
	<div class="ltext">
	<input type='hidden' name='id' id='move' class="form-control">
	</div>
	<div class="rtext"><a href="move_family.php" id="move_button" class="btn btn-primary btn-block" <?php echo $val; ?> > Move </a></div>
    <br><br>
<form name="edit" action='edit_form.php' method='GET'>
	<div class="ltext">
	<input type='hidden' name='id' id='edit' class="form-control">
	</div>
	<div class="rtext"><button type="submit" id="edit_button" class="btn btn-primary btn-block" disabled="disabled" <?php echo $val; ?> > edit </button>
    </div>
</form>
<br><br>
<form action='delete.php' method='GET'>
	<div class="ltext">
	<input type='hidden' name='id' id='delete' class="form-control">
	</div>
	<div class="rtext"><button type="submit" id="delete_button" class="btn btn-primary btn-block" <?php echo $val; ?> >delete</button></div>
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


	<script src="dist\jstree.min.js"></script>
	<script >
$(function() {

    $(".search-input").keyup(function() {

        var searchString = $(this).val();
        console.log(searchString);
        $('#jstreeleft').jstree('search', searchString);
    });

    

    $('#jstreeleft').jstree({
        'core': {
        	'data': [
<?php
////============================================  family ======================================================
  for($i=0;$i<$cntf;$i++){
    echo '{ "id" : "family:'.$fam['code'][$i].'", "parent" : "#", "text" : "'.$fam['thaiName'][$i].'"},';
    ////================================================ Department =================================================
    	
		     for($d=0;$d<$cntD;$d++){
		     	if($De['parentCode'][$d]==$fam['code'][$i]){
			    echo '{ "id" : "Department:'.$De['code'][$d].'", "parent" : "family:'.$fam['code'][$i].'", "text" : "'.$De['thaiName'][$d].'"},';
				//=============================================== Category  =====================================================	
					for($c=0;$c<$cntC;$c++){
				     	if($Ca['parentCode'][$c]==$De['code'][$d]){
					    echo '{ "id" : "category:'.$Ca['code'][$c].'", "parent" : "Department:'.$De['code'][$d].'", "text" : "'.$Ca['thaiName'][$c].'"},';
						    //============================================= subCate =====================================================
						    for($s=0;$s<$cntS;$s++){
						     	if($Sub['parentCode'][$s]==$Ca['code'][$c]){
							    echo '{ "id" : "subcate:'.$Sub['code'][$s].'", "parent" : "category:'.$Ca['code'][$c].'", "text" : "'.$Sub['thaiName'][$s].'"},';
								}
							}
						}
					}
			 
				}
			}

  }

?>

        ] ,  

		"check_callback" : true,

        },
        "animation" : 0,
	    
	    "themes" : { "stripes" : true },

        "search": {

            "case_insensitive": true,
            "show_only_matches" : true

        },

        "plugins": ["search","dnd"]
        	
    });
    /*$("#jstreeleft").bind('loaded.jstree', function (event, data) { 
	$("#jstreeleft").jstree("open_all",id);

	//$("#jstreeleft").jstree("open_all","vw_IV_catfamily:00009");
	});*/


});

$('#jstreeleft')
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

	//var edit = document.getElementById("edit").value;
	

   /* alert(t.join())
    alert(i.join())
    alert(p.join())*/

  $.ajax({
  method: "POST",
  url: "itemselect.php",
  data: { id: id}
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
var edit = document.forms["edit"]["id"].value
	
	if(edit == null || edit == ""){document.getElementById("edit_button").disabled = true;}
   else{document.getElementById("edit_button").disabled = false;}

    //alert(str)
  });
	//alert(r.join())
	//alert(s.join())
   
   
 //window.location="itemselect.php";//?id="+r.join('; ')+"&pid="+s.join();  
  });

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
  url: "itemselect.php",
  data: { id: ""}
})
 	$('#title').html('<h1>Root</h1>');
 	$('#content').html('<h1>Root Add family</h1>');
 	document.getElementById("move").value = "";
	document.getElementById("delete").value = "";
	document.getElementById("edit").value = "";
	document.getElementById("add").value = "#root;#disable;disable;.disable;.disable";
}
	</script>
</body>
</html>