<?php
header("Content-Type:application/json");
if (isset($_GET['TransferId']) && $_GET['TransferId'] != "") {
    include('db.php');
    $TransferId = $_GET["TransferId"];
    $stmt = $con->prepare("CALL tw_deleteTransfer(?);");
    $stmt->bind_param("i", $TransferId);
    $stmt->execute();
    $stmt->close();
}
?>