<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<title>Setting link api</title>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/bootstrap.css" />
</head>

<body>
<div id="header"><h1 class="hleft"> Manage Category</h1></div>
<div class="main">
<?php
$server1 = fopen("server.txt","r") or die("Unable to open file!");
$urlserver = fgets($server1);
fclose($server1);

$myfile1 = fopen("family.txt","r") or die("Unable to open file!");
$url1 = fgets($myfile1);
fclose($myfile1);

$myfile2 = fopen("department.txt","r") or die("Unable to open file!");
$url2 = fgets($myfile2);
fclose($myfile2);

$myfile3 = fopen("category.txt","r") or die("Unable to open file!");
$url3 = fgets($myfile3);
fclose($myfile3);

$myfile4 = fopen("subcate.txt","r") or die("Unable to open file!");
$url4 = fgets($myfile4);
fclose($myfile4);

$myfile5 = fopen("items.txt","r") or die("Unable to open file!");
$url5 = fgets($myfile5);
fclose($myfile5);

$myfile6 = fopen("insert.txt","r") or die("Unable to open file!");
$url6 = fgets($myfile6);
fclose($myfile6);

$myfile7 = fopen("update.txt","r") or die("Unable to open file!");
$url7 = fgets($myfile7);
fclose($myfile7);

$myfile8 = fopen("delete.txt","r") or die("Unable to open file!");
$url8 = fgets($myfile8);
fclose($myfile8);

$myfile9 = fopen("move.txt","r") or die("Unable to open file!");
$url9 = fgets($myfile9);
fclose($myfile9);

$myfile10 = fopen("expert.txt","r") or die("Unable to open file!");
$url10 = fgets($myfile10);
fclose($myfile10);

?>
<!-- ใส่ URL ของไฟล์ sign.php ลงไปบรรทัดด้านล่างนี้ครับ -->
<div class="setting">
<h1 class="head">Setting</h1>
<hr class="hr">
<!--=================================================queuecount==============================================-->
<FORM action="setup.php" method="POST">
<div class="set"><label for="manage">link ของ server:</label>
<INPUT name="server" class="form-control" id="setup" value="<?php echo $urlserver?>" size="40"></div>   
<br class="clear">
<div class="set"><label for="manage">link ของ api Family:</label>
<INPUT name="apifamily" class="form-control" id="setup" value="<?php echo $url1?>" size="40"></div>   
<br class="clear">
<div class="set"><label for="manage">link ของ api Department:</label>
<INPUT name="apidepartment" class="form-control" id="setup" value="<?php echo $url2?>" size="40"></div>  
<br class="clear">
<div class="set"><label for="manage">link ของ api Category:</label>
<INPUT name="apicategory" class="form-control" id="setup" value="<?php echo $url3?>" size="40"></div>
<br class="clear">
<div class="set"><label for="manage">link ของ api Sub-Category:</label>
<INPUT name="apisubcate" class="form-control" id="setup" value="<?php echo $url4?>" size="40"></div>
<br class="clear">
<div class="set"><label for="manage">link ของ api Items:</label>
<INPUT name="apiitems" class="form-control" id="setup" value="<?php echo $url5?>" size="40"></div>
<br class="clear">
<div class="set"><label for="manage">link ของ api Insert:</label>
<INPUT name="apiinsert" class="form-control" id="setup" value="<?php echo $url6?>" size="40"></div>
<br class="clear">
<div class="set"><label for="manage">link ของ api Update:</label>
<INPUT name="apiupdate" class="form-control" id="setup" value="<?php echo $url7?>" size="40"></div>
<br class="clear">
<div class="set"><label for="manage">link ของ api Delete:</label>
<INPUT name="apidelete" class="form-control" id="setup" value="<?php echo $url8?>" size="40"></div>
<br class="clear">
<div class="set"><label for="manage">link ของ api Move:</label>
<INPUT name="apimove" class="form-control" id="setup" value="<?php echo $url9?>" size="40"></div>   
<br class="clear">
<div class="set"><label for="manage">link ของ api catman:</label>
<INPUT name="apicatman" class="form-control" id="setup" value="<?php echo $url10?>" size="40"></div>   
<br class="clear">
<hr class="hr">
<input type="submit" value="ตกลง" class="btn btn-success sett"/>
<input type="reset" value="cancel" class="btn btn-danger"></button>

</FORM>
</div>
<div class="back"><a href="../manage_category.php" class="back"></a></div>
</div>
</body>

</html>