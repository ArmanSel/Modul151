<?php
header("Content-Type:application/json");
if (isset($_GET['PlayerFirstName']) && $_GET['PlayerFirstName'] != "") {
    include('../db.php');
    $PlayerFirstName = $_GET["PlayerFirstName"];
    $PlayerLastName = $_GET["PlayerLastName"];
    $PlayerAge = $_GET["PlayerAge"];
    $PlayerNationality = $_GET["PlayerNationality"];
    $PlayerPosition = $_GET["PlayerPosition"];
    try{
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
?>