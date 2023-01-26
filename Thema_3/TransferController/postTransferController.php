<?php
header("Content-Type:application/json");
// inserts Transfer from the database.
function postTransfer($PlayerId, $OldTeamId, $NewTeamId, $TransferSum){
    try{
        include("../db.php");
        $transfersCollection = $client->m151->tw_transfers;

        $transfersCollection->insertOne(["TransferId" => $transfersCollection->countDocuments() + 1, "PlayerId" => $PlayerId, "OldTeamId" => $OldTeamId,
        "NewTeamId" => $NewTeamId, "TransferSum" => $TransferSum]);

        echo "Transfer has successfully been inserted!";
    }
    catch(Exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}