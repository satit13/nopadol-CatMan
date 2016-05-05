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

$sql =  "SELECT * FROM vw_IV_catfamily ORDER BY 'ASC'"; 
//this function will execute the sql satament
$rs=odbc_exec($connection, $sql);

echo "<table border='1'><tr style='background:gray;'>";
echo "<th>IDfa</th><th>Namefa</th>";
while (odbc_fetch_row($rs)) {
    $faid = odbc_result($rs, 1);
    $faname = odbc_result($rs, 6);
    echo "<tr><td>$faid</td>";
    echo "<td>$faname</td></tr>";

    echo "{
                'id': $faid,
                'text': $faname,
                'icon': '',
                'state': {
                    'opened': false,
                    'disabled': false,
                    'selected': false
                },
                'children': [],
                'liAttributes': null,
                'aAttributes': null

    
},";

}

            ]



        },
        "search": {

            "case_insensitive": true,
            "show_only_matches" : true


        },

        "plugins": ["search"]


    });
});
