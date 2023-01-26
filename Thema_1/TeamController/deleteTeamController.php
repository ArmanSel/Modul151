<?php
header("Content-Type:application/json");

// Function to delete a team.
function deleteTeam($TeamId){
    try {
        include ("../db.php");
        $stmt = $con->prepare("CALL tw_deleteTeam(?);");
        $stmt->bind_param("i", $TeamId);
        $stmt->execute();
        $stmt->close();

        echo "Team has successfully been deleted!";
    }
    catch(mysqli_sql_exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}