<?php
header("Content-Type:application/json");
function postTeam($TeamName,$TeamLeague) {
    include('../db.php');
    try{
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