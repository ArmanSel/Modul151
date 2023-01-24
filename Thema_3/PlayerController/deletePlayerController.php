<?php
header("Content-Type:application/json");
function deletePlayer($PlayerId){
    try {
        include('../db.php');
        $playersCollection = $client->m151->tw_players;
        settype($PlayerId, "integer");
        $playersCollection->deleteOne(["PlayerId" => $PlayerId]);

        echo "Player has successfully been deleted!";
    }
    catch(Exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}