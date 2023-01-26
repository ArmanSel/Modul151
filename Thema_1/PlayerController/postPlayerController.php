<?php
header("Content-Type:application/json");

// Function to create a new player in the database.
function postPlayer($PlayerFirstName,$PlayerLastName,$PlayerAge,$PlayerNationality,$PlayerPosition){
    try{
        include ("../db.php");
        $stmt = $con->prepare("CALL tw_insertPlayer(?,?,?,?,?);");
        $stmt->bind_param("ssiss", $PlayerFirstName,$PlayerLastName,$PlayerAge,$PlayerNationality,$PlayerPosition);
        $stmt->execute();
        $stmt->close();
    }
    catch(mysqli_sql_exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}