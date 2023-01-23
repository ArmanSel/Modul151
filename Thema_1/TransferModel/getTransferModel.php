<?php
header("Content-Type:application/json");
if (isset($_GET['TransferId']) && $_GET['TransferId']!="") {
    include("../TransferController/getTransferController.php");
    $transferId = $_GET['TransferId'];

    $result = getTransfer($transferId);

    echo $result;
}