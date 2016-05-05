<!Doctype html>
<html>
<head>
<meta charset="utf-8">
<title>TEST</title>
</head>
<body>

<div id='family'>

</div>
<?php
echo "<p style='display:none;'>";
require("connect_apifamily.php");
echo "</p>";

?>
<script type="text/javascript">
	
var con = <?php echo $end; ?>;
var i = 0;
var count = con.length;
var all ="";

while(i < count){
	
	 if(con[i].code==33333){
	 	all = "family";
	 	i = count+1;
	 }else{
	 	all = "not data";
	 }
		i++;
	}
	  document.getElementById("family").innerHTML = all
</script>

</body>
</html>