<?php
header("Content-Type:application/json");
function getTeam($teamId): ?string
{
    include('../db.php');
    if(!is_numeric($teamId) && strpos($teamId, ",") == false && strtolower($teamId) != "all") {
        echo "Invalid input";
        return null;
    }
    $response = null;
    $teamIdArr = explode(",", $teamId);
    foreach ($teamIdArr as $s) {
        $qb = $conn->createQueryBuilder();
        if (strtolower($teamId) == "all")
        {
            $qb->select("*")->from("tw_teams");
        }
        else
        {
            $qb->select("*")->from("tw_teams")->where("TransferId = $s");
        }
        try {
            $result = $qb->executeQuery();
            while ($row = $result->fetchNumeric()) {
                $errorOccured = false;
                $exceptionMessage = "";
                try {
                    $teamName = $row[1];
                    $teamLeague = $row[2];
                } catch (Exception $e) {
                    $errorOccured = true;
                    $exceptionMessage = "Following exception occured: " . $e->getMessage();
                }

                if ($errorOccured == false)
                {
                    $response .= buildResponse($teamName,$teamLeague);
                }
                else
                {
                    echo $exceptionMessage;
                }
            }
        } catch (\Doctrine\DBAL\Exception $e) {
            echo "Following exception occured: " . $e->getMessage();
        }
    }
    return $response;
}

function buildResponse($teamName,$teamLeague): bool|string
{
    $response['TeamName'] = $teamName;
    $response['TeamLeague'] = $teamLeague;

    return json_encode($response);
}