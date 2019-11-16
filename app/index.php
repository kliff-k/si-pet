<?php

session_start();

if(!$_SESSION['si-pet-id'])
    $page = 'login';
else
    $page = $_GET['page']?$_GET['page']:'home';

$body   = file_get_contents("../pages/$page.html");
$main   = file_get_contents("../pages/main.html");
$main   = str_replace("{active-$page}", 'active', $main);
$main   = str_replace("{body}", $body, $main);

echo $main;
