<?php
header("Content-Type:application/json");
function getTransfer($transferId){
    include('../db.php');
    if (!is_numeric($transferId) && strpos($transferId, ",") == false && strtolower($transferId) != "all") {
        echo "Invalid input";
        return;
    }
    $response = null;
    $transferIdArr = explode(",", $transferId);
    foreach ($transferIdArr as $s) {
        $qb = $conn->createQueryBuilder();
        if (strtolower($s) == "all")
        {
            $qb->select("*")->from("tw_v_transferOverview");
        }
        else{
            $qb->select("*")->from("tw_v_transferOverview")->where("TransferId = $s");
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
                    $oldTeam = $row[6];
                    $newTeam = $row[7];
                    $transferFee = $row[8];
                } catch (Exception $e) {
                    $errorOccured = true;
                    $exceptionMessage = "Following exception occured: " . $e->getMessage();
                }

                if ($errorOccured == false) {

                    $response .= buildResponse($firstName,$lastName,$age,$nationality,$position,$oldTeam,$newTeam,$transferFee);

                } else {
                    echo $exceptionMessage;
                }
            }
        } catch (\Doctrine\DBAL\Exception $e) {
            echo "Following exception occured: " . $e->getMessage();
        }
    }
    return $response;
}

function buildResponse($firstName, $lastName, $age, $nationality, $position, $oldTeam, $newTeam, $transferFee): bool|string
{
        $response['FirstName'] = $firstName;
        $response['LastName'] = $lastName;
        $response['Age'] = $age;
        $response['Nationality'] = $nationality;
        $response['Position'] = $position;
        $response['OldTeam'] = $oldTeam;
        $response['NewTeam'] = $newTeam;
        if ($transferFee != "Free") {
            if ($transferFee > 1000000000) $response['TransferFee'] = round(($transferFee / 1000000000), 2) . ' billion';
            elseif ($transferFee > 1000000) $response['TransferFee'] = round(($transferFee / 1000000), 2) . ' million';
            elseif ($transferFee > 1000) $response['TransferFee'] = round(($transferFee / 1000), 2) . ' thousand';
        } else {
            $response['TransferFee'] = $transferFee;
        }


        return json_encode($response);
}