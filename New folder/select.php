<!--<!doctype>
<html>
<head>
	<title>Select * </title>
</head>
<body>
<?php
/*
require("connect_nebula2.php");

$sql =  "SELECT TOP 1 * FROM vw_IV_catfamily ORDER BY 'ASC'"; 
//this function will execute the sql satament
$rs=odbc_exec($connection, $sql);


echo "<table border='1'><tr style='background:gray;''>";
echo "<th>IDfa</th><th>Namefa</th>";
while (odbc_fetch_row($rs)) {
	$faid = odbc_result($rs, 1);
	$faname = odbc_result($rs, 6);
	echo "<tr><td>$faid</td>";
	echo "<td>$faname</td></tr>";

	echo '{
                "id": '.$faid.',
                "text":'. $faname.',
                "icon": "",
                "state": {
                    "opened": false,
                    "disabled": false,
                    "selected": false
                },
                "children": [],
                "liAttributes": null,
                "aAttributes": null

	
},';

}

echo "</table>";*/


?>
</body>
</html>-->
<!DOCTYPE html>
<html lang="en">
<head>
	<title>jstree basic demos</title>

	<link rel="stylesheet" href="dist\themes\default\style.min.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	

</head>
<body>
<div style="font">
    Search : <input class="search-input form-control"></input>
</div>
<div style="font:18px black;"><b>Root</b></div>
<div id="jstree">
   
</div>
	<script src="dist\jstree.min.js"></script>
	<script >
$(function() {

    $(".search-input").keyup(function() {

        var searchString = $(this).val();
        console.log(searchString);
        $('#jstree').jstree('search', searchString);
    });


    $('#jstree').jstree({
        'core': {
        	'data': [
<?php  
					require("connect_nebula2.php");
				   
                            $sqls =  "SELECT top 5 * FROM vw_IV_catsubcategory ORDER BY 'ASC'"; 
                            $sub = odbc_exec($connection, $sqls);
                                    
                                while(odbc_fetch_row($sub)){
                                    $csid = odbc_result($sub, 1);
                                    $sid = odbc_result($sub, 2);
                                    $sname = odbc_result($sub, 4);

                                   echo  '{ "id" : "'.$sid.'", "parent" : "#", "text" : "'.$sname.'" },';

                                    $sqlI =  "SELECT top 5  * FROM bcitem WHERE CategoryCode != '' AND CategoryCode = '$sid'"; 
                                    $item = odbc_exec($connection, $sqlI);


                                        while (odbc_fetch_row($item)) {

                                            $subID = odbc_result($item, 6);
                                            $itemID = odbc_result($item, 2);
                                            $itemname = odbc_result($item, 3);

                                            echo  '{ "id" : "'.$itemID.'", "parent" : "'.$subID.'", "text" : "'.$itemname.'" },';
                                            //echo  '{ "id" : "'.$itemID.'", "parent" : "#", "text" : "'.$itemname.'" },';
                                        }
                                    
                                }
                                

				    ?>
        ]    



        },
        "search": {

            "case_insensitive": true,
            "show_only_matches" : true


        },

        "plugins": ["search"]


    });
});

	</script>
</body>
</html>
