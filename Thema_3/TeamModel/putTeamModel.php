<?php
header("Content-Type:application/json");
// Handler for Put request. Checks if TeamId was entered in the request URL.
if (isset($_GET['TeamId']) && $_GET['TeamId'] != "") {
    include('../TeamController/putTeamController.php');
    $TeamId = $_GET["TeamId"];
    $TeamName = $_GET["TeamName"];
    $TeamLeague = $_GET["TeamLeague"];

    putTeam($TeamId,$TeamName,$TeamLeague);
}