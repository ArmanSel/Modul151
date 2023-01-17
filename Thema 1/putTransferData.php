<?php
header("Content-Type:application/json");
if (isset($_GET['TransferId']) && $_GET['TransferId'] != "") {
    include('db.php');
    $TransferId = $_GET["TransferId"];
    $PlayerId = $_GET["PlayerId"];
    $OldTeamId = $_GET["OldTeamId"];
    $NewTeamId = $_GET["NewTeamId"];
    $TransferSum = $_GET["TransferSum"];
    try {
        $stmt = $con->prepare("CALL tw_getTransfersData(?)");
        $stmt->bind_param("i", $TransferId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if (mysqli_num_rows($result) > 0)
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
    ?>