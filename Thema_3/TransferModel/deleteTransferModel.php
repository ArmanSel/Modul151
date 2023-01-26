<?php
header("Content-Type:application/json");
// Handler for Delete request. Checks if TransferId was entered in the request URL.
if (isset($_GET['TransferId']) && $_GET['TransferId'] != "") {
    include('../TransferController/deleteTransferController.php');
    $TransferId = $_GET["TransferId"];

    deleteTransfer($TransferId);
}