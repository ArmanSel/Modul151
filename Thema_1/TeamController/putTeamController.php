<?php
header("Content-Type:application/json");
function putTeam($TeamId,$TeamName,$TeamLeague){
    try {
        include('../db.php');
        if (checkIfTeamExists($TeamId, $con))
        {
            $stmt = $con->prepare("CALL tw_updateTeam(?,?,?);");
            $stmt->bind_param("iss", $TeamId,$TeamName,$TeamLeague);
            $stmt->execute();
            $stmt->close();

            echo "Team has successfully been updated!";
        }
        else
        {
            echo "No entry was found in the Database";
        }
    }
    catch(mysqli_sql_exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}

function checkIfTeamExists($TeamId, $con): bool
{
    try {
        $stmt = $con->prepare("CALL tw_getTeams(?)");
        $stmt->bind_param("i", $TeamId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if(mysqli_num_rows($result) > 0)
        {
            return true;
        }
        return false;
    }
    catch(mysqli_sql_exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
        return false;
    }
}