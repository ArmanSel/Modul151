<?php
header("Content-Type:application/json");
function putTransfer($TransferId,$PlayerId,$OldTeamId,$NewTeamId,$TransferSum){
    try {
        include('../db.php');
        $transfersCollection = $client->m151->tw_transfers;

        $result = $transfersCollection->updateMany(["TransferId" => $TransferId], ['$set' => ["PlayerId" => $PlayerId, "OldTeamId" => $OldTeamId, "NewTeamId" => $NewTeamId,
            "TransferSum" => $TransferSum]]);

        echo "Transfer has successfully been updated!";
        echo $result->getUpsertedCount();
    }
    catch(Exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}