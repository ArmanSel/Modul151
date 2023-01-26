<?php
header("Content-Type:application/json");
// gets Players from database. Supports cases where "all" is entered to show every entry in the database.
function getPlayer($playerId){
    include('../db.php');
    if (!is_numeric($playerId) && strpos($playerId, ",") == false && strtolower($playerId) != "all") {
        echo "Invalid input";
        return;
    }

    $playersCollection = $client->m151->tw_players;

    if ($playerId == "all") {
        $counter = 0;
        while ($counter < $playersCollection->countDocuments()) {
            $playerResults = $playersCollection->find(
                ['PlayerId' => $counter + 1],
                ['projection' => ['PlayerFirstName' => 1, 'PlayerLastName' => 1, 'PlayerAge' => 1, 'PlayerNationality' => 1, 'PlayerPosition' => 1, '_id' => 0]]);

            foreach ($playerResults as $s) {
                $resultPlayerFirstName = $s['PlayerFirstName'];
                $resultPlayerLastName = $s['PlayerLastName'];
                $resultPlayerAge = $s['PlayerAge'];
                $resultPlayerNationality = $s['PlayerNationality'];
                $resultPlayerPosition = $s['PlayerPosition'];
            }

            if (isset($resultPlayerFirstName) && isset($resultPlayerLastName) && isset($resultPlayerAge) && isset($resultPlayerNationality) && isset($resultPlayerPosition))
            {
                response($resultPlayerFirstName, $resultPlayerLastName, $resultPlayerAge, $resultPlayerNationality, $resultPlayerPosition, false);
            }

            $counter++;
        }
    } else {
    $playerIds = explode(",", $playerId);
    foreach ($playerIds as $id) {
        settype($id, 'integer');
        $playerResults = $playersCollection->find(
            ['PlayerId' => $id],
            ['projection' => ['PlayerFirstName' => 1, 'PlayerLastName' => 1, 'PlayerAge' => 1, 'PlayerNationality' => 1, 'PlayerPosition' => 1, '_id' => 0]]);

        foreach ($playerResults as $s) {

            $resultPlayerFirstName = $s['PlayerFirstName'];
            $resultPlayerLastName = $s['PlayerLastName'];
            $resultPlayerAge = $s['PlayerAge'];
            $resultPlayerNationality = $s['PlayerNationality'];
            $resultPlayerPosition = $s['PlayerPosition'];
        }

        response($resultPlayerFirstName, $resultPlayerLastName, $resultPlayerAge, $resultPlayerNationality, $resultPlayerPosition, false);
    }
}

}
function response($playerFirstName,$playerLastName,$playerAge,$playerNationality,$playerPosition,$errorOccured,$exceptionMessage=null)
{
    if ($errorOccured == false) {
        $response['FirstName'] = $playerFirstName;
        $response['LastName'] = $playerLastName;
        $response['Age'] = $playerAge;
        $response['Nationality'] = $playerNationality;
        $response['Position'] = $playerPosition;

        $json_response = json_encode($response);
        echo $json_response;
    } else {
        echo $exceptionMessage;
    }
}