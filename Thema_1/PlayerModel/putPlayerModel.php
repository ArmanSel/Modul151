<?php
header("Content-Type:application/json");

// Handler for put request. Checks if PlayerId was entered in the URL.

if (isset($_GET['PlayerId']) && $_GET['PlayerId'] != "") {
    include('../PlayerController/putPlayerController.php');
    $PlayerId = $_GET["PlayerId"];
    $PlayerFirstName = $_GET["PlayerFirstName"];
    $PlayerLastName = $_GET["PlayerLastName"];
    $PlayerAge = $_GET["PlayerAge"];
    $PlayerNationality = $_GET["PlayerNationality"];
    $PlayerPosition = $_GET["PlayerPosition"];

    putPlayer($PlayerId,$PlayerFirstName,$PlayerLastName,$PlayerAge,$PlayerNationality,$PlayerPosition);
}