<?php
    $servername = "localhost";
    $username = "localhostuser";
    $password = "123";
    $dbname = $_GET["dbname"];
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    $tablename = $_GET["tablename"];

?>
<html>
    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
    <?php
    // get the column name of the table
        $sql = "SHOW COLUMNS FROM $tablename";
        $retval_columns = mysqli_query( $conn, $sql );
    // show the data of the table(start)
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
    // show the data of the table(end)
    ?>
    <form action="UpdateData.php" method="get">
        <input type="hidden" name="dbname" value="<?php echo $dbname; ?>">
        <input type="hidden" name="tablename" value="<?php echo $tablename; ?>">
        In which condition: <br>
        <input type="text" name="wherefield"> is
        <input type="text" name="wherecondition">
        <br> update the data to: <br>
        <input type="text" name="setfield"> is
        <input type="text" name="setcondition">
        <button type="submit">Update</button>
    </form>
    <button type="button" onclick="back()">Back</button>
</html>

<script>
    function back() {
        window.location.href = "./chooseTableToInsert.php?dbname=<?php echo $dbname; ?>";
    }
</script>