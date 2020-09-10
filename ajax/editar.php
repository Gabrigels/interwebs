<?php
    include_once("../connect.php");
    $url = $_POST["url"];
    $usuario = $_POST["usuario"];
    $id = $_POST["id"];

    $retorno = "";

    $query_insert = "UPDATE `url` SET `url` = '{$url}' WHERE id = {$id}";

    mysqli_query($link, $query_insert);

    if (mysqli_affected_rows($link)) {
        include("carregar.php");
    } else {
        echo 1;
    }

?>