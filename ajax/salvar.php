<?php
    include_once("../connect.php");
    $url = $_POST["url"];
    $usuario = $_POST["usuario"];

    $retorno = "";

    $query_insert = "INSERT INTO `url` SET `url` = '{$url}', usuario = '{$usuario}'";

    mysqli_query($link, $query_insert);

    if (mysqli_affected_rows($link)) {
        include("carregar.php");
    } else {
        echo 1;
    }

?>