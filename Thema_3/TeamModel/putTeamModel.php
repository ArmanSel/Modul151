<?php
header("Content-Type:application/json");
if (isset($_GET['TeamId']) && $_GET['TeamId'] != "") {
    include('../TeamController/putTeamController.php');
    $TeamId = $_GET["TeamId"];
    $TeamName = $_GET["TeamName"];
    $TeamLeague = $_GET["TeamLeague"];

    putTeam($TeamId,$TeamName,$TeamLeague);
}