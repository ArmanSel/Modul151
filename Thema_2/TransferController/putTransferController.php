<?php
header("Content-Type:application/json");
function putTransfer($TransferId,$PlayerId,$OldTeamId,$NewTeamId,$TransferSum){
    try {
        include('../db.php');
        if (checkIfTransferExists($TransferId,$conn))
        {
            $qb = $conn->createQueryBuilder();
            $qb->update("tw_transfers")->set("PlayerId", $PlayerId)->set("OldTeamId", $OldTeamId)->set("NewTeamId", $NewTeamId)->set("TransferSum", $TransferSum)->where("TransferId = $TransferId");
            $qb->executeQuery();

            echo "Transfer has successfully been updated!";
        }
        else
        {
            echo "No entry was found in the Database";
        }
    }
    catch(\Doctrine\DBAL\Exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}

function checkIfTransferExists($TransferId, $conn): bool
{
    try {
        $qb = $conn->createQueryBuilder();
        $qb->select("*")->from("tw_transfers")->where("TransferId = $TransferId");
        $result = $qb->executeQuery();
        if ($result->fetchNumeric())
        {
            return true;
        }
        return false;
    }
    catch(\Doctrine\DBAL\Exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
        return false;
    }
}