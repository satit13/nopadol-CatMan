<?php
	$str = $_GET['id'];
	$api=fopen("itemcode.txt","w");
		fwrite($api,$str);
		fclose($api);

?>