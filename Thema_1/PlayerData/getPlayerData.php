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
        $stmt = $con->prepare("CALL tw_getPlayers(?);");
        $stmt->bind_param("s", $playerId);
        $stmt->execute();
        $result = $stmt->get_result();
        $counter = 0;
        while ($counter < mysqli_num_rows($result))
        {
            $errorOccured = false;
            $exceptionMessage = "";
            try {
                $row = mysqli_fetch_array($result);
                $firstName = $row['PlayerFirstName'];
                $lastName = $row['PlayerLastName'];
                $age = $row['PlayerAge'];
                $nationality = $row['PlayerNationality'];
                $position = $row['PlayerPosition'];
            } catch (Exception $e) {
                $errorOccured = true;
                $exceptionMessage = "Following exception occured: " . $e->getMessage();
            }
            response($firstName, $lastName, $age, $nationality, $position, $errorOccured, $exceptionMessage);
            $counter++;
        }
        $stmt->close();
    }
    else{
        $playerIdArr = explode(",", $playerId);
        foreach ($playerIdArr as $s) {
            $stmt = $con->prepare("CALL tw_getPlayers(?);");
            $stmt->bind_param("i", $s);
            $stmt->execute();
            $result = $stmt->get_result();
            if (mysqli_num_rows($result) > 0) {
                $errorOccured = false;
                $exceptionMessage = "";
                try {
                    $row = mysqli_fetch_array($result);
                    $firstName = $row['PlayerFirstName'];
                    $lastName = $row['PlayerLastName'];
                    $age = $row['PlayerAge'];
                    $nationality = $row['PlayerNationality'];
                    $position = $row['PlayerPosition'];
                } catch (Exception $e) {
                    $errorOccured = true;
                    $exceptionMessage = "Following exception occured: " . $e->getMessage();
                }
                response($firstName, $lastName, $age, $nationality, $position, $errorOccured, $exceptionMessage);
                $stmt->close();
            } else {
                echo "No record found!";
            }
        }
    }
    mysqli_close($con);
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