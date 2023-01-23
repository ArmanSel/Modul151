<?php
header("Content-Type:application/json");
if (isset($_GET['TeamId']) && $_GET['TeamId'] != "") {
    include('../TeamController/deleteTeamController.php');
    $TeamId = $_GET["TeamId"];

    deletePlayer($TeamId);
}