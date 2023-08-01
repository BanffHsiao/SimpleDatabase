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

    echo "Choose table to select data";
    echo '<p>';

    mysqli_close($conn);
?>
<html>
    <form action="enterMessageToSelectData.php" method="get">
        <?php
            $row_name = "Tables_in_$dbname";
            while ($row = mysqli_fetch_assoc($retval)) {
                echo '<input type="radio" name="tablename" value=' . $row[$row_name] . '>' . $row[$row_name] . '<p>';
            }
        ?>
        <input type="hidden" name="dbname" value="<?php echo $dbname; ?>">
        <button type="submit">Choose</button>
    </form>
    <button type="button" onclick="back()">Back</button>
</html>

<script>
    function back() {
        window.location.href = "./DBIndex.php?dbname=<?php echo $dbname; ?>";
    }
</script>