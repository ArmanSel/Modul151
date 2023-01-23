<?php
header("Content-Type:application/json");
function putTeam($TeamId,$TeamName,$TeamLeague){
    include('../db.php');
    try {
        if (checkIfTeamExists($TeamId, $con) > 0)
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

function checkIfTeamExists($TeamId, $con)
{
    try {
        $stmt = $con->prepare("CALL tw_getTeams(?)");
        $stmt->bind_param("i", $TeamId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return mysqli_num_rows($result);
    }
    catch(mysqli_sql_exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}
?>