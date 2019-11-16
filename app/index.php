<?php

$page = $_GET['page']?$_GET['page']:'home';

$body   = execCurl("http://localhost/si-pet/pages/$page.php");
$main   = execCurl("http://localhost/si-pet/pages/main.php");
$main   = str_replace("{active-$page}", 'active', $main);
$main   = str_replace("{body}", $body, $main);

echo $main;

function execCurl ($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);

    return $output;
}
