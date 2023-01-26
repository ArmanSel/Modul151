<?php
header("Content-Type:application/json");
// Handler for Get request. Checks if TransferId was entered in the request URL.
if (isset($_GET['TransferId']) && $_GET['TransferId']!="") {
    include("../TransferController/getTransferController.php");
    $transferId = $_GET['TransferId'];

    $result = getTransfer($transferId);

    echo $result;
}