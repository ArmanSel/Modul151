<?php
header("Content-Type:application/json");
// Handler for Get request. Checks if TeamId was entered in the request URL.
if (isset($_GET['TeamId']) && $_GET['TeamId']!="") {
    include('../TeamController/getTeamController.php');
    $teamId = $_GET['TeamId'];

    $result = getTeam($teamId);

    echo $result;
}