<?php
if (isset($_GET['PlayerId']) && $_GET['PlayerId']!="") {

// // Handler for get request. Checks if PlayerId was entered in the URL.

    include('../PlayerController/getPlayerController.php');
    $playerId = $_GET['PlayerId'];

    $result = getPlayer($playerId);

    echo $result;
}
