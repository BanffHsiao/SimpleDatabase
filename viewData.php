<html>    
    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
    <?php
        $servername = "localhost";
        $username = "localhostuser";
        $password = "123";
        $dbname = $_GET["dbname"];
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $tablename = $_GET["tablename"];

    // show the data of the table(start)
        $sql = "SHOW COLUMNS FROM $tablename";
        $retval_columns = mysqli_query( $conn, $sql );

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

        mysqli_close($conn);
    // show the data of the table(end)
    ?>
    <form action="ChooseTableToView.php" method="get">
        <input type="hidden" name="dbname" value="<?php echo $dbname; ?>"> 
        <button type="submit">Back</button>
    </form>
</html>