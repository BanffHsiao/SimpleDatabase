<?php
    $servername = 'localhost';
    $username = 'localhostuser';
    $password = '123';
    $conn = mysqli_connect($servername, $username, $password);
    
    if(! $conn ) {
        die('Could not connect: ' . mysqli_error());
    }
    
    $dbname = $_GET["dbname"];
    $sql = "Drop Database $dbname";
    $retval = mysqli_query( $conn, $sql );
    
    if(! $retval ) {
        die('Could not delete table employee: ' . mysqli_error());
    }
    
    echo "Database $dbname deleted successfully\n";
    
    mysqli_close($conn);

    // return to index html
    header("Location: index.php");
    exit;
?>