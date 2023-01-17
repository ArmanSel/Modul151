<?php
header("Content-Type:application/json");
if (isset($_GET['PlayerId']) && $_GET['PlayerId'] != "") {
    include('db.php');
    $PlayerId = $_GET["PlayerId"];
    $OldTeamId = $_GET["OldTeamId"];
    $NewTeamId = $_GET["NewTeamId"];
    $TransferSum = $_GET["TransferSum"];
    $values =array(
        "PlayerId" => $PlayerId,
        "OldTeamId" => $OldTeamId,
        "NewTeamId" => $NewTeamId,
        "TransferSum" => $TransferSum
    );
    try{
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
?>