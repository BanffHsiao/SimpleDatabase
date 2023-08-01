<html>    
    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
    <?php
        $servername = 'localhost';
        $username = 'localhostuser';
        $password = '123';
        $dbname = $_GET["dbname"];

        $conn = mysqli_connect($servername, $username, $password, $dbname);
        
        if(! $conn ) {
            die('Could not connect: ' . mysqli_error());
        }
        
        $tablename = $_GET["tablename"];

        $field = array();
        $fieldcount = $_GET["fieldcount"];

        $count = 1;

        while($count <= $fieldcount) {
            array_push($field, $_GET["field" . $count]);
            $count++;
        }

        $count = 0;

        $sql = "SELECT ";
        while($count < $fieldcount) {
            $sql .= "$field[$count] ";
            if($count != ($fieldcount-1)) {
                $sql .= ", ";
            }
            $count++;
        }
        $sql .= "FROM $tablename";
        $retval = mysqli_query( $conn, $sql );
        
        if ($retval->num_rows > 0) {
            echo '<table style="width:30%"> <tr>';
            $count = 0;
            while ($count < $fieldcount){
                echo '<th>' . $field[$count] . '</th>';
                $count++;
            }
            echo '</tr>';
            // output data of each row
            while($row = $retval->fetch_assoc()) {
                $count = 0;
                
                echo '<tr>';
                while($count < $fieldcount) {
                    echo '<td>' . $row[$field[$count]] . '</td>';
                    $count++;
                }
                echo '</tr>';
            }
            echo '</table> <br>';
        } 
        else {
            echo "0 results";
        }
        
        mysqli_close($conn);
    ?>
    <form action="enterMessageToSelectData.php" method="get">
        <input type="hidden" name="dbname" value="<?php echo $dbname; ?>"> 
        <input type="hidden" name="tablename" value="<?php echo $tablename; ?>">
        <button type="submit">Back</button>
    </form>
</html>