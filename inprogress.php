<HTML>
<HEAD>
    <TITLE> Add/Remove dynamic rows in HTML table </TITLE>
    <SCRIPT language="javascript">
        function addRow(tableID) {

            var table = document.getElementById(tableID);

            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);

            var cell1 = row.insertCell(0);
            var element1 = document.createElement("input");
            element1.type = "checkbox";
            element1.name="chkbox[]";
            cell1.appendChild(element1);

            var cell2 = row.insertCell(1);
            cell2.innerHTML = rowCount + 1;

            var cell3 = row.insertCell(2);
            var element2 = document.createElement("input");
            element2.type = "text";
            element2.name = "txtbox[]";
            cell3.appendChild(element2);


        }

        function deleteRow(tableID) {
            try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;

            for(var i=0; i<rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked) {
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }


            }
            }catch(e) {
                alert(e);
            }
        }

    </SCRIPT>
</HEAD>
<BODY>

    <INPUT type="button" value="Add Row" onClick="addRow('dataTable')" />

    <INPUT type="button" value="Delete Row" onClick="deleteRow('dataTable')" />
 <form action="" method="post">
 <?php $i= 1; ?>
    <TABLE id="dataTable" width="350px" border="1">
        <TR>
            <TD><INPUT type="checkbox" name="chk"/></TD>
            <TD> 1 </TD>
            <TD> <INPUT type="text" name="harsh"/> </TD>
        </TR>
    </TABLE>
    <input name="saveNewSales" type="submit" value="Save" id="button2" style="text-align:center"/>
 </form>
 <?php

foreach($_POST as $name => $content) { // Most people refer to $key => $value
   echo "The HTML name: $name <br>";
   echo "The content of it: $content <br>";
}
?>

</BODY>
</HTML>