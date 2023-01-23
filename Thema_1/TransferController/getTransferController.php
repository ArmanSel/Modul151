<?php
header("Content-Type:application/json");
function getTransfer($transferId): ?string
{
    include('../db.php');
    if(!is_numeric($transferId) && strpos($transferId, ",") == false && strtolower($transferId) != "all") {
        echo "Invalid input";
        return null;
    }
    $response = null;
    $transferIdArr = explode(",", $transferId);
    foreach ($transferIdArr as $s) {
        $stmt = $con->prepare("CALL tw_getTransfers(?);");
        $stmt->bind_param("s", $s);
        $stmt->execute();
        $result = $stmt->get_result();
        if (mysqli_num_rows($result) > 0) {
            while(($row = mysqli_fetch_row($result)) != null){
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

                if ($errorOccured == false)
                {
                    $response .= buildResponse($firstName,$lastName,$age,$nationality,$position,$oldTeam,$newTeam,$transferFee);
                }
                else
                {
                    echo $exceptionMessage;
                }
            }
            $stmt->close();
        } else {
            echo "No record found!";
        }
    }
    mysqli_close($con);
    return $response;
}

function buildResponse($firstName,$lastName,$age,$nationality,$position,$oldTeam,$newTeam,$transferFee,): bool|string
{
    $response['FirstName'] = $firstName;
    $response['LastName'] = $lastName;
    $response['Age'] = $age;
    $response['Nationality'] = $nationality;
    $response['Position'] = $position;
    $response['OldTeam'] = $oldTeam;
    $response['NewTeam'] = $newTeam;
    if ($transferFee != "Free")
    {
        if ($transferFee > 1000000000) $response['TransferFee'] = round(($transferFee/1000000000), 2).' billion';
        elseif ($transferFee > 1000000) $response['TransferFee'] = round(($transferFee/1000000), 2).' million';
        elseif ($transferFee > 1000) $response['TransferFee'] = round(($transferFee/1000), 2).' thousand';
    }
    else
    {
        $response['TransferFee'] = $transferFee;
    }

    return json_encode($response);
}