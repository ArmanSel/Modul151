<?php

function deletePlayer($playerId)
{
    try{
        include('../db.php');
        $stmt = $con->prepare("CALL tw_deletePlayer(?);");
        $stmt->bind_param("i", $playerId);
        $stmt->execute();
        $stmt->close();

        echo "Player has successfully been deleted!";
    }
    catch(mysqli_sql_exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}