<?php
header("Content-Type:application/json");
if (isset($_GET['PlayerId']) && $_GET['PlayerId'] != "") {
    include('../db.php');
    $PlayerId = $_GET["PlayerId"];
    $PlayerFirstName = $_GET["PlayerFirstName"];
    $PlayerLastName = $_GET["PlayerLastName"];
    $PlayerAge = $_GET["PlayerAge"];
    $PlayerNationality = $_GET["PlayerNationality"];
    $PlayerPosition = $_GET["PlayerPosition"];
    try {
        $qb = $conn->createQueryBuilder();
        $qb->select("*")->from("tw_players")->where("PlayerId = $PlayerId");
        $result = $qb->executeQuery();

        if ($result->fetchNumeric())
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
?>