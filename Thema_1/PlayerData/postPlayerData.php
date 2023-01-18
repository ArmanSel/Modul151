<?php
header("Content-Type:application/json");
if (isset($_GET['PlayerFirstName']) && $_GET['PlayerFirstName'] != "") {
    include('../db.php');
    $PlayerFirstName = $_GET["PlayerFirstName"];
    $PlayerLastName = $_GET["PlayerLastName"];
    $PlayerAge = $_GET["PlayerAge"];
    $PlayerNationality = $_GET["PlayerNationality"];
    $PlayerPosition = $_GET["PlayerPosition"];
    try{
        $stmt = $con->prepare("CALL tw_insertPlayer(?,?,?,?,?);");
        $stmt->bind_param("ssiss", $PlayerFirstName,$PlayerLastName,$PlayerAge,$PlayerNationality,$PlayerPosition);
        $stmt->execute();
        $stmt->close();

        echo "Player has successfully been inserted!";
    }
    catch(mysqli_sql_exception $e)
    {
        echo "A exception occured: " . $e->getMessage();
    }
}
?>