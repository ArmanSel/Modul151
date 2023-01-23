<?php
header("Content-Type:application/json");
function postPlayer($PlayerFirstName,$PlayerLastName,$PlayerAge,$PlayerNationality,$PlayerPosition){
    include ("../db.php");
    try{
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