<?php
header("Content-Type:application/json");
if (isset($_GET['TransferId']) && $_GET['TransferId'] != "") {
    include('../db.php');
    $transferId = $_GET['TransferId'];
    if (!is_numeric($transferId)) {
        if (strpos($transferId, ",") == false) {
            if (strtolower($transferId) != "all") {
                echo "Invalid input";
                return;
            }
        }
    }

    if ($transferId == "all") {
        $qb = $conn->createQueryBuilder();
        $qb->select("*")->from("tw_v_transferOverview");
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
                    $oldTeam = $row[6];
                    $newTeam = $row[7];
                    $transferFee = $row[8];
                } catch (Exception $e) {
                    $errorOccured = true;
                    $exceptionMessage = "Following exception occured: " . $e->getMessage();
                }

                response($firstName, $lastName, $age, $nationality, $position, $oldTeam, $newTeam, $transferFee, $errorOccured, $exceptionMessage);
            }
        } catch (\Doctrine\DBAL\Exception $e) {
            echo "Following exception occured: " . $e->getMessage();
        }
    } else {
        $transferIdArr = explode(",", $transferId);
        foreach ($transferIdArr as $s) {
            $qb = $conn->createQueryBuilder();
            $qb->select("*")->from("tw_v_transferOverview")->where("TransferId = $s");
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
                        $oldTeam = $row[6];
                        $newTeam = $row[7];
                        $transferFee = $row[8];
                    } catch (Exception $e) {
                        $errorOccured = true;
                        $exceptionMessage = "Following exception occured: " . $e->getMessage();
                    }
                    response($firstName, $lastName, $age, $nationality, $position, $oldTeam, $newTeam, $transferFee, $errorOccured, $exceptionMessage);
                } else {
                    echo "No record found!";
                }
            } catch (\Doctrine\DBAL\Exception $e) {
                echo "Following exception occured: " . $e->getMessage();
            }
        }
    }
}

function response($firstName, $lastName, $age, $nationality, $position, $oldTeam, $newTeam, $transferFee, $errorOccured, $exceptionMessage = null)
{
    if ($errorOccured == false) {
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


        $json_response = json_encode($response);
        echo $json_response;
    } else {
        echo $exceptionMessage;
    }
}