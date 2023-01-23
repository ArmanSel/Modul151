<?php
header("Content-Type:application/json");
function putPlayer($PlayerId,$PlayerFirstName,$PlayerLastName,$PlayerAge,$PlayerNationality,$PlayerPosition){
    try {
        include('../db.php');
        if (checkIfPlayerExists($PlayerId, $conn))
        {
            $qb = $conn->createQueryBuilder();
            $qb->update("tw_players")->set("PlayerFirstName", "'$PlayerFirstName'")->set("PlayerLastName", "'$PlayerLastName'")->set("PlayerAge", $PlayerAge)
                ->set("PlayerNationality", "'$PlayerNationality'")->set("PlayerPosition", "'$PlayerPosition'")->where("PlayerId = $PlayerId");
            $qb->executeQuery();
            echo "Player has successfully been updated!";
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

function checkIfPlayerExists($PlayerId, $conn): bool
{
    try {
        $qb = $conn->createQueryBuilder();
        $qb->select("*")->from("tw_players")->where("PlayerId = $PlayerId");
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