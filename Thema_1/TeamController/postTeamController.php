<?php
header("Content-Type:application/json");
function postTeam($TeamName,$TeamLeague) {
    try{
        include('../db.php');
        $stmt = $con->prepare("CALL tw_insertTeam(?,?);");
        $stmt->bind_param("ss", $TeamName,$TeamLeague);
        $stmt->execute();
        $stmt->close();

        echo "Team has successfully been inserted!";
    }
    catch(mysqli_sql_exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}