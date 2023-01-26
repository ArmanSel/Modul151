<?php
header("Content-Type:application/json");
// Handler for Put request. Checks if TransferId was entered in the request URL.
if (isset($_GET['TransferId']) && $_GET['TransferId'] != "") {
    include("../TransferController/putTransferController.php");
    $TransferId = $_GET["TransferId"];
    $PlayerId = $_GET["PlayerId"];
    $OldTeamId = $_GET["OldTeamId"];
    $NewTeamId = $_GET["NewTeamId"];
    $TransferSum = $_GET["TransferSum"];

    putTransfer($TransferId,$PlayerId,$OldTeamId,$NewTeamId,$TransferSum);
}