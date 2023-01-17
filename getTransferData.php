<?php
header("Content-Type:application/json");
if (isset($_GET['TransferId']) && $_GET['TransferId']!="") {
    include('db.php');
    $transferId = $_GET['TransferId'];
    if(!is_numeric($transferId)){
        if (strpos($transferId, ",") == false){
            if (strtolower($transferId) != "all")
            {
                echo "Invalid input";
                return;
            }
        }
    }
    if ($transferId == "all")
    {
        $stmt = $con->prepare("CALL tw_getTransfers(?);");
        $stmt->bind_param("s", $transferId);
        $stmt->execute();
        $result = $stmt->get_result();
        $counter = 0;
        while ($counter < mysqli_num_rows($result))
        {
            $errorOccured = false;
            $exceptionMessage = "";
            try {
                $row = mysqli_fetch_array($result);
                $firstName = $row['First Name'];
                $lastName = $row['Last Name'];
                $age = $row['Age'];
                $nationality = $row['Nationality'];
                $position = $row['Position'];
                $oldTeam = $row['Old Team'];
                $newTeam = $row['New Team'];
                $transferFee = $row['Transfer Fee'];
            } catch (Exception $e) {
                $errorOccured = true;
                $exceptionMessage = "Following exception occured: " . $e->getMessage();
            }
            response($firstName, $lastName, $age, $nationality, $position, $oldTeam, $newTeam, $transferFee, $errorOccured, $exceptionMessage);
            $counter++;
        }
        $stmt->close();
    }
    else{
        $transferIdArr = explode(",", $transferId);
        foreach ($transferIdArr as $s) {
            $stmt = $con->prepare("CALL tw_getTransfers(?);");
            $stmt->bind_param("i", $s);
            $stmt->execute();
            $result = $stmt->get_result();
            if (mysqli_num_rows($result) > 0) {
                $errorOccured = false;
                $exceptionMessage = "";
                try {
                    $row = mysqli_fetch_array($result);
                    $firstName = $row['First Name'];
                    $lastName = $row['Last Name'];
                    $age = $row['Age'];
                    $nationality = $row['Nationality'];
                    $position = $row['Position'];
                    $oldTeam = $row['Old Team'];
                    $newTeam = $row['New Team'];
                    $transferFee = $row['Transfer Fee'];
                } catch (Exception $e) {
                    $errorOccured = true;
                    $exceptionMessage = "Following exception occured: " . $e->getMessage();
                }
                response($firstName, $lastName, $age, $nationality, $position, $oldTeam, $newTeam, $transferFee, $errorOccured, $exceptionMessage);
                $stmt->close();
            } else {
                echo "No record found!";
            }
        }
    }
    mysqli_close($con);
}

function response($firstName,$lastName,$age,$nationality,$position,$oldTeam,$newTeam,$transferFee,$errorOccured,$exceptionMessage=null){
    if ($errorOccured == false)
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



        $json_response = json_encode($response);
        echo $json_response;
    }
    else
    {
        echo $exceptionMessage;
    }
}