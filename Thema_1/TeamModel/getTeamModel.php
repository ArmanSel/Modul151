<?php
header("Content-Type:application/json");
if (isset($_GET['TeamId']) && $_GET['TeamId']!="") {
    include('../TeamController/getTeamController.php');
    $teamId = $_GET['TeamId'];

    $result = getTeam($teamId);

    echo $result;
}