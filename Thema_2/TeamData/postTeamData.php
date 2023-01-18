<?php
header("Content-Type:application/json");
if (isset($_GET['TeamName']) && $_GET['TeamName'] != "") {
    include('../db.php');
    $TeamName = $_GET["TeamName"];
    $TeamLeague = $_GET["TeamLeague"];
    $values = array("TeamName" => "'$TeamName'", "TeamLeague" => "'$TeamLeague'");
    try{
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
?>