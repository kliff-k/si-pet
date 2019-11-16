<?php

session_start();

if(!$_SESSION['si-pet-id'])
    $page = 'login';
else
    $page = $_GET['page']?$_GET['page']:'home';

$body   = execCurl("https://localhost/si-pet/pages/$page.php");
$main   = execCurl("https://localhost/si-pet/pages/main.php");
$main   = str_replace("{active-$page}", 'active', $main);
$main   = str_replace("{body}", $body, $main);

echo $main;

function execCurl ($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // Temp! For localhost testing only. TODO: Remove
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // Temp! For localhost testing only. TODO: Remove
    $output = curl_exec($ch);
    curl_close($ch);

    return $output;
}
