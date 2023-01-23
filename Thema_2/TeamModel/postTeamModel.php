<?php
header("Content-Type:application/json");
if (isset($_GET['TeamName']) && $_GET['TeamName'] != "") {
    include('../TeamController/postTeamController.php');
    $TeamName = $_GET["TeamName"];
    $TeamLeague = $_GET["TeamLeague"];

    postTeam($TeamName,$TeamLeague);
}