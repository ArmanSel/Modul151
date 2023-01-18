<?php
header("Content-Type:application/json");
if (isset($_GET['TransferId']) && $_GET['TransferId'] != "") {
    include('../db.php');
    $TransferId = $_GET["TransferId"];
    try {
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
?>