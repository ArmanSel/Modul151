<?php
header("Content-Type:application/json");
// updates existing Team in the database
function putTeam($TeamId,$TeamName,$TeamLeague){
    try {
        include('../db.php');
        $teamsCollection = $client->m151->tw_teams;
        settype($TeamId, "integer");
        $teamsCollection->findOneAndUpdate(["TeamId" => $TeamId], ['$set' => ["TeamName" => $TeamName, "TeamLeague" => $TeamLeague]]);

        echo "Team has successfully been updated!";
    } catch (Exception $e) {
        echo "A exception occured: " . $e->getMessage();
    }
}