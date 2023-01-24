<?php
header("Content-Type:application/json");
function deleteTransfer($TransferId){
    try {
        include('../db.php');
        $transfersCollection = $client->m151->tw_transfers;
        settype($TransferId, "integer");
        $transfersCollection->deleteOne(["TransferId" => $TransferId]);

        echo "Transfer has successfully been deleted!";
    }
    catch(Exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}