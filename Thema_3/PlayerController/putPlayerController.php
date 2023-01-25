<?php
header("Content-Type:application/json");
function putPlayer($PlayerId,$PlayerFirstName,$PlayerLastName,$PlayerAge,$PlayerNationality,$PlayerPosition){
    try {
        include('../db.php');
        $playersCollection = $client->m151->tw_players;
        settype($PlayerId, "integer");
        $playersCollection->updateOne(["PlayerId" => $PlayerId], ['$set' => ["PlayerFirstName" => $PlayerFirstName, "PlayerLastName" => $PlayerLastName,
            "PlayerAge" => $PlayerAge, "PlayerNationality" => $PlayerNationality, "PlayerPosition" => $PlayerPosition]]);

        echo "Player has successfully been updated!";
    } catch (Exception $e) {
        echo "A exception occured: " . $e->getMessage();
    }
}