<?php
header("Content-Type:application/json");
// Handler for Delete request. Checks if TeamId was entered in the request URL.
if (isset($_GET['TeamId']) && $_GET['TeamId'] != "") {
    include('../TeamController/deleteTeamController.php');
    $TeamId = $_GET["TeamId"];

    deleteTeam($TeamId);
}