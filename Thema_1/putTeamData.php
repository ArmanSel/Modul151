<?php
header("Content-Type:application/json");
if (isset($_GET['TeamId']) && $_GET['TeamId'] != "") {
    include('db.php');
    $TeamId = $_GET["TeamId"];
    $TeamName = $_GET["TeamName"];
    $TeamLeague = $_GET["TeamLeague"];
    try {
        $stmt = $con->prepare("CALL tw_getTeams(?)");
        $stmt->bind_param("i", $TeamId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if (mysqli_num_rows($result) > 0)
        {
            $stmt = $con->prepare("CALL tw_updateTeam(?,?,?);");
            $stmt->bind_param("iss", $TeamId,$TeamName,$TeamLeague);
            $stmt->execute();
            $stmt->close();

            echo "Transfer has successfully been updated!";
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
?>