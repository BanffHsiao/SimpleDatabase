<?php
    $servername = "localhost";
    $username = "localhostuser";
    $password = "123";
    $conn = mysqli_connect($servername, $username, $password);

    $dbname = $_GET["dbname"];
    $sql = "CREATE Database $dbname";
    $retval = mysqli_query( $conn, $sql );

    if(! $retval ) {
        die('Could not create database: ' . mysqli_error());

    }

    echo "Database $dbname delete successfully\n";

    mysqli_close($conn);

    // return to index html
    header("Location: index.php");
    exit;
?>
