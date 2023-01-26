<?php
header("Content-Type:application/json");

// Creates a transfer
function postTransfer($PlayerId,$OldTeamId,$NewTeamId,$TransferSum){
    try{
        include('../db.php');
        $stmt = $con->prepare("CALL tw_insertTransfer(?,?,?,?);");
        $stmt->bind_param("iiii", $PlayerId,$OldTeamId,$NewTeamId,$TransferSum);
        $stmt->execute();
        $stmt->close();

        echo "Transfer has successfully been inserted!";
    }
    catch(mysqli_sql_exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}