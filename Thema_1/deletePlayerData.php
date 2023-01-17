<?php
header("Content-Type:application/json");
if (isset($_GET['PlayerId']) && $_GET['PlayerId'] != "") {
    include('db.php');
    $PlayerId = $_GET["PlayerId"];
    try {
        $stmt = $con->prepare("CALL tw_deletePlayer(?);");
        $stmt->bind_param("i", $PlayerId);
        $stmt->execute();
        $stmt->close();

        echo "Player has successfully been deleted!";
    }
    catch(mysqli_sql_exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}
?>