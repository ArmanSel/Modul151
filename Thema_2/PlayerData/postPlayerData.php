<?php
header("Content-Type:application/json");
if (isset($_GET['PlayerFirstName']) && $_GET['PlayerFirstName'] != "") {
    include('../db.php');
    $PlayerFirstName = $_GET["PlayerFirstName"];
    $PlayerLastName = $_GET["PlayerLastName"];
    $PlayerAge = $_GET["PlayerAge"];
    $PlayerNationality = $_GET["PlayerNationality"];
    $PlayerPosition = $_GET["PlayerPosition"];
    $values = array("PlayerFirstName" => "'$PlayerFirstName'", "PlayerLastName" => "'$PlayerLastName'", "PlayerAge" => $PlayerAge,
        "PlayerNationality" => "'$PlayerNationality'", "PlayerPosition" => "'$PlayerPosition'");
    try{
        $qb = $conn->createQueryBuilder();
        $qb->insert("tw_players")->values($values);
        $qb->executeQuery();

        echo "Player has successfully been inserted!";
    }
    catch(\Doctrine\DBAL\Exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}
?>