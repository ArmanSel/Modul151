<?php
header("Content-Type:application/json");
function postPlayer($PlayerFirstName,$PlayerLastName,$PlayerAge,$PlayerNationality,$PlayerPosition){
    $values = array("PlayerFirstName" => "'$PlayerFirstName'", "PlayerLastName" => "'$PlayerLastName'", "PlayerAge" => $PlayerAge,
        "PlayerNationality" => "'$PlayerNationality'", "PlayerPosition" => "'$PlayerPosition'");
    try{
        include('../db.php');
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