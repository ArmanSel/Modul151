<?php
header("Content-Type:application/json");
function postTransfer($PlayerId,$OldTeamId,$NewTeamId,$TransferSum){
    $values =array(
        "PlayerId" => $PlayerId,
        "OldTeamId" => $OldTeamId,
        "NewTeamId" => $NewTeamId,
        "TransferSum" => $TransferSum
    );
    try{
        include('../db.php');
        $qb = $conn->createQueryBuilder();
        $qb->insert("tw_transfers")->values($values);
        $qb->executeQuery();

        echo "Transfer has successfully been inserted!";
    }
    catch(\Doctrine\DBAL\Exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}