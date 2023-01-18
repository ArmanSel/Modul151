<?php
header("Content-Type:application/json");
if (isset($_GET['PlayerId']) && $_GET['PlayerId'] != "") {
    include('../db.php');
    $PlayerId = $_GET["PlayerId"];
    $OldTeamId = $_GET["OldTeamId"];
    $NewTeamId = $_GET["NewTeamId"];
    $TransferSum = $_GET["TransferSum"];
    try{
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
?>