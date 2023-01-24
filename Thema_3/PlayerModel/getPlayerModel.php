<?php
header("Content-Type:application/json");
if (isset($_GET['PlayerId']) && $_GET['PlayerId']!="") {
    include('../PlayerController/getPlayerController.php');
    $playerId = $_GET['PlayerId'];

    getPlayer($playerId);
}