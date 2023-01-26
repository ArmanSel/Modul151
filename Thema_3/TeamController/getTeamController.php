<?php
header("Content-Type:application/json");
// gets Team from the Database.
function getTeam($teamId){
    include('../db.php');
    if (!is_numeric($teamId) && strpos($teamId, ",") == false && strtolower($teamId) != "all") {
        echo "Invalid input";
        return;
    }

    $teamsCollection = $client->m151->tw_teams;

    if ($teamId == "all") {
        $counter = 0;
        while ($counter < $teamsCollection->countDocuments()) {
            $teamResults = $teamsCollection->find(
                ['TeamId' => $counter + 1],
                ['projection' => ['TeamName' => 1, 'TeamLeague' => 1, '_id' => 0]]);

            foreach ($teamResults as $s) {
                $resultTeamName = $s['TeamName'];
                $resultTeamLeague = $s['TeamLeague'];
            }

            if (isset($resultTeamName) && isset($resultTeamLeague))
            {
                response($resultTeamName, $resultTeamLeague, false);
            }

            $counter++;
        }
    } else {
    $playerIds = explode(",", $teamId);
    foreach ($playerIds as $id) {
        settype($id, 'integer');
        $teamResults = $teamsCollection->find(
            ['TeamId' => $id],
            ['projection' => ['TeamName' => 1, 'TeamLeague' => 1, '_id' => 0]]);

        foreach ($teamResults as $s) {
            $resultTeamName = $s['TeamName'];
            $resultTeamLeague = $s['TeamLeague'];
        }

        if (isset($resultTeamName) && isset($resultTeamLeague)) {
            response($resultTeamName, $resultTeamLeague, false);
        }
    }
}

}
function response($teamName,$teamLeague,$errorOccured)
{
    if ($errorOccured == false) {
        $response['TeamName'] = $teamName;
        $response['TeamLeague'] = $teamLeague;

        $json_response = json_encode($response);
        echo $json_response;
    }
}