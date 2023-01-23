<?php
header("Content-Type:application/json");
function deleteTeam($TeamId){
    try {
        include("../db.php");
        $qb = $conn->createQueryBuilder();
        $qb->delete("tw_teams")->where("TeamId = $TeamId");
        $qb->executeQuery();

        echo "Team has successfully been deleted!";
    }
    catch(mysqli_sql_exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}