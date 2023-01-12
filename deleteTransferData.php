<?php
header("Content-Type:application/json");
if (isset($_GET['TransferId']) && $_GET['TransferId'] != "") {
    include('db.php');
    $TransferId = $_GET["TransferId"];

    // delete chosen data from the database
    $sql = "DELETE from tw_Transfers WHERE TransferId = '$TransferId'";
    if ($con->query($sql) === TRUE) {
        echo "New record deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>