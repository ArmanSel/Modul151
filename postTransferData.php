<?php
header("Content-Type:application/json");
if (isset($_GET['PlayerId']) && $_GET['PlayerId'] != "") {
    include('db.php');
    $PlayerId = $_GET["PlayerId"];
    $OldTeamId = $_GET["OldTeamId"];
    $NewTeamId = $_GET["NewTeamId"];
    $TransferSum = $_GET["TransferSum"];

    // insert the data into the database
    $sql = "INSERT INTO tw_Transfers (PlayerId, OldTeamId, NewTeamId, TransferSum) VALUES ('$PlayerId', '$OldTeamId', '$NewTeamId', '$TransferSum')";
    if ($con->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>