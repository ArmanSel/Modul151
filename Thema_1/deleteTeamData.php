<?php
header("Content-Type:application/json");
if (isset($_GET['TeamId']) && $_GET['TeamId'] != "") {
    include('db.php');
    $TeamId = $_GET["TeamId"];
    try {
        $stmt = $con->prepare("CALL tw_deleteTeam(?);");
        $stmt->bind_param("i", $TeamId);
        $stmt->execute();
        $stmt->close();

        echo "Team has successfully been deleted!";
    }
    catch(mysqli_sql_exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}
?>