<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
$server = $_POST['server'];
$fpserver = fopen("server.txt","w");

$apifamily = $_POST['apifamily'];
$fpfamily = fopen("family.txt","w");

$apidepartment = $_POST['apidepartment'];
$fpdepartment = fopen("department.txt","w");

$apicategory = $_POST['apicategory'];
$fpcategory = fopen("category.txt","w");

$apisubcate = $_POST['apisubcate'];
$fpsubcate = fopen("subcate.txt","w");

$apiitems = $_POST['apiitems'];
$fpitems = fopen("items.txt","w");

$apiinsert = $_POST['apiinsert'];
$fpinsert = fopen("insert.txt","w");

$apiupdate = $_POST['apiupdate'];
$fpupdate = fopen("update.txt","w");

$apidelete = $_POST['apidelete'];
$fpdelete = fopen("delete.txt","w");

$apimove = $_POST['apimove'];
$fpmove = fopen("move.txt","w");

$apicatman = $_POST['apicatman'];
$fpexpert = fopen("expert.txt","w");


fputs($fpfamily,$apifamily);
fputs($fpdepartment,$apidepartment);
fputs($fpcategory,$apicategory);
fputs($fpsubcate,$apisubcate);
fputs($fpitems,$apiitems);
fputs($fpinsert,$apiinsert);
fputs($fpupdate,$apiupdate);
fputs($fpdelete,$apidelete);
fputs($fpmove,$apimove);
fputs($fpexpert,$apicatman);
fputs($fpserver,$server);



fclose($fpfamily);
fclose($fpdepartment);
fclose($fpcategory);
fclose($fpsubcate);
fclose($fpitems);
fclose($fpinsert);
fclose($fpupdate);
fclose($fpdelete);
fclose($fpmove);
fclose($fpexpert);
fclose($fpserver);
}
?>
<script>window.location="setting.php"</script>
