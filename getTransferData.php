<?php
header("Content-Type:application/json");
if (isset($_GET['TransferId']) && $_GET['TransferId']!="") {
    include('db.php');
    $transferId = $_GET['TransferId'];
    if (!is_numeric($transferId))
    {
        if (strtolower($transferId) != "all")
        {
            echo "Invalid input";
            return;
        }
    }
    $query = "SELECT * FROM `tw_v_transferOverview`";
    if (strtolower($transferId) != "all")
    {
        $query .= "WHERE TransferId IN ($transferId)";
    }
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result)>0){
        $counter = 0;
        $errorOccured = false;
        $exceptionMessage = "";
        while($counter < mysqli_num_rows($result))
        {
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
            }
            catch (Exception $e)
            {
                $errorOccured = true;
                $exceptionMessage = "Following exception occured: " . $e->getMessage();
            }
            response($firstName, $lastName, $age, $nationality, $position, $oldTeam, $newTeam, $transferFee, $errorOccured, $exceptionMessage);
            $counter++;
        }
        mysqli_close($con);
    }
    else
    {
        echo "No record found!";
    }
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
?>