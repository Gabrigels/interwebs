<?php
include_once("connect.php"); // conexão com o banco de dados

$query = "SELECT * FROM `url` WHERE baixado = 0";
$exec = mysqli_query($link, $query);

while ($result = mysqli_fetch_assoc($exec)) {
    $url = $result['url'];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_TIMEOUT,10);
    $output = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    mysqli_query($link, "UPDATE `url` SET corpo='{$output}', status='{$httpcode}', baixado=1, data_baixa=NOW() WHERE id = {$result['id']}");
}