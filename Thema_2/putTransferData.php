<?php
header("Content-Type:application/json");
if (isset($_GET['TransferId']) && $_GET['TransferId'] != "") {
    include('db.php');
    $TransferId = $_GET["TransferId"];
    $PlayerId = $_GET["PlayerId"];
    $OldTeamId = $_GET["OldTeamId"];
    $NewTeamId = $_GET["NewTeamId"];
    $TransferSum = $_GET["TransferSum"];
    $values = array($TransferId, $PlayerId, $OldTeamId, $NewTeamId, $TransferSum);
    try {
        $qb = $conn->createQueryBuilder();
        $qb->select("*")->from("tw_transfers")->where("TransferId = $TransferId");
        $result = $qb->executeQuery();
        if ($result->fetchNumeric())
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
    ?>