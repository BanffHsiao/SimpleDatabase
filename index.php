
<?php
    $servername = "localhost";
    $username = "localhostuser";
    $password = "123";

    $conn = mysqli_connect($servername, $username, $password);
    $sql = "SHOW DATABASES";
    $retval = mysqli_query( $conn, $sql );

    echo "Databases:";
    echo '<p>';
    while ($row = mysqli_fetch_assoc($retval)) {
        echo $row['Database'] . '<p>';
    }
?>

<html>
    <br>
    <button onclick="changeToCreateDBPage()">Create</button>
    <button onclick="changeToDeleteDBPage()">Delete</button>
    <button onclick="changeToUseDBPage()">Use</button>
</html>



<script>
    function changeToCreateDBPage() {
        window.location.href = "./createDB.html";
    }
    function changeToDeleteDBPage() {
        window.location.href = "./deleteDB.html";
    }
    function changeToUseDBPage() {
        window.location.href = "./useDB.html";
    }
</script>