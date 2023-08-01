<?php
    // connect to the database
    $servername = 'localhost';
    $username = 'localhostuser';
    $password = '123';
    $dbname = $_GET["dbname"];

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    if(! $conn ) {
        die('Could not connect: ' . mysqli_error());
    }
    
    $tablename = $_GET["tablename"];

    // delete the data according to the condition
    $sql = "DELETE FROM $tablename WHERE ";
    $field = $_GET["field"];
    $condition = $_GET["condition"];
    $sql .= "$field = $condition";
    $retval = mysqli_query( $conn, $sql );
    if(! $retval ) {
        die('Could not delete data: ' . mysqli_error());
    }

    echo "Delete data successfully";
    echo '<p>';
?>

<html>
    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
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