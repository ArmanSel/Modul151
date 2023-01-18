<?php
header("Content-Type:application/json");
if (isset($_GET['TeamId']) && $_GET['TeamId'] != "") {
    include('../db.php');
    $TeamId = $_GET["TeamId"];
    try {
        $qb = $conn->createQueryBuilder();
        $qb->delete("tw_teams")->where("TeamId = $TeamId");

        echo "Team has successfully been deleted!";
    }
    catch(mysqli_sql_exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}
?>