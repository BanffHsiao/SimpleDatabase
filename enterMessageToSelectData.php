<?php
    $servername = "localhost";
    $username = "localhostuser";
    $password = "123";
    $dbname = $_GET["dbname"];
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    $tablename = $_GET["tablename"];

    $sql = "SHOW COLUMNS FROM $tablename";
    $retval_columns = mysqli_query( $conn, $sql );
?>

<html>
    <style>
    table, th, td {
        border: 1px solid black;
    }
    </style>
    <?php
    // show the data of the table
        $column_array = array();

        echo '<table style="width:30%"> <tr>';
        $count = 0;
        while ($row = mysqli_fetch_array($retval_columns)){
            echo '<th>' . $row['Field'] . '</th>';
            $count++;
            array_push($column_array, $row['Field']);
        }
        echo '</tr>';
        $sql = "SELECT ";
        while($count > 0) {
            $sql .= $column_array[$count-1];
            if($count != 1) {
                $sql .= ", ";
            }
            $count--;
        }
        $sql .= " FROM $tablename";
        $retval = mysqli_query( $conn, $sql );
        while($row = $retval->fetch_assoc()) {
            echo '<tr>';
            $count = 0;
            while($count < sizeof($column_array)) {
                echo '<td>' . $row[$column_array[$count]] . '</td>';
                $count++;
            }
            echo '</tr>';
        }
        echo '</table>';
        echo '<br>';
    ?>
    <form action="selectData.php" method="get">
        <input type="hidden" name="dbname" value="<?php echo $dbname; ?>">
        <input type="hidden" name="tablename" value="<?php echo $tablename; ?>">
        enter the column to select: <br>
        <div>
            <input id="fieldcount" type="hidden" value="1" name="fieldcount">
            <li>
                <input name="field1" type="text" placeholder="column1"></input> 
            </li>
            <div id="createTableInputField"></div>   
        </div>
        <button type="button" onclick="addColumn()">Add Column</button>
        <button type="button" onclick="removeColumn()">Remove Column</button>
        <button type="submit">Select</button>
    </form>
    <button type="button" onclick="back()">Back</button>
</html>

<script>
    var rowNumber = 1;
    function back() {
        window.location.href = "./chooseTableToDelete.php?dbname=<?php echo $dbname; ?>";
    }
    // add HTML text function
    function addColumn() {
        rowNumber++;

        var newRow = document.createElement('li');
        newRow.innerHTML = '<input name="field' + rowNumber + '" type="text" placeholder="column' + rowNumber + '"> </input>';
        document.getElementById('createTableInputField').appendChild(newRow);
        document.getElementById('fieldcount').value = rowNumber;
    }
    // remove HTML text function
    function removeColumn() {
        if(rowNumber > 1) {
            var lastRow = document.getElementById('createTableInputField').lastChild;
            document.getElementById('createTableInputField').removeChild(lastRow);
            rowNumber--;
            document.getElementById('fieldcount').value = rowNumber;
        }
    }
</script>