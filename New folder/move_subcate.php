<!Doctype html>
<html>
<head>
<link rel="stylesheet" href="css/jquery-ui.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/bootstrap.css" />
<script src="js/jquery-1.10.2.js"></script>
<!--<script src="//code.jquery.com/jquery-1.10.2.js"></script>-->
<script src="js/jquery-ui.js"></script>
<meta http-equiv=Content-Type content="text/html; charset=UTF-8">

<script type="text/javascript">
	$(function(){
		$("#begin,#to").sortable({

			contanment:'document',tolerance:'pointer',cursor:'pointer',revert:'true',
			opacity:'0.60',connectWith:"#begin,#to",
			/*update: function(){
				
				
				div1 = $('#begin').text();
				
				$('#show_data').text(div1);
				var textbox1 = document.getElementById("data1");
				textbox1.value = div1;
				var pid1 = document.getElementById("sbegin").value;
				document.getElementById("pid1").value = pid1;
				

				div2 = $('#to').text();
				
				//$('#newlist2').text(div2);
				var textbox2 = document.getElementById("data2");
				textbox2.value = div2;
				var pid2 = document.getElementById("sto").value;
				document.getElementById("pid2").value = pid2;
			}
	*/
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
			 
			 //var fromnodename = fname.options[fname.selectedIndex].fname;
			 var fname = document.getElementById('sbegin');
			 var fromnodename = $('select#sbegin option:selected').data("value")
			 
			 var tname = document.getElementById('sto');
			 var tonodename = $('select#sto option:selected').data("value")
			 
			
		//var url="save_subcate.php"; // ไฟล์ที่ต้องการรับค้า  
        //var dataSet={ test: "asdasd"}; // กำหนดชื่อและค่าที่ต้องการส่ง  
        //$.get(url,dataSet,function(data){  
          //  alert("แจ้งเเมื่อทำการส่งข้อมูลเรียบร้อยแล้ว"); 
         //});
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.onreadystatechange=function() {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("show_data").innerHTML=xmlhttp.responseText;
				}
			}
			var alerts = "ย้าย "+id+" "+name+"จาก "+fromnode+" "+fromnodename+" ไปที่ "+tonode +" "+tonodename+" เรียบร้อยแล้ว"
			alert(alerts)
		xmlhttp.open("GET","save_subcate.php?code="+id+"&name="+name+"&tonode="+tonode+"&fromnode="+fromnode+"&fromnodename="+fromnodename+"&tonodename="+tonodename,true);
		xmlhttp.send();  
			//alert(id);
			
			} 
			
			});
		$("div").disableSelection();
	});
	
	
		$(function() {
		
		$("#to").sortable({});
		$("#begin").draggable({
			helper: "clone",
			connectToSortable: "#to"
		});
		$("#begin")
		.droppable({drop: function (event,div) {
			 var id = div.draggable.attr("id");
			 var name = div.draggable.attr("name");
			 var tonode = document.getElementById("sbegin").value;
			 var fromnode = document.getElementById("sto").value;
			 var fname = document.getElementById('sto');
			 var fromnodename = $('select#sto option:selected').data("value")
			 
			 var tname = document.getElementById('sbegin');
			 var tonodename = $('select#sbegin option:selected').data("value")
			 
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.onreadystatechange=function() {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("show_data").innerHTML=xmlhttp.responseText;
					
				}
			}
			var alerts = "ย้าย "+id+" "+name+"จาก "+fromnode+" "+fromnodename+" ไปที่ "+tonode +" "+tonodename+" เรียบร้อยแล้ว"
			alert(alerts)
		xmlhttp.open("GET","save_subcate.php?code="+id+"&name="+name+"&tonode="+tonode+"&fromnode="+fromnode+"&fromnodename="+fromnodename+"&tonodename="+tonodename,true);
		xmlhttp.send();  
			//alert(id);
			
			} 
			
			});
		$("div").disableSelection();
	});
	
	
</script>
<title>move item in SubCategory</title>
</head>
<body onLoad="items()">
<?php 

$myfile = fopen("setting/items.txt","r") or die("Unable to open file!");
$urlitems = fgets($myfile);;
fclose($myfile);

if(!empty($_GET['t_select'])){
$t_select=$_GET['t_select'];}else{$t_select="0";}

if(!empty($_GET['b_select'])){
$b_select=$_GET['b_select'];}else{$b_select="0";}
	require("require/connect_apisubcate.php");
	
	?>
<div id="header"><h1 class="hleft"> Manage Category</h1></div>
<br><br><br><br><h1 class="head">ย้ายข้อมูลภายใน Sub-Category</h1>
    <hr class="hr">
<div id="select">

</div>
<div id="treeview" class="col-md-3 treeview"><?php 
echo "<select  class='form-control'  onChange='return select_function(this)'>";
echo "<option value='1'>--  Family --</option>";
echo "<option value='2' >--  Department --</option>";
echo "<option value='3' >--  Category --</option>";
echo "<option value='4' selected='selected' >-- SubCategory --</option>";
echo "</select>"; ?></div>

<div id="beginmove" class="col-md-4 beginmove">
<?php

$b_out=json_decode($subcate,true);
$b_result = array();
foreach ($b_out as $b_row) {
  $b_result[$b_row['code']]['code'] = $b_row['code'];
  $b_result[$b_row['code']]['thaiName'] = $b_row['thaiName'];
 
}
  $b_result = array_values($b_result);

      
$bnt=count($b_result);
$b_dd = array_values($b_result);
echo "เลือก SubCategory ต้นทาง : <select class='form-control' id='sbegin' onchange='return be_select(this);'>";
echo "<option value='0'>-- เลือก SubCategory ต้นทาง --</option>";

for($b=0;$b<$bnt;$b++){
	if($b_result[$b]['code']===$b_select){
echo "<option selected='selected' value='".$b_result[$b]['code']."' data-value='".$b_result[$b]['thaiName']."'>".$b_result[$b]['thaiName']." ".$b_result[$b]['code']."</option>";
}else{
echo "<option value='".$b_result[$b]['code']."' data-value='".$b_result[$b]['thaiName']."'>".$b_result[$b]['thaiName']." ".$b_result[$b]['code']."</option>";
	}
	}
	echo "</select>";
	echo $b_select;
echo"<div id=begin></div>";

$b_data = array (
	"subCatCode" => $b_select
	);
$b_data_string = json_encode($b_data); 
$b_ch = curl_init();
curl_setopt($b_ch, CURLOPT_URL,$urlitems);
curl_setopt($b_ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($b_ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($b_ch, CURLOPT_POST, true);
curl_setopt($b_ch, CURLOPT_POSTFIELDS, $b_data_string);
curl_setopt($b_ch, CURLOPT_HEADER, true);
curl_setopt($b_ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($b_data_string)                                                                       
));       
$b_output = curl_exec($b_ch);
$b_item = "[";
$b_sub = explode(":[",$b_output);
$b_item .= substr($b_sub[1],0,-1);
//echo $b_item;


?>

</div></div>

<div id="moveto" class="col-md-4 moveto">
<?php  	
$out=json_decode($subcate,true);
$result = array();
foreach ($out as $row) {
  $result[$row['code']]['code'] = $row['code'];
  $result[$row['code']]['thaiName'] = $row['thaiName'];
 
}
  $result = array_values($result);

      
$cnt=count($result);
$dd = array_values($result);
echo "เลือก SubCategory ปลายทาง : <select class='form-control' id='sto' onchange='return to_select(this);'>";

echo "<option value='0'>-- เลือก SubCategory ปลายทาง --</option>";
for($t=0;$t<$cnt;$t++){
if($result[$t]['code']===$t_select){
echo "<option selected='selected' value='".$result[$t]['code']."' data-value='".$result[$t]['thaiName']."'>".$result[$t]['thaiName']." ".$result[$t]['code']."</option>";
}else{
echo "<option value='".$result[$t]['code']."' data-value='".$result[$t]['thaiName']."'>".$result[$t]['thaiName']." ".$result[$t]['code']."</option>";

	}
}
	echo "</select>";
	echo $t_select;
echo"<div id=to></div>";

$t_data = array (
	"subCatCode" => $t_select
	);
$t_data_string = json_encode($t_data); 
$t_ch = curl_init();
curl_setopt($t_ch, CURLOPT_URL,$urlitems);
curl_setopt($t_ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($t_ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($t_ch, CURLOPT_POST, true);
curl_setopt($t_ch, CURLOPT_POSTFIELDS, $t_data_string);
curl_setopt($t_ch, CURLOPT_HEADER, true);
curl_setopt($t_ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($t_data_string)                                                                       
));       
$t_output = curl_exec($t_ch);
$t_item = "[";
$t_sub = explode(":[",$t_output);
$t_item .= substr($t_sub[1],0,-1);
//echo $t_item;

?>

	</div></div>


<div id="show_data" style="clear:both;"></div>
<div style='clear:both'>
<form name="test" action="save_subcate.php" method="post">
<input type='hidden' name='data1' id="data1">
<input type='hidden' name='data2' id="data2">

<input type='hidden' name='pid1' id="pid1">
<input type='hidden' name='pid2' id="pid2">
<input type='hidden' value="save"  class="btn btn-success">
</form>
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
		
		function be_select(be){
			var to = document.getElementById("sto").value
			window.location="move_subcate.php?b_select="+be.value+"&t_select="+to;
			}
			function to_select(to){
			var be = document.getElementById("sbegin").value
			window.location="move_subcate.php?t_select="+to.value+"&b_select="+be;
			}
</script>

<script>
function items(){

var b_str = document.getElementById('sbegin').value;
if(b_str){
	 $("#sto option[value="+b_str+"]").hide();
	 $("#sto option[value!="+b_str+"]").show();
	}
var b=0;
var b_data = <?php echo $b_item?>;
var b_count = b_data.length;
var b_all="";
while(b < b_count){
	
	b_all+="<div id='"+ b_data[b].itemCode +"'name='"+ b_data[b].itemName +"'>" + b_data[b].itemCode +" "+ b_data[b].itemName+"</div>";
b++;
}
	document.getElementById("begin").innerHTML = b_all;	
	
	
		
		
		
var t_str = document.getElementById('sto').value;
var t=0;
var t_data = <?php echo $t_item?>;
var t_count = t_data.length;
var t_all="";
while(t < t_count){
	
	t_all+="<div id='"+ t_data[t].itemCode +"' name='"+ t_data[t].itemName +"'> " + t_data[t].itemCode +" "+ t_data[t].itemName+" "+"</div>";
t++;
}
	document.getElementById("to").innerHTML = t_all;	
	if(t_str.value){
		 $("#sbegin option[value="+t_str+"]").hide();
		 $("#sbegin option[value!="+t_str+"]").show();
	}
	

	}	  

                    </script>
<div class="back"><a href="index.php" class="back"></a></div>

</body>
</html>