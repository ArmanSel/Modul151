<?php
header("Content-Type:application/json");
if (isset($_GET['TransferId']) && $_GET['TransferId'] != "") {
    include('../TransferController/deleteTransferController.php');
    $TransferId = $_GET["TransferId"];

    deleteTransfer($TransferId);
}