<?php
    // Copy the file enterMessageToInsertData.php to enterMessageToDeleteData.php, and do several changes.
    // 1. Change the title to "Enter Message to delete data".
    // 2. Change the action to "deleteData.php".
    // 3. Change the button name to "Delete".
    // 4. In the function back(), change the action to "chooseTableToDelete.php".
    // 5. That's it. generate the code for me.
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
    <form action="deleteData.php" method="get">
        <input type="hidden" name="dbname" value="<?php echo $dbname; ?>">
        <input type="hidden" name="tablename" value="<?php echo $tablename; ?>">
        enter the condition: <br>
        <input type="text" name="field"> is
        <input type="text" name="condition">
        <button type="submit">Delete</button>
    </form>
    <button type="button" onclick="back()">Back</button>
</html>

<script>
    function back() {
        window.location.href = "./chooseTableToDelete.php?dbname=<?php echo $dbname; ?>";
    }
</script>