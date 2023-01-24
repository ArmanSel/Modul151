<?php
header("Content-Type:application/json");
function postTeam($TeamName,$TeamLeague){
    try{
        include('../db.php');
        $teamsCollection = $client->m151->tw_teams;

        $teamsCollection->insertOne(["PlayerId" => $teamsCollection->countDocuments() + 1, "TeamName" => $TeamName, "TeamLeague" => $TeamLeague]);

        echo "Team has successfully been inserted!";
    }
    catch(Exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}