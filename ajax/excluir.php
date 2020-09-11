<?php
    error_reporting(0);
    include_once("../connect.php");
    $id = $_POST["id"];

    $query_insert = "DELETE FROM `url` WHERE id = '{$id}'";
    mysqli_query($link, $query_insert);

    if (mysqli_affected_rows($link)) {
        include("carregar.php");
    } else {
        echo 1;
    }
?>