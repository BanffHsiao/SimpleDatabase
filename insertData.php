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

    // get the column name of the table
    $sql = "SHOW COLUMNS FROM $tablename";
    $retval = mysqli_query( $conn, $sql );
    $row_name = "Field";
    $column = array();
    while ($row = mysqli_fetch_assoc($retval)) {
        array_push($column, $row[$row_name]);
    }

    // $totalfield is the number of fields, from 1 to $count
    $totalfield = $_GET["totalfield"];

    // build the sql statement
    $sql = "INSERT INTO $tablename (";

    // first, the column name

    $count = 0;
    while ($count < $totalfield) {
        $sql .= $column[$count];
        if($count != $totalfield-1) {
            $sql .= ", ";
        }
        $count++;
    }
    $sql .= ") VALUES (";

    // second, the value

    $count = 1;
    $field = array();
    while($count <= $totalfield) {
        array_push($field, $_GET["field" . $count]);
        $count++;
    }

    
    $count = 0;
    while($count < $totalfield) {
        if(is_numeric($field[$count]))
            $sql .= $field[$count];
        else
            $sql .= "'" . $field[$count] . "'";
        if($count != $totalfield-1) {
            $sql .= ", ";
        }
        $count++;
    }
    $sql .= ")";

    $retval = mysqli_query( $conn, $sql );
    
    if(! $retval ) {
        die('Could not create table: ' . mysqli_error());
    }

    echo "Insert data successfully";
    echo '<p>';
    
    mysqli_close($conn);
?>

<html>
    
    <form action="viewData.php" method="get">
        <input type="hidden" name="dbname" value="<?php echo $dbname; ?>"> 
        <input type="hidden" name="tablename" value="<?php echo $tablename; ?>"> 
        <button type="submit">View Data</button>
    </form>
    <form action="DBIndex.php" method="get">
        <input type="hidden" name="dbname" value="<?php echo $dbname; ?>"> 
        <button type="submit">Back</button>
    </form>
</html>