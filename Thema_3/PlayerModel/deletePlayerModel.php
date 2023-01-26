<?php
header("Content-Type:application/json");
// Handler for Delete request. Checks if PlayerId was entered in the request URL.
if (isset($_GET['PlayerId']) && $_GET['PlayerId'] != "") {
    include('../PlayerController/deletePlayerController.php');
    $PlayerId = $_GET["PlayerId"];

    deletePlayer($PlayerId);
}