<?php
header("Content-Type:application/json");

// Handler for Post request. Checks if PlayerId was entered in the request URL.

if (isset($_GET['PlayerId']) && $_GET['PlayerId'] != "") {
    include("../TransferController/postTransferController.php");
    $PlayerId = $_GET["PlayerId"];
    $OldTeamId = $_GET["OldTeamId"];
    $NewTeamId = $_GET["NewTeamId"];
    $TransferSum = $_GET["TransferSum"];

    postTransfer($PlayerId,$OldTeamId,$NewTeamId,$TransferSum);
}