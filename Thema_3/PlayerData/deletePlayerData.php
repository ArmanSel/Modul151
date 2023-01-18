<?php
header("Content-Type:application/json");
if (isset($_GET['PlayerId']) && $_GET['PlayerId'] != "") {
    include('../db.php');
    $PlayerId = $_GET["PlayerId"];
    try {
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
?>