<?php
header("Content-Type:application/json");
function deleteTransfer($TransferId){
    try {
        include('../db.php');
        $stmt = $con->prepare("CALL tw_deleteTransfer(?);");
        $stmt->bind_param("i", $TransferId);
        $stmt->execute();
        $stmt->close();

        echo "Transfer has successfully been deleted!";
    }
    catch(mysqli_sql_exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}