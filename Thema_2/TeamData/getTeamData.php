<?php
header("Content-Type:application/json");
if (isset($_GET['TeamId']) && $_GET['TeamId']!="") {
    include('../db.php');
    $teamId = $_GET['TeamId'];
    if(!is_numeric($teamId)){
        if (strpos($teamId, ",") == false){
            if (strtolower($teamId) != "all")
            {
                echo "Invalid input";
                return;
            }
        }
    }
    if ($teamId == "all")
    {
        $qb = $conn->createQueryBuilder();
        $qb->select("*")->from("tw_teams");
        try {
            $result = $qb->executeQuery();
            while ($row = $result->fetchNumeric())
            {
                $errorOccured = false;
                $exceptionMessage = "";
                try {
                    $teamName = $row[1];
                    $teamLeague = $row[2];
                } catch (Exception $e) {
                    $errorOccured = true;
                    $exceptionMessage = "Following exception occured: " . $e->getMessage();
                }
                response($teamName, $teamLeague, $errorOccured, $exceptionMessage);
            }
        } catch (\Doctrine\DBAL\Exception $e) {
            echo "Following exception occured: " . $e->getMessage();
        }
    }
    else{
        $teamIdArr = explode(",", $teamId);
        foreach ($teamIdArr as $s) {
            $qb = $conn->createQueryBuilder();
            $qb->select("*")->from("tw_teams")->where("TransferId = $s");
            try {
                $result = $qb->executeQuery();
                if ($row = $result->fetchNumeric()) {
                    $errorOccured = false;
                    $exceptionMessage = "";
                    try {
                        $teamName = $row[1];
                        $teamLeague = $row[2];
                    } catch (Exception $e) {
                        $errorOccured = true;
                        $exceptionMessage = "Following exception occured: " . $e->getMessage();
                    }
                    response($teamName, $teamLeague, $errorOccured, $exceptionMessage);
                } else {
                    echo "No record found!";
                }
            } catch (\Doctrine\DBAL\Exception $e) {
                echo "Following exception occured: " . $e->getMessage();
            }
        }
    }
}

function response($teamName,$teamLeague,$errorOccured,$exceptionMessage=null){
    if ($errorOccured == false)
    {
        $response['TeamName'] = $teamName;
        $response['TeamLeague'] = $teamLeague;

        $json_response = json_encode($response);
        echo $json_response;
    }
    else
    {
        echo $exceptionMessage;
    }
}