<?php
header("Content-Type:application/json");
if (isset($_GET['TeamName']) && $_GET['TeamName'] != "") {
    include('../db.php');
    $TeamName = $_GET["TeamName"];
    $TeamLeague = $_GET["TeamLeague"];
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
?>