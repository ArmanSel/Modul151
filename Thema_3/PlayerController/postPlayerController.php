<?php
header("Content-Type:application/json");
// Inserts Player in database.
function postPlayer($PlayerFirstName,$PlayerLastName,$PlayerAge,$PlayerNationality,$PlayerPosition){
    try{
        include('../db.php');
        $playersCollection = $client->m151->tw_players;

        $playersCollection->insertOne(["PlayerId" => $playersCollection->countDocuments() + 1, "PlayerFirstName" => $PlayerFirstName, "PlayerLastName" => $PlayerLastName,
        "PlayerAge" => $PlayerAge, "PlayerNationality" => $PlayerNationality, "PlayerPosition" => $PlayerPosition]);

        echo "Player has successfully been inserted!";
    }
    catch(Exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}