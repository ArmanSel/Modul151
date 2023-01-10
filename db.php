<?php

$con = mysqli_connect("127.0.0.1:3306", "root", "", "m151");
if (mysqli_connect_errno()){
    echo "Connection to Database failed. Following error occured: " . mysqli_connect_error();
    die();
}