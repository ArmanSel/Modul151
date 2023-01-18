<?php
header("Content-Type:application/json");
if (isset($_GET['PlayerId']) && $_GET['PlayerId'] != "") {
    include('../db.php');
    $PlayerId = settype($_GET["PlayerId"], "integer");
    $PlayerFirstName = $_GET["PlayerFirstName"];
    $PlayerLastName = $_GET["PlayerLastName"];
    $PlayerAge = $_GET["PlayerAge"];
    $PlayerNationality = $_GET["PlayerNationality"];
    $PlayerPosition = $_GET["PlayerPosition"];
    try {
        $playersCollection = $client->m151->tw_players;

        $playersCollection->findOneAndUpdate(["PlayerId" => $PlayerId], ['$set' => ["PlayerFirstName" => $PlayerFirstName, "PlayerLastName" => $PlayerLastName,
            "PlayerAge" => $PlayerAge, "PlayerNationality" => $PlayerNationality, "PlayerPosition" => $PlayerPosition]]);

        echo "Player has successfully been updated!";
    }
    catch(Exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}
    ?>