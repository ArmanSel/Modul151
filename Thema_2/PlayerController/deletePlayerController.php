<?php
header("Content-Type:application/json");
function deletePlayer($PlayerId){
    try {
        include('../db.php');
        $qb = $conn->createQueryBuilder();
        $qb->delete("tw_players")->where("PlayerId = $PlayerId");
        $qb->executeQuery();

        echo "Player has successfully been deleted!";
    }
    catch(\Doctrine\DBAL\Exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}