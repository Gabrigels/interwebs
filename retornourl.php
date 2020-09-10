<?php
include_once("connect.php"); // conexão com o banco de dados

// $query = "SELECT * FROM `url`";
// $exec = mysqli_query($link, $query);

// while ($result = mysqli_fetch_assoc($exec)) {
//     $url = $result['url'];

//     $ch = curl_init($url);
//     curl_setopt($ch, CURLOPT_HEADER, true);
//     curl_setopt($ch, CURLOPT_NOBODY, false);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
//     curl_setopt($ch, CURLOPT_TIMEOUT,10);
//     $output = curl_exec($ch);
//     $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//     curl_close($ch);

//     mysqli_query($link, "UPDATE `url` SET corpo='{$output}', status='{$httpcode}', baixado=1 WHERE id = {$result['id']}");

// }

// echo "UPDATE `url` SET corpo='{$output}', status='{$httpcode}', baixado=1 WHERE id = {$result['id']}";

// $url = 'https://g1.globo.com/';

//     $ch = curl_init($url);
//     curl_setopt($ch, CURLOPT_HEADER, true);
//     curl_setopt($ch, CURLOPT_NOBODY, false);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
//     curl_setopt($ch, CURLOPT_TIMEOUT,10);
//     $output = curl_exec($ch);
//     $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//     curl_close($ch);

// echo "<pre>";
// print_r($httpcode);


/* Remove the execution time limit */
set_time_limit(0);

/* Iteration interval in seconds */
$sleep_time = 30;

while (TRUE)
{
   /* Sleep for the iteration interval */
   sleep($sleep_time);
   
   /* Print the time (to the console) */
   echo 'Time: ' . date('H:i:s');

   mysqli_query("INSERT INTO user SET name='teste', email='teste@teste.com', senha='mudar123'");
}
