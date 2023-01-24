<?php
header("Content-Type:application/json");
function getTransfer($transferId){
    include('../db.php');
    if (!is_numeric($transferId) && strpos($transferId, ",") == false && strtolower($transferId) != "all") {
        echo "Invalid input";
        return;
    }

    $transfersCollection = $client->m151->tw_transfers;
    $playersCollection = $client->m151->tw_players;
    $teamsCollection = $client->m151->tw_teams;

    if ($transferId == "all") {
        $counter = 0;
        while ($counter < $transfersCollection->countDocuments()) {
            $transferResults = $transfersCollection->find(
                ['TransferId' => $counter + 1],
                ['projection' => ['PlayerId' => 1, 'OldTeamId' => 1, 'NewTeamId' => 1, 'TransferSum' => 1, '_id' => 0]]);

            foreach ($transferResults as $s) {
                $resultPlayerId = $s['PlayerId'];
                $resultOldTeamId = $s['OldTeamId'];
                $resultNewTeamId = $s['NewTeamId'];
                $resultTransferSum = $s['TransferSum'];

                $playersResults = $playersCollection->find(
                    ['PlayerId' => $resultPlayerId],
                    ['projection' => ['PlayerFirstName' => 1, 'PlayerLastName' => 1, 'PlayerAge' => 1, 'PlayerNationality' => 1, 'PlayerPosition' => 1, '_id' => 0]]
                );

                foreach ($playersResults as $p) {
                    $resultFirstName = $p['PlayerFirstName'];
                    $resultLastName = $p['PlayerLastName'];
                    $resultAge = $p['PlayerAge'];
                    $resultNationality = $p['PlayerNationality'];
                    $resultPosition = $p['PlayerPosition'];
                }

                $oldTeamResult = $teamsCollection->find(
                    ['TeamId' => $resultOldTeamId],
                    ['projection' => ['TeamName' => 1, '_id' => 0]]
                );
                foreach ($oldTeamResult as $ot) {
                    $resultOldTeam = $ot['TeamName'];
                }

                $newTeamResult = $teamsCollection->find(
                    ['TeamId' => $resultNewTeamId],
                    ['projection' => ['TeamName' => 1, '_id' => 0]]
                );
                foreach ($newTeamResult as $nt) {
                    $resultNewTeam = $nt['TeamName'];
                }
                if (isset($resultFirstName) && isset($resultLastName) && isset($resultAge) && isset($resultNationality) && isset($resultPosition)
                    && isset($resultOldTeam) && isset($resultNewTeam) && isset($resultTransferSum))
                {
                    response($resultFirstName, $resultLastName, $resultAge, $resultNationality, $resultPosition, $resultOldTeam, $resultNewTeam, $resultTransferSum, false);
                }
            }
            $counter++;
        }

    } else {
        $transferIds = explode(",", $transferId);
        foreach ($transferIds as $id) {
            settype($id, 'integer');
            $transferResults = $transfersCollection->find(
                ['TransferId' => $id],
                ['projection' => ['PlayerId' => 1, 'OldTeamId' => 1, 'NewTeamId' => 1, 'TransferSum' => 1, '_id' => 0]]);

            foreach ($transferResults as $s) {

                $resultPlayerId = $s['PlayerId'];
                $resultOldTeamId = $s['OldTeamId'];
                $resultNewTeamId = $s['NewTeamId'];
                $resultTransferSum = $s['TransferSum'];

                $playersResults = $playersCollection->find(
                    ['PlayerId' => $resultPlayerId],
                    ['projection' => ['PlayerFirstName' => 1, 'PlayerLastName' => 1, 'PlayerAge' => 1, 'PlayerNationality' => 1, 'PlayerPosition' => 1, '_id' => 0]]
                );

                foreach ($playersResults as $p) {
                    $resultFirstName = $p['PlayerFirstName'];
                    $resultLastName = $p['PlayerLastName'];
                    $resultAge = $p['PlayerAge'];
                    $resultNationality = $p['PlayerNationality'];
                    $resultPosition = $p['PlayerPosition'];
                }

                $oldTeamResult = $teamsCollection->find(
                    ['TeamId' => $resultOldTeamId],
                    ['projection' => ['TeamName' => 1, '_id' => 0]]
                );
                foreach ($oldTeamResult as $ot) {
                    $resultOldTeam = $ot['TeamName'];
                }

                $newTeamResult = $teamsCollection->find(
                    ['TeamId' => $resultNewTeamId],
                    ['projection' => ['TeamName' => 1, '_id' => 0]]
                );
                foreach ($newTeamResult as $nt) {
                    $resultNewTeam = $nt['TeamName'];
                }

                if (isset($resultFirstName) && isset($resultLastName) && isset($resultAge) && isset($resultNationality) && isset($resultPosition)
                    && isset($resultOldTeam) && isset($resultNewTeam) && isset($resultTransferSum))
                {
                    response($resultFirstName, $resultLastName, $resultAge, $resultNationality, $resultPosition, $resultOldTeam, $resultNewTeam, $resultTransferSum, false);
                }
            }
        }
    }
}
function response($firstName,$lastName,$age,$nationality,$position,$oldTeam,$newTeam,$transferFee,$errorOccured,$exceptionMessage=null)
{
    if ($errorOccured == false) {
        $response['FirstName'] = $firstName;
        $response['LastName'] = $lastName;
        $response['Age'] = $age;
        $response['Nationality'] = $nationality;
        $response['Position'] = $position;
        $response['OldTeam'] = $oldTeam;
        $response['NewTeam'] = $newTeam;
        if ($transferFee != 0) {
            if ($transferFee > 1000000000) $response['TransferFee'] = round(($transferFee / 1000000000), 2) . ' billion';
            elseif ($transferFee > 1000000) $response['TransferFee'] = round(($transferFee / 1000000), 2) . ' million';
            elseif ($transferFee > 1000) $response['TransferFee'] = round(($transferFee / 1000), 2) . ' thousand';
        } else {
            $response['TransferFee'] = "Free";
        }


        $json_response = json_encode($response);
        echo $json_response;
    } else {
        echo $exceptionMessage;
    }
}