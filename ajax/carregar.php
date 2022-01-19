<?php
    error_reporting(0);
    include_once("../connect.php");

    $query_select = "SELECT * FROM `url` ORDER BY id DESC";
    $exec = mysqli_query($link, $query_select);

    while ($result = mysqli_fetch_assoc($exec)) {
        $pos = strpos($result['url'], "http");

        if ($pos === false) {
            $url = substr($result['url'], 8);
        } else {
            $url = substr($result['url'], 7);
        }

        $retorno .= "<tr>
                                    <td>{$result['url']}</td>
                                    <td>{$result['corpo']}</td>
                                    <td>{$result['status']}</td>
                                    <td><button class='btn btn-primary' alt='Excluir' width='25' height='25' onclick='editar({$result['id']}, \"{$url}\")'>Editar</button></td>
                                    <td><button class='btn btn-danger' alt='Excluir' width='25' height='25' onclick='excluir({$result['id']})'>Excluir</button></td>
                                </tr>";
    }

    echo $retorno;
?>