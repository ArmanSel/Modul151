<?php
header("Content-Type:application/json");
if (isset($_GET['PlayerId']) && $_GET['PlayerId'] != "") {
    include('../db.php');
    $PlayerId = $_GET["PlayerId"];
    try {
        $qb = $conn->createQueryBuilder();
        $qb->delete("tw_players")->where("PlayerId = $PlayerId");
        $qb->executeQuery();

        echo "Player has successfully been deleted!";
    }
    catch(\Doctrine\DBAL\Exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}
?>