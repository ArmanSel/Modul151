<?php
header("Content-Type:application/json");
if (isset($_GET['PlayerId']) && $_GET['PlayerId'] != "") {
    include('../PlayerController/deletePlayerController.php');
    $PlayerId = $_GET["PlayerId"];

    deletePlayer($PlayerId);

    echo "Player has successfully been deleted!";
}
?>