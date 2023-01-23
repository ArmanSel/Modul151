<?php
header("Content-Type:application/json");
function putTeam($TeamId,$TeamName,$TeamLeague){
    try {
        include('../db.php');
        if (checkIfTeamExists($TeamId, $conn))
        {
            $qb = $conn->createQueryBuilder();
            $qb->update("tw_teams")->set("TeamName", "'$TeamName'")->set("TeamLeague", "'$TeamLeague'")->where("TeamId = $TeamId");
            $qb->executeQuery();

            echo "Teams has successfully been updated!";
        }
        else
        {
            echo "No entry was found in the Database";
        }
    }
    catch(\Doctrine\DBAL\Exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}

function checkIfTeamExists($TeamId, $conn): bool
{
    try {
        $qb = $conn->createQueryBuilder();
        $qb->select("*")->from("tw_teams")->where("TeamId = $TeamId");
        $result = $qb->executeQuery();
        if ($result->fetchNumeric())
        {
            return true;
        }
        return false;
    }
    catch(\Doctrine\DBAL\Exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
        return false;
    }
}