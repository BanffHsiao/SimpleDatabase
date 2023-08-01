<?php
    $servername = "localhost";
    $username = "localhostuser";
    $password = "123";
    $dbname = $_GET["dbname"];
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SHOW Tables";
    $retval = mysqli_query( $conn, $sql );

    echo "Tables in database $dbname:\n";
    echo '<p>';
    $row_name = "Tables_in_$dbname";
    while ($row = mysqli_fetch_assoc($retval)) {
        echo $row[$row_name] . '<p>';
    }

    mysqli_close($conn);
?>
<html>
    <br>
    <form action="enterMessageToCreateTable.php" method="get">
        <input type="hidden" name="dbname" value="<?php echo $dbname; ?>">
        <button type="submit">Create Table</button>
    </form>

    <form action="chooseTableToInsert.php" method="get">
        <input type="hidden" name="dbname" value="<?php echo $dbname; ?>">
        <button type="submit">Insert</button>
    </form>

    <form action="chooseTableToView.php" method="get">
        <input type="hidden" name="dbname" value="<?php echo $dbname; ?>">
        <button type="submit">View</button>
    </form>

    <form action="chooseTableToSelect.php" method="get">
        <input type="hidden" name="dbname" value="<?php echo $dbname; ?>">
        <button type="submit">Select</button>
    </form>

    <form action="chooseTableToUpdate.php" method="get">
        <input type="hidden" name="dbname" value="<?php echo $dbname; ?>">
        <button type="submit">Update</button>
    </form>

    <form action="chooseTableToDelete.php" method="get">
        <input type="hidden" name="dbname" value="<?php echo $dbname; ?>">
        <button type="submit">Delete</button>
    </form>

    <button type="button" onclick="back()">Back</button>
</html>

<script>
    function back() {
        window.location.href = "./useDB.html";
    }
</script>
