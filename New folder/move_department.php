<!Doctype html>
<html>
<head>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/bootstrap.css" />
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<meta http-equiv=Content-Type content="text/html; charset=UTF-8">

<script type="text/javascript">
	$(function(){
		$("#begin,#to").sortable({

			contanment:'document',tolerance:'pointer',cursor:'pointer',revert:'true',
			opacity:'0.60',connectWith:"#begin,#to",
			update: function(){
				/*div1 = $('#begin').text();
				document.test.data1.value= div1;
				$('#newlist1').text(div1);

				div2 = $('#to').text();
				document.test.data2.value = div2;
				$('#newlist2').text(div2);*/
			}
	
		});
	});
	
	
	$(function() {
		
		$("#begin").sortable({});
		$("#to").draggable({
			appendTo: "body",
			helper: "clone",
			connectToSortable: "#begin"
		});
		
		$("#to")
		.droppable({drop: function (event,div) {
		
			 var id = div.draggable.attr("id");
			 var name = div.draggable.attr("name");
			 var tonode = document.getElementById("sto").value;
			 var fromnode = document.getElementById("sbegin").value;
			 var fromnodename = $('select#sbegin option:selected').data("value")
			 var tonodename = $('select#sto option:selected').data("value")
			 var xmlhttp=new XMLHttpRequest();
				 xmlhttp.onreadystatechange=function() {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("show_data").innerHTML=xmlhttp.responseText;
					
				}
			}
			var alerts = "ย้าย "+id+" "+name+" จาก "+fromnode+" "+fromnodename+" ไปที่ "+tonode +" "+tonodename+" เรียบร้อยแล้ว"
			alert(alerts)
		xmlhttp.open("GET","save_department.php?code="+id+"&name="+name+"&tonode="+tonode+"&fromnode="+fromnode+"&fromnodename="+fromnodename+"&tonodename="+tonodename,true);
		xmlhttp.send();
			
			} 
			
			});
		$("div").disableSelection();
	});
	
	
	$(function() {
		
		$("#to").sortable({});
		$("#begin").draggable({
			appendTo: "body",
			helper: "clone",
			connectToSortable: "#to"
		});
		
		$("#begin")
		.droppable({drop: function (event,div) {		
			 var id = div.draggable.attr("id");
			 var name = div.draggable.attr("name");
			 var tonode = document.getElementById("sbegin").value;
			 var fromnode = document.getElementById("sto").value;
			 var fromnodename = $('select#sto option:selected').data("value")
			 var tonodename = $('select#sbegin option:selected').data("value")
			 var xmlhttp=new XMLHttpRequest();
				 xmlhttp.onreadystatechange=function() {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("show_data").innerHTML=xmlhttp.responseText;
					
				}
			}
			var alerts = "ย้าย "+id+" "+name+" จาก "+fromnode+" "+fromnodename+" ไปที่ "+tonode +" "+tonodename+" เรียบร้อยแล้ว"
			alert(alerts)
		xmlhttp.open("GET","save_department.php?code="+id+"&name="+name+"&tonode="+tonode+"&fromnode="+fromnode+"&fromnodename="+fromnodename+"&tonodename="+tonodename,true);
		xmlhttp.send();
			
			} 
			
			});
		$("div").disableSelection();
	});
</script>
<title>move item in Department</title>
</head>
<body>
<?php 
	require("require/connect_apiDepartment.php");
	
	

		
	?>
<div id="header"><h1 class="hleft"> Manage Category</h1></div>

<br><br><br><br><h1 class="head">ย้ายข้อมูลภายใน Department</h1>
<hr class="hr">
 
<div id="select">

</div>
<div id="treeview" class="col-md-3 treeview"><?php 
echo "<select  class='form-control'  onChange='return select_function(this)'>";
echo "<option value='1' >--  Family --</option>";
echo "<option value='2' selected='selected'>--  Department --</option>";
echo "<option value='3' >--  Category --</option>";
echo "<option value='4' >-- Sub Cate --</option>";
echo "</select>"; ?></div>

<div id="beginmove" class="col-md-4 beginmove">
<?php

$b_out=json_decode($Depart,true);
$b_result = array();
foreach ($b_out as $b_row) {
  $b_result[$b_row['code']]['code'] = $b_row['code'];
  $b_result[$b_row['code']]['thaiName'] = $b_row['thaiName'];
 
}
  $b_result = array_values($b_result);

      
$bnt=count($b_result);
$b_dd = array_values($b_result);
echo "เลือก Department ต้นทาง : <select class='form-control' id='sbegin' onchange='return begin_id(this);'>";
echo "<option value='' data-value='".$b_result[$b]['thaiName']."'>-- เลือก Department ต้นทาง --</option>";

for($b=0;$b<$bnt;$b++){
echo "<option value='".$b_result[$b]['code']."' data-value='".$b_result[$b]['thaiName']."'>".$b_result[$b]['thaiName']." ".$b_result[$b]['code']."</option>";}
	
	echo "</select>";
echo"<div id=begin></div>";
require("require/connect_apicategory.php");
?>
<script>
function begin_id(str){
var i=0;
var data = <?php echo $cate?>;
var count = data.length;
var allt="";
while(i < count){
	if(data[i].parentCode == str.value){
	
	allt+="<div id='"+ data[i].code +"'name='"+ data[i].thaiName +"'>" + data[i].code +" "+ data[i].thaiName+"</div>";}
	else{allt+=""}
i++;
}
	document.getElementById("begin").innerHTML = allt;
		if(str.value){
		 $("#sto option[value="+str.value+"]").hide();
		 $("#sto option[value!="+str.value+"]").show();
		}		  
}
                    </script>

</div></div>

<div id="moveto" class="col-md-4 moveto">
<?php  	
$out=json_decode($Depart,true);
$result = array();
foreach ($out as $row) {
  $result[$row['code']]['code'] = $row['code'];
  $result[$row['code']]['thaiName'] = $row['thaiName'];
 
}
  $result = array_values($result);

      
$cnt=count($result);
$dd = array_values($result);
echo "เลือก Department ปลายทาง : <select class='form-control' id='sto' onchange='return to_id(this);'>";
echo "<option value='' data-value='".$result[$t]['thaiName']."'>-- เลือก Department ปลายทาง --</option>";
for($t=0;$t<$cnt;$t++){
echo "<option value='".$result[$t]['code']."' data-value='".$result[$t]['thaiName']."'>".$result[$t]['thaiName']." ".$result[$t]['code']."</option>";}
	
	echo "</select>";
echo"<div id=to></div>";
require("require/connect_apicategory.php");
?>
<script>
function to_id(str){
var i=0;
var data = <?php echo $cate?>;
var count = data.length;
var allt="";
while(i < count){
	if(data[i].parentCode == str.value){
	
	allt+="<div id='"+ data[i].code +"'name='"+ data[i].thaiName +"'>" + data[i].code +" "+ data[i].thaiName+"</div>";}
	else{allt+=""}
i++;
}
	document.getElementById("to").innerHTML = allt;
	
	if(str.value){
		 $("#sbegin option[value="+str.value+"]").hide();
		 $("#sbegin option[value!="+str.value+"]").show();
		}			  
}
                    </script>
	</div></div>

<div id="show_data" style="clear:both;"></div>

<div style='clear:both'>
<form name="show" action="save.php" method="post">
<div style='display:none'>
<input type='hidden' name='data1'>
<input type='hidden' name='data2'></div>
<input type='hidden' value="save"  class="btn btn-success">
</form>

</div>
</div>
<script>
	function select_function(str){
		if(str.value==1){
		window.location="move_family.php";
		}else if(str.value==2){
		window.location="move_department.php";
		}else if(str.value==3){
		window.location="move_cate.php";
		}else if(str.value==4){
		window.location="move_subcate.php";
		}
		}
</script>
<div class="back"><a href="index.php" class="back"></a></div>

</body>
</html>