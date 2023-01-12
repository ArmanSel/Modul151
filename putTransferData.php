<?php
header("Content-Type:application/json");
if (isset($_GET['TransferId']) && $_GET['TransferId'] != "") {
    include('db.php');
    $TransferId = $_GET["TransferId"];
    $PlayerId = $_GET["PlayerId"];
    $OldTeamId = $_GET["OldTeamId"];
    $NewTeamId = $_GET["NewTeamId"];
    $TransferSum = $_GET["TransferSum"];

    $check_query = "SELECT * FROM tw_Transfers WHERE TransferId = '$TransferId'";
    $result = $con->query($check_query);

    if ($result->num_rows > 0) {
        // update the data in the database
        $update_query = "UPDATE tw_Transfers SET OldTeamId = '$OldTeamId', NewTeamId = '$NewTeamId', TransferSum = '$TransferSum' WHERE TransferId = '$TransferId'";
        if ($con->query($update_query) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error: " . $update_query . "<br>" . $conn->error;
        }
    } else {
        echo "Error: PlayerId does not exist in the table";
    }
}
    ?>