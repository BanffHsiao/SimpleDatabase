<?php
    $dbname = $_GET["dbname"];
?>

<html>
    <form action="createTable.php" method="get">
        <input type="hidden" name="dbname" value="<?php echo $dbname; ?>">
        <input name="tablename" type="text" placeholder="table name"></input>
        <div>
            <input id="fieldcount" type="hidden" value="2" name="fieldcount">
            <li>
                <input name="field1" type="text" placeholder="field1"></input> 
                <input name="type1" type="text" placeholder="type1"></input>
            </li>
            <li>
                <input name="field2" type="text" placeholder="field2"></input> 
                <input name="type2" type="text" placeholder="type2"></input>
            </li>
            <div id="createTableInputField"></div>   
        </div>
        <button type="button" onclick="addInputField()">Add Field</button>
        <button type="button" onclick="removeInputField()">Remove Field</button>
        
        <button type="submit">Create Table</button>
    </form>

    <button type="button" onclick="back()">Back</button>
</html>

<script>
    var rowNumber = 2;
    function back() {
        window.location.href = "./DBIndex.php?dbname=<?php echo $dbname; ?>";
    }
    function addInputField() {
        rowNumber++;

        var newRow = document.createElement('li');
        newRow.innerHTML = '<input name="field' + rowNumber + '" type="text" placeholder="field' + rowNumber + '"> </input>' +  
                '<input name="type' + rowNumber + '" type="text" placeholder="type' + rowNumber + '"> </input>';
        document.getElementById('createTableInputField').appendChild(newRow);
        document.getElementById('fieldcount').value = rowNumber;
    }
    function removeInputField() {
        if(rowNumber > 2) {
            var lastRow = document.getElementById('createTableInputField').lastChild;
            document.getElementById('createTableInputField').removeChild(lastRow);
            rowNumber--;
            document.getElementById('fieldcount').value = rowNumber;
        }
    }
</script>