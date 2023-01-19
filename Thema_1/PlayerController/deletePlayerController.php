<?php

include('../db.php');

function deletePlayer($playerId){
    try{
        $stmt = $con->prepare("CALL tw_deletePlayer(?);");
        $stmt->bind_param("i", $playerId);
        $stmt->execute();
        $stmt->close();
    }
    catch(mysqli_sql_exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}

?>