<?php
header("Content-Type:application/json");
function deleteTransfer($TransferId){
    try {
        include('../db.php');
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