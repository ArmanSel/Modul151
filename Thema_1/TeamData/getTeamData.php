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
        $stmt = $con->prepare("CALL tw_getTeams(?);");
        $stmt->bind_param("s", $teamId);
        $stmt->execute();
        $result = $stmt->get_result();
        $counter = 0;
        while ($counter < mysqli_num_rows($result))
        {
            $errorOccured = false;
            $exceptionMessage = "";
            try {
                $row = mysqli_fetch_array($result);
                $teamName = $row['TeamName'];
                $teamLeague = $row['TeamLeague'];
            } catch (Exception $e) {
                $errorOccured = true;
                $exceptionMessage = "Following exception occured: " . $e->getMessage();
            }
            response($teamName, $teamLeague, $errorOccured, $exceptionMessage);
            $counter++;
        }
        $stmt->close();
    }
    else{
        $teamIdArr = explode(",", $teamId);
        foreach ($teamIdArr as $s) {
            $stmt = $con->prepare("CALL tw_getTeams(?);");
            $stmt->bind_param("i", $s);
            $stmt->execute();
            $result = $stmt->get_result();
            if (mysqli_num_rows($result) > 0) {
                $errorOccured = false;
                $exceptionMessage = "";
                try {
                    $row = mysqli_fetch_array($result);
                    $teamName = $row['TeamName'];
                    $teamLeague = $row['TeamLeague'];
                } catch (Exception $e) {
                    $errorOccured = true;
                    $exceptionMessage = "Following exception occured: " . $e->getMessage();
                }
                response($teamName, $teamLeague, $errorOccured, $exceptionMessage);
                $stmt->close();
            } else {
                echo "No record found!";
            }
        }
    }
    mysqli_close($con);
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