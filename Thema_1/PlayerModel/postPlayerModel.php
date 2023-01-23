<?php
header("Content-Type:application/json");
if (isset($_GET['PlayerFirstName']) && $_GET['PlayerFirstName'] != "") {
    include('../PlayerController/postPlayerController.php');
    $PlayerFirstName = $_GET["PlayerFirstName"];
    $PlayerLastName = $_GET["PlayerLastName"];
    $PlayerAge = $_GET["PlayerAge"];
    $PlayerNationality = $_GET["PlayerNationality"];
    $PlayerPosition = $_GET["PlayerPosition"];

    postPlayer($PlayerFirstName,$PlayerLastName,$PlayerAge,$PlayerNationality,$PlayerPosition);

    echo "Player has successfully been inserted!";
}
?>