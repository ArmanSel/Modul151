<?php
header("Content-Type:application/json");
// Handler for get request. Checks if PlayerId was entered in the URL.
if (isset($_GET['PlayerId']) && $_GET['PlayerId']!="") {
    include('../PlayerController/getPlayerController.php');
    $playerId = $_GET['PlayerId'];

    getPlayer($playerId);
}