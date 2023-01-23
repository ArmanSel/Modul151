<?php
header("Content-Type:application/json");
function getPlayer($playerId): ?string
{
    include("../db.php");
    if(!is_numeric($playerId) && !strpos($playerId, ",") && strtolower($playerId) != "all")
    {
        echo "Invalid input";
        return null;
    }
    $response = null;
    $playerIdArr = explode(",", $playerId);
    foreach ($playerIdArr as $s) {
        $stmt = $con->prepare("CALL tw_getPlayers(?);");
        $stmt->bind_param("s", $s);
        $stmt->execute();
        $result = $stmt->get_result();
        if (mysqli_num_rows($result) > 0) {
            while(($row = mysqli_fetch_row($result)) != null)
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

                if (!$errorOccured)
                {
                    $response .= buildResponse($firstName,$lastName,$age,$nationality,$position);
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

function buildResponse($firstName,$lastName,$age,$nationality,$position): bool|string
{
        $response['FirstName'] = $firstName;
        $response['LastName'] = $lastName;
        $response['Age'] = $age;
        $response['Nationality'] = $nationality;
        $response['Position'] = $position;

        return json_encode($response);
}