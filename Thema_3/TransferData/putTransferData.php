<?php
header("Content-Type:application/json");
if (isset($_GET['TransferId']) && $_GET['TransferId'] != "") {
    include('../db.php');
    $TransferId = settype($_GET["TransferId"], "integer");
    $PlayerId = $_GET["PlayerId"];
    $OldTeamId = $_GET["OldTeamId"];
    $NewTeamId = $_GET["NewTeamId"];
    $TransferSum = $_GET["TransferSum"];
    try {
        $transfersCollection = $client->m151->tw_transfers;

        $transfersCollection->findOneAndUpdate(["TransferId" => $TransferSum], ['$set' => ["PlayerId" => $PlayerId, "OldTeamId" => $OldTeamId, "NewTeamId" => $NewTeamId,
            "TransferSum" => $TransferSum]]);

        echo "Transfer has successfully been updated!";
    }
    catch(Exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}
    ?>