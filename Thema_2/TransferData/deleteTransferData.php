<?php
header("Content-Type:application/json");
if (isset($_GET['TransferId']) && $_GET['TransferId'] != "") {
    include('../db.php');
    $TransferId = $_GET["TransferId"];
    try {
        $qb = $conn->createQueryBuilder();
        $qb->delete("tw_transfers")->where("TransferId = $TransferId");
        $qb->executeQuery();

        echo "Transfer has successfully been deleted!";
    }
    catch(\Doctrine\DBAL\Exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}
?>