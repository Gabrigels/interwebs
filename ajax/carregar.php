<?php
    include_once("../connect.php");

    $query_select = "SELECT * FROM `url` ORDER BY id DESC";
    $exec = mysqli_query($link, $query_select);

    while ($result = mysqli_fetch_assoc($exec)) {
        $url = str_replace("http://", "", $result['url']);
        $url = str_replace("https://", "", $result['url']);

        $retorno .= "<tr>
                                    <td>{$result['url']}</td>
                                    <td>{$result['corpo']}</td>
                                    <td>{$result['status']}</td>
                                    <td><img src='../img/editar.png' alt='Excluir' width='25' height='25' onclick='editar({$result['id']}, \"{$url}\")'></td>
                                    <td><img src='../img/excluir.png' alt='Excluir' width='25' height='25' onclick='excluir({$result['id']})'></td>
                                </tr>";
    }

    echo $retorno;
?>