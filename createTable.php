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
    $type = array();
    $fieldcount = $_GET["fieldcount"];
    $count = 1;

    while($count <= $fieldcount) {
        array_push($field, $_GET["field" . $count]);
        array_push($type, $_GET["type" . $count]);
        $count++;
    }
    $count = 0;

    $sql = "CREATE Table $tablename(";
    while($count < $fieldcount) {
        $sql .= "$field[$count] $type[$count]";
        if($count != ($fieldcount-1)) {
            $sql .= ", ";
        }
        $count++;
    }
    $sql .= ")";
    $retval = mysqli_query( $conn, $sql );
    
    if(! $retval ) {
        die('Could not create table: ' . mysqli_error());
    }
    echo "create $tablename successfully\n";
    
    mysqli_close($conn);
?>

<html>
    <form action="DBIndex.php" method="get">
        <input type="hidden" name="dbname" value="<?php echo $dbname; ?>"> 
        <button type="submit">Back</button>
    </form>
</html>