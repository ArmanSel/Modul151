<?php
header("Content-Type:application/json");
if (isset($_GET['TransferId']) && $_GET['TransferId']!="") {
    include('db.php');
    $TransferId = $_GET['TransferId'];
    $result = mysqli_query(
        $con,
        "SELECT * FROM `tw_v_transferOverview` WHERE TransferId=$TransferId");
    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_array($result);
        $firstName = $row['First Name'];
        $lastName = $row['Last Name'];
        $age = $row['Age'];
        $nationality = $row['Nationality'];
        $position = $row['Position'];
        $oldTeam = $row['Old Team'];
        $newTeam = $row['New Team'];
        $transferFee = $row['Transfer Fee'];
        response($firstName, $lastName, $age, $nationality, $position, $oldTeam, $newTeam, $transferFee);
        mysqli_close($con);
    }
}

function response($firstName,$lastName,$age,$nationality,$position,$oldTeam,$newTeam,$transferFee){
    $response['FirstName'] = $firstName;
    $response['LastName'] = $lastName;
    $response['Age'] = $age;
    $response['Nationality'] = $nationality;
    $response['Position'] = $position;
    $response['OldTeam'] = $oldTeam;
    $response['NewTeam'] = $newTeam;
    if ($transferFee != "Free")
    {
        if ($transferFee > 1000000000000) $response['TransferFee'] = round(($transferFee/1000000000000), 2).' trillion';
        elseif ($transferFee > 1000000000) $response['TransferFee'] = round(($transferFee/1000000000), 2).' billion';
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
?>