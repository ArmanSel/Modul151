<?php
header("Content-Type:application/json");
if (isset($_GET['TeamId']) && $_GET['TeamId'] != "") {
    include('../db.php');
    $TeamId = $_GET["TeamId"];
    $TeamName = $_GET["TeamName"];
    $TeamLeague = $_GET["TeamLeague"];
    try {
        $qb = $conn->createQueryBuilder();
        $qb->select("*")->from("tw_teams")->where("TeamId = $TeamId");
        $result = $qb->executeQuery();
        if ($result->rowCount() > 0)
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
?>