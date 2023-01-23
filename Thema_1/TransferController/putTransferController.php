<?php
header("Content-Type:application/json");
function putTransfer($TransferId,$PlayerId,$OldTeamId,$NewTeamId,$TransferSum){
    try {
        include('../db.php');
        if (checkIfTransferExists($TransferId, $con))
        {
            $stmt = $con->prepare("CALL tw_updateTransfer(?,?,?,?,?);");
            $stmt->bind_param("iiiii", $TransferId,$PlayerId,$OldTeamId,$NewTeamId,$TransferSum);
            $stmt->execute();
            $stmt->close();

            echo "Transfer has successfully been updated!";
        }
        else
        {
            echo "No entry was found in the Database";
        }
    }
    catch(mysqli_sql_exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}

function checkIfTransferExists($TransferId, $con): bool
{
    try {
        $stmt = $con->prepare("CALL tw_getTransfersData(?)");
        $stmt->bind_param("i", $TransferId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if (mysqli_num_rows($result) > 0) {
            return true;
        }
        return false;
    }
    catch(mysqli_sql_exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
        return false;
    }
}