<?php
header("Content-Type:application/json");
function getPlayer($playerId): ?string
{
    include('../db.php');
    if(!is_numeric($playerId) && strpos($playerId, ",") == false && strtolower($playerId) != "all") {
        echo "Invalid input";
        return null;
    }
    $response = null;
    $playerIdArr = explode(",", $playerId);
    foreach ($playerIdArr as $s) {
        $qb = $conn->createQueryBuilder();
        if (strtolower($s) == "all")
        {
            $qb->select("*")->from("tw_players");
        }
        else{
            $qb->select("*")->from("tw_players")->where("PlayerId = $s");
        }
        try {
            $result = $qb->executeQuery();
            while ($row = $result->fetchNumeric()) {
                $errorOccured = false;
                $exceptionMessage = "";
                try {
                    $firstName = $row[1];
                    $lastName = $row[2];
                    $age = $row[3];
                    $nationality = $row[4];
                    $position = $row[5];
                } catch (Exception $e) {
                    $errorOccured = true;
                    $exceptionMessage = "Following exception occured: " . $e->getMessage();
                }

                if ($errorOccured == false)
                {
                    $response .= buildResponse($firstName,$lastName,$age,$nationality,$position);
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

function buildResponse($firstName,$lastName,$age,$nationality,$position): bool|string
{

    $response['FirstName'] = $firstName;
    $response['LastName'] = $lastName;
    $response['Age'] = $age;
    $response['Nationality'] = $nationality;
    $response['Position'] = $position;

    return json_encode($response);
}