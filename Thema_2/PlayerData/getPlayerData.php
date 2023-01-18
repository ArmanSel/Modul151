<?php
header("Content-Type:application/json");
if (isset($_GET['PlayerId']) && $_GET['PlayerId']!="") {
    include('../db.php');
    $playerId = $_GET['PlayerId'];
    if(!is_numeric($playerId)){
        if (strpos($playerId, ",") == false){
            if (strtolower($playerId) != "all")
            {
                echo "Invalid input";
                return;
            }
        }
    }
    if ($playerId == "all")
    {
        $qb = $conn->createQueryBuilder();
        $qb->select("*")->from("tw_players");
        try {
            $result = $qb->executeQuery();
            while ($row = $result->fetchNumeric())
            {
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
                response($firstName, $lastName, $age, $nationality, $position, $errorOccured, $exceptionMessage);
            }
        } catch (\Doctrine\DBAL\Exception $e) {
            echo "Following exception occured: " . $e->getMessage();
        }
    }
    else{
        $playerIdArr = explode(",", $playerId);
        foreach ($playerIdArr as $s) {
            $qb = $conn->createQueryBuilder();
            $qb->select("*")->from("tw_players")->where("PlayerId = $s");
            try {
                $result = $qb->executeQuery();
                if ($row = $result->fetchNumeric()) {
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
                    response($firstName, $lastName, $age, $nationality, $position, $errorOccured, $exceptionMessage);
                } else {
                    echo "No record found!";
                }
            } catch (\Doctrine\DBAL\Exception $e) {
                echo "Following exception occured: " . $e->getMessage();
            }
        }
    }
}

function response($firstName,$lastName,$age,$nationality,$position,$errorOccured,$exceptionMessage=null){
    if ($errorOccured == false)
    {
        $response['FirstName'] = $firstName;
        $response['LastName'] = $lastName;
        $response['Age'] = $age;
        $response['Nationality'] = $nationality;
        $response['Position'] = $position;

        $json_response = json_encode($response);
        echo $json_response;
    }
    else
    {
        echo $exceptionMessage;
    }
}