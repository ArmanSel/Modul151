<?php
header("Content-Type:application/json");
function getTeam($teamId): ?string
{
    include('../db.php');
    if(!is_numeric($teamId) && strpos($teamId, ",") == false && strtolower($teamId) != "all")
    {
       echo "Invalid input";
       return null;
    }
    $response = null;
    $teamIdArr = explode(",", $teamId);
    foreach ($teamIdArr as $s) {
        $stmt = $con->prepare("CALL tw_getTeams(?);");
        $stmt->bind_param("s", $s);
        $stmt->execute();
        $result = $stmt->get_result();
        if (mysqli_num_rows($result) > 0) {
            while(($row = mysqli_fetch_row($result)) != null) {
                $errorOccured = false;
                $exceptionMessage = "";
                try {
                    $teamName = $row[1];
                    $teamLeague = $row[2];
                } catch (Exception $e) {
                    $errorOccured = true;
                    $exceptionMessage = "Following exception occured: " . $e->getMessage();
                }

                if ($errorOccured == false) {
                    $response .= buildResponse($teamName, $teamLeague);
                } else {
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

function buildResponse($teamName,$teamLeague): bool|string
{

        $response['TeamName'] = $teamName;
        $response['TeamLeague'] = $teamLeague;

        return json_encode($response);
}