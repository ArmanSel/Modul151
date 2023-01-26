<?php
header("Content-Type:application/json");
// Handler for Post request. Checks if TeamName was entered in the request URL.
if (isset($_GET['TeamName']) && $_GET['TeamName'] != "") {
    include('../TeamController/postTeamController.php');
    $TeamName = $_GET["TeamName"];
    $TeamLeague = $_GET["TeamLeague"];

    postTeam($TeamName,$TeamLeague);
}