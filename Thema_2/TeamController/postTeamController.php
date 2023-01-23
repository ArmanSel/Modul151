<?php
header("Content-Type:application/json");
function postTeam($TeamName,$TeamLeague){
    $values = array("TeamName" => "'$TeamName'", "TeamLeague" => "'$TeamLeague'");
    try{
        include('../db.php');
        $qb = $conn->createQueryBuilder();
        $qb->insert("tw_teams")->values($values);
        $qb->executeQuery();

        echo "Team has successfully been inserted!";
    }
    catch(\Doctrine\DBAL\Exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}