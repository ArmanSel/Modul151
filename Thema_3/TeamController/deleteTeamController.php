<?php
header("Content-Type:application/json");
function deleteTeam($TeamId){
    try {
        include('../db.php');
        $teamsCollection = $client->m151->tw_teams;
        settype($TeamId, "integer");
        $teamsCollection->deleteOne(["TeamId" => $TeamId]);

        echo "Team has successfully been deleted!";
    }
    catch(Exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}