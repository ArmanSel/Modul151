<?php
header("Content-Type:application/json");
if (isset($_GET['PlayerId']) && $_GET['PlayerId'] != "") {
    include('db.php');
    $PlayerId = $_GET["PlayerId"];
    $OldTeamId = $_GET["OldTeamId"];
    $NewTeamId = $_GET["NewTeamId"];
    $TransferSum = $_GET["TransferSum"];

    $stmt = $con->prepare("CALL tw_insertTransfer(?,?,?,?);");
    $stmt->bind_param("iiii", $PlayerId,$OldTeamId,$NewTeamId,$TransferSum);
    $stmt->execute();
    $stmt->close();
}
?>