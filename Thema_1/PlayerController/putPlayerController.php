<?php
header("Content-Type:application/json");

// Function to edit and successfully update a player in the database.
function putPlayer($PlayerId,$PlayerFirstName,$PlayerLastName,$PlayerAge,$PlayerNationality,$PlayerPosition){
    try {
        include ("../db.php");
        if (checkIfPlayerExists($PlayerId, $con))
        {
            $stmt = $con->prepare("CALL tw_updatePlayer(?,?,?,?,?,?);");
            $stmt->bind_param("ississ", $PlayerId,$PlayerFirstName,$PlayerLastName,$PlayerAge,$PlayerNationality,$PlayerPosition);
            $stmt->execute();
            $stmt->close();

            echo "Player has successfully been updated!";
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

function checkIfPlayerExists($PlayerId, $con): bool
{
    try {
        $stmt = $con->prepare("CALL tw_getPlayers(?)");
        $stmt->bind_param("i", $PlayerId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if (mysqli_num_rows($result) > 0)
        {
            return true;
        }
        return false;
    }
    catch (mysqli_sql_exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
        return false;
    }
}
?>