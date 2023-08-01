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
    $sql = "UPDATE $tablename SET ";
    $setfield = $_GET["setfield"];
    $setcondition = $_GET["setcondition"];
    $wherefield = $_GET["wherefield"];
    $wherecondition = $_GET["wherecondition"];
    if(is_numeric($setcondition))
        $sql .= "$setfield = $setcondition";
    else
        $sql .= "$setfield = '$setcondition'";
    if(is_numeric($wherecondition))
        $sql .= " WHERE $wherefield = $wherecondition";
    else
        $sql .= " WHERE $wherefield = '$wherecondition'";
    $retval = mysqli_query( $conn, $sql );
    if(! $retval ) {
        die('Could not update data: ' . mysqli_error());
    }

    echo "Update data successfully";
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