<?php
header("Content-Type:application/json");
function putTransfer($TransferId,$PlayerId,$OldTeamId,$NewTeamId,$TransferSum){
    try {
        include('../db.php');
        $transfersCollection = $client->m151->tw_transfers;
        settype($TransferId, "integer");
        settype($PlayerId, "integer");
        settype($OldTeamId, "integer");
        settype($NewTeamId, "integer");
        settype($TransferSum, "integer");
        $transfersCollection->UpdateOne(["TransferId" => $TransferId], ['$set' => ["PlayerId" => $PlayerId, "OldTeamId" => $OldTeamId, "NewTeamId" => $NewTeamId,
            "TransferSum" => $TransferSum]]);

        echo "Transfer has successfully been updated!";
    }
    catch(Exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}